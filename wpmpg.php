<?php
/*
Contributors: WebVyz
Plugin Name: WPmpg
Plugin URI: http://WPmpg.com
Description: Enable WPmpg.com features
Author: James Bowery
Author URI: http://jimbowery.blogspot.com
Version: 1.2
Requires at least: 3.0
Tested up to: 3.2.1
*/

/**
 * Create new author.
 *
 * @since 3.0
 *
 * @param array $args Method parameters.
 * @return int user ID.
 */
function wp_newAuthor($args) {
	global $wp_xmlrpc_server;
	$wp_xmlrpc_server->escape($args);

	$blog_id				= (int) $args[0];
	$username				= $args[1];
	$password				= $args[2];
	$author          			= $args[3];

	if ( !$user = $wp_xmlrpc_server->login($username, $password) )
		return $wp_xmlrpc_server->error;

	do_action('xmlrpc_call', 'wp.newAuthor');

	// Make sure the user is allowed to create a user.
	if ( !current_user_can("create_users") )
		return(new IXR_Error(401, __("Sorry, you do not have the right to create users.")));

	$new_user = array(
		"user_login"		=> $author['user_login'],
		"user_pass"		=> $author['user_pass'],
		"user_email"		=> $author['user_email'],
		"display_name"		=> $author['display_name'],
		"user_pass"             => $password,
		"role"                  => 'author',
	);

	$user_id = wp_insert_user($new_user, true);
	if ( is_wp_error( $user_id ) ) {
		if ( 'term_exists' == $user_id->get_error_code() )
			return (int) $user_id->get_error_data();
		else
			return(new IXR_Error(500, __("Sorry, the new user failed.")));
	} elseif ( ! $user_id ) {
		return(new IXR_Error(500, __("Sorry, the new user failed.")));
	}

	return($user_id);
}


/**
 * Appends author functions to the XML-RPC Interface
 * @param array $methods XML-RPC allowed methods
 * returns array
 */
function authorxmlrpc_methods($methods) {
	$methods['wp.newAuthor']		= 'wp_newAuthor';
	return $methods;
}


/**
 * includes WPmpg analytics code
 *
 * @since 3.0
 *
 * @param none
 * returns none
 */
function wpmpg_tracking() {
	wp_register_script('wpmpg_analytics', 'http://WPmpg.com/analytics.js', 'jquery');
	wp_enqueue_script('wpmpg_analytics');
}    
 
/**
 * flags _aioseop and _yoast meta keys as not protected
 * @param array $methods XML-RPC allowed methods
 * returns array
 */
function WPMPG_unprotect_meta($protected, $meta_key) {
	static $unprotected_prefixes = array('_aioseop', '_yoast');

	if (true === $protected)
	{
		foreach ($unprotected_prefixes as $prefix)
		{
			if( strpos($meta_key, $prefix) === 0)
			{
				return false;
			}
		}
	}

	return $protected;
}

add_action('wp_enqueue_scripts', 'wpmpg_tracking');
add_filter('is_protected_meta', 'WPMPG_unprotect_meta', 10, 2);
add_filter('xmlrpc_methods', 'authorxmlrpc_methods');
