<?php

/**
 * @Module Flickr
 */
if (!class_exists('Mb_Modules_Flickr')) {

    class Mb_Modules_Flickr {

        public function __construct() {

        }

        /**
         * @Flickr settings
         * @return {HTML}
         */
        public static function mb_prepare_settings() {
            $obj    = new MB_FormProcess();            
            $obj->form_process_wrapper_start(
                    array('id'      => 'mb-flickr',
                          'class'   => 'mb-flickr',
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
                    array ('name' => 'Flickr Key' ,
                            'id'   => 'mb_flickr_key' ,
                            'std'  => '' ,
                            'desc' => 'Please add flickr key here.' ,
                            'meta' => ''
                    )
            );
            
            $obj->form_process_text(
                    array ('name' => 'Flickr Secret' ,
                            'id'   => 'mb_flickr_secret' ,
                            'std'  => '' ,
                            'desc' => 'Please add flickr secret here.' ,
                            'meta' => ''
                    )
            );
            
            $obj->form_process_tab(
                array('name'    => 'How To Use?',
                    'id'        => 'mb_flickr',
                    'std'       => '',
                    'desc'      => '',
                    'meta'      => ''
                )
            );
            
            $obj->form_process_note(
                array('name'    => 'Note',
                    'id'        => 'mb-flickr-note',
                    'std'       => '',
                    'desc'      => '<ul>
                                    <li>To Show Flickr Gallery as widget Go to widgets and add in any sidebar</li> 
                                    <li>To use shortcode go to any page and add shortcode from Tinymce toolbar or copy : [mb_flickr title="Title Here" view="list" username="" no_of_photos="5"] and paste it in WP Editor.</li>
                                    <li>OR by directly adding following lines to any php file : <?php do_shortcode("[mb_flickr title="Title Here" view="list" username="" no_of_photos="5"]"); ?></li>
</ul>',
                    'meta'      => ''
                )
            );
            
            $obj->form_process_tab(
                array('name'    => 'Element Settings?',
                    'id'        => 'mb-flickr',
                    'std'       => '',
                    'desc'      => '',
                    'meta'      => ''
                )
            );
            
            $obj->form_process_note(
                array('name'    => 'Note',
                    'id'        => 'mb-flickr-note',
                    'std'       => '',
                    'desc'      => '<ul>
                                        <li>title : Add Title</li>
                                        <li>view : Flickr Gallery listing type, To show as slider set as: "slider" or for simple listing as: "list"</li>
                                        <li>username : Flickr Gallery user name for photos. eg: "envato"</li>
                                        <li>no_of_photos : To show number of photos eg: "5"</li>
                                    </ul>',
                    'meta'      => ''
                )
            );
           
            $obj->form_process_wrapper_end(
                    array('id'      => 'mb-flickr',
                          'class'   => 'mb-flickr',
                          'display' => 'none',
                          'attr'    => array(),
                    )
            );
            
        }
    }
    new Mb_Modules_Flickr();
}