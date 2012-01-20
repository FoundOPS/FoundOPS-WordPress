<?php
/**
 * Plugin Name: Google AJAX Feed Slide Show Widget
 * Plugin URI: http://martinj.net/wordpress-plugins/google-ajax-feed-slide-show-widget
 * Description: Image Slideshow from Media RSS.
 * Version: 1.3
 * Author: Martin Jonsson
 * Author URI: http://martinj.net
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

//Add function to register the widget class
add_action('widgets_init', 'google_ajax_feed_slide_show_load_widgets');

//Register function that handles the shortcode
add_shortcode('mj-google-slideshow', 'google_ajax_feed_slide_show_sc');

/**
 * Registers the widget class
 */
function google_ajax_feed_slide_show_load_widgets() {
	register_widget('GoogleAJAXFeedSlideShow_Widget');

	//Add function to load the required stuff to the head and in footer
	add_action('wp_head', 'google_ajax_feed_slide_show_wp_head');
	add_action('wp_footer', 'google_ajax_feed_slide_show_wp_footer');
	
}

/**
 * Put some required javascript/styles in the header
 */
function google_ajax_feed_slide_show_wp_head(){
	echo '<script src="http://www.google.com/jsapi" type="text/javascript"></script>';
  	echo '<script src="http://www.google.com/uds/solutions/slideshow/gfslideshow.js" type="text/javascript"></script>';
}

/**
 * Load google ajax feed in the footer
 */
function google_ajax_feed_slide_show_wp_footer(){
	echo '<script type="text/javascript">google.load("feeds", "1");</script>';
}

function google_ajax_feed_slide_show_option_is_true($value) {
	return $value === true || $value === 'true' || $value === '1' || $value === 'on' || $value === 1;
}

function google_ajax_feed_slide_show_output($options) {
	$id = 'slideshow_' . uniqid();	
	$css_style = '';
	$feed_url = html_entity_decode($options['feed_url']);
	
	if ($options['height']) 
		$css_style .= 'height:' . $options['height'] . 'px;';
	
	if ($options['width']) 
		$css_style .= 'width:' . $options['width'] . 'px;';

	$output = "
		<script type=\"text/javascript\">  
			google.setOnLoadCallback(function() {
				var options = {
				" . ($options['link_target'] !== 'false' ? 'linkTarget: ' . $options['link_target'] . ',': '') .
				($options['num_results'] ? 'numResults: ' . $options['num_results'] . ',': '') .				
				($options['thumbnail_size'] ? 'thumbnailSize: ' . $options['thumbnail_size'] . ',': '') .
				"displayTime: {$options['display_time']},
				transistionTime: {$options['transition_time']},
				scaleImages: " . (google_ajax_feed_slide_show_option_is_true($options['scale_images']) ? 'true' : 'false') . ",
				maintainAspectRatio: " . (google_ajax_feed_slide_show_option_is_true($options['maintain_aspect']) ? 'true' : 'false') . ",
				pauseOnHover: ". (google_ajax_feed_slide_show_option_is_true($options['pause_hover']) ? 'true' : 'false') . ",
				fullControlPanel: " . (google_ajax_feed_slide_show_option_is_true($options['full_control_panel']) ? 'true' : 'false') . ",
				fullControlPanelSmallIcons: " . (google_ajax_feed_slide_show_option_is_true($options['full_control_panel_small']) ? 'true' : 'false') . "
			};
			var feedURL = '{$feed_url}';
			new GFslideShow(feedURL, '{$id}', options);
		});
	</script>	
	<div id=\"{$id}\" class=\"{$options['classname']}\" style=\"{$css_style}\">Loading...</div>
	";
	
	return $output;
}

function google_ajax_feed_slide_show_defaults() {
	return array(
		'title' 					=> __('Photos'),
		'display_time' 				=> '3000',
		'transition_time'			=> '600',
		'scale_images'				=> true,
		'maintain_aspect'			=> true,
		'pause_hover'				=> false,
		'full_control_panel'		=> false,
		'full_control_panel_small'	=> false,
		'link_target'				=> 'false',
		'thumbnail_size'			=> '',
		'num_results'				=> false,
		'feed_url'					=> '',
		'classname'					=> '',
		'width'						=> '400',
		'height'					=> '400',
	);	
}

function google_ajax_feed_slide_show_sc($atts) {
	$options = shortcode_atts(google_ajax_feed_slide_show_defaults(), $atts);
	return google_ajax_feed_slide_show_output($options);
}

class GoogleAJAXFeedSlideShow_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function GoogleAJAXFeedSlideShow_Widget() {
		$widget_ops = array( 'classname' => 'gglslideshow', 'description' => __('A Slideshow Widget that uses Google AJAX Feed API.') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'gglslideshow-widget' );

		$this->WP_Widget( 'gglslideshow-widget', 'Google AJAX Feed Slide Show', $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		
		/* Before widget (defined by themes). */
		echo $before_widget;

		if ($title)
			echo $before_title . $title . $after_title;
		
		if ($instance['html_before'])
			echo $instance['html_before'];
		
		echo google_ajax_feed_slide_show_output($instance);

		if ($instance['html_after'])
			echo $instance['html_after'];

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] 						= $new_instance['title'];
		$instance['feed_url'] 					= $new_instance['feed_url'];

		$instance['display_time']				= $new_instance['display_time'];
		$instance['transition_time'] 			= $new_instance['transition_time'];

		$instance['scale_images']				= $new_instance['scale_images'];
		$instance['maintain_aspect'] 			= $new_instance['maintain_aspect'];
		$instance['pause_hover'] 				= $new_instance['pause_hover'];
		$instance['full_control_panel'] 		= $new_instance['full_control_panel'];
		$instance['full_control_panel_small']	= $new_instance['full_control_panel_small'];
		$instance['link_target'] 				= $new_instance['link_target'];
		$instance['thumbnail_size'] 			= $new_instance['thumbnail_size'];
		$instance['num_results'] 				= $new_instance['num_results'];
		
		$instance['width'] 						= $new_instance['width'];
		$instance['height'] 					= $new_instance['height'];
		$instance['classname'] 					= $new_instance['classname'];

		$instance['html_before'] 				= $new_instance['html_before'];
		$instance['html_after'] 				= $new_instance['html_after'];

		return $instance;
	}

	function form( $instance ) {
		$defaults = google_ajax_feed_slide_show_defaults();

		$instance = wp_parse_args((array)$instance, $defaults); ?>
		
		<!-- Widget Title -->
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>

		<!-- Widget Feed URL -->
		<p>
			<label for="<?php echo $this->get_field_id('feed_url'); ?>"><?php _e('Feed URL:'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('feed_url'); ?>" name="<?php echo $this->get_field_name('feed_url'); ?>" value="<?php echo $instance['feed_url']; ?>" class="widefat"/>
		</p>

		<!-- Widget Num Results -->
		<p>
			<label for="<?php echo $this->get_field_id('num_results'); ?>"><?php _e('Number of images to display:'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('num_results'); ?>" name="<?php echo $this->get_field_name('num_results'); ?>" value="<?php echo $instance['num_results']; ?>" style="width:30px;"/>
		</p>

		<!-- Widget displayTime -->
		<p>
			<label for="<?php echo $this->get_field_id('display_time'); ?>"><?php _e('Display Time (ms):'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('display_time'); ?>" name="<?php echo $this->get_field_name('display_time'); ?>" value="<?php echo $instance['display_time']; ?>" class="widefat" />
		</p>

		<!-- Widget transitionTime -->
		<p>
			<label for="<?php echo $this->get_field_id('transition_time'); ?>"><?php _e('Transition Time (ms):'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('transition_time'); ?>" name="<?php echo $this->get_field_name('transition_time'); ?>" value="<?php echo $instance['transition_time']; ?>" class="widefat" />
		</p>

		<!-- Widget scaleImages, maintainAspectRatio, pauseOnHover, fullControlPanel, fullControlPanelSmallIcons-->
		<p>
			<input type="checkbox" <?php checked( $instance['scale_images'], 'on' ); ?> name="<?php echo $this->get_field_name('scale_images'); ?>" id="<?php echo $this->get_field_id('scale_images'); ?>" class="checkbox">
			<label for="<?php echo $this->get_field_id('scale_images'); ?>"><?php _e('Scale images'); ?></label>
			<br/>
			<input type="checkbox" <?php checked( $instance['maintain_aspect'], 'on' ); ?> name="<?php echo $this->get_field_name('maintain_aspect'); ?>" id="<?php echo $this->get_field_id('maintain_aspect'); ?>" class="checkbox">
			<label for="<?php echo $this->get_field_id('maintain_aspect'); ?>"><?php _e('Maintain aspect ratio'); ?></label>						
			<br/>
			<input type="checkbox" <?php checked( $instance['pause_hover'], 'on' ); ?> name="<?php echo $this->get_field_name('pause_hover'); ?>" id="<?php echo $this->get_field_id('pause_hover'); ?>" class="checkbox">
			<label for="<?php echo $this->get_field_id('pause_hover'); ?>"><?php _e('Pause on hover'); ?></label>						
			<br/>
			<input type="checkbox" <?php checked( $instance['full_control_panel'], 'on' ); ?> name="<?php echo $this->get_field_name('full_control_panel'); ?>" id="<?php echo $this->get_field_id('full_control_panel'); ?>" class="checkbox">
			<label for="<?php echo $this->get_field_id('full_control_panel'); ?>"><?php _e('Full control panel'); ?></label>						
			<br/>
			<input type="checkbox" <?php checked( $instance['full_control_panel_small'], 'on' ); ?> name="<?php echo $this->get_field_name('full_control_panel_small'); ?>" id="<?php echo $this->get_field_id('full_control_panel_small'); ?>" class="checkbox">
			<label for="<?php echo $this->get_field_id('full_control_panel_small'); ?>"><?php _e('Full control panel small images'); ?></label>						
		</p>
		
		<!-- Widget thumbnailSize -->
		<p>
			<label for="<?php echo $this->get_field_id('thumbnail_size'); ?>"><?php _e('Thumbnail Size:'); ?></label> 
			<select id="<?php echo $this->get_field_id('thumbnail_size'); ?>" name="<?php echo $this->get_field_name('thumbnail_size'); ?>" class="widefat">
				<option value="GFslideShow.THUMBNAILS_LARGE" <?php if ( 'GFslideShow.THUMBNAILS_LARGE' == $instance['thumbnail_size'] ) echo 'selected="selected"'; ?>>Large</option>
				<option value="GFslideShow.THUMBNAILS_MEDIUM" <?php if ( 'GFslideShow.THUMBNAILS_MEDIUM' == $instance['thumbnail_size'] ) echo 'selected="selected"'; ?>>Medium</option>
				<option value="GFslideShow.THUMBNAILS_SMALL" <?php if ( 'GFslideShow.THUMBNAILS_SMALL' == $instance['thumbnail_size'] ) echo 'selected="selected"'; ?>>Small</option>
			</select>
		</p>		
		
		<!-- Widget linkTarget -->
		<p>
			<label for="<?php echo $this->get_field_id('link_target'); ?>"><?php _e('Link Target:'); ?></label> 
			<select id="<?php echo $this->get_field_id('link_target'); ?>" name="<?php echo $this->get_field_name('link_target'); ?>" class="widefat">
				<option value="false" <?php if ( 'false' == $instance['link_target'] ) echo 'selected="selected"'; ?>>&lt; Don't link images &gt;</option>
				<option value="google.feeds.LINK_TARGET_SELF" <?php if ( 'google.feeds.LINK_TARGET_SELF' == $instance['link_target'] ) echo 'selected="selected"'; ?>>_self</option>
				<option value="google.feeds.LINK_TARGET_BLANK" <?php if ( 'google.feeds.LINK_TARGET_BLANK' == $instance['link_target'] ) echo 'selected="selected"'; ?>>_blank</option>
				<option value="google.feeds.LINK_TARGET_PARENT" <?php if ( 'google.feeds.LINK_TARGET_PARENT' == $instance['link_target'] ) echo 'selected="selected"'; ?>>_parent</option>
				<option value="google.feeds.LINK_TARGET_TOP" <?php if ( 'google.feeds.LINK_TARGET_TOP' == $instance['link_target'] ) echo 'selected="selected"'; ?>>_top</option>
			</select>
		</p>		

		<!-- Widget Width and Height -->
		<p>
			<label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('width:'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" value="<?php echo $instance['width']; ?>" style="width:30px;" /> px 
			<label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('height:'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" value="<?php echo $instance['height']; ?>" style="width:30px;" /> px
		</p>
		
		<!-- Widget ClassName -->
		<p>
			<label for="<?php echo $this->get_field_id('classname'); ?>"><?php _e('classname:'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id('classname'); ?>" name="<?php echo $this->get_field_name('classname'); ?>" value="<?php echo $instance['classname']; ?>" class="widefat" />
		</p>

		<!-- Widget HTML before -->
		<p>
			<label for="<?php echo $this->get_field_id('html_before'); ?>"><?php _e('HTML before:'); ?></label>
			<textarea id="<?php echo $this->get_field_id('html_before'); ?>" name="<?php echo $this->get_field_name('html_before'); ?>" class="widefat"><?php echo $instance['html_before']; ?></textarea>
		</p>
		<!-- Widget HTML after -->
		<p>
			<label for="<?php echo $this->get_field_id('html_after'); ?>"><?php _e('HTML after:'); ?></label>
			<textarea id="<?php echo $this->get_field_id('html_after'); ?>" name="<?php echo $this->get_field_name('html_after'); ?>" class="widefat"><?php echo $instance['html_after']; ?></textarea>
		</p>
	<?php
	}
}

?>