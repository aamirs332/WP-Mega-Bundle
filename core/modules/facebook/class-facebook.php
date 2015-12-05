<?php

/**
 * @Module Facebook
 */
if (!class_exists('Mb_Modules_Facebook')) {

    class Mb_Modules_Facebook {

        public function __construct() {
            
        }

        /**
         * @Facebook settings
         * @return {HTML}
         */
        public static function mb_prepare_settings() {
            $obj = new MB_FormProcess();

            $obj->form_process_wrapper_start(
                    array ('id'      => 'mb-facebook' ,
                            'class'   => 'mb-facebook' ,
                            'display' => 'none' ,
                            'attr'    => array () ,
                    )
            );

            $obj->form_process_tab(
                    array ('name' => 'Faceboook Like Button' ,
                            'id'   => 'mb_facebook_like' ,
                            'std'  => '' ,
                            'desc' => '' ,
                            'meta' => ''
                    )
            );
            
            $obj->form_process_note(
                    array ('name' => 'Note' ,
                            'id'   => 'mb-facebook-note' ,
                            'std'  => '' ,
                            'desc'      => '<ul>
                                    <li>To Show Facebook Like Button  as widget Go to widgets and add in any sidebar</li> 
                                    <li>To use shortcode go to any page and add shortcode from Tinymce toolbar or copy : [mb_facebook_like title="Title Here" url_to_like="" mb_fb_like_layout="" fb_like_width="" fb_show_friends_faces="yes" mb_fb_include_button="no"] and paste it in WP Editor.</li>
                                    <li>OR by directly adding following lines to any php file : <?php do_shortcode("[mb_facebook_like title="Title Here" url_to_like="" mb_fb_like_layout="" fb_like_width="" fb_show_friends_faces="yes" mb_fb_include_button="no"]"); ?></li>
                                </ul>',
                    'meta'      => ''
                    )
            );
                
            $obj->form_process_note(
                array('name'    => 'Note',
                    'id'        => 'mb-fb-like-note',
                    'std'       => '',
                    'desc'      => '<ul>
                                        <li>title : Add Title</li>
                                        <li>url_to_like : Add Facebook Page URL to like eg : http://facebook.com/mypage</li>
                                        <li>mb_fb_like_layout : Different layouts as : "standard", "button_count", "box_count" or "button"</li>
                                        <li>fb_like_width : The pixel width of the embed (Min. 180 to Max. 500)</li>
                                        <li>fb_show_friends_faces : To show Friends faces after liking set as: "yes" or set as: "no"</li>
                                        <li>mb_fb_include_button : To include button set as: "yes" or set as: "no"a</li>
                                    </ul>',
                    'meta'      => ''
                )
            );
            
            $obj->form_process_tab(
                    array ('name' => 'Faceboook Page' ,
                            'id'   => 'mb_facebook_page' ,
                            'std'  => '' ,
                            'desc' => '' ,
                            'meta' => ''
                    )
            );
            
            $obj->form_process_note(
                    array ('name' => 'Note' ,
                            'id'   => 'mb-facebook-note' ,
                            'std'  => '' ,
                            'desc'      => '<ul>
                                    <li>To Show Facebook Page as widget Go to widgets and add in any sidebar</li> 
                                    <li>To use shortcode go to any page and add shortcode from Tinymce toolbar or copy : [mb_facebook_page title="Title Here" fb_page_url="" show_posts="" fb_show_friends_faces="" fb_small_header="" fb_hide_cover_photo=""] and paste it in WP Editor.</li>
                                    <li>OR by directly adding following lines to any php file : <?php do_shortcode("[mb_facebook_page title="Title Here" fb_page_url="" fb_width="300" fb_page_url="600" show_posts="" fb_show_friends_faces="" fb_small_header="" fb_hide_cover_photo=""]"); ?></li>
                                </ul>',
                    )
            );
            
            $obj->form_process_note(
                array('name'    => 'Note',
                    'id'        => 'mb-fb-page-note',
                    'std'       => '',
                    'desc'      => '<ul>
                                        <li>title : Add Title</li>
                                        <li>fb_page_url : Add Facebook Page URL. eg : http://facebook.com/mypage</li>
                                        <li>fb_width : Add Facebook Page width. eg : 300</li>
                                        <li>fb_height : Add Facebook Page height. eg : 600</li>
                                        <li>show_posts : Show posts from the Pages timeline set as : "yes" or set as: "no"</li>
                                        <li>fb_show_friends_faces : To show Friends faces set as: "yes" or to hide as: "no"</li>
                                        <li>fb_small_header : Uses a smaller version of the page header set as : "yes" else set as : "no"</li>
                                        <li>fb_hide_cover_photo : To hide set as : "yes" or to show as :"no"</li>
                                    </ul>',
                    'meta'      => ''
                )
            );
            
            $obj->form_process_tab(
                    array ('name' => 'Faceboook Share Button' ,
                            'id'   => 'mb_facebook_share' ,
                            'std'  => '' ,
                            'desc' => '' ,
                            'meta' => ''
                    )
            );
            
            $obj->form_process_note(
                    array ('name' => 'Note' ,
                            'id'   => 'mb-facebook-note' ,
                            'std'  => '' ,
                            'desc'      => '<ul>
                                    <li>To Show Facebook Share Button as widget Go to widgets and add in any sidebar</li> 
                                    <li>To use shortcode go to any page and add shortcode from Tinymce toolbar or copy : [mb_facebook_share title="Title Here" fb_share_button_url="" mb_fb_share_layout=""] and paste it in WP Editor.</li>
                                    <li>OR by directly adding following lines to any php file : <?php do_shortcode("[mb_facebook_share title="Title Here" fb_share_button_url="" mb_fb_share_layout=""]"); ?></li>
                                </ul>',
                    )
            );
            
            $obj->form_process_note(
                array('name'    => 'Note',
                    'id'        => 'mb-fb-share-note',
                    'std'       => '',
                    'desc'      => '<ul>
                                        <li>title : Add Title</li>
                                        <li>fb_share_button_url : Add Facebook Page URL. eg : http://facebook.com/mypage</li>
                                        <li>mb_fb_share_layout : Different layouts as : "button_count", "box_count", "button", "icon_link", "icon_link", "icon" or "link"</li>
                                    </ul>',
                    'meta'      => ''
                )
            );
            
            $obj->form_process_tab(
                    array ('name' => 'Faceboook Send Button' ,
                            'id'   => 'mb_facebook_share' ,
                            'std'  => '' ,
                            'desc' => '' ,
                            'meta' => ''
                    )
            );
            
             $obj->form_process_note(
                    array ('name' => 'Note' ,
                            'id'   => 'mb-facebook-note' ,
                            'std'  => '' ,
                            'desc'      => '<ul>
                                    <li>To Show Facebook Send Button as widget Go to widgets and add in any sidebar</li> 
                                    <li>To use shortcode go to any page and add shortcode from Tinymce toolbar or copy : [mb_facebook_send title="Title Here" fb_send_to_url=""] and paste it in WP Editor.</li>
                                    <li>OR by directly adding following lines to any php file : <?php do_shortcode("[mb_facebook_send title="Title Here" fb_send_to_url=""]"); ?></li>
                                </ul>',
                    )
            );
            $obj->form_process_note(
                array('name'    => 'Note',
                    'id'        => 'mb-fb-send-note',
                    'std'       => '',
                    'desc'      => '<ul>
                                        <li>title : Add Title</li>
                                        <li>fb_send_to_url : Add Facebook Send To URL. eg : https://developers.facebook.com/docs/plugins/</li>
                                     </ul>',
                    'meta'      => ''
                )
            );
            
           
            $obj->form_process_wrapper_end(
                    array ('id'      => 'mb-facebook' ,
                            'class'   => 'mb-facebook' ,
                            'display' => 'none' ,
                    )
            );
        }

    }

    new Mb_Modules_Facebook();
}