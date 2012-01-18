<?php

/**
 * A WordPress plugin that strips the "#more" fragments from the end of "Read
 * More" teaser links.
 *
 * @package StripTease
 * @link http://guyfisher.com/builder/striptease/
 * @author Guy Fisher
 * @version 2.0
 * @copyright Copyright © 2010 Guy M. Fisher
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

/*

Plugin Name: StripTease
Plugin URI: http://guyfisher.com/builder/striptease/
Description: Strips the "#more" fragments from the end of "Read More" teaser links.
Author: Guy Fisher
Author URI: http://guyfisher.com/
Version: 2.0

Copyright © 2010 Guy M. Fisher

This program is free software; you can redistribute it and/or modify it under
the terms of the GNU General Public License as published by the Free Software
Foundation; either version 2 of the License, or (at your option) any
later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY
WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
A PARTICULAR PURPOSE. See the GNU General Public License for more details.

http://www.gnu.org/licenses/gpl-2.0.html

*/

/**
 * Strips the #more-$id fragments from the end of "Read More" teaser links.
 *
 * Filters the HTML string passed from the_content_more_link filter in the
 * get_the_content function.
 *
 * @since 2.0
 *
 * @global int Post ID
 * @param string $more_link HTML markup for teaser link
 * @return string HTML markup with #more-$id fragment stripped off
 */
function striptease_more_link( $more_link ) {
	global $id;
	return str_replace( "#more-$id", '', $more_link );
}
add_filter( 'the_content_more_link', 'striptease_more_link' );

?>