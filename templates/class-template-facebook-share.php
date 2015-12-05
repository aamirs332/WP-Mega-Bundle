<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/**
 * @init Facebook Share Template
 * $return {}
 */
if (!class_exists('MB_Template_Facebook_Share')) {

    class MB_Template_Facebook_Share  extends MB_System_Helper{

        public static $counter;

        /**
         * @init Facebook Share
         * $return {}
         */
        public function __construct() {
            global $mb_plugin_options;
            $mb_plugin_options = get_option('mb_plugin_options');
            add_action('mb_prepare_facebook_share' , array (&$this , 'mb_render_facebook_share_html'),5);
            add_action('wp_head' , array (&$this , 'mb_init_fb_script'));
        }

        /**
         * @return Facebook Share HTML
         */
        public function mb_render_facebook_share_html( $args = array() ) {
            global $mb_plugin_options;
            $counter = $this->mb_get_uniqueue_flag(5);

            $button_url = $args['fb_share_button_url'];
            $layout     = $args['mb_fb_share_layout'];
            
            $mb_output = sprintf('<div class="fb-share-button" '
                    . 'data-href="%s" '
                    . 'data-layout="%s"></div>', $button_url, $layout);

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
                    if (d.getElementById(id))
                        return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=314663488736894";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
            <?php
        }

    }

    new MB_Template_Facebook_Share();
}