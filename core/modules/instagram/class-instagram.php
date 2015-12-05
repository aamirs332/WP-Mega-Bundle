<?php
/**
 * @Module Instagram
 */
if (!class_exists('Mb_Modules_Instagram')) {

    class Mb_Modules_Instagram {

        public function __construct() {
           
        }
        
        /**
         * @Instagram settings
         * @return {HTML}
         */
        public static function mb_prepare_settings() {
            $obj    = new MB_FormProcess();            
            
            $obj->form_process_wrapper_start(
                    array('id'      => 'mb-instagram',
                          'class'   => 'mb-instagram',
                          'display' => 'none',
                          'attr'    => array(),
                    )
            );
            
            $obj->form_process_tab(
                array('name'    => 'API Settings',
                    'id'        => 'mb_instagram',
                    'std'       => '',
                    'desc'      => '',
                    'meta'      => ''
                )
            );
            
            
            
            $obj->form_process_text(
                    array ('name' => 'Instagram access token' ,
                            'id'   => 'mb_instagram_access_token' ,
                            'std'  => '' ,
                            'desc' => 'Please add access token here.' ,
                            'meta' => ''
                    )
            );
            
            $obj->form_process_tab(
                array('name'    => 'How To Use?',
                    'id'        => 'mb_instagram',
                    'std'       => '',
                    'desc'      => '',
                    'meta'      => ''
                )
            );
            $obj->form_process_note(
                array('name'    => 'Note',
                    'id'        => 'mb-instagram-note',
                    'std'       => '',
                    'desc'      => '<ul>
                                    <li>To Show Instagram Gallery  as widget Go to widgets and add in any sidebar</li> 
                                    <li>To use shortcode go to any page and add shortcode from Tinymce toolbar or copy : [mb_instagram title="Title Here" view="" username="" no_of_photos=""] and paste it in WP Editor.</li>
                                    <li>OR by directly adding following lines to any php file : <?php do_shortcode("[mb_instagram title="Title Here" view="" username="" no_of_photos=""]"); ?></li>
</ul>',
                    'meta'      => ''
                )
            );
            
            $obj->form_process_tab(
                array('name'    => 'Element Settings?',
                    'id'        => 'mb-instagram',
                    'std'       => '',
                    'desc'      => '',
                    'meta'      => ''
                )
            );
            
            $obj->form_process_note(
                array('name'    => 'Note',
                    'id'        => 'mb-instagram-note',
                    'std'       => '',
                    'desc'      => '<ul>
                                        <li>title : Add Title</li>
                                        <li>view : Instagram listing type, To show as slider set as: "slider" or for simple listing as: "list"</li>
                                        <li>username : Instagram user name for photos.eg: "envato"</li>
                                        <li>no_of_photos : To show number of photos eg: "5"</li>
                                    </ul>',
                    'meta'      => ''
                )
            );
            
            $obj->form_process_wrapper_end(
                    array('id'      => 'mb-instagram',
                          'class'   => 'mb-instagram',
                          'display' => 'none',
                          'attr'    => array(),
                    )
            );
        }
    }

    new Mb_Modules_Instagram();
}