<?php
$options = twentyeleven_get_theme_options();
$current_layout = $options['theme_layout'];

if ( 'content' != $current_layout ) :
?>
		<div id="secondary" class="widget-area" role="complementary">
        <?php if(is_author()){ ?>
        	<script type="text/javascript">
				function $style(ElementId, CssProperty)
				{
					function $(stringId)
					{
						return document.getElementById(stringId);
					}
					if($(ElementId).currentStyle)
					{
						var convertToCamelCase = CssProperty.replace(/\-(.)/g, function(m, l){return l.toUpperCase()});
						return $(ElementId).currentStyle[convertToCamelCase];
					}
					else if (window.getComputedStyle)
					{
						var elementStyle = window.getComputedStyle($(ElementId), "");
						return elementStyle.getPropertyValue(CssProperty);
					}
				}
			
            	var sec = document.getElementById('secondary');
				var abc = $style('author-info', "height");
				sec.style.top = abc;
				sec.style.marginTop = "67px";
            </script>
        <?php } ?>
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
				
                <aside id="topics" class="widget">
					<h3 class="widget-title"><?php _e( 'Topics', 'twentyeleven' ); ?></h3>
					<ul>
						<?php wp_list_categories() ?>
					</ul>
				</aside>
                
                <aside id="getConnected" class="widget">
                <?php if(is_author()){ ?>
					<h3 class="widget-title"><?php echo 'Connect with ' . get_the_author_meta( 'first_name' ); ?></h3>
				<?php }else{ ?>
					<h3 class="widget-title"><?php _e( 'Get Connected', 'twentyeleven' ); ?></h3>
                    <?php } ?>
					<table>
						<tr>
                        	<td id="getFacebook">
                            <a href="<?php if(is_author()){echo get_the_author_meta( 'facebook' );}else{?>http://www.facebook.com/foundops<?php } ?>"></a>
                            </td>
                            <td id="getRss">
                            <a href="<?php echo $GLOBALS["blogLink"];?>/feed"></a>
                            </td>
                            <td id="getTwitter">
                            <a href="<?php if(is_author()){echo get_the_author_meta( 'twitter' );}else{?>http://twitter.com/#!/FoundOPS<?php } ?>"></a>
                            </td>
                            <td id="getGoogle">
                            <a href="<?php if(is_author()){echo get_the_author_meta( 'google' );}else{?>https://plus.google.com/b/116861256577185051449/<?php } ?>"></a>
                            </td>
                            <td id="getLinkedin">
                            <a href="<?php if(is_author()){echo get_the_author_meta( 'linkedin' );}else{?>http://www.linkedin.com/company/foundops<?php } ?>"></a>
                            </td>
                        </tr>
					</table>
                    <div id="or">or</div>
                    <span style="color:#aaa;">&nbsp;&nbsp;__________&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;__________</span>
                    <?php mailchimpSF_signup_form(); ?>
				</aside>
                
				<aside id="archives" class="widget">
					<h3 class="widget-title"><?php _e( 'Archives', 'twentyeleven' ); ?></h3>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->
<?php endif; ?>