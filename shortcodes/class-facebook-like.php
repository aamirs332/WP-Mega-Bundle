<?php
/**
 * File Type: Facebook Like
 */
if (!class_exists('SC_Facebook_Like')) {

    class SC_Facebook_Like {

        public function __construct() {
            add_shortcode('mb_facebook_like' , array (&$this , 'shortCodeCallBack'));
        }

        /**
         * @return Facebook Like Form
         *
         */
        public static function shortCodeCallBack($args , $content = '') {
            $$defaults = array (
                'title'                 => '',
                'url_to_like'           => '' ,
                'mb_fb_like_layout'     => '' ,
                'fb_like_width'         => '' ,
                'fb_show_friends_faces' => '' ,
                'mb_fb_include_button'  => '' ,
            );
            
            extract(shortcode_atts($defaults , $args));
            
            $atts                   = array ();
            $atts['url_to_like']            = $fb_page_url;
            $atts['mb_fb_like_layout']      = $fb_page_height;
            $atts['fb_like_width']          = $fb_page_width;
            $atts['fb_show_friends_faces']  = $fb_small_header;
            $atts['mb_fb_include_button']   = $fb_hide_cover_photo;
            
            echo '<div class="mb-shortcode-wrap">';
                if( !empty( $title ) && $title !='' ) {
                    echo '<h3 class="mb-shortcode-heading">'.$title.'</h3>';
                }
                do_action('mb_prepare_facebook_like',$atts);
            echo '</div>';
        }

    }

    new SC_Facebook_Like();
}