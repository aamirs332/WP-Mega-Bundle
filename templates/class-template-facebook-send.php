<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/**
 * @init Facebook Send Template
 * $return {}
 */
if (!class_exists('MB_Template_Facebook_Send')) {

    class MB_Template_Facebook_Send  extends MB_System_Helper{

        public static $counter;
        
        /**
         * @init Facebook Send
         * $return {}
         */
        public function __construct() {
            global $mb_plugin_options;
            $mb_plugin_options = get_option('mb_plugin_options');
            add_action('mb_prepare_facebook_send' , array (&$this , 'mb_render_facebook_send_html'),5);
            add_action('wp_head' , array (&$this , 'mb_init_fb_script'));
        }

        /**
         * @return Facebook Send HTML
         */
        public function mb_render_facebook_send_html( $args = array() ) {
            global $mb_plugin_options;
            $flag = $this->mb_get_uniqueue_flag(5);

            $fb_send_button_url = $args['fb_send_to_url'];
            
            $mb_output = sprintf('<div class="fb-send" data-href="%s" data-layout="button_count"></div>', $fb_send_button_url);

            echo force_balance_tags( $mb_output );
            
        }
        
        /**
         * @init fb script
         */
        public function mb_init_fb_script() {
            ?>
            <div id="fb-root"></div>
            <script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            <?php
        }

    }

    new MB_Template_Facebook_Send();
}