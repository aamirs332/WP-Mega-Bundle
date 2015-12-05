<?php
/**
 * File Type: Facebook Send
 */
if (!class_exists('SC_Facebook_Send')) {

    class SC_Facebook_Send {

        public function __construct() {
            add_shortcode('mb_facebook_send' , array (&$this , 'shortCodeCallBack'));
        }

        /**
         * return Facebook Send Form
         *
         */
        public static function shortCodeCallBack($args , $content = '') {
            $defaults = array (
                'title'                   => '',
                'fb_send_to_url'          => '' ,
            );
            
            extract(shortcode_atts($defaults , $args));
            
            $atts                   = array ();
            $atts['fb_send_to_url']      = $fb_send_to_url;
            
            echo '<div class="mb-shortcode-wrap">';
            if( !empty( $title ) && $title !='' ) {
                echo '<h3 class="mb-shortcode-heading">'.$title.'</h3>';
            }
                do_action('mb_prepare_facebook_send',$atts);
            echo '</div>';
        }

    }

    new SC_Facebook_Send();
}