=== WPmpg ===
Contributors: WebVyz
Tags: WPmpg, xmlrpc
Version: 1.2
Requires at least: 3.0
Tested up to: 3.2.1
Stable tag: trunk

WPmpg.com functions including XML-RPC interface.

== Description ==
Enable [WPmpg.com](http://WPmpg.com "WordPress Mass Posts Generator") features

This plugin is required to use the services of [WPmpg.com](http://WPmpg.com "WordPress Mass Posts Generator")

== Installation ==
1. Upload `WPmpg.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the **Plugins** menu in WordPress
1. Under the **Settings** menu, choose **Writing** and make sure **XML-RPC** *(“Enable the WordPress, Movable Type, MetaWeblog and Blogger XML-RPC publishing protocols”)* is enabled; click **Save Changes**.

== Frequently Asked Questions ==
= What is WPmpg? =
Functionality enabling [WPmpg.com](http://WPmpg.com "WordPress Mass Posts Generator") services, including enhanced XML-RPC features.

According to [Wikipedia](http://en.wikipedia.org/wiki/Xml-rpc), XML-RPC is a remote procedure call (RPC) protocol which uses XML to encode its calls and HTTP as a transport mechanism. Refer to the [WordPress Wiki](http://codex.wordpress.org/XML-RPC_Support) for further explanation about WordPress’ XML-RPC capabilities.

= My plugin is enabled but does not appear to be working; what should I do? =

The remote publishing functionality is required to for this plugin to function. Make sure **XML-RPC** is enabled (step 3 in *Installation*).

== Changelog ==

= 1.2 =
* Added filter to “unprotect” *All-in-one-SEO-Pack*’s and *Yoast*’s **`meta`** fields
* WPmpg’s XML-RPC now works with *All-in-one-SEO-Pack* in WordPress versions 3.2 and greater

= 1.1 =
* Added analytics code

== Upgrade Notice ==

= 1.1 =
WPmpg plugin is now hosted on WordPress.org.

Upgrade now to keep current with WPmpg features.

== Technical Details ==
The XMLRPC functions enabled by this plugin are:

* newAuthor (wp.newAuthor)

refer to the [wiki](http://wiki.github.com/jabowery/WPmpg/) for further documentation
