<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/**
 * @init Facebook Like Template
 * $return {}
 */
if (!class_exists('MB_Template_Facebook_Like')) {

    class MB_Template_Facebook_Like extends MB_System_Helper {

        public static $counter;

        /**
         * @init Facebook Like
         * $return {}
         */
        public function __construct() {
            global $mb_plugin_options;
            $mb_plugin_options = get_option('mb_plugin_options');
            add_action('mb_prepare_facebook_like' , array (&$this , 'mb_render_facebook_like_html'),5);
            add_action('wp_head' , array (&$this , 'mb_init_fb_script'));
        }

        /**
         * @return Facebook Like HTML
         */
        public function mb_render_facebook_like_html( $args = array() ) {
            global $mb_plugin_options;
            $counter = $this->mb_get_uniqueue_flag(5);

            $show_friends_faces         = isset($args['fb_show_like_friends_faces']) ? $args['fb_show_like_friends_faces'] : '';
            $include_facebook_button    = isset($args['mb_fb_include_button']) ? $args['mb_fb_include_button'] : '';
            $url_to_like                = isset($args['url_to_like']) ? $args['url_to_like'] : '';
            $layout                     = isset($args['mb_fb_like_layout']) ? $args['mb_fb_like_layout'] : '';
            $fb_like_width              = isset($args['fb_like_width']) ? $args['fb_like_width'] : '';
            
            $show_faces = $show_friends_faces == 'yes' ? TRUE : FALSE;
            $include_facebook_button = $include_facebook_button == 'yes' ? TRUE : FALSE;
            
            $mb_output = sprintf('<div class="fb-like" data-href="%s" '
                    . 'data-width="%s" '
                    . 'data-layout="%s" '
                    . 'data-action="like" '
                    . 'data-show-faces="%s" '
                    . 'data-share="%s">'
                    . '</div>', $url_to_like, $fb_like_width, $layout, $show_faces, $include_facebook_button);

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

    new MB_Template_Facebook_Like();
}
