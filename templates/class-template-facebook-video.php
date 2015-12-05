<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/**
 * @init Facebook Video Template
 * $return {}
 */
if (!class_exists('MB_Template_Facebook_Video')) {

    class MB_Template_Facebook_Video extends MB_System_Helper {

        public static $counter;

        /**
         * @init Facebook Video
         * $return {}
         */
        public function __construct() {
            global $mb_plugin_options;
            $mb_plugin_options = get_option('mb_plugin_options');
            add_action('mb_prepare_facebook_video' , array (&$this , 'mb_render_facebook_video_html') , 5);
            add_action('wp_head' , array (&$this , 'mb_init_fb_script'));
        }

        /**
         * @return Facebook Video HTML
         */
        public function mb_render_facebook_video_html($args = array ()) {
            global $mb_plugin_options;
            $flag = $this->mb_get_uniqueue_flag(5);

            $fb_video_url  = $args['fb_video_url'];
            $fb_fullscreen = $args['fb_fullscreen'];
            $fb_width      = $args['fb_width'];
            $fb_autoplay   = $args['fb_autoplay'];

            $mb_output = sprintf('<div class="fb-video"
                                    data-href="%s"
                                    data-width="%s"
                                    data-allowfullscreen="%s"
                                    data-autoplay="%s"></div>'
                    , $fb_video_url
                    , $fb_width
                    , $fb_fullscreen
                    , $fb_autoplay
            );

            echo force_balance_tags($mb_output);
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
              js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.5&appId=324956780898651";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
            <?php
        }

    }

    new MB_Template_Facebook_Video();
}