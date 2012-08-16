<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

$options = twentyeleven_get_theme_options();
$current_layout = $options['theme_layout'];

if ( 'content' != $current_layout ) :
?>
		<div id="secondary" class="widget-area" role="complementary" onload="reposition()">
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="getConnected" class="widget">
                <?php if(is_author()){ 
					  	$userid = $_GET["author"];
					  	$user_info = get_userdata($userid);?>
						<h3 class="widget-title"><?php echo 'Connect with ' . $user_info->user_firstname; ?></h3>
				<?php }else{ ?>
						<h3 class="widget-title"><?php _e( 'Get Connected', 'twentyeleven' ); ?></h3>
                    <?php } ?>
					<table>
						<tr>
                        	<?php $userid = $_GET["author"]; ?>
                        	<?php if((is_author() && get_usermeta($userid, 'facebook') != "") || !(is_author())){ ?>
                                <td id="getFacebook">
                                <a href="<?php if(is_author()){echo get_usermeta($userid, 'facebook');}else{?>http://www.facebook.com/foundops<?php } ?>"></a>
                                </td>
                            <?php } if(!(is_author())){ ?>
                                <td id="getRss">
                                <?php if( class_exists('Add_to_Any_Subscribe_Widget') ) { Add_to_Any_Subscribe_Widget::display(); } ?>
                                </td>
                            <?php } if((is_author() && get_usermeta($userid, 'twitter') != "") || !(is_author())){ ?>
                                <td id="getTwitter">
                                <a href="<?php if(is_author()){echo get_usermeta($userid, 'twitter');}else{?>http://twitter.com/#!/FoundOPS<?php } ?>"></a>
                                </td>
                            <?php } if((is_author() && get_usermeta($userid, 'google') != "") || !(is_author())){ ?>
                                <td id="getGoogle">
                                <a href="<?php if(is_author()){echo get_usermeta($userid, 'google');}else{?>https://plus.google.com/b/116861256577185051449/<?php } ?>"></a>
                                </td>
                            <?php } if((is_author() && get_usermeta($userid, 'linkedin') != "") || !(is_author())){ ?>
                                <td id="getLinkedin">
                                <a href="<?php if(is_author()){echo get_usermeta($userid, 'linkedin');}else{?>http://www.linkedin.com/company/foundops<?php } ?>"></a>
                                </td>
                            <?php } ?>
                        </tr>
					</table>
                    <div id="or">or</div>
                    <span style="color:#aaa;">&nbsp;&nbsp;__________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;__________</span>
                    <?php mailchimpSF_signup_form(); ?>
				</aside>
				<aside id="topics" class="widget">
					<h3 class="widget-title"><?php _e( 'Topics', 'twentyeleven' ); ?></h3>
					<ul>
						<?php wp_list_categories() ?>
					</ul>
				</aside>
				<aside id="archives" class="widget">
					<h3 class="widget-title"><?php _e( 'Archives', 'twentyeleven' ); ?></h3>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly', 'limit' => '5' ) ); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->
<?php endif; ?>