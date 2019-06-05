<?php
if (!class_exists('Clayball_Widget_ShareLink')) {
    return;
}

/**
 * Class Thim_Widget_Layout_Builder.
 *
 * @since 0.8.2
 */
class Clayball_Widget_ShareLink extends WP_Widget
{
    /**
     * @var string
     *
     * @since 0.8.2
     */
    private static $id_base_ = null;

    /**
     * Thim_Widget_Layout_Builder constructor.
     *
     * @since 0.8.2
     */
    function __construct()
    {
        parent::__construct(false, __('ClayBall Share Buttons', 'clayball_lang'));
        add_action('wp_enqueue_scripts', array($this, 'Clayball_custom_styles_sharelink'), 1);
    }


    public function widget($args, $instance)
    {

        $title                   = apply_filters('widget_title', $instance['title']);
        $Clayball_sharelink_facebook  = (!empty($instance['Clayball_sharelink_facebook'])) ? esc_attr($instance['Clayball_sharelink_facebook']) : '';
        $Clayball_sharelink_twitter   = (!empty($instance['Clayball_sharelink_twitter'])) ? esc_attr($instance['Clayball_sharelink_twitter']) : '';
        $Clayball_sharelink_google    = (!empty($instance['Clayball_sharelink_google'])) ? esc_attr($instance['Clayball_sharelink_google']) : '';
        $Clayball_sharelink_instagram = (!empty($instance['Clayball_sharelink_instagram'])) ? esc_attr($instance['Clayball_sharelink_instagram']) : '';
// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
        if (!empty($Clayball_sharelink_facebook))
                echo '<a href="' . $Clayball_sharelink_facebook . '" class="Clayball_sharelink_link Clayball_sharelink_facebook sufshare-social-facebook" target="_blank"></a>';
        if (!empty($Clayball_sharelink_twitter))
                echo '<a href="' . $Clayball_sharelink_twitter . '" class="Clayball_sharelink_link Clayball_sharelink_twitter sufshare-social-twitter" target="_blank"></a>';
        if (!empty($Clayball_sharelink_google))
                echo '<a href="' . $Clayball_sharelink_google . '" class="Clayball_sharelink_link Clayball_sharelink_google sufshare-social-googleplus" target="_blank"></a>';
        if (!empty($Clayball_sharelink_instagram))
                echo '<a href="' . $Clayball_sharelink_instagram . '" class="Clayball_sharelink_link Clayball_sharelink_instagram sufshare-social-instagram-outline" target="_blank"></a>';
//        echo __('Hello, World!', 'wpb_widget_domain');
        echo $args['after_widget'];
    }

// Widget Backend
    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('');
        }
        $Clayball_sharelink_facebook  = (!empty($instance['Clayball_sharelink_facebook'])) ? esc_attr($instance['Clayball_sharelink_facebook']) : '';
        $Clayball_sharelink_twitter   = (!empty($instance['Clayball_sharelink_twitter'])) ? esc_attr($instance['Clayball_sharelink_twitter']) : '';
        $Clayball_sharelink_google    = (!empty($instance['Clayball_sharelink_google'])) ? esc_attr($instance['Clayball_sharelink_google']) : '';
        $Clayball_sharelink_instagram = (!empty($instance['Clayball_sharelink_instagram'])) ? esc_attr($instance['Clayball_sharelink_instagram']) : '';
// Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('Clayball_sharelink_facebook'); ?>"><?php _e('Facebook:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('Clayball_sharelink_facebook'); ?>"
                   name="<?php echo $this->get_field_name('Clayball_sharelink_facebook'); ?>" type="text"
                   value="<?php echo esc_attr($Clayball_sharelink_facebook); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('Clayball_sharelink_twitter'); ?>"><?php _e('Twitter:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('Clayball_sharelink_twitter'); ?>"
                   name="<?php echo $this->get_field_name('Clayball_sharelink_twitter'); ?>" type="text"
                   value="<?php echo esc_attr($Clayball_sharelink_twitter); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('Clayball_sharelink_google'); ?>"><?php _e('Google+:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('Clayball_sharelink_google'); ?>"
                   name="<?php echo $this->get_field_name('Clayball_sharelink_google'); ?>" type="text"
                   value="<?php echo esc_attr($Clayball_sharelink_google); ?>"/>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('Clayball_sharelink_instagram'); ?>"><?php _e('Instagram:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('Clayball_sharelink_instagram'); ?>"
                   name="<?php echo $this->get_field_name('Clayball_sharelink_instagram'); ?>" type="text"
                   value="<?php echo esc_attr($Clayball_sharelink_instagram); ?>"/>
        </p>
        <?php
    }

// Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance                            = array();
        $instance['title']                   = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['Clayball_sharelink_facebook']  = (!empty($new_instance['Clayball_sharelink_facebook'])) ? strip_tags($new_instance['Clayball_sharelink_facebook']) : '';
        $instance['Clayball_sharelink_twitter']   = (!empty($new_instance['Clayball_sharelink_twitter'])) ? strip_tags($new_instance['Clayball_sharelink_twitter']) : '';
        $instance['Clayball_sharelink_google']    = (!empty($new_instance['Clayball_sharelink_google'])) ? strip_tags($new_instance['Clayball_sharelink_google']) : '';
        $instance['Clayball_sharelink_instagram'] = (!empty($new_instance['Clayball_sharelink_instagram'])) ? strip_tags($new_instance['Clayball_sharelink_instagram']) : '';
        return $instance;
    }

    public function Clayball_custom_styles_sharelink()
    {
        /*Enqueue The Styles*/
        wp_enqueue_style('clayball_cssgroup-widget-sharelink', __CLAYBALLPLUGINURI__ . '/assets/css/share-link.css', false, CLAYBALL_ADDONS_VERSION, 'screen, print');

    }
}

function Clayball_Widget_ShareLink_Reg()
{
    register_widget('Clayball_Widget_ShareLink');
}

add_action('widgets_init', 'Clayball_Widget_ShareLink_Reg');