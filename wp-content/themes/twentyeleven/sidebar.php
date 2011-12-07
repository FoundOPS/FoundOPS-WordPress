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
	<div id="navBoxBlog">
            <ul class="tabs">
                <li style="border-top:none"><a href="<?php echo $GLOBALS["foundopsLink"]; ?>">Home</a></li>
                <li><a href="<?php echo $GLOBALS["blogLink"]; ?>/beta" >FoundOPS</a></li>
                <li><a href="<?php echo $GLOBALS["blogLink"]; ?>/team">About Us</a></li>
                <li><a href="<?php echo $GLOBALS["blogLink"]; ?>">Blog</a></li>
            </ul>
        </div>	
    
		<div id="secondary" class="widget-area" role="complementary" style="margin-left:20px; position:relative; top:50px; left:0px;">
        	<!--<div id="banner"><h3 style="font-size:30px; color:#fff;">Some Awesome Header</h3></div>-->
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
				
                <?php if( function_exists('subscribe_sidebar') ) { ?>
                <p><?php subscribe_sidebar(); ?></p>
                <?php } ?>

                
				<aside id="archives" class="widget">
					<h3 class="widget-title"><?php _e( 'Archives', 'twentyeleven' ); ?></h3>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h3 class="widget-title"><?php _e( 'Meta', 'twentyeleven' ); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->
<?php endif; ?>