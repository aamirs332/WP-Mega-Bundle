<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

if (!class_exists('MB_Instagram')) {

        class MB_Instagram extends WP_Widget {

        /**
         * @init Instagram
         * $return {}
         */
        public function __construct() {
            $widget_ops  = array ('classname' => 'instagram' , 'description' => 'To Displays Photos.');
            $control_ops = array ('width' => 300 , 'height' => 250 , 'id_base' => 'instagram');
            parent::__construct('instagram' , __('MB Instagram' , 'social_mb') , $widget_ops , $control_ops);
        }

        /**
         * @Instagram form
         *
         */
        public function form($instance) {
           $title        = isset( $instance['title'] ) && !empty( $instance['title'] ) ? $instance['title'] : __('Title','social_mb');
           $select_view  = isset( $instance['select_view'] ) && !empty( $instance['select_view'] ) ? $instance['select_view'] : 'slider';
           $user_id     = isset( $instance['user_id'] ) && !empty( $instance['user_id'] ) ? $instance['user_id'] : '';
           $no_of_photos = isset( $instance['no_of_photos'] ) && !empty( $instance['no_of_photos'] ) ? $instance['no_of_photos'] : 5;
           
           ?>

            <p>
                <label for=""<?php echo $this->get_field_id('title'); ?>">
                    <?php _e('<strong>Title</strong>' , 'social_mb'); ?>
                </label>
                <input id=""<?php echo $this->get_field_id('title'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
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
                <label for="<?php echo $this->get_field_id('user_id'); ?>">
                    <?php _e('<strong>User ID</strong>' , 'social_mb'); ?>
                </label>
                <input id="<?php echo $this->get_field_id('user_id'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('user_id')); ?>" type="text" value="<?php echo esc_attr($user_id); ?>"/>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('no_of_photos'); ?>">
                    <?php _e('<strong>No of photos</strong>' , 'social_mb'); ?>
                </label>
                <input id="<?php echo $this->get_field_id('no_of_photos'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('no_of_photos')); ?>" type="text" value="<?php echo esc_attr($no_of_photos); ?>"/>
            </p>
            <p><?php _e('For instagram API settings please go to plugin settings','social_mb');?></p>
            <?php
        }

        /**
         * @Update Instagram
         *
         */
        public function update($new_instance , $old_instance) {
            $instance          = $old_instance;
            $instance['title']        = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
            $instance['select_view']  = (!empty($new_instance['select_view']) ) ? strip_tags($new_instance['select_view']) : '';
            $instance['user_id']     = (!empty($new_instance['user_id']) ) ? strip_tags($new_instance['user_id']) : '';
            $instance['no_of_photos'] = (!empty($new_instance['no_of_photos']) ) ? strip_tags($new_instance['no_of_photos']) : '';
            return $instance;
        }

        /**
         * @Display Instagram
         *
         */
        public function widget($args , $instance) {
            extract($args);
            $title        = $instance['title'];
            $select_view  = $instance['select_view'];
            $user_id      = $instance['user_id'];
            $no_of_photos = $instance['no_of_photos'];
            
            echo '<div class="widget mb-widget">';
            if (!empty($title)) {
                echo force_balance_tags($args['before_title'] . apply_filters('widget_title' , esc_attr($title)) . $args['after_title']);
            }
            
            $atts                  = array();
            $atts['view']          = $select_view;
            $atts['user_id']      = $user_id;
            $atts['no_of_photos']  = $no_of_photos;
            
            do_action('mb_prepare_instagram',$atts);
            echo $args['after_widget'];
            echo '</div>';
        }

    }

    add_action('widgets_init' , create_function('' , 'return register_widget("MB_Instagram");'));
}
?>