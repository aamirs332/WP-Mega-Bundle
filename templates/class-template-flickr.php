<?php

if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/**
 * @init Flickr Template
 * $return {}
 */
if (!class_exists('MB_Template_Flickr')) {

    class MB_Template_Flickr extends MB_System_Helper {

        /**
         * @init Flickr
         * $return {}
         */
        public function __construct() {
            global $mb_plugin_options;
            $mb_plugin_options = get_option('mb_plugin_options');
            add_action('mb_prepare_flickr' , array (&$this , 'mb_render_flickr_html') , 5);
        }

        /**
         * @return Flickr HTML
         */
        public function mb_render_flickr_html($args = array ()) {
            global $mb_plugin_options;
            $flag = $this->mb_get_uniqueue_flag(5);

            $apiKey         = $mb_plugin_options['mb_flickr_key'];
            $apiSecret      = $mb_plugin_options['mb_flickr_secret'];
            $username       = $args['username'];
            $no_of_photos   = $args['no_of_photos'];
            $mb_flickr_view = $args['view'];

            $no_of_photos    = isset($no_of_photos) && !empty($no_of_photos) ? $no_of_photos : '10';
            $fliker_username = isset($fliker_username) && !empty($fliker_username) ? $fliker_username : 'Pluto5339';
            
            $slider_id          = '';
            $slider_classes     = '';
                
            if( $mb_flickr_view == 'slider' ) {
                $slider_id          = 'id="mb-flickr-'.esc_js( $flag ).'"';
                $slider_classes     = '';
            }
            
            if ($apiKey <> '') {
                // Getting transient
                $cachetime       = 86400;
                $transient       = 'flickr_gallery_data';
                $check_transient = get_transient($transient);
                $check_transient = false;
                
                // Get Flickr Gallery saved data
                $saved_data      = get_option('flickr_gallery_data');
                $db_apiKey       = '';
                $db_user_name    = '';
                $db_total_photos = '';
                if ($saved_data <> '') {
                    $db_apiKey       = isset($saved_data['api_key']) ? $saved_data['api_key'] : '';
                    $db_user_name    = isset($saved_data['user_name']) ? $saved_data['user_name'] : '';
                    $db_total_photos = isset($saved_data['total_photos']) ? $saved_data['total_photos'] : '';
                }
                if ($check_transient === false || ($apiKey <> $db_apiKey || $username <> $db_user_name || $no_of_photos <> $db_total_photos)) {
                    $user_id = "https://api.flickr.com/services/rest/?method=flickr.people.findByUsername&api_key=" . $apiKey . "&username=" . $username . "&format=json&nojsoncallback=1";

                    $response = wp_remote_post($user_id , array (
                                             'method'      => 'POST' ,
                                             'timeout'     => 45 ,
                                             'redirection' => 5 ,
                                             'httpversion' => '1.0' ,
                                             'blocking'    => true ,
                                             'headers'     => array () ,
                                             'cookies'     => array ()
                            )
                    );

                    $result = wp_remote_retrieve_body($response);

                    $user_info = json_decode($result , true);

                    if ($user_info['stat'] == 'ok') {
                        $user_get_id                   = $user_info['user']['id'];
                        $get_flickr_array['api_key']   = $apiKey;
                        $get_flickr_array['user_name'] = $username;
                        $get_flickr_array['user_id']   = $user_get_id;
                        $url                           = "https://api.flickr.com/services/rest/?method=flickr.people.getPublicPhotos&api_key=" . $apiKey . "&user_id=" . $user_get_id . "&per_page=" . $no_of_photos . "&format=json&nojsoncallback=1";

                        $response = wp_remote_post($url , array (
                                    'method'      => 'POST' ,
                                    'timeout'     => 45 ,
                                    'redirection' => 5 ,
                                    'httpversion' => '1.0' ,
                                    'blocking'    => true ,
                                    'headers'     => array () ,
                                    'cookies'     => array ()
                                )
                        );

                        $result  = wp_remote_retrieve_body($response);
                        $content = json_decode($result , true);

                        if (is_wp_error($response)) {
                            $error_message = $response->get_error_message();
                            echo "Something went wrong: $error_message";
                        } else {
                            $counter = 0;
                            echo '<div class="flickr-gallery-wrapper">';
                            echo '<ul '.$slider_id.' class="flickr-gallery '.$slider_classes.'">';
                            foreach ((array) $content['photos']['photo'] as $single_photo) {
                                $title      = $single_photo['title'];
                                $farm_id    = $single_photo['farm'];
                                $server_id  = $single_photo['server'];
                                $photo_id   = $single_photo['id'];
                                $secret_id  = $single_photo['secret'];
                                $size       = 's';
                                $image_file = 'http://farm' . $farm_id . '.staticflickr.com/' . $server_id . '/' . $photo_id . '_' . $secret_id . '_' . $size . '.' . 'jpg';


//                                $response = wp_remote_post($image_file , array (
//                                        'method'      => 'POST' ,
//                                        'timeout'     => 45 ,
//                                        'redirection' => 5 ,
//                                        'httpversion' => '1.0' ,
//                                        'blocking'    => true ,
//                                        'headers'     => array () ,
//                                        'cookies'     => array ()
//                                      )
//                                );
//                               
//                                $img_headers = wp_remote_retrieve_response_code($response);
                                //&& strpos($img_headers, '200') !== false
                                
                                if (isset($image_file) && !empty($image_file) ) {
                                    echo '<li class="item">';
                                    echo "<a target='_blank' title='" . $photo['title'] . "' href='https://www.flickr.com/photos/" . $single_photo['owner'] . "/" . $single_photo['id'] . "/'>";
                                    echo "<img alt='" . $single_photo['title'] . "' src='" . $image_file . "'>";
                                    echo "<div class='img-hover'><div class='holder'><span>+</span></div></div>";
                                    echo "</a>";
                                    echo '</li>';
                                    $counter++;
                                    $get_flickr_array['photo_src'][]   = $image_file;
                                    $get_flickr_array['photo_title'][] = $single_photo['title'];
                                    $get_flickr_array['photo_owner'][] = $single_photo['owner'];
                                    $get_flickr_array['photo_id'][]    = $single_photo['id'];
                                }
                            }
                            echo '</ul>';
                            
                            
                            if( $mb_flickr_view == 'slider' ) {
                                $this->mb_get_uniqueue_script($flag);
                            }
                            echo '</div>';
                            $get_flickr_array['total_photos'] = $counter;
                            // Setting Transient
                            set_transient($transient , true , $cachetime);
                            update_option('flickr_gallery_data' , $get_flickr_array);
                            if ($counter == 0)
                                _e('No result found.' , 'social_mb');
                        }
                    } else {
                        echo __('Error:' , 'social_mb') . $user_info['code'] . ' - ' . $user_info['message'];
                    }
                } else {
                    if (get_option('flickr_gallery_data') <> '') {
                        $flick_data = get_option('flickr_gallery_data');
                        echo '<div class="flickr-gallery-wrapper">';
                        echo '<ul '.$slider_id.' class="flickr-gallery '.$slider_classes.'">';
                        if (isset($flick_data['photo_src'])):
                            $i = 0;
                            foreach ($flick_data['photo_src'] as $ph) {
                                echo '<li class="item">';
                                echo "<a target='_blank' title='" . $flick_data['photo_title'][$i] . "' href='https://www.flickr.com/photos/" . $flick_data['photo_owner'][$i] . "/" . $flick_data['photo_id'][$i] . "/'>";
                                echo "<img alt='" . $flick_data['photo_title'][$i] . "' src='" . $flick_data['photo_src'][$i] . "'>";
                                echo "<div class='img-hover'><div class='holder'><span>+</span></div></div>";
                                echo "</a>";
                                echo '</li>';
                                $i++;
                            }
                        endif;
                        echo '</ul>';
                        if( $mb_flickr_view == 'slider' ) {
                            $this->mb_get_uniqueue_script($flag);
                        }
                        
                        echo '</div>';
                    } else {
                        _e('No result found.' , 'social_mb');
                    }
                }
            } else {
                _e('Please set API key first. Please go to Plugin Options' , 'social_mb');
            }
        }
        
        public function mb_get_uniqueue_script( $flag='1332') {
            ?>
            <script>
                jQuery(document).ready(function() {
                   jQuery("#mb-flickr-<?php echo esc_js( $flag );?>").owlCarousel({
                        autoPlay: false,
                        pagination: false,
                        navigation: true,
                        navigationText: [
                            "<i class='flaticon-leftarrow67'></i>",
                            "<i class='flaticon-circular297'></i>"
                        ]
                    });          
                });
            </script>
            <?php 
        }

    }

    new MB_Template_Flickr();
}
