<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}
/**
 * @init Twitter Template
 * $return {}
 */
if (!class_exists('MB_Template_Twitter')) {

    class MB_Template_Twitter extends MB_System_Helper {

        /**
         * @init Twitter
         * $return {}
         */
        public function __construct() {
            global $mb_plugin_options;
            $mb_plugin_options = get_option('mb_plugin_options');
            add_action('mb_prepare_twitter' , array (&$this , 'mb_render_twitter_html'),5);
        }

        /**
         * @return Twitter HTML
         */
        public function mb_render_twitter_html( $args = array() ) {
            $flag   = $this->mb_get_uniqueue_flag(5);
            $view           = isset($args['view']) ? $args['view'] : '';
            $username       = isset( $args['username'] ) ? $args['username'] : '';
            $no_of_tweets   = isset( $args['no_of_tweets'] ) ? $args['no_of_tweets'] :'';
            
            if( $view == 'slider' ) {?>
                
            <div id="mb-tweets-<?php echo esc_js( $flag );?>" class="owl-carousel owl-theme">
                <?php echo $this->mb_render_tweets( $args );?>
            </div>
            <script>
                jQuery(document).ready(function() {
                  jQuery("#mb-tweets-<?php echo esc_js( $flag );?>").owlCarousel({
                      navigation : true, // Show next and prev buttons
                      slideSpeed : 300,
                      paginationSpeed : 400,
                      singleItem:true,
                      navigationText: [
                        "<i class='flaticon-leftarrow67'></i> ",
                        "<i class='flaticon-circular297'></i>"
                        ],
                  });
                });
            </script>
            <?php } else{?>               
                <div class="mb-tweets">
                    <?php echo $this->mb_render_tweets( $args );?>
                </div>  
           <?php  }
        }

        /**
         * @return Tweets
         */
        public function mb_render_tweets( $args = array() ) {
            global $mb_plugin_options;
            $flag   = $this->mb_get_uniqueue_flag();
            
            $mb_tweets_view = $args['view'];
            $username       = $args['username'];
            $numoftweets    = $args['no_of_tweets'];



            $username = html_entity_decode($username);

            if ($numoftweets == '') {
                $numoftweets = 2;
            }
            if (strlen($username) > 1) {

                $text      = '';
                $return    = '';
                $cacheTime = 10000;
                $transName = 'latest-tweets';

                $get_consumerkey       = $mb_plugin_options['mb_twitter_key'];
                $get_consumersecret    = $mb_plugin_options['mb_twitter_consumer_secret'];
                $get_accesstoken       = $mb_plugin_options['mb_twitter_access_token'];
                $get_accesstokensecret = $mb_plugin_options['mb_access_token_secret'];

                $consumerkey       = isset($get_consumerkey) ? $get_consumerkey : '';
                $consumersecret    = isset($get_consumersecret) ? $get_consumersecret : '';
                $accesstoken       = isset($get_accesstoken) ? $get_accesstoken : '';
                $accesstokensecret = isset($get_accesstokensecret) ? $get_accesstokensecret : '';
                $connection        = new TwitterOAuth($consumerkey , $consumersecret , $accesstoken , $accesstokensecret);

                $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=" . $username . "&count=" . $numoftweets);
                //print_r($tweets);
                if (!is_wp_error($tweets) and is_array($tweets)) {
                    set_transient($transName , $tweets , 60 * $cacheTime);
                } else {
                    $tweets = get_transient('latest-tweets');
                }
                if (!is_wp_error($tweets) and is_array($tweets)) {

                    $rand_id = rand(5 , 300);
                    $exclude = 0;
                    foreach ($tweets as $tweet) {
                        $exclude++;
                        //if($exclude > 1 ){
                        $text = $tweet->{'text'};
                        foreach ($tweet->{'user'} as $type => $userentity) {
                            if ($type == 'profile_image_url') {
                                $profile_image_url = $userentity;
                            } else if ($type == 'screen_name') {
                                $screen_name = '<a href="https://twitter.com/' . $userentity . '" target="_blank" class="colrhover" title="' . $userentity . '">@' . $userentity . '</a>';
                            }
                        }
                        foreach ($tweet->{'entities'} as $type => $entity) {
                            if ($type == 'hashtags') {
                                foreach ($entity as $j => $hashtag) {
                                    $update_with = '<a href="https://twitter.com/search?q=%23' . $hashtag->{'text'} . '&amp;src=hash" target="_blank" title="' . $hashtag->{'text'} . '">#' . $hashtag->{'text'} . '</a>';
                                    $text        = str_replace('#' . $hashtag->{'text'} , $update_with , $text);
                                }
                            }
                        }
                        $large_ts = time();
                        $n        = $large_ts - strtotime($tweet->{'created_at'});
                        if ($n < (60)) {
                            $posted = sprintf(__('%d seconds ago' , 'himalayan') , $n);
                        } elseif ($n < (60 * 60)) {
                            $minutes = round($n / 60);
                            $posted  = sprintf(_n('About a Minute Ago' , '%d Minutes Ago' , $minutes , 'himalayan') , $minutes);
                        } elseif ($n < (60 * 60 * 16)) {
                            $hours  = round($n / (60 * 60));
                            $posted = sprintf(_n('About an Hour Ago' , '%d Hours Ago' , $hours , 'himalayan') , $hours);
                        } elseif ($n < (60 * 60 * 24)) {
                            $hours  = round($n / (60 * 60));
                            $posted = sprintf(_n('About an Hour Ago' , '%d Hours Ago' , $hours , 'himalayan') , $hours);
                        } elseif ($n < (60 * 60 * 24 * 6.5)) {
                            $days   = round($n / (60 * 60 * 24));
                            $posted = sprintf(_n('About a Day Ago' , '%d Days Ago' , $days , 'himalayan') , $days);
                        } elseif ($n < (60 * 60 * 24 * 7 * 3.5)) {
                            $weeks  = round($n / (60 * 60 * 24 * 7));
                            $posted = sprintf(_n('About a Week Ago' , '%d Weeks Ago' , $weeks , 'himalayan') , $weeks);
                        } elseif ($n < (60 * 60 * 24 * 7 * 4 * 11.5)) {
                            $months = round($n / (60 * 60 * 24 * 7 * 4));
                            $posted = sprintf(_n('About a Month Ago' , '%d Months Ago' , $months , 'himalayan') , $months);
                        } elseif ($n >= (60 * 60 * 24 * 7 * 4 * 12)) {
                            $years  = round($n / (60 * 60 * 24 * 7 * 52));
                            $posted = sprintf(_n('About a year Ago' , '%d years Ago' , $years , 'himalayan') , $years);
                        }

                        $return .= '<div class="item">';
                        $return .= '<div class="tweet-slide">';
                        //$return .= '<img src="' . get_template_directory_uri() . '/img/twitter-icon.png" alt="twitter icon">';
                        $return .= '<p>' . $text . '</p>';
                        $return .= '</div>';
                        $return .= '</div>';
                    }
                    return $return;
                } else {
                    if (isset($tweets->errors[0]) && $tweets->errors[0] <> "") {
                        return '<div class="mb-twitter item" data-hash="mb-one"><h4>' . $tweets->errors[0]->message . ". Please enter valid Twitter API Keys </h4></div>";
                    } else {
                        return '<div class="mb-twitter item" data-hash="mb-two"><h4>' . __('No Tweets Found' , 'himalayan') . '</h4></div>';
                    }
                }
            } else {
                return '<div class="mb-twitter item" data-hash="mb-three"><h4>' . __('No Tweets Found' , 'himalayan') . '</h4></div>';
            }
        }

    }

    new MB_Template_Twitter();
}
