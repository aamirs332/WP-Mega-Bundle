<?php
if (!defined('ABSPATH')) {
    die('Direct access forbidden.');
}

if (!class_exists('MB_MailChimp')) {

    class MB_MailChimp extends WP_Widget {

        /**
         * @init Mailchimp
         * $return {}
         */
        public function __construct() {
            $widget_ops  = array ('classname' => 'mailchimp' , 'description' => 'To Displays mailchimp form.');
            $control_ops = array ('width' => 300 , 'height' => 250 , 'id_base' => 'mailchimp');
            parent::__construct('mailchimp' , __('MB MailChimp' , 'social_mb') , $widget_ops , $control_ops);
        }

        /**
         * @Mailchimp form
         *
         */
        public function form($instance) {
            $title      = isset( $instance['title'] ) && !empty( $instance['title'] ) ? $instance['title'] : __('Title','social_mb');
            $firstname  = isset( $instance['firstname'] ) && !empty( $instance['firstname'] ) ? $instance['firstname'] : '';
            $lastname   = isset( $instance['lastname'] ) && !empty( $instance['lastname'] ) ? $instance['lastname'] : '';
            $success    = isset( $instance['success'] ) && !empty( $instance['success'] ) ? $instance['success'] : '';
            $error      = isset( $instance['error'] ) && !empty( $instance['error'] ) ? $instance['error'] : '';
            
            ?>

            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>">
                    <?php _e('<strong>Title</strong>' , 'social_mb'); ?>
                </label>
                <input id="<?php echo $this->get_field_id('title'); ?>" class="widefat" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
            </p>
            <p>
                <input id="<?php echo $this->get_field_id('firstname'); ?>" <?php checked($firstname, 'on'); ?> class="widefat" name="<?php echo esc_attr($this->get_field_name('firstname')); ?>" type="checkbox"/>
                <label for="<?php echo $this->get_field_id('firstname'); ?>">
                    <?php _e('First name required?' , 'social_mb'); ?>
                </label>
            </p>
            <p>
                <input id="<?php echo $this->get_field_id('lastname'); ?>" <?php checked($lastname, 'on'); ?> class="widefat" name="<?php echo esc_attr($this->get_field_name('lastname')); ?>" type="checkbox" />
                <label for="<?php echo $this->get_field_id('lastname'); ?>">
                    <?php _e('Last name required?' , 'social_mb'); ?>
                </label>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('success'); ?>">
                    <?php _e('<strong>Success Message</strong>' , 'social_mb'); ?>
                </label>
                <textarea id="<?php echo $this->get_field_id('success'); ?>" rows="7" class="widefat" name="<?php echo esc_attr($this->get_field_name('success')); ?>"><?php echo esc_attr($success); ?></textarea>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('error'); ?>">
                    <?php _e('<strong>Error Message</strong>' , 'social_mb'); ?>
                </label>
                <textarea id="<?php echo $this->get_field_id('error'); ?>" rows="7" class="widefat" name="<?php echo esc_attr($this->get_field_name('error')); ?>"><?php echo esc_attr($error); ?></textarea>
            </p>
            <p><?php _e('For More mailchimp settings please go to plugin settings','social_mb');?></p>
            <?php
        }

        /**
         * @Update Mailchimp
         *
         *
         */
        public function update($new_instance , $old_instance) {
            $instance          = $old_instance;
            $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
            $instance['firstname'] = (!empty($new_instance['firstname']) ) ? strip_tags($new_instance['firstname']) : '';
            $instance['lastname'] = (!empty($new_instance['lastname']) ) ? strip_tags($new_instance['lastname']) : '';
            $instance['success'] = (!empty($new_instance['success']) ) ? strip_tags($new_instance['success']) : '';
            $instance['error'] = (!empty($new_instance['error']) ) ? strip_tags($new_instance['error']) : '';
            return $instance;
        }

        /**
         * @Display Mailchimp
         *
         *
         */
        public function widget($args , $instance) {
            extract($args);
            $title      = $instance['title'];
            $firstname  = $instance['firstname'];
            $lastname   = $instance['lastname'];
            $success    = $instance['success'];
            $error      = $instance['error'];
            
            $atts                  = array();
            $atts['firstname']     = $firstname;
            $atts['lastname']      = $lastname;
            $atts['success']       = $success;
            $atts['error']         = $error;
            
            echo '<div class="widget mb-widget">';
            if (!empty($title)) {
                echo force_balance_tags($args['before_title'] . apply_filters('widget_title' , esc_attr($title)) . $args['after_title']);
            }
            
            do_action('mb_prepare_mailchimp',$atts);
            echo $args['after_widget'];
            echo '</div>';
        }

    }

    add_action('widgets_init' , create_function('' , 'return register_widget("MB_MailChimp");'));
}
?>