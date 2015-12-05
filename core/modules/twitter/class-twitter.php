<?php
/**
 * @Module Twitter
 */
if (!class_exists('Mb_Modules_Twitter')) {

    class Mb_Modules_Twitter {

        public function __construct() {
           
        }
        
        /**
         * @Twitter settings
         * @return {HTML}
         */
        public static function mb_prepare_settings() {
            $obj    = new MB_FormProcess();            
            
            $obj->form_process_wrapper_start(
                    array('id'      => 'mb-twitter',
                          'class'   => 'mb-twitter',
                          'display' => 'none',
                          'attr'    => array(),
                    )
            );
            
            $obj->form_process_tab(
                array('name'    => 'API Settings',
                    'id'        => 'mb_mailchimp',
                    'std'       => '',
                    'desc'      => '',
                    'meta'      => ''
                )
            );
            
            $obj->form_process_text(
                    array ('name' => 'Consumer Key' ,
                            'id'   => 'mb_twitter_key' ,
                            'std'  => '' ,
                            'desc' => 'Enter your Twitter Consumer Key Here.' ,
                            'meta' => ''
                    )
            );
            
            $obj->form_process_text(
                    array ('name' => 'Consumer Key Secret' ,
                            'id'   => 'mb_twitter_consumer_secret' ,
                            'std'  => '' ,
                            'desc' => 'Enter Your Twitter Consumer Key Secret Here.' ,
                            'meta' => ''
                    )
            );
            
            $obj->form_process_text(
                    array ('name' => 'Consumer Key Token' ,
                            'id'   => 'mb_twitter_access_token' ,
                            'std'  => '' ,
                            'desc' => 'Enter Your Twitter Access Token Here.' ,
                            'meta' => ''
                    )
            );
            
            $obj->form_process_text(
                    array ('name' => 'Access Token Secret' ,
                            'id'   => 'mb_access_token_secret' ,
                            'std'  => '' ,
                            'desc' => 'Enter Your Access Token Secret Here.' ,
                            'meta' => ''
                    )
            );
            
            $obj->form_process_tab(
                array('name'    => 'How To Use?',
                    'id'        => 'mb_twitter',
                    'std'       => '',
                    'desc'      => '',
                    'meta'      => ''
                )
            );
            
            $obj->form_process_note(
                array('name'    => 'Note',
                    'id'        => 'mb-twitter-note',
                    'std'       => '',
                    'desc'      => '<ul>
                                    <li>To Show Tweets  as widget Go to widgets and add in any sidebar</li> 
                                    <li>To use shortcode go to any page and add shortcode from Tinymce toolbar or copy : [mb_tweets title="Title Here" view="list" username="" no_of_tweets="5"] and paste it in WP Editor.</li>
                                    <li>OR by directly adding following lines to any php file : <?php do_shortcode("[mb_tweets title="Title Here" view="list" username="" no_of_tweets="5"]"); ?></li>
</ul>',
                    'meta'      => ''
                )
            );
            
            $obj->form_process_tab(
                array('name'    => 'Element Settings?',
                    'id'        => 'mb-mailchimp',
                    'std'       => '',
                    'desc'      => '',
                    'meta'      => ''
                )
            );
            
            $obj->form_process_note(
                array('name'    => 'Note',
                    'id'        => 'mb-mailchimp-note',
                    'std'       => '',
                    'desc'      => '<ul>
                                        <li>title : Add Title</li>
                                        <li>view : Tweets listing type, To show as slider set as: "slider" or for simple listing as: "list"</li>
                                        <li>username : Twitter user name for tweets.eg: "envato"</li>
                                        <li>no_of_tweets : To show number of tweets eg: "5"</li>
                                    </ul>',
                    'meta'      => ''
                )
            );
            
            $obj->form_process_wrapper_end(
                    array('id'      => 'mb-twitter',
                          'class'   => 'mb-twitter',
                          'display' => 'none',
                          'attr'    => array(),
                    )
            );
            
        }
    }

    new Mb_Modules_Twitter();
}