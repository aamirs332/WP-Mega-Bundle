<?php

/**
 * File Type: Facebook Video
 */
if (!class_exists('SC_Facebook_Video')) {

    class SC_Facebook_Video {

        public function __construct() {
            add_shortcode('mb_facebook_video' , array (&$this , 'shortCodeCallBack'));
        }

        /**
         * return Facebook Video Form
         *
         */
        public static function shortCodeCallBack($args , $content = '') {
            $defaults = array (
                    'title'         => '' ,
                    'fb_video_url'  => '' ,
                    'fb_fullscreen' => '' ,
                    'fb_width'      => '' ,
                    'fb_autoplay'   => '' ,
            );

            extract(shortcode_atts($defaults , $args));

            $atts                  = array ();
            $atts['fb_video_url']  = $fb_video_url;
            $atts['fb_fullscreen'] = $fb_fullscreen;
            $atts['fb_width']      = $fb_width;
            $atts['fb_autoplay']   = $fb_autoplay;

            echo '<div class="mb-shortcode-wrap">';
            if (!empty($title) && $title != '') {
                echo '<h3 class="mb-shortcode-heading">' . $title . '</h3>';
            }
            do_action('mb_prepare_facebook_video' , $atts);
            echo '</div>';
        }

    }

    new SC_Facebook_Video();
}