=== Google AJAX Feed Slide Show Widget ===
Contributors: martinjonsson
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=martin%2ejonsson%40gmail%2ecom&lc=SE&item_name=Martin%20Jonsson&item_number=google%2dajax%2dwidget&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: slideshow, album, photo, widget, sidebar, google, shortcode
Requires at least: 2.8
Tested up to: 2.9.2
Stable tag: 1.3

Photo slide show using Media RSS as a source. Display slideshows from photo feeds from popular sites, such as Expono, Flickr, and Picasa Web Albums.

== Description ==

This is a wordpress plugin that displays a photo slide show as a sidebar widget or in lined in your posts using a shortcode. The plugin uses Media RSS as a source and Google AJAX Feed API Slide Show.
You can easily display a slide show from photo feeds from all popular sites, such as Expono, PhotoBucket, Flickr, and Picasa Web Albums.

== Installation ==

1. Download the installation zip file and unzip leaving the directory structure in tact.
2. Upload the newly unzipped 'google-ajax-slideshow' folder to the `/wp-content/plugins/` folder
3. Activate the Google AJAX Feed Slide Show Widget plugin from the 'Plugins' menu.
4. Add the widget to your sidebar from the 'Widgets' design page or enter the shortcode [mj-google-slideshow feed_url="" /] in your post.

== Shortcode syntax ==

Don't forget to set the height and width or make sure the classname has a height or width, if you don't it won't work.

Example 
[mj-google-slideshow feed_url="http://www.expono.com/go/rss" width="300" height="300" /]

Required parameters:

* feed_url = URL to the feed

Optional parameters:

* display_time = value in ms, default 2000 
* transition_time = value in ms, default 600
* scale_images = boolean value, default true
* maintain_aspect = boolean value, default true
* pause_hover = pause slide show when mouse is hovering (boolean), default true
* full_control_panel = boolean value, default false
* full_control_panel_small = boolean value, default false
* link_target = If images are linked to its source, accepted values (false, google.feeds.LINK_TARGET_SELF, google.feeds.LINK_TARGET_BLANK, google.feeds.LINK_TARGET_PARENT, google.feeds.LINK_TARGET_TOP) default false
* thumbnail_size = Thumbnail size to use, this only works on feeds that expose different sizes. Accepted values (GFslideShow.THUMBNAILS_LARGE, GFslideShow.THUMBNAILS_MEDIUM, GFslideShow.THUMBNAILS_SMALL) default GFslideShow.THUMBNAILS_LARGE
* num_results = Number of images to display
* classname	= class name for the surrounding html container
* width = slide show width in pixels
* height = slide show height in pixels

Boolean types accepts values (1, on, true) everything else is evaluated as false.

== Screenshots ==

1. Widget settings

== Changelog ==

= 1.3 =
* Fixed bug with thumbnail_size that occurred when upgrading and existing defaults was old. 

= 1.2 =
* Added thumbnail_size option (Set image size)
* Added num_results option (Number of images to display)
* Fixed bug on feed url, some urls needs to be decoded, eg. Flickr

= 1.1 =
* Added shortcode mj-google-slideshow
* Added option to add html before and after

= 1.0 =
* First release

== Upgrade Notice ==

= 1.3 =
Fixed error that occurred when upgrading to 1.2

= 1.2 =
This version fix a problem with some urls e.g with flickr.
Adds two more options (num_results, thumbnail_size)

= 1.1 =
This version adds shortcode functionality so you can include slideshows in your posts.

== Frequently Asked Questions ==

For any questions, comments or suggestions regarding the plugin please visit http://www.martinj.net