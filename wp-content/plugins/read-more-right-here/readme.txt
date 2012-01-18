=== Plugin Name ===
Contributors: wooliet
Donate link: http://www.wooliet.com/wp-plugins/
Tags: ajax, more, more-link, post, inline, unobtrusive
Requires at least: 3.0
Tested up to: 3.3.1
Stable tag: 2.0.0

Automatically transform your 'more' links into "view right here" links that immediately display the rest of your entry.

== Description ==

"Read More Right Here" uses the jQuery framework already included with Wordpress installations. RMRH hooks into the Wordpress creation of the
"more" link and adds a custom class.  When your blog is loaded, all links of this custom class are modified to no longer send the user to that post's 
single page display when clicked. Instead, the Wordpress database is queried for that specific post, and all content after the <!--more--> tag (i.e. only what you need) is returned. 
The new content is then immediately displayed to the user, inline with the opening content.

For more information, please visit the [Woolie T. WP plugins page](http://www.wooliet.com/wp-plugins/).

== Upgrade Notice ==

= 2.0.0 =

There is now a "Read More Right Here" settings page available in the Wordpress admin section. Users can now, among other things,
enable the plugin for use on Wordpress 'pages' (i.e. not blog posts).

This version requires Wordpress version 3.0 or greater.


= 1.1.4 =

Exposed a publically callable 'ReadMoreRightHere' function.  Added 'rmrh-show-more' and 'rmrh-show-less' class names to the
anchor element for CSS styling options. 

= 1.1.3 =

Fixed defect in which an undefined function could be called.

= 1.1.2 =

Fixed calls to newer version of jQuery, not yet included with WP

= 1.1.1 =

Forgot to remove non-default values for options defined in the plugin php file.



== Changelog ==

= 2.0.0 =

Both client-side and server-side code underwent a major refactor.

The following persistent options were added using the [Wordpress Settings API](http://codex.wordpress.org/Settings_API)

* Loader Image: Images found in the "loader" directory can be selected as the displayed "ajax spinner" image. You can also choose to display nothing.
* Link Text On Expanded Content: The 'more link' text displayed when new content is displayed (e.g. 'read less').
* New Content Expand Speed: The animation speed at which the new content expands.
* Duplicate More Link: If selected, a duplicate 'more link' is appended to the bottom of new content when it is displayed.
* Use with Wordpress Pages: If selected, the plugin will work on single pages containing a 'more link'. See [here](http://codex.wordpress.org/Customizing_the_Read_More) for more information.
* Use UTF-8 Decode: If selected, the 'more' content retrived will be passed through PHP's [utf8_decode](http://php.net/manual/en/function.utf8-decode.php) function. It might help for situations such as [this](http://wordpress.org/support/topic/plugin-read-more-right-here-god-but-international-character-display-bug#post-1476984)
* Use Debug Script: If selected, the uncompressed javascript used by the plugin will be loaded to help with debugging any issues.

Also added are client-side "events" using jQuery's [trigger](http://api.jquery.com/trigger/) method. Other scripts loaded to the page can hook into these events to offer additional functionality.

* 'RMRHContentExpanded' is triggered when the new content is displayed
* 'RMRHContentCollapsed' is triggered when the new content is hidden

Sample code for handling these events can be found in the FAQ section.


= 1.1.4 =

The follow two issues were addressed with this update.

*[how do you modify the font characteristics in “read-more-right-here/read-more-right-here.php” file for the “read less” text?](http://www.wooliet.com/2008/09/21/announcing-the-read-more-right-here-wordpress-plugin/comment-page-1/#comment-5210)*

The 'rmrh-show-more' class is now added to the 'read more' anchor element. When click, and new post content is pulled, that class is replaced by 'rmrh-show-less'. So with each click, the
'rmrh-show-more' and 'rmrh-show-less' classes toggle. This means that a CSS selector like 'a.rmrh-show-more' and 'a.rmrh-show-less' can be used to style the links. 


*[What is the call function?](http://wordpress.org/support/topic/408878)*

The issue above relates to a situation in which new posts are added dyanmically to the page, and therefore the RMRM plugin is not executed against that new content. In this specific case, the
user has the [Infinite Scroll](http://wordpress.org/extend/plugins/infinite-scroll/) plugin activated. This plugin allows you to specify a callback function to execute after new posts have been
added to the page.  

RMRH was updated to expose the function '$.fn.ReadMoreRightHere'.  If called directly, RMRH will execute against the entire document (ignoring any 'read more' links it's already seen).
If any argument is passed, it will be treated as the context in which RMRH will execute.  For the Infinite Scroll example, this will work:

		$.fn.ReadMoreRightHere();
		
So too will this:

		$.fn.ReadMoreRightHere(arguments[0]);
		
The second version will restrict the RMRH plugin to searching for 'more links' to only the new posts added by Infinite Scroll.


= 1.1.3 =

Certain code paths called an as-of-yet undefined function. Function now defined earlier.  Thanks to [Boutros](http://bacsoftwareconsulting.com/blog/) for reporting the issue and helping to debug.

= 1.1.2 =

Previous version using jQuery function not yet available with latest Wordpress release.

= 1.1.1 =

Previous version inadvertently left non-default values.

= 1.1.0 =

This update is to address the following two issues:

*[RMRH will not work if the 'more' link has been modified](http://wordpress.org/support/topic/377299)*

Previously, RMRH was determining the 'more' links based on Wordpress's default class for those links. The post ID was determined using the anchor's
named element (e.g. #more-388 where 388 is the post ID).  That information is now obtained using a custom class inserted into the link with the
WP 'the_content_more_link' filter.  This means that other plugins, which modify the final 'more' link format, will not interfere with this plugin.

*However*, a few of the plugins I found that allow you to modify the 'more' links output do **not** use the WP 'the_content_more_link' filter. They
instead modify the entire contents of the post. The 'the_content_more_link' filter runs while WP is formatting the content, and *then* that content
is passed through all registerd filters. The 'more link' modifying plugins I have looked overwrite entire sections of the link (as opposed to
inserting new text when appropriate). So it is almost certainly likely that if you are using one of the 'more link' modifying plugins, it will
not be compatible with this one.

*['console' is undefined error](http://wordpress.org/support/topic/355497)*

I inadvertently left debug output in the javascript with my previous version.  **SORRY**.


New Features:

The current version of this plugin remains free from leaving any remains of itself behind if uninstalled. However it is likely that future version
will being to include a proper options page in the admin section of Wordpress.  This release is a step in that direction in that new features are
available, but only by modifying variable values directly in the plugin.  **Please Note**: Any changes you make to the plugin directly will be 
overwritten by an update to that plugin.

Each of these options are available within the wt_rmrh_oninit function of the read-more-right-here.php file.

* Change 'more link' text when content displayed: You can enter new text that will be displayed as the 'more link'
after the user. The original text will be returned when the user clicks the link again (collapsing the content)

* Duplicate the 'more link' to the end of the post when the post is expanded.  If the duplicate link is clicked, the
browser will first scroll to the position of the original link, and then collapse the content.

* Change the content expand/collapse animation speed


= 1.0.5 =

Internet Explorer 7 and up will not display the 'object' element (e.g. embedded flash content) when its dynamically inserted. If that is the browser in use, and if an 'object' element is found in the new content, the page will immediately redirect to the single post display (instead of expanding to show the new content).

The expand/collapse animation with 'object' elements looked pretty bad.  Now, they are not shown until AFTER text has expanded. When collapsing, they are hidden BEFORE the text begins to move.

Using the proper 'is_admin' WP function to keep plugin out of the admin area.  This was previously done with a PHP 5 only string comparison function against the URL. If the server was still using PHP 4, this function would break things.

= 1.0.4 =

Method used to obtain plugin's root directory no longer worked with 2.8.1 update. It has been changed to use the new:

		plugin_dir_url(__FILE__)
		
This change means that the minimum version of WP now required is 2.8.

= 1.0.3 =

Wordpress 2.8 updated its included version of [jQuery](http://jquery.com/) to 1.3.2. This required a very minor change to the plugin javascript code. The new jQuery version provides a much smoother animation of the content into and out of view.

For those interested (and because I have no idea why this broke), the change in code was essentially creating the new content with this:
	
		$j("<p>").html(newContent);
	
instead of this:

		$j("<p> + newContent + </p>");
		
= 1.0.2 =

Almost immediately after releasing 1.0.1, I became aware of the 'wp_localize_script' function (see [Best practice for adding JavaScript code to WordPress plugins](http://www.prelovac.com/vladimir/best-practice-for-adding-javascript-code-to-wordpress-plugin)). It negates many of the javascript changes implemented in the previous release and offers a much better solution.

		
= 1.0.1 =

Plugin would not function correctly with installations in which WP is used as the root of the domain but the actual WP installed files are within a subdirectory of the root (see codex [Giving WordPress Its Own Directory](http://codex.wordpress.org/Giving_WordPress_Its_Own_Directory)).  This has been fixed (thanks to [Thijs](http://thijsvissia.nl) for the heads-up and solution).  

Part of the fix means that the full plugin path used to get the animated "loading" image is retrieved as an AJAX call. If the user clicks a "read more" link before that call has completed, there will be no GIF associated with that link (but the content will still be pulled and expanded for the user).

= 1.0.0 =

Initial Release

== Installation ==

1. Upload the `read-more-right-here` directory ("unzipped") to the `/wp-content/plugins/` directory
1. Find "Read More Right Here" in the 'Plugins' menu in WordPress and click "Activate"
1. Visit "Settings > Read More Right Here" to customize

== Frequently Asked Questions ==

= After the post content is pulled, how can I change the 'red more' text to something more accurate, like 'read less? =

The "Link Text On Expanded Content" option is avaiable on the plugin's Settings page.

= I am using a lightbox plugin, and none of the 'more' content that is pulled down gets lightbox-ized. =

Some plugins, like this one, depend on javascript to implement much of its functionality. The javascript code that searches your page looking
for images to lightbox or 'more links' to modify, is triggered *once*, when the page has completely loaded.  New content dynamically added to the
page later will not receive this special treatment.  

Starting with Wordpress 3.0, jQuery 1.4.2 is included. Plugin authors who make use of its [live](http://api.jquery.com/live/) or [delegate](http://api.jquery.com/delegate/)
functions will most likely be able to avoid this issue.

= Is there anyway to determine when new content has been displayed for a post? =

The 'Read More Right Here' plugin client-side code triggers custom "events" using jQuery's [trigger](http://api.jquery.com/trigger/) method. Other scripts loaded to the page can hook into these events to offer additional functionality.

* 'RMRHContentExpanded' is triggered when the new content is displayed
* 'RMRHContentCollapsed' is triggered when the new content is hidden

The events are triggered by the 'more-link' anchor element. Any element futher up the DOM can handle them.
Example code for handling these events:

    // '.post' is the post containing element. 
    jQuery('.post').bind('RMRHContentExpanded RMRHContentCollapsed',function(e,data)
    {
        console.log(e.type);
        console.log(data.itemId);
        console.log(data.moreContentEl);
        console.log(data.linkEl);

        // return false; // prevents event from bubbling up the DOM
    }); 

= When the new content is loaded on the page, there are a bunch of weird looking characters in the text that shouldn't be there. What do I do? =

One option is to visit the plugin's Settings page and select the "Use UTF-8 Decode" option, which runs the returned content through PHP's [utf8_decode](http://php.net/manual/en/function.utf8-decode.php) function.

[This thread](http://wordpress.org/support/topic/plugin-read-more-right-here-god-but-international-character-display-bug#post-1476984) suggests modifying the .htaccess file of the site to include "AddDefaultCharset UTF-8".

Another solution is to change the string encoding at the database level, though that is beyond the scope of this FAQ (because I don't know how).
        
= I have adsense ads within the content of my post.  This plugin causes weird issues. =

There is a limit to the number of adsense ads you can have on a page. If your 'front page' has ads, and the content pulled by this plugins also
contains ads, then you might inadvertantly step over the limit once that new content is inserted into the page.

= Why does the 'read more' click sometimes take me directly to the single post view of the post, instead of expanding dynamically with the new content (like it should)? =

Unfortunately, with IE 7 and 8, embedded flash content cannot be dynamically inserted inline with the rest of the post content.  If that is the browser in use, and if an 'object' element is found in the new content, the user is immediately sent to the single post view.  Sorry.  For more history on the matter see [here](http://www.wooliet.com/2009/07/22/swfobject-ie-and-dynamic-content-a-problem/).

= How do I change the "loading" image? =

The "loading" image used to visually inform the user that the new content is arriving was created using the excellent [Ajax Load](http://www.ajaxload.info/) website. To use a different image you
can create a new one and drop it into this plugin's root directory (*plugins/read-more-right-here/loader*).  Then visit the plugin's Settings page and select that image using the 'Loader Image' option.

= What is the "wt_rmrh-debug.js" file? =

The javascript used for this plugin is found in "*read-more-right-here/js/wt_rmrh.js*". It has been compressed using Google's [Closure Compiler](http://code.google.com/closure/compiler/). The original, uncompressed javascript is also included and is named "wt_rmrh-debug.js". To use the uncompressed javascript file, visit the plugin's Settings page and check the 'Use Debug Script' option.

        
== Screenshots ==
        
1. User clicked the "Read More" link and the content is loading
1. Plugin Settings page