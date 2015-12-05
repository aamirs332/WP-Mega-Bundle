<?php defined('ABSPATH') or die('No script kiddies please!');
/*
  Plugin Name: Social Mega Bundle
  Plugin URI: http://xaraar.com/
  Description: Mega Bundle for social and WP Widgets and shortcodes
  Version: 1.0
  Author: Aamir Shahzad
  Author URI: http://xaraar.com/
  License: GPL2
 */

if (!class_exists('Wp_Mega_Bundle')) {

    class Wp_Mega_Bundle {

        public $plugin_url;
        public $plugin_dir;

        public function __construct() {
            $this->plugin_url = plugin_dir_url(__FILE__);
            $this->plugin_dir = plugin_dir_path(__FILE__);
            require_once('core/class-core.php');
            require_once('core/modules/class-config.php');
            require_once('core/form-options/class-form-attributes.php');
            require_once('core/modules/mailchimp/class-mailchimp.php');
            require_once('core/modules/flickr/class-flickr.php');
            require_once('core/modules/instagram/class-instagram.php');
            require_once('core/modules/twitter/class-twitter.php');
            require_once('core/modules/facebook/class-facebook.php');
            
            //helpers
            require_once('helpers/class-system-helpers.php');
            
            //Templates
            require_once('templates/init.php');
            
            //Widgets
            require_once('widgets/init.php');
            
            //shortcodes
            require_once('shortcodes/init.php');
            
            
            
            //Libraries
            require_once('libraries/mailchimp/class-mailchimp-oath.php');
            require_once('libraries/twitter/twitteroauth.php');
            
            
             
            add_action('wp_enqueue_scripts' , array (&$this , 'mb_frontend_enqueue_assets'));
            add_action( 'admin_init', array(&$this,'mb_enqueue_admin_assets' ));
        }

        /**
         *
         * @PLugin URl
         */
        public static function plugin_url() {
            return plugin_dir_url(__FILE__);
        }

        /**
         *
         * @Plugin Images Path
         */
        public static function plugin_img_url() {
            return plugin_dir_url(__FILE__);
        }

        /**
         *
         * @Plugin Directory URL
         */
        public static function plugin_dir() {
            return plugin_dir_path(__FILE__);
        }

        /**
         *
         * @Plugin Activation
         */
        public static function activate() {
            global $mb_plugin_options;
            $mb_plugin_options  = get_option('mb_plugin_options');
        }

        /**
         *
         * @Plugin deactivation
         */
        public static function deactivate() {
            //do something
        }

        /**
         * enqeueue frontend assets
         */
        public function mb_frontend_enqueue_assets() {
            // JS
            wp_enqueue_script('jquery');
            wp_enqueue_script('mb_owl_js' , plugins_url('js/owl.carousel.min.js' , __FILE__) , array ('jquery') , '1.0' , true);
            //Styles
            wp_enqueue_style('mb_frontend_styles.css' , plugins_url('css/mb_style.css' , __FILE__));
            wp_enqueue_style('mb_flaticon_style.css' , plugins_url('core/assets/css/flaticon.css' , __FILE__));
            wp_enqueue_style('mb_owl_carousel.css' , plugins_url('css/owl.carousel.css' , __FILE__));
            wp_enqueue_style('mb_owl_theme.css' , plugins_url('css/owl.theme.css' , __FILE__));
        }

      
        /**
         * enqeueue admin assets
         */
        public static function mb_enqueue_admin_assets() {
            //Js
            wp_enqueue_script('jquery');
            wp_enqueue_script('mb_shortcodes_js' , plugins_url('core/assets/js/shortcode_handler.js' , __FILE__) , array ('jquery') , '1.0' , true); 
            wp_enqueue_script('mb_function_js' , plugins_url('core/assets/js/functions.js' , __FILE__) , array ('jquery') , '1.0' , true);
            wp_enqueue_script('mb_sticky_js' , plugins_url('core/assets/js/sticky.js' , __FILE__) , array ('jquery') , '1.0' , true); 
            //Styles
            wp_enqueue_style('mb_sticky.css' , plugins_url('core/assets/css/sticky.css' , __FILE__));
            wp_enqueue_style('mb_styles.css' , plugins_url('core/assets/css/styles.css' , __FILE__));
                
        }
    }

    new Wp_Mega_Bundle();
    register_activation_hook(__FILE__ , array ('Wp_Mega_Bundle' , 'activate'));
    register_deactivation_hook(__FILE__ , array ('Wp_Mega_Bundle' , 'deactivate'));
}
