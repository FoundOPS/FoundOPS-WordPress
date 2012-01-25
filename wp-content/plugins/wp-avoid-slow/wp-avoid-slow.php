<?php
/*
Plugin Name: WP Avoid Slow
Plugin URI: http://www.whoisabhi.com
Description: WP Avoid Slow - Add .htaccess tricks to boost your WP Blog Speed.
Author: Abhishek Deshpande
Version: 0.2
Author URI: http://www.whoisabhi.com/
*/
function wp_avoid_slow_act(){
	
	$filename = ABSPATH.'.htaccess';
	$message='';
	$httrick = '# WP-AVOID-SLOW Begin'."\r\n";
	$httrick .='# Add Expires headers'."\r\n";
	$httrick .='ExpiresActive On'."\r\n";
	$httrick .='ExpiresDefault "access plus 5 days"'."\r\n";
	$httrick .='# ETags'."\r\n";
	$httrick .='FileETag none'."\r\n";
	$httrick .='# WP-AVOID-SLOW END'."\r\n";
	
	if (file_exists($filename)) {
		if (is_writable($filename)) {
			$htcontent=file_get_contents($filename);
			
			if(preg_match("/\bExpiresActive\b/i", $htcontent)==0) { $towrite=True; }
			if(preg_match("/\bFileETag\b/i", $htcontent)==0) { $towrite=True; ;}
			
			if($towrite)
			{
				$fp = fopen($filename, 'a');
				fwrite($fp, $httrick."\r\n");
				$message='.htaccess file updated successfuly.';
			}else{ $message='Tag Exist.'; }			
		}else {$message='.htaccess file is not writable.';}
	}else{	
		$fp = fopen($filename, 'w');
		fwrite($fp, $httrick."\r\n");
		$message='.htaccess file is Created.';
	}
}

function wp_avoid_slow_deact(){
	
	$filename = ABSPATH.'.htaccess';
	
	if (file_exists($filename)) {
		if (is_writable($filename)) {
			$htcontent=file_get_contents($filename);
						
			$httrick = '# WP-AVOID-SLOW Begin'."\r\n";
			$httrick .='# Add Expires headers'."\r\n";
			$httrick .='ExpiresActive On'."\r\n";
			$httrick .='ExpiresDefault "access plus 5 days"'."\r\n";
			$httrick .='# ETags'."\r\n";
			$httrick .='FileETag none'."\r\n";
			$httrick .='# WP-AVOID-SLOW END'."\r\n";
			
			$htcontent=str_replace($httrick, " ", $htcontent);
			
			$fp = fopen($filename, 'w');
			fwrite($fp, $htcontent."\r\n");
						
		}else {$message='.htaccess file is not writable.';}
	}	
}

register_activation_hook( __FILE__, 'wp_avoid_slow_act' );
register_deactivation_hook( __FILE__, 'wp_avoid_slow_deact' );
?>