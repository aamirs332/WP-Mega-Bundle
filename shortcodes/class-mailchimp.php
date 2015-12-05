<?php
/**
 * File Type: Mailchimp
 */
if (!class_exists('SC_Mailchimp')) {

    class SC_Mailchimp {

        public function __construct() {
            add_shortcode('mb_mailchimp' , array (&$this , 'shortCodeCallBack'));
        }

        /**
         * return Mailchimp Form
         *
         */
        public static function shortCodeCallBack($args , $content = '') {
            
            $defaults = array (
                'title'         => '',
                'firstname'     => '' ,
                'lastname'      => '' ,
                'success'       => __('Subscribed Successfully.','scoial_mb') ,
                'error'         => __('Some error occur, please try again later.','scoial_mb') ,
            );
            
            extract(shortcode_atts($defaults , $args));
            
            $atts                   = array ();
            $atts['firstname']      = $firstname;
            $atts['lastname']       = $lastname;
            $atts['success']        = $success;
            $atts['error']          = $error;
            
            echo '<div class="mb-shortcode-wrap">';
                if( !empty( $title ) && $title !='' ) {
                    echo '<h3 class="mb-shortcode-heading">'.$title.'</h3>';
                }
                do_action('mb_prepare_mailchimp', $atts);
            echo '</div>';
        }

    }

    new SC_Mailchimp();
}