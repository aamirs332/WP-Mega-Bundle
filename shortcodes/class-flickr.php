<?php
/**
 * File Type: Flickr
 */
if (!class_exists('SC_Flickr')) {

    class SC_Flickr {

        public function __construct() {
            add_shortcode('mb_flickr' , array (&$this , 'shortCodeCallBack'));
        }

        /**
         * return Flickr Form
         *
         */
        public static function shortCodeCallBack($args , $content = '') {
            $defaults = array (
                'title'         => '',
                'view'          => 'list' ,
                'username'      => 'envato' ,
                'no_of_photos'  => '10' ,
            );
            
            extract(shortcode_atts($defaults , $args));

            $atts                  = array();
            $atts['view']          = $view;
            $atts['username']      = $username;
            $atts['no_of_photos']  = $no_of_photos;
            
            echo '<div class="mb-shortcode-wrap">';
            if( !empty( $title ) && $title !='' ) {
                echo '<h3 class="mb-shortcode-heading">'.$title.'</h3>';
            }
                do_action( 'mb_prepare_flickr', $atts );
            echo '</div>';
        }

    }

    new SC_Flickr();
}