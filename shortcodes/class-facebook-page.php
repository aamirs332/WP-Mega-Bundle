<?php
/**
 * File Type: Facebook Page
 */
if (!class_exists('SC_Facebook_Page')) {

    class SC_Facebook_Page {

        public function __construct() {
            add_shortcode('mb_facebook_page' , array (&$this , 'shortCodeCallBack'));
        }

        /**
         * return Facebook Page Form
         *
         */
        public static function shortCodeCallBack($args , $content = '') {
             $defaults = array (
                'title'                => '',
                'fb_page_url'          => '' ,
                'fb_width'              => '' ,
                'fb_height'             => '' ,
                'show_posts'            => '' ,
                'fb_show_friends_faces' => '' ,
                'fb_small_header'       => '' ,
                'fb_hide_cover_photo'      => '' ,
            );
            
            extract(shortcode_atts($defaults , $args));
            
            $atts                   = array ();
            $atts['fb_page_url']         = $fb_page_url;
            $atts['fb_width']            = $fb_width;
            $atts['fb_height']           = $fb_height;
            $atts['show_posts']          = $show_posts;
            $atts['fb_show_friends_faces']  = $fb_show_friends_faces;
            $atts['fb_small_header']        = $fb_small_header;
            $atts['fb_hide_cover_photo']    = $fb_hide_cover_photo;
            
            echo '<div class="mb-shortcode-wrap">';
                if( !empty( $title ) && $title !='' ) {
                    echo '<h3 class="mb-shortcode-heading">'.$title.'</h3>';
                }
                do_action('mb_prepare_facebook_page',$atts);
            echo '</div>';
        }

    }

    new SC_Facebook_Page();
}