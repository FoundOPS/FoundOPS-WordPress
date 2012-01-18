=== StripTease ===

Contributors: guyfisher
Tags: anchor, excerpt, filter, more-link, navigation, permalink, quicktag, read-more, teaser
Requires at least: 2.8
Tested up to: 3.3
Stable tag: trunk

Strips the "#more" fragments from the end of "Read More" teaser links so they link to full posts.

== Description ==

The Striptease plugin changes WordPress's default "Read More" teaser links so that they link to full posts.

WordPress makes it easy to break up long posts so you can save space on your home page. Simply insert the `<!--more-->` quicktag while editing a post, and WordPress will display the text that comes before it as a teaser followed by a Read More link to the rest of the post. When a reader follows the link, the single-post page is loaded and the browser "jumps" to the unread text.

This jump can be disorienting, and some bloggers prefer to link their teasers to the full posts instead of the unread text.

That's where the StripTease plugin comes in. It automatically strips the "#more" fragments from the end of your teaser links and turns them into links to your full posts.

== Installation ==

1. Put the striptease plugin folder in your WordPress plugins directory.
2. Activate the StripTease plugin on your WordPress plugins administration panel.

The StripTease plugin doesn't require any configuration. Once it's activated, it will immediately begin stripping your teaser links.

== Frequently Asked Questions ==

= Why would I use this plugin? =

If you create teasers for your posts with the `<!--more-->` quicktag, and you want those teasers to link to the full posts instead of jumping to the unread text, you should use the StripTease plugin.

= How do I configure this plugin? =

The StripTease plugin doesn't require any configuration. Once it's activated, it will immediately begin stripping the "#more" fragments from the end of your teaser links.

= Do I have to use "pretty permalinks" with this plugin? =

No, you don't. The StripTease plugin will work with WordPress's default querystring permalinks as well as its rewrite-based pretty permalinks.

== Changelog ==

= 2.0 =

* Replaced `the_content` filter with `the_content_more_link` filter

= 1.1 =

* Removed unnecessary call to `get_permalink` function

= 1.0 =

* Initial release

== Upgrade Notice ==

= 2.0 =

This version filters teaser links directly instead of filtering the entire post. Requires WordPress 2.8 or higher.

== Example ==

The StripTease plugin automatically changes your teaser links from this:

	http://guyfisher.com/2005/09/striptease/#more-6

To this:

	http://guyfisher.com/2005/09/striptease/