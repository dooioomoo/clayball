<?php
if ( !class_exists( 'Clayball_Add_Login_Button' ) ) {
    return;
}
/**
 * Class Thim_Widget_Layout_Builder.
 *
 * @since 0.8.2
 */
class Clayball_Add_Login_Button extends WP_Widget {

    private static $id_base_ = null;
    /**
     * Thim_Widget_Layout_Builder constructor.
     *
     * @since 0.8.2
     */
    function __construct() {
        parent::__construct( false, __( 'Member Login', 'suf-lang' ) );
    }


    /**
     * Print content.
     *
     * @since 0.8.2
     *
     * @param array $args
     * @param array $instance
     */
    function widget( $args, $instance ) {
        $title                   = apply_filters('widget_title', $instance['title']);
        echo $args['before_widget'];
        echo '<a href="'.home_url().'/my-account/" class="widget_Clayball_add_login_link">'.$title.'</a>';
        echo $args['after_widget'];
    }

    /**
     * Update settings widget.
     *
     * @since 0.8.2
     *
     * @param array $new_instance
     * @param array $old_instance
     *
     * @return array
     */
    function update( $new_instance, $old_instance ) {
        $instance                            = array();
        $instance['title']                   = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

    /**
     * Form widget.
     *
     * @since 0.8.2
     *
     * @param array $instance
     *
     * @return mixed
     */
    function form( $instance ) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = '';
        } ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <?php 
    }

}
function Clayball_Add_Login_Button_Func() {
    register_widget( 'Clayball_Add_Login_Button' );
}
add_action( 'widgets_init', 'Clayball_Add_Login_Button_Func');