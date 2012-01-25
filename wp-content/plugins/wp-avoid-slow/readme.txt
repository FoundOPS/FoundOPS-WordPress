=== WP Avoid Slow ===
Contributors: Abhishek
Tags: Speed, Htaccess, Cache
Requires at least: 2.8
Tested up to: 2.9.2
Stable tag: 0.2

WP Avoid Slow - Add .htaccess tricks to boost your WP Blog Speed.

== Description ==

= 1. Add an Expires Header =
Web pages are becoming increasingly complex with more scripts, style sheets, images, and Flash on them. A first-time visit to a page may require several HTTP requests to load all the components. By using Expires headers these components become cacheable, which avoids unnecessary HTTP requests on subsequent page views. Expires headers are most often associated with images, but they can and should be used on all page components including scripts, style sheets, and Flash.

Using WP Avoid Slow reduces number of HTTP requests affecting the page load performance.

= 2. Configure Etags =
Entity tags (ETags) are a mechanism web servers and the browser use to determine whether a component in the browser's cache matches one on the origin server. Since ETags are typically constructed using attributes that make them unique to a specific server hosting a site, the tags will not match when a browser gets the original component from one server and later tries to validate that component on a different server.

WP Avoid Slow Configure Etags helping browsers to validate the component !!

= Please Note =
Performance can be measured via Yslow. [Read More](http://developer.yahoo.com/yslow/) about Yslow .

== Installation ==

1. Upload `wp-avoid-slow` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress


== Frequently Asked Questions ==

= How it affects Yslow score ? =

Add an Expires Header & Etags configuration helps server and browser to interact fast affecting the performance of WordPress Blog.

== Changelog ==
* v0.1 Release
* v0.2 Expire Cache fix. 