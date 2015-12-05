<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/**
 * @init Facebook Page Template
 * $return {}
 */
if (!class_exists('MB_Template_Facebook_Page')) {

    class MB_Template_Facebook_Page  extends MB_System_Helper{

        public static $counter;

        /**
         * @init Facebook Page
         * $return {}
         */
        public function __construct() {
            global $mb_plugin_options;
            $mb_plugin_options = get_option('mb_plugin_options');
            add_action('mb_prepare_facebook_page' , array (&$this , 'mb_render_facebook_page_html'),5);
            add_action('wp_head' , array (&$this , 'mb_init_fb_script'));
        }

        /**
         * @return Facebook Page HTML
         */
        public function mb_render_facebook_page_html( $args = array() ) {
            global $mb_plugin_options;
            $counter = $this->mb_get_uniqueue_flag(5);

            $width              = $args['fb_width'];
            $height             = $args['fb_height'];
            $show_posts         = $args['show_posts'] === 'yes' ? TRUE : FALSE;
            $fb_page_url        = $args['fb_page_url'] ? $args['fb_page_url'] : '';
            $fb_small_header    = $args['fb_small_header'] === 'yes' ? TRUE : FALSE;
            $hide_cover_photo   = $args['fb_hide_cover_photo'] === 'yes' ? TRUE : FALSE;
            $show_friends_faces = $args['fb_show_friends_faces'] === 'on' ? TRUE : FALSE;

            $mb_output = sprintf('<div class="fb-page" '
                    . 'data-width="%s" '
                    . 'data-height="%s" '
                    . 'data-href="%s" '
                    . 'data-small-header="%s" '
                    . 'data-adapt-container-width="true" '
                    . 'data-hide-cover="%s" '
                    . 'data-show-posts="%s"> '
                    . 'data-show-facepile="%s" '
                    . '<div class="fb-xfbml-parse-ignore">'
                    . '<blockquote cite="https://www.facebook.com/facebook">'
                    . '<a href="https://www.facebook.com/facebook">Facebook</a>'
                    . '</blockquote></div></div>', 
                    $width ,
                    $height,
                    $fb_page_url ,
                    $fb_small_header,
                    $hide_cover_photo,
                    $show_posts,
                    $show_friends_faces);

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

    new MB_Template_Facebook_Page();
}
