<?php
if ( !class_exists( 'Suf_Widget_Layout_Builder' ) ) {
    return;
}
/**
 * Class Thim_Widget_Layout_Builder.
 *
 * @since 0.8.2
 */
class Suf_Widget_Layout_Builder extends WP_Widget {
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
    function __construct() {
        parent::__construct( false, __( 'Suf Layout Builder', 'suf-lang' ) );
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
        $content = ! empty( $instance['content'] ) ? $instance['content'] : false;
        if ( ! $content ) {
            return;
        }

        $custom_css = ! empty( $instance['custom_css'] ) ? '<style>' . $instance['custom_css'] . '</style>' : '';

        echo $args['before_widget'];
        echo $custom_css;
        echo do_shortcode( $content );
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
        return $old_instance;
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
        //$id             = $this->number;
        //$linking_widget = Thim_Builder_Linking_Widget::instance( $id );
        //$url            = $linking_widget->get_url_go_to_page_builder();
        //$url = admin_url( sprintf( '?%1$s=true&widget-id=%2$s', self::$key_request, $this->widget_id ) )
       // Thim_Modal::enqueue_modal();

        ?>
        <p class="thim-wrapper-layout-builder">
            <a title="<?php esc_html_e( 'Thim Layout Builder', 'suf-lang' ); ?>" href="<?php //echo esc_url( $url ); ?>" type="button" class="tc-open-modal button button-primary thim-olp">
                <?php esc_html_e( 'Open layout builder!', 'suf-lang' ); ?></a>
        </p>
        <?php
        return;
    }

    /**
     * Update content widget by id.
     *
     * @since 0.8.2
     *
     * @param $id
     * @param $content
     *
     * @return bool
     */
    public static function update_content( $id, $content ) {
        $widget = new self();
        $widget->_set( $id );

        $custom_css = '';
        if ( function_exists( 'visual_composer' ) ) {
            $custom_css = visual_composer()->parseShortcodesCustomCss( $content );
        }

        $all_instances = $widget->get_settings();
        foreach ( $all_instances as $number => $settings ) {
            if ( $id == $number ) {
                if ( ! is_array( $settings ) ) {
                    $settings = (array) $settings;
                }
                $settings['content']    = $content;
                $settings['custom_css'] = $custom_css;

                $all_instances[ $number ] = $settings;
                $widget->save_settings( $all_instances );
                break;
            }
        }

        return true;
    }

    /**
     * Get instance widget by id
     *
     * @since 0.8.3
     *
     * @param $id
     *
     * @return bool
     */
    public static function get_instance( $id ) {
        $widget = new self();
        $widget->_set( $id );

        $all_instances = $widget->get_settings();
        foreach ( $all_instances as $number => $settings ) {
            if ( $id == $number ) {
                return $settings;
            }
        }

        return false;
    }

    /**
     * Get content by id.
     *
     * @since 0.8.2
     *
     * @param $id
     *
     * @return bool
     */
    public static function get_content( $id ) {
        return self::get_field( $id, 'content' );
    }

    /**
     * Get custom css by id.
     *
     * @since 0.8.3
     *
     * @param $id
     *
     * @return bool
     */
    public static function get_custom_css( $id ) {
        return self::get_field( $id, 'custom_css' );
    }

    /**
     * Get field by id
     *
     * @since 0.8.3
     *
     * @param $id
     * @param $field
     *
     * @return bool
     */
    public static function get_field( $id, $field ) {
        $instance = self::get_instance( $id );

        if ( ! $instance ) {
            return false;
        }

        return isset( $instance[ $field ] ) ? $instance[ $field ] : false;
    }

    /**
     * Get id base widget.
     *
     * @since 0.8.2
     *
     * @return string
     */
    public static function get_id_base() {
        if ( ! self::$id_base_ ) {
            $widget         = new self();
            self::$id_base_ = $widget->id_base;
        }

        return self::$id_base_;
    }
}
function Suf_Layout_Builder() {
    register_widget( 'Suf_Widget_Layout_Builder' );
}
//add_action( 'widgets_init', 'Suf_Layout_Builder');