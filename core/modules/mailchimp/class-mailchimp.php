<?php defined('ABSPATH') or die('No script kiddies please!');
/**
 * @Module MailChimp
 */
if (!class_exists('Mb_Modules_MailChimp')) {

    class Mb_Modules_MailChimp {

        public function __construct() {
           
        }
        
        /**
         * @Mailchimp settings
         * @return {HTML}
         */
        public static function mb_prepare_settings(){
            $obj    = new MB_FormProcess();            
            $obj->form_process_wrapper_start(
                    array('id'      => 'mb-mailchimp',
                          'class'   => 'mb-mailchimp',
                          'display' => 'block',
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
                array('name'    => 'Mailchimp Key',
                    'id'        => 'mb_mailchimp_key',
                    'std'       => '',
                    'desc'      => 'Please add Mailchimp key. For Demo Use: e12c8ee5546cf3134b83f02b8b12702e-us11',
                    'meta'      => ''
                )
            );
            
            $obj->form_process_select(
                array('name'    => 'Mailchimp List',
                    'id'        => 'mb_mailchimp_list',
                    'std'       => '',
                    'desc'      => 'Select Mailchimp list for newsletters.',
                    'meta'      => '',
                    'options'   => Mb_Modules_Configuration::prepare_mailchimp_options(),       
                )
            );
            
            $obj->form_process_tab(
                array('name'    => 'How to Use?',
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
                                    <li>To Show Mailchimp form as widget Go to widgets and add in any sidebar</li> 
                                    <li>To use shortcode go to any page and add shortcode from Tinymce toolbar or copy : [mb_mailchimp title="Title Here" firstname="on" lastname="on" success="" error=""] and paste it in WP Editor.</li>
                                    <li>OR by directly adding following lines to any php file : <?php do_shortcode("[mb_mailchimp title="Title Here" firstname="on" lastname="on" success="" error=""]"); ?></li>
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
                                        <li>firstname : To show first name in form set as : "on" or to hide as "off"</li>
                                        <li>lastname : To show last name in form set as : "on" or to hide as "off"</li>
                                        <li>success : To show message after successfully scbscribed.</li>
                                        <li>error : To show message if error occur during subscription.</li>
                                    </ul>',
                    'meta'      => ''
                )
            );
            
            $obj->form_process_wrapper_end(
                    array('id'      => 'mb-mailchimp',
                          'class'   => 'mb-mailchimp',
                          'display' => 'block',
                          'attr'    => array(),
                    )
            );
 
        }
    }

    new Mb_Modules_MailChimp();
}