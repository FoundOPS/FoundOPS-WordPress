=== Overwrite Uploads ===
Contributors: iandunn
Donate link: http://kiva.org
Tags: overwrite, uploads, files, media library
Requires at least: 3.1
Tested up to: 3.3.1
Stable tag: 1.0.2

Allows you to overwrite uploaded files instead of storing multiple copies.


== Description ==
By default Wordpress doesn't overwrite existing files. Instead, it appends a number to the end of the filename in order to make it unique, *e.g., filename1.jpg*. That isn't always the desired behavior, so this plugin makes it so that any files uploaded will automatically overwrite existing files that have the same name, rather than creating a second file with a unique name. 

**NOTE**: You have to make a small change to one of Wordpress' core files for this to work; see [the FAQ](http://wordpress.org/extend/plugins/overwrite-uploads/faq/) for details. If you need help check out [the support forums](http://wordpress.org/tags/overwrite-uploads?forum_id=10).


== Installation ==
1. Upload the *overwrite-uploads* directory to your *wp-content/plugins/* directory.
2. Backup a copy of *wp-admin/includes/file.php* in case you make a mistake installing the new hook.
3. Edit *wp-admin/includes/file.php* and scroll down to the line that says, `function wp_handle_upload( &$file, $overrides = false, $time = null ) {` *(line 230 in WordPress 3.3.1)*
4. Right above it, add this new line: `define('OVUP_FILTER_ADDED', true); // custom modification for Overwrite Uploads plugin`
5. Scroll down a few more lines until you see, `$file = apply_filters( 'wp_handle_upload_prefilter', $file );` *(line 238 in WordPress 3.3.1)*
6. Right above it, add this new line: `$overrides = apply_filters( 'wp_handle_upload_overrides', $overrides ); // custom modification for Overwrite Uploads plugin`
7. Activate the plugin through the 'Plugins' menu in WordPress


== Frequently Asked Questions ==
= Why do I have to modify a core file? =
Plugins use [hooks](http://codex.wordpress.org/Writing_a_Plugin#WordPress_Plugin_Hooks) to modify the default behavior of Wordpress, but the hook that this plugin needs doesn't currently exist, so we create it ourselves. I've submitted [a request for Wordpress to add the hook](http://core.trac.wordpress.org/ticket/16849) and when they do I'll release an updated version of the plugin that doesn't require modifying the core.


= What does the new code do? = 
The first line creates a flag to let the plugin know that the new hook has been installed. This lets us warn users if they haven't created the new hook, or if they've upgraded Wordpress haven't re-installed the hook.

The second line adds the new hook itself.


= How do I add the new hook? =
See the installation instructions for full details. It's a fairly easy change to make, but you need to be careful that you follow the directions closely. If you put things in the wrong place then you might cause an error which would make Wordpress stop working. If you're not comfortable with making basic PHP tweaks then you might want to ask someone for help.


= I tried to add the new hook, but something went wrong and now Wordpress is broken = 
If you're seeing any errors after modifying *wp-admin/includes/file.php*, just re-upload your backup copy of it and that will fix the errors. If you didn't make a backup copy before making the changes, you can re-download Wordpress and upload the files.


= Can I make a donation to support the plugin? =
I do this as a way to give back to the WordPress community, so I don't want to take any donations, but if you'd like to give something I'd encourage you to make a microloan with [Kiva](http://www.kiva.org).


= How can I get help when I'm having a problem? =
Check [the support forum](http://wordpress.org/tags/overwrite-uploads?forum_id=10), because your problem may already have already been answered there, and if not the answer you get will help others in the future.

If you can't find anything, then start a new thread with a detailed description of your problem and the URL to your site. Tag the post with `overwrite-uploads` so that I get an e-mail notification. If you use the link above it'll automatically tag it for you. Check the 'Notify me of follow-up posts via e-mail' box so you won't miss any replies.

I monitor the forums and respond to most requests.


= How can I send feedback that isn't of a support nature? =
You can send me feedback/comments/suggestions using the [contact form](http://iandunn.name/contact) on my website, and I'll respond as my schedule permits. *Please **don't** use this if you're having trouble using the plugin;* use the support forums instead (see above question for details). **I only provide support using the forums, not over e-mail.**


== Changelog ==

= 1.0.2 = 
* Fixed bug where old Media Library entries weren't removed if the 'Organize my uploads into year and month folders' setting was enabled.
* Setting removed because it's unnecessary. Plugin will overwrite uploads if activated, and won't if it isn't.

= 1.0.1 = 
* Added network-wide activation for WPMS blogs

= 1.0 =
* Initial release


== Upgrade Notice ==

= 1.0.2 = 
Overwrite Uploads 1.0.2 fixes a bug where old Media Library entries weren't deleted.

= 1.0.1 =
Overwrite Uploads 1.0.1 adds support for network-side activation on WordPress MultiSite installations

= 1.0 =
Initial release