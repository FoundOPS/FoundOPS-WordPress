<?php 
/*
Plugin Name: Read More Right Here
Plugin URI: http://www.wooliet.com/wp-plugins/
Description: Allow users to view your entry's &lt;!--more--&gt; content immediately.
Author: William King
Author URI: http://www.wooliet.com
Version: 2.0.0
*/

if (!class_exists('WtReadMoreRightHerePluginOptions')) 
{
	
	class WtReadMoreRightHerePluginOptions
	{
		const OPTIONS_ID = 'WT_ReadMoreRightHere_PluginOptions';
		const OPTIONS_PAGE_ID = 'WT_ReadMoreRightHere_PluginOptionsPage';
		
		const OPTIONS_PAGE_TITLE = 'Read More Right Here Plugin Options';
		const SETTINGS_MENU_TEXT = 'Read More Right Here';
		
		
		const LOADER_IMG_KEY = 'loaderImageURL';
		const DUPLICATE_LINK_KEY = 'duplicateLink'; 
        const ANIMATE_SPEED_KEY = 'animateSpeed';
        const EXPANDED_TEXT_KEY = 'expandedText';

        // The following 'key' CONST values need to be
        //  removed from the client-side options
        const INCLUDE_PAGES_KEY = 'includePages';
        const USE_UTF8_DECODE_KEY = 'useUtf8Decode'; 
        const LOAD_DEBUG_SCRIPT_KEY = 'loadDebugScript';
        
        const LOADER_DIR_NAME = 'loader';
        const LOADER_IMG_NONE_VALUE = '-- None --';
        
        /***
         * The name of the image to display while the "Read More" content
         *  is loaded. It is assumed this file exists in the "loader" directory
         *  at the root of this plugin's directory.
         * <br>
         * @var string
         * default:  LOAD_IMAGE_NAME = 'ajax-loader.gif';
         */ 
        const LOAD_IMAGE_NAME = 'ajax-loader.gif';
        
        /***
         * Text used as a replacement for the 'read more' link in the post.
         *  Leave as an empty string to prevent any change
         * <br>
         * @var string
         * default:  MORE_TEXT_ON_EXPAND = "";
         */     
        const MORE_TEXT_ON_EXPAND = "";
        // &uarr;&uarr;(show less)&uarr;&uarr;
        
        
        /***
         * The speed (in milliseconds) with which the post expands to display
         *   the new content
         * <br>
         * @var int
         * default:  ANIMATE_SPEED = 1000;
         */
        const ANIMATE_SPEED = 1000;        
        
        /***
         * If true, the 'more link' anchor element will be duplicated and moved
         *   to after the displayed post's content. This is useful if you wish 
         *   for the reads to be able to collapse the text from the bottom
         *   of the post (and not just from the default 'more link' location).
         * <br>
         * @var boolean
         * default:  ADD_CLONE_LINK_ON_EXPAND = false;
         */
        const ADD_CLONE_LINK_ON_EXPAND = false;
        

        /***
         * If true, the plugin will work on the 'more' link included on
         *   single wordpress pages. This requires setting the global
         *   $more value to 0 before 'the_content' call in the WP loop.
         *   See http://codex.wordpress.org/Customizing_the_Read_More
         *   for mroe details.
         * <br>
         * @var boolean
         * default:  INCLUDE_PAGES = false;
         */
        const INCLUDE_PAGES = false;
        
        /***
         * The AJAX loaded more content is passed through php's
         * 'utf8_decode' function.
         * <br>
         * @var boolean
         * default:  USE_UTF8_DECODE = false;
         */
        const USE_UTF8_DECODE = false;
        
        /***
         * If true, will use the uncompressed javascript
         * file.
         * <br>
         * @var boolean
         * default: LOAD_DEBUG_SCRIPT = false;
         */
        const LOAD_DEBUG_SCRIPT = false;
		
        
		var $defaults = array
		(
			self::LOADER_IMG_KEY         => self::LOAD_IMAGE_NAME,
			self::DUPLICATE_LINK_KEY     => self::ADD_CLONE_LINK_ON_EXPAND,
			self::ANIMATE_SPEED_KEY      => self::ANIMATE_SPEED,
			self::EXPANDED_TEXT_KEY      => self::MORE_TEXT_ON_EXPAND,
			self::INCLUDE_PAGES_KEY      => self::INCLUDE_PAGES,
			self::LOAD_DEBUG_SCRIPT_KEY => self::LOAD_DEBUG_SCRIPT
		);          
        
		/***
		 * Old constructor
		 */
		function WtReadMoreRightHerePluginOptions()
		{
			$this->__construct();
		}
		
		/***
		 * New constructor
		 */
		function __construct()
		{
            $this->AddActions();
            //register_activation_hook(__FILE__, array($this,'SetOptionDefaults'));
            $this->SetOptionDefaults();
		}
		
		public function AddActions()
		{
			add_action('admin_menu', array($this,'AdminMenu'));			
			add_action('admin_init', array($this,'RegisterSettings'));
		}
		
        public function AdminMenu()
        {
            add_options_page(
                self::OPTIONS_PAGE_TITLE, 
                self::SETTINGS_MENU_TEXT, 
                'manage_options', 
                self::OPTIONS_PAGE_ID, 
                array($this,'AddOptionsPage')); 
        }
        
        public function AddOptionsPage()
        {
            include(plugin_dir_path(__FILE__) . 'display/options_page.php');
        }   
        		
		
		private function SetOptionDefaults()
		{
			// add the plugin directory to the defaults
			$this->defaults['pluginUrl'] = plugin_dir_url(__FILE__);
			
			$options = NULL;
			if($this->CheckForDefaultsReset())
			{
				$options = $this->defaults;
			}
			else
			{
				$current = $this->GetOptions();
				$options = wp_parse_args($current,$this->defaults);				
			}
			update_option(self::OPTIONS_ID,$options);
		}
		
		// TODO : CheckForDefaultsReset doesn't work
		public function CheckForDefaultsReset()
		{
			if($_POST['SetDefaults'])
			{
				return true;
			}
			
			return false;
		}

		public function RegisterSettings()
		{
			$settingsId = self::OPTIONS_ID;
			
			register_setting($settingsId,$settingsId,array($this,'ValidateOptions'));			

			$this->AddMainSection();
			$this->AddTroubleshootingSection();
		}
		
	    public function DisplayMainSection()
        {
            //echo '<p>Control how the RMRH plugin functions.</p>';
        }
		
		private function AddMainSection()
		{
            $sectionId = 'WTRMRH-MainSection';
            add_settings_section($sectionId,'Main Options',array($this,'DisplayMainSection'),self::OPTIONS_PAGE_ID);
            			
			add_settings_field(
				 'LoadImageInputField', 
				 'Loader Image' . $this->GetLoaderImageDisplay(), 
				 array($this,'DisplayLoaderImageField'), 
				 self::OPTIONS_PAGE_ID, 
				 $sectionId);
				 
            add_settings_field(
                 'ExpandedTextInputField', 
                 'Link Text On Expanded Content', 
                 array($this,'DisplayExpandedLinkTextField'), 
                 self::OPTIONS_PAGE_ID, 
                 $sectionId);

            add_settings_field(
                 'ExpandAnimationSpeed', 
                 'New Content Expand Speed', 
                 array($this,'DisplayAnimationSpeedTextField'), 
                 self::OPTIONS_PAGE_ID, 
                 $sectionId);
                 
            add_settings_field(
                 'CloneMoreLink', 
                 'Duplicate More Link', 
                 array($this,'DisplayCloneLinkCheckBox'), 
                 self::OPTIONS_PAGE_ID, 
                 $sectionId);
                 
            add_settings_field(
                 'IncludeOnPages', 
                 'Use with Wordpress Pages', 
                 array($this,'DisplayPageIncludeCheckBox'), 
                 self::OPTIONS_PAGE_ID, 
                 $sectionId);             
		}
		
	    public function DisplayTroubleShootingSection()
        {
            //echo '<p>Troubleshoot issues</p>';
        }       
        
        private function AddTroubleshootingSection()
        {
            $sectionId = 'WTRMRH-TroubleshootingSection';
            add_settings_section($sectionId,'<div style="margin-top:45px;">Troubleshooting</div>',array($this,'DisplayTroubleShootingSection'),self::OPTIONS_PAGE_ID);
            
            add_settings_field(
                 'UseUTF8Decode', 
                 'Use UTF-8 Decode', 
                 array($this,'DisplayUseUTF8DecodeCheckBox'), 
                 self::OPTIONS_PAGE_ID, 
                 $sectionId); 
                 
            add_settings_field(
                 'LoadDebugScript', 
                 'Use Debug Script', 
                 array($this,'DisplayLoadDebugScriptCheckBox'), 
                 self::OPTIONS_PAGE_ID, 
                 $sectionId);                
        }		
		
		private function GetLoaderImageDisplay()
		{
			$optionValue = $this->GetOptionValue(self::LOADER_IMG_KEY);
            if($optionValue == '')
            {
                return '';
            }
            else
            {
                //return sprintf("<p style='float:right;margin:0 3px 0 0'><img src='%s'/></p>",$this->GetLoadImagesUrl($optionValue));
                return sprintf("<img style='float:right;' src='%s'/>",$this->GetLoadImagesUrl($optionValue));
            }
		}
        
		public function DisplayLoaderImageField()
		{
            $files = $this->GetLoaderImages();          
            $filesString = implode(",",$files);

            $id = 'loader-image-select';
            $optionNameAttr = $this->GetOptionNameAttr(self::LOADER_IMG_KEY);
            $optionValue = $this->GetOptionValue(self::LOADER_IMG_KEY);
?>
            <select id='<?php echo $id ?>' <?php echo $optionNameAttr ?>>
            <?php       
                echo $this->GetSelectOption(self::LOADER_IMG_NONE_VALUE,$optionValue);          
                foreach($files as $file)
                {
                    echo $this->GetSelectOption($file,$optionValue);
                }                
            ?>
            </select>
<?php
		}
		
		public function DisplayCloneLinkCheckBox()
		{
			$input = $this->GetCheckBoxInput(self::DUPLICATE_LINK_KEY,'duplicate-link-checkbox');
			echo $input . '<em style="padding-left:10px;">Add second "more" link to bottom of expanded content</em>';
		}
		
		public function DisplayExpandedLinkTextField()
		{
			$input = $this->GetTextInput(self::EXPANDED_TEXT_KEY,'expanded-text-input');
            echo $input. '<br/><em>Link text displayed after click; leave blank to keep unchanged</em>';
		}
		
		public function DisplayAnimationSpeedTextField()
		{
			$input = $this->GetTextInput(self::ANIMATE_SPEED_KEY,'animate-speed-text-input');
			echo $input. '<br/><em>Duration (in milliseconds) of new content expansion</em>';
		}
		
	    public function DisplayUseUTF8DecodeCheckBox()
        {
            $input = $this->GetCheckBoxInput(self::USE_UTF8_DECODE_KEY,'utf8decode-checkbox');
            echo $input . '<em style="padding-left:10px;">Run <code><a href="http://php.net/manual/en/function.utf8-decode.php" target="_blank">utf8_decode</a></code> on returned content.</em>';          
        }		
		
		public function DisplayPageIncludeCheckBox()
		{
			$input = $this->GetCheckBoxInput(self::INCLUDE_PAGES_KEY,'include-pages-checkbox');
			echo $input . '<em style="padding-left:10px;">(see <a href="http://codex.wordpress.org/Customizing_the_Read_More" target="_blank">How to use Read More in Pages</a>)</em>';
		}
		
	    public function DisplayLoadDebugScriptCheckBox()
        {
            $input = $this->GetCheckBoxInput(self::LOAD_DEBUG_SCRIPT_KEY,'load-debug-script-checkbox');
            echo $input . '<em style="padding-left:10px;">Loads the uncompressed javascript for debugging</em>';
        }		
		
		private function GetSelectOption($value, $selectedValue)
		{
			$selected = ($value == $selectedValue) ? 'selected="selected"' : '';
			return "<option value='$value' $selected style='padding:3px 10px;'>$value</option>";
		}
		
		private function GetTextInput($optionKey, $id)
		{
            $optionValue = $this->GetOptionValue($optionKey);
            $optionNameAttr = $this->GetOptionNameAttr($optionKey);
            return "<input id='$id' $optionNameAttr size='40' type='text' value='$optionValue' />";
		}
		
		private function GetCheckBoxInput($optionKey, $id)
		{
            $optionValue = $this->GetOptionValue($optionKey);
            $optionNameAttr = $this->GetOptionNameAttr($optionKey);
            
            $checked = $optionValue ? 'checked="checked"' : '';
            
            return "<input $checked id='$id' $optionNameAttr type='checkbox' />";            
		}
		
        /***
         * All options must be added to this as only those 'valid' will
         * be included. If not set here the value will never change.
         */
        public function ValidateOptions($input)
        {
            $options = $this->GetOptions();
            
            
            $loaderFileName = trim($input[self::LOADER_IMG_KEY]);
            
            // If no loader selected
            if($loaderFileName == self::LOADER_IMG_NONE_VALUE)
            {
            	$options[self::LOADER_IMG_KEY] = '';
            }
            // Loader selected, check that it's a valid file
            else
            {
	            $loaderFilePath = $this->GetLoaderImagesDirPath($loaderFileName);
	            if(strlen($loaderFileName) > 0 && file_exists($loaderFilePath))
	            {
	                $options[self::LOADER_IMG_KEY] =  $loaderFileName;
	            }
            }
            
            // Animation speed must be a number greater than -1
            $animationSpeed = $input[self::ANIMATE_SPEED_KEY];
            if(is_numeric($animationSpeed))
            {
                if($animationSpeed >= 0)
                {
                    $options[self::ANIMATE_SPEED_KEY] =  $animationSpeed;
                }   
            }
            
            // No validation on expansion text
            $options[self::EXPANDED_TEXT_KEY] = $input[self::EXPANDED_TEXT_KEY];
            
            // No validation on inclusion with pages
            $options[self::INCLUDE_PAGES_KEY] = $input[self::INCLUDE_PAGES_KEY] ? true : false;
            
            // No validation of clone link
            $options[self::DUPLICATE_LINK_KEY] = $input[self::DUPLICATE_LINK_KEY] ? true : false;
            
            // No validation of UTF-8 decode option
            $options[self::USE_UTF8_DECODE_KEY] = $input[self::USE_UTF8_DECODE_KEY] ? true : false;
            
            // No validation of debug script option
            $options[self::LOAD_DEBUG_SCRIPT_KEY] = $input[self::LOAD_DEBUG_SCRIPT_KEY] ? true : false;
            
            return $options;
        }   		
		
		/***
		 * Returns 'name' element attribute for use on a 
		 * DOM element; format of "name='[option value]'"
		 */
		private function GetOptionNameAttr($option)
		{
			return sprintf("name='%s[%s]'",self::OPTIONS_ID,$option);
		}
		
		/***
		 * Returns the stored value for the given plugin
		 * option.
		 */
		private function GetOptionValue($option)
		{
			$options = $this->GetOptions();
			return $options[$option];
		}
		
		/***
		 * Returns all plugin options
		 */
		private function GetOptions()
		{
			return get_option(self::OPTIONS_ID);
		}
		
        /***
         * Returns array of all image file names found in
         * the plugin's loader directory
         */
		private function GetLoaderImages()
		{
			$result = array();
			$dirPath = $this->GetLoaderImagesDirPath();
			// 'list_files' WP function in wp-admin/includes/file.php
			$files = list_files($dirPath,1);
			$validExtentions = array('gif','jpg','jpeg','png');
			foreach($files as $file)
			{
				$fileInfo = pathinfo($file);
				$extension = strtolower($fileInfo['extension']);
				if(in_array($extension,$validExtentions))
				{
					array_push($result, $fileInfo['basename']);
				}
			}
			natsort($result);
			return $result;
		}

	    /***
         * Returns the key=>value array of options that will
         * be tranformed to a javascript object literal for
         * client-side access to options.
         */
        public function GetClientSideOptions()
        {
            $result = $this->GetOptions();
            
            // remove those not relevant to client script
            unset($result[self::INCLUDE_PAGES_KEY]);
            unset($result[self::USE_UTF8_DECODE_KEY]);
            
            // set loader image path
            $this->SetClientSideLoaderImageOption($result);
            
            return $result;
        }
        
        /***
         * Takes the provided options array and, if there is an
         * image loader file, that option is replaced by the
         * URL to that image.
         */
        private function SetClientSideLoaderImageOption(&$options)
        {
        	$imageFile = $options[self::LOADER_IMG_KEY];
        	if($imageFile != '')
        	{
	            $options[self::LOADER_IMG_KEY] = $this->GetLoadImagesUrl($imageFile);
        	}
        }
		
		/***
		 * Returns file system path to the plugin's loader
		 * images directory
		 */
		public function GetLoaderImagesDirPath()
		{
			return plugin_dir_path(__FILE__) . self::LOADER_DIR_NAME . '/';
		}
		
		/***
		 * Returns URL to the plugin's loader images
		 * directory
		 */
		public function GetLoadImagesUrl($imageFile = '')
		{
			$result = plugin_dir_url(__FILE__) . self::LOADER_DIR_NAME . '/';
			if($imageFile != '')
			{
				$result = $result . $imageFile;
			}
			return $result;
		}
		
		/***
		 * Returns boolean indicating if option to include plugin
		 * in WP pages has been enabled.
		 */
		public function IncludeInPages()
		{
			return $this->GetOptionValue(self::INCLUDE_PAGES_KEY);
		}
		
		/***
		 * Returns boolean indicating if option to run returned
		 * content through PHP's 'utf8_decode' has been enabled.
		 */
        public function UseUTF8Decode()
        {
        	return $this->GetOptionValue(self::USE_UTF8_DECODE_KEY);
        }
        
        /***
         * Returns boolean indicating if the uncompressed javascript
         * file should be used.
         */
        public function UseDebugScript()
        {
        	return $this->GetOptionValue(self::LOAD_DEBUG_SCRIPT_KEY);
        }
	}

} // class exists = WtReadMoreRightHerePluginOptions

if (!class_exists('WtReadMoreRightHerePlugin')) 
{
	

	class WtReadMoreRightHerePlugin
	{
	    var $Options = NULL;
	    
	    /***
	     * Old constructor
	     */
	    function WtReadMoreRightHerePlugin()
	    {
	        $this->__construct();
	    }    
	    
	    /***
	     * New Constructor
	     */
	    function __construct()
	    {
	    	$this->AddActions();
	    	$this->AddFilters();
	    	
            $this->Options = new WtReadMoreRightHerePluginOptions;
	    }
	    
	    /***
	     * Add WP filter handlers
	     */
	    private function AddFilters()
	    {
	    	// Big 999 to try to make sure last filter applied
	    	add_filter('the_content_more_link', array($this,'FilterMoreLinks'),999);
	    }
	    
	    /***
	     * Add WP action handlers
	     */
	    private function AddActions()
	    {
	    	add_action('init', array(&$this,'Init'));
	    }
	    
	    /***
	     * Returns boolean value indicating if the plugin script should
	     * be loaded to the page
	     */
	    private function CanLoadScript()
	    {
            // 1. Stay out of admin pages
            if(is_admin())
            {
                return false;
            }
            // 2. Only load for single page if option selected
            if(is_page() && !$this->Options->IncludeInPages())
            {
            	return false;
            } 
            
            return true;
	    }
	    
	    /***
	     * Plugin initialization
	     */
	    function Init()
	    {   
	        if($this->CanLoadScript())
	        {    	
		    	// Will 'exit' if request handled and skip rest of method    	
		        $this->HandleRequest();            	
	
		        $scriptFile = $this->Options->UseDebugScript() ? 'wt_rmrh-debug.js' : 'wt_rmrh.js';
		        
		        $scriptUrl = plugin_dir_url(__FILE__) . "js/$scriptFile";
		        
		        // wt_rmrh.js can be replaced with wt_rmrh-debug.js
		        // to debug uncompressed javascript source
		        wp_register_script(
		            'wt_rmrh', 
		            $scriptUrl,
		            array('jquery'));
		            
		        wp_enqueue_script('wt_rmrh');		        
	        
		        // This injects the defined values into the page header
		        // to make available in our javascript.
		        wp_localize_script('wt_rmrh', 
		                           'RMRH_VALUES', 
		                           $this->GetOptions());
		    }
	    }
		
	    /***
	     * Returns client-side options 'localized' by WP
	     */
	    private function GetOptions()
	    {
	    	$result = $this->Options->GetClientSideOptions();
	        return $result;
	    }
	    
	    /***
	     * Handle plugin client-side request and 'exit'
	     */
	    private function HandleRequest()
	    {
	        if($this->IsPluginAjaxRequest())
		    {   
		        global $more;
	            $id = $_POST['itemid'];
	            $spanId = "more-" . $id;
	            
		        // If nothing found, will send 404 and 'exit'
		        $this->RunPostQuery($id);
		        
		        // Make sure full content pulled
		        $more = true;
		        $content = get_the_content();
		    
		        // Have to apply any filters; 'get_the_content' does
		        // not do this (copied from 'the_content', WP function)
		        $content = apply_filters('the_content', $content);
		        $content = str_replace(']]>', ']]&gt;', $content);
		        
		        // grab only the stuff after 'more'
		        $explodeTarget = sprintf('<span id="%s"></span>',$spanId);
		        $debris = explode($explodeTarget, $content);
		        
		        $content = $debris[1];
		        
		        if($this->Options->UseUTF8Decode())
		        {
		        	$content = utf8_decode($content);
		        }

		        echo $content;
		        exit;        
		    }
	    }
	    
	    /***
	     * Runs the WP query searching for any post or page
	     * with the given id
	     */
	    function RunPostQuery($id)
	    {
			$wpQuery = new WP_Query(array
			( 
				'post_type' => 'any', 
				'p' => $id 
			));     
			
			if(!$wpQuery->have_posts())
			{       
				// no post with matching id, return 404
				header("HTTP/1.0 404 Not Found");
				exit;
			}
			
			$wpQuery->the_post();
	    }
	    
	    /***
	     * Checks the request header as well as plugin POST variables to
	     * determine if it's an AJAX request we should handle.
	     */
	    function IsPluginAjaxRequest()
	    {
	    	$result = false;
	    	$requestedWith = $_SERVER['HTTP_X_REQUESTED_WITH'];
	    	
			// Check request header for AJAX (should be set client-side)		
			if(!empty($requestedWith) && strtolower($requestedWith) == 'xmlhttprequest') 
			{
				// Check for plugin specific POST parameters
				if($_POST && $_POST['wt-rmrh-redirect'] == '1' && isset($_POST['itemid']))
				{
	                $result = true;
				}
			}    	
	    	
	    	return $result;
	    }
	    
		 /**
		 * The purpse of this filter is to add a custom class to the
		 *   more link that can be used to identify the post ID regardless
		 *   of the link structure used. In other words, remove the
		 *   reliance on the "#[post-id]" in the link.
		 * <br>
		 * @param $link
		 * @return $link with new class
		 */
	    function FilterMoreLinks($link)
	    {
			global $post;
			$result = $link;
			if($this->CanLoadScript())
			{	
				$target = "class=\"";
				$pos = strpos($link,$target);
		 
				$newClass = "rmrh-itemId-". $post->ID;
		
				// the 'class' has been completely removed, add it back
				if($pos === false)
				{
					$target = "<a ";
					$pos = strpos($link,$target);
					$replacement = "class=\"" . $newClass . "\" ";
				}
				else
				{
				  $replacement = $newClass . " ";
				}
		
				$at = $pos + strlen($target);
				$result = substr_replace($link, $replacement,$at,0);
			}
			return $result;
	    }
	}

    new WtReadMoreRightHerePlugin;

} // class exists
?>
