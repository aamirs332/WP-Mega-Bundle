<?php

/**
 * File Type: Twitter
 */
if (!class_exists('SC_Twitter')) {

    class SC_Twitter {

        public function __construct() {
            add_shortcode('mb_tweets' , array (&$this , 'shortCodeCallBack'));
        }

        /**
         * @return Latest Tweets
         *
         */
        public static function shortCodeCallBack($args , $content = '') {
            $defaults = array (
                'title'        => '' ,
                'view'         => '' ,
                'username'     => '' ,
                'no_of_tweets' => '' ,
            );
            extract(shortcode_atts($defaults , $args));

            $atts                 = array ();
            $atts['view']         = $view;
            $atts['username']     = $username;
            $atts['no_of_tweets'] = $no_of_tweets;

            echo '<div class="mb-shortcode-wrap">';
            if (!empty($title) && $title != '') {
                echo '<h3 class="mb-shortcode-heading">' . $title . '</h3>';
            }
            do_action('mb_prepare_twitter' , $atts);
            echo '</div>';
        }

    }

    new SC_Twitter();
}