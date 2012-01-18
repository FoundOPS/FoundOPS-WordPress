<?php

/**
 * Uninstaller. Removes options and settings from the database.
 * @package OverwriteUploads
 * @author Ian Dunn <ian@iandunn.name>
 */
 
if( defined('WP_UNINSTALL_PLUGIN') && WP_UNINSTALL_PLUGIN == 'overwrite-uploads/overwrite-uploads.php' )
{
	delete_option('ovup_options');
}
else
	die('Access denied.');

?>