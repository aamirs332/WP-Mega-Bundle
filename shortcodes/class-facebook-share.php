<?php
/**
 * File Type: Facebook Share
 */
if (!class_exists('SC_Facebook_Share')) {

    class SC_Facebook_Share {

        public function __construct() {
            add_shortcode('mb_facebook_share' , array (&$this , 'shortCodeCallBack'));
        }

        /**
         * return Facebook Share Form
         *
         */
        public static function shortCodeCallBack($args , $content = '') {
            $defaults = array (
                'title'                   => '',
                'fb_share_button_url'     => '' ,
                'mb_fb_share_layout'      => '' ,
            );
            
            extract(shortcode_atts($defaults , $args));
            
            $atts                   = array ();
            $atts['fb_share_button_url']      = $fb_share_button_url;
            $atts['mb_fb_share_layout']       = $mb_fb_share_layout;
            
            echo '<div class="mb-shortcode-wrap">';
            if( !empty( $title ) && $title !='' ) {
                echo '<h3 class="mb-shortcode-heading">'.$title.'</h3>';
            }
                do_action('mb_prepare_facebook_share',$atts);
            echo '</div>';
        }

    }

    new SC_Facebook_Share();
}