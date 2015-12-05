<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

if (!class_exists('MB_Twitter')) {

        class MB_Twitter extends WP_Widget {

        /**
         * @init Twitter
         * $return {}
         */
        public function __construct() {
            $widget_ops  = array ('classname' => 'twitter' , 'description' => 'To Displays Tweets.');
            $control_ops = array ('width' => 300 , 'height' => 250 , 'id_base' => 'twitter');
            parent::__construct('twitter' , __('MB Twitter' , 'social_mb') , $widget_ops , $control_ops);
        }

        /**
         * @Twitter form
         *
         */
        public function form($instance) {
           $title = isset( $instance['title'] ) && !empty( $instance['title'] ) ? $instance['title'] : __('Title','social_mb');
           $select_view = isset( $instance['select_view'] ) && !empty( $instance['select_view'] ) ? $instance['select_view'] : 'slider';
           $username = isset( $instance['username'] ) && !empty( $instance['username'] ) ? $instance['username'] : '';
           $no_of_tweets = isset( $instance['no_of_tweets'] ) && !empty( $instance['no_of_tweets'] ) ? $instance['no_of_tweets'] : 5;
           
           ?>

            <p>
                <label fo)r="title">
                    <?php _e('<strong>Title</strong>' , 'social_mb'); ?>
                </label>
                <input id="title" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
            </p>
            <p>
        	<label for="<?php echo $this->get_field_id('select_view'); ?>"> 
                    <?php _e('Select View:', 'social_mb') ?>
                </label>
            	<select id="<?php echo $this->get_field_id('select_view'); ?>" name="<?php echo $this->get_field_name('select_view'); ?>">
                    <option value="slider" <?php echo isset($select_view) && $select_view == 'slider' ? 'selected': '';?>><?php _e('Slider', 'social_mb') ?></option>
                    <option value="list" <?php echo isset($select_view) && $select_view == 'list' ? 'selected': '';?>><?php _e('List', 'social_mb') ?></option>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('username'); ?>">
                    <?php _e('<strong>Username</strong>' , 'social_mb'); ?>
                </label>
                <input id="<?php echo $this->get_field_id('username'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('username')); ?>" type="text" value="<?php echo esc_attr($username); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('no_of_tweets'); ?>">
                    <?php _e('<strong>No of tweets</strong>' , 'social_mb'); ?>
                </label>
                <input id="<?php echo $this->get_field_id('no_of_tweets'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('no_of_tweets')); ?>" type="text" value="<?php echo esc_attr($no_of_tweets); ?>"/>
            </p>
            <p><?php _e('For twitter API settings please go to plugin settings','social_mb');?></p>
            <?php
        }

        /**
         * @Update Twitter
         *
         *
         */
        public function update($new_instance , $old_instance) {
            $instance          = $old_instance;
            $instance['title']        = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
            $instance['select_view']  = (!empty($new_instance['select_view']) ) ? strip_tags($new_instance['select_view']) : '';
            $instance['username']     = (!empty($new_instance['username']) ) ? strip_tags($new_instance['username']) : '';
            $instance['no_of_tweets'] = (!empty($new_instance['no_of_tweets']) ) ? strip_tags($new_instance['no_of_tweets']) : '';
            return $instance;
        }

        /**
         * @Display Twitter
         *
         *
         */
        public function widget($args , $instance) {
            extract($args);
            $title        = $instance['title'];
            $select_view  = $instance['select_view'];
            $username     = $instance['username'];
            $no_of_tweets = $instance['no_of_tweets'];
            
            echo '<div class="widget mb-widget">';
            if (!empty($title)) {
                echo force_balance_tags($args['before_title'] . apply_filters('widget_title' , esc_attr($title)) . $args['after_title']);
            }
            $atts                  = array();
            $atts['view']          = $select_view;
            $atts['username']      = $username;
            $atts['no_of_tweets']  = $no_of_tweets;
            
            do_action('mb_prepare_twitter',$atts);
            echo $args['after_widget'];
            echo '</div>';
        }

    }

    add_action('widgets_init' , create_function('' , 'return register_widget("MB_Twitter");'));
}
?>