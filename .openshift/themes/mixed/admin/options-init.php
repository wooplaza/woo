<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('admin_folder_Redux_Framework_config')) {

    class admin_folder_Redux_Framework_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css) {
            //echo '<h1>The compiler hook has run!';
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'redux-framework-demo'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
        function change_arguments($args) {
            $args['dev_mode'] = false;

            return $args;
        }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'redux-framework-demo'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'redux-framework-demo'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'redux-framework-demo'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'redux-framework-demo') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'redux-framework-demo'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'title'     => __('General Settings', 'redux-framework-demo'),
                'icon'      => 'el-icon-home',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(

                   
                    
                    array(
                        'id'        => 'section-media-end',
                        'type'      => 'section',
                        'indent'    => false // Indent all options below until the next 'section' option is set.
                    ),
                    array(
                        'id'        => 'logo',
                        'type'      => 'media',
                        'title'     => __('Logo', 'redux-framework-demo'),
                        'desc'      => __('Maximum logo size should be 300px x 30px, if you want to seem properly on retina screens, upload 400px x 30px.', 'redux-framework-demo'),
                        'subtitle'  => __('Upload a Logo', 'redux-framework-demo'),
                    ),
                    array(
                        'id'        => 'favicon',
                        'type'      => 'media',
                        'title'     => __('Favicon', 'redux-framework-demo'),
                        'desc'      => __('Image should be ico format and 16x16 size ( Exp: favicon.ico ) ', 'redux-framework-demo'),
                        'subtitle'  => __('Upload a favicon', 'redux-framework-demo'),
                    ),  

                     array(
                        'id'        => 'opt-ace-editor-css',
                        'type'      => 'ace_editor',
                        'title'     => __('CSS Code', 'redux-framework-demo'),
                        'subtitle'  => __('Paste your CSS code here.', 'redux-framework-demo'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                        'desc'      => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                        'default'   => "body{\n}"
                    ),
                    array(
                        'id'        => 'opt-ace-editor-js',
                        'type'      => 'ace_editor',
                        'title'     => __('JS Code', 'redux-framework-demo'),
                        'subtitle'  => __('Paste your JS code here.', 'redux-framework-demo'),
                        'mode'      => 'javascript',
                        'theme'     => 'chrome',
                        'desc'      => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                        'default'   => "jQuery(document).ready(function(){\n\n});"
                    ), 

                     array(
                        'id'        => 'credit',
                        'type'      => 'switch',
                        'title'     => __('Themes\' Credit Links', 'redux-framework-demo'),
                        'subtitle'  => __('Theme by Burak Aydin | Powered by WordPress', 'redux-framework-demo'),
                        'default'   => true,
                    ), 

                     array(
                        'id'        => 'opt-editor',
                        'type'      => 'editor',
                        'title'     => __('Footer Text', 'redux-framework-demo'),                       
                        'default'   => '© Copyrights 2014. All Rights Reserved.',
                    ),                                    
                   
                ),
            );

            $this->sections[] = array(
                'type' => 'divide',
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-picture',
                'title'     => __('Slider Setting', 'redux-framework-demo'),
                'fields'    => array( 
                  
                  array(
                        'id'        => 'slider-color',
                        'type'      => 'color',
                        'default'   => '#22262e',
                        'title'     => __('Slider', 'so-panels'),
                        'subtitle'  => __('Change Sliders\' Background Color ', 'so-panels'),
                        'desc'      => __('Slider Color', 'redux-framework-demo'),
                    ),     
                )
            );




                $this->sections[] = array(
                'title'     => __('Social Media', 'redux-framework-demo'),
                'icon'      => 'el-icon-globe',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'        => 'facebook',
                        'type'      => 'text',
                        'title'     => __('Facebook', 'redux-framework-demo'),
                        'placeholder'=> __('Ex : http://burak-aydin.com','redux-framework-demo'),
                        'desc'      => __('Url Validated','redux-framework-demo'),
                        'subtitle'  => __('Paste the url', 'redux-framework-demo'),                        
                        'validate'  => 'url',
                    ), 
                     array(
                        'id'        => 'twitter',
                        'type'      => 'text',
                        'title'     => __('Twitter', 'redux-framework-demo'),
                        'placeholder'=> __('Ex : http://burak-aydin.com','redux-framework-demo'),
                        'desc'      => __('Url Validated','redux-framework-demo'),
                        'subtitle'  => __('Paste the url', 'redux-framework-demo'),                        
                        'validate'  => 'url',
                    ),
                     array(
                        'id'        => 'instagram',
                        'type'      => 'text',
                        'title'     => __('Instagram', 'redux-framework-demo'),
                        'placeholder'=> __('Ex : http://burak-aydin.com','redux-framework-demo'),
                        'desc'      => __('Url Validated','redux-framework-demo'),
                        'subtitle'  => __('Paste the url', 'redux-framework-demo'),                        
                        'validate'  => 'url',
                    ),
                     array(
                        'id'        => 'pinterest',
                        'type'      => 'text',
                        'title'     => __('Pinterest', 'redux-framework-demo'),
                        'placeholder'=> __('Ex : http://burak-aydin.com','redux-framework-demo'),
                        'desc'      => __('Url Validated','redux-framework-demo'),
                        'subtitle'  => __('Paste the url', 'redux-framework-demo'),                        
                        'validate'  => 'url',
                    ),
                     array(
                        'id'        => 'linkedin',
                        'type'      => 'text',
                        'title'     => __('LinkedIn', 'redux-framework-demo'),
                        'placeholder'=> __('Ex : http://burak-aydin.com','redux-framework-demo'),
                        'desc'      => __('Url Validated','redux-framework-demo'),
                        'subtitle'  => __('Paste the url', 'redux-framework-demo'),                        
                        'validate'  => 'url',
                    ),
                     array(
                        'id'        => 'rss',
                        'type'      => 'text',
                        'title'     => __('RSS', 'redux-framework-demo'),
                        'placeholder'=> __('Ex : http://burak-aydin.com','redux-framework-demo'),
                        'desc'      => __('Url Validated','redux-framework-demo'),
                        'subtitle'  => __('Paste the url', 'redux-framework-demo'),                        
                        'validate'  => 'url',
                    ),
                     array(
                        'id'        => 'behance',
                        'type'      => 'text',
                        'title'     => __('Behance', 'redux-framework-demo'),
                        'placeholder'=> __('Ex : http://burak-aydin.com','redux-framework-demo'),
                        'desc'      => __('Url Validated','redux-framework-demo'),
                        'subtitle'  => __('Paste the url', 'redux-framework-demo'),                        
                        'validate'  => 'url',
                    ),
                     array(
                        'id'        => 'github',
                        'type'      => 'text',
                        'title'     => __('Github', 'redux-framework-demo'),
                        'placeholder'=> __('Ex : http://burak-aydin.com','redux-framework-demo'),
                        'desc'      => __('Url Validated','redux-framework-demo'),
                        'subtitle'  => __('Paste the url', 'redux-framework-demo'),                        
                        'validate'  => 'url',
                    ),
                     array(
                        'id'        => 'google',
                        'type'      => 'text',
                        'title'     => __('Google +', 'redux-framework-demo'),
                        'placeholder'=> __('Ex : http://burak-aydin.com','redux-framework-demo'),
                        'desc'      => __('Url Validated','redux-framework-demo'),
                        'subtitle'  => __('Paste the url', 'redux-framework-demo'),                        
                        'validate'  => 'url',
                    ),
                     array(
                        'id'        => 'wordpress',
                        'type'      => 'text',
                        'title'     => __('WordPress', 'redux-framework-demo'),
                        'placeholder'=> __('Ex : http://burak-aydin.com','redux-framework-demo'),
                        'desc'      => __('Url Validated','redux-framework-demo'),
                        'subtitle'  => __('Paste the url', 'redux-framework-demo'),                        
                        'validate'  => 'url',
                    ),
                     array(
                        'id'        => 'youtube',
                        'type'      => 'text',
                        'title'     => __('Youtube', 'redux-framework-demo'),
                        'placeholder'=> __('Ex : http://burak-aydin.com','redux-framework-demo'),
                        'desc'      => __('Url Validated','redux-framework-demo'),
                        'subtitle'  => __('Paste the url', 'redux-framework-demo'),                        
                        'validate'  => 'url',
                    ),
                     array(
                        'id'        => 'flickr',
                        'type'      => 'text',
                        'title'     => __('Flickr', 'redux-framework-demo'),
                        'placeholder'=> __('Ex : http://burak-aydin.com','redux-framework-demo'),
                        'desc'      => __('Url Validated','redux-framework-demo'),
                        'subtitle'  => __('Paste the url', 'redux-framework-demo'),                        
                        'validate'  => 'url',
                    ),    
                ),
            );

           
          
          

            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'redux-framework-demo') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'redux-framework-demo') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'redux-framework-demo') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'redux-framework-demo') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            
            

            $this->sections[] = array(
                'title'     => __('Import / Export', 'redux-framework-demo'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'redux-framework-demo'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     
                    
            $this->sections[] = array(
                'type' => 'divide',
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', 'redux-framework-demo'),
                'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'redux-framework-demo'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );

            
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Mixed Theme Help', 'redux-framework-demo'),
                'content'   => __('<p>If you have any issue, you can contact me via this email : mail@burak-aydin.com</p>', 'redux-framework-demo')
            );

           

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>Theme by <a href="http://burak-aydin.com" target="_blank">Burak Aydin</a></p>', 'redux-framework-demo');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name' => 'mixed',
                'display_name' => 'Mixed WordPress Theme',
                'page_slug' => '_options',
                'page_title' => 'Mixed Options',
                'intro_text' => '',
                'footer_text' => 'Mixed Theme by Burak Aydin',
                'admin_bar' => '1',
                'menu_type' => 'submenu',
                'menu_title' => 'Mixed Options',
                'allow_sub_menu' => '1',
                'page_parent_post_type' => 'your_post_type',
                'page_priority' => '100',
                'default_mark' => '*',
                'google_api_key' => 'muslum-baba',
                'hints' => 
                array(
                  'icon' => 'el-icon-question-sign',
                  'icon_position' => 'right',
                  'icon_color' => '#dd3333',
                  'icon_size' => 'large',
                  'tip_style' => 
                  array(
                    'color' => 'light',
                    'style' => 'youtube',
                  ),
                  'tip_position' => 
                  array(
                    'my' => 'top left',
                    'at' => 'bottom right',
                  ),
                  'tip_effect' => 
                  array(
                    'show' => 
                    array(
                      'effect' => 'fade',
                      'duration' => '100',
                      'event' => 'mouseover',
                    ),
                    'hide' => 
                    array(
                      'effect' => 'fade',
                      'duration' => '100',
                      'event' => 'mouseleave unfocus',
                    ),
                  ),
                ),
                'output' => '1',
                'compiler' => '1',
                'global_variable' => 'mixed',
                'page_icon' => 'icon-upload',
                'page_permissions' => 'manage_options',
                'save_defaults' => '1',
                'show_import_export' => '1',
                'last_tab' => '1',
                'transient_time' => '3600',
                'network_sites' => '1',
              );

            
            $this->args['share_icons'][] = array(
                'url'   => 'http://burak-aydin.com/',
                'title' => 'My Personal Page',
                'icon'  => 'el-icon-website-alt'
            ); 

            $this->args['share_icons'][] = array(
                'url'   => 'http://profiles.wordpress.org/burakkaptan/',
                'title' => 'My WordPress Profile',
                'icon'  => 'el-icon-wordpress'
            );            
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.behance.net/buraksdu',
                'title' => 'Follow me on Behance',
                'icon'  => 'el-icon-behance'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://tr.linkedin.com/pub/burak-ayd%C4%B1n/91/800/181',
                'title' => 'Find me on LinkedIn',
                'icon'  => 'el-icon-linkedin'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://twitter.com/buraksdu',
                'title' => 'Follow me on Twitter',
                'icon'  => 'el-icon-twitter'
            );

        }

    }
    
    global $reduxConfig;
    $reduxConfig = new admin_folder_Redux_Framework_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('admin_folder_my_custom_field')):
    function admin_folder_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('admin_folder_validate_callback_function')):
    function admin_folder_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
