<?php
/*
Element Description: VC Info Box
*/

// Element Class
class AddonsClayballPostSlider extends WPBakeryShortCode
{

    // Element Init
    function __construct()
    {

        add_action('init', array($this, 'vc_postslider_mapping'));
        add_shortcode('AddonsClayballPostSlider', array($this, 'vc_postslider_html'));
        add_action('wp_enqueue_scripts', array($this, 'Clayball_custom_styles'), 1);
    }

    // Element Mapping
    public function vc_postslider_mapping()
    {

        // Stop all if VC is not enabled
        if (!defined('WPB_VC_VERSION')) {
            return;
        }
        // Map the block with vc_map()
        vc_map(
            array(
                'name'     => __('Clayball Postslider', 'Clayball-lang'),//VC元件名称
                'base'     => 'AddonsClayballPostSlider', //对应shortcode
                //                'description' => __('Clayball Postslider', 'Clayball-lang'), //远见说明
                'category' => __('CLAYBALL', 'Clayball-lang'), //VC元件标签设置
                'icon'     => __CLAYBALLPLUGINURI__ . '/assets/img/vc-icon.png',
                'params'   => array(
                    array(
                        'type'        => 'textfield', //表单类型
                        'holder'      => 'div', //包裹
                        'class'       => 'field-class', // 使用class名
                        'heading'     => __('Count', 'Clayball-lang'), // 标题
                        'param_name'  => 'param', //传参变量
                        'value'       => __('10', 'Clayball-lang'), // 数值
                        'description' => __('Count of news displayed', 'Clayball-lang'), //说明
                        'admin_label' => false,
                        'weight'      => 0,
                    ),
                    array(
                        "type"        => "posttypes",
                        "class"       => "",
                        "heading"     => __("Post Type", "Clayball-lang"),
                        "param_name"  => "posttypes",
                        "value"       => __("", "Clayball-lang"),
                        "description" => __("Enter description.", "Clayball-lang")
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => __('Link', 'Clayball-lang'),
                        'param_name'  => 'itemlink',
                        'admin_label' => true,
                        'value'       => array(
                            'yes' => 'YES',
                            'no'  => 'NO',
                        ),
                        'std'         => 'yes', // 默认选项
                    ),
                    array(
                        'type'        => 'textfield', //表单类型
                        'class'       => 'field-class', // 使用class名
                        'heading'     => __('Autoplay', 'Clayball-lang'), // 标题
                        'param_name'  => 'autoplay', //传参变量
                        'value'       => __('0', 'Clayball-lang'), // 数值
                        'description' => __('Autoplay Parameters 0=>stop >0=>play', 'Clayball-lang'), //说明
                        'admin_label' => false,
                        'weight'      => 0,
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => __('Taxonomy', 'Clayball-lang'),
                        'param_name'  => 'taxonomy',
                        'admin_label' => true,
                        'value'       => get_taxonomies(),
                        'std'         => 'two', // 默认选项
                        'description' => __('choice a category', 'Clayball-lang'),
                    ),
                    array(
                        'type'        => 'textfield', //表单类型
                        'class'       => 'field-class', // 使用class名
                        'heading'     => __('Terms Slug', 'Clayball-lang'), // 标题
                        'param_name'  => 'term', //传参变量
                        'value'       => __('', 'Clayball-lang'), // 数值
                        'description' => __('the filter for Terms slug', 'Clayball-lang'), //说明
                        'admin_label' => false,
                        'weight'      => 0,
                    ),
                    array(
                        'type'        => 'textfield', //表单类型
                        'class'       => 'field-class', // 使用class名
                        'heading'     => __('Space Between', 'Clayball-lang'), // 标题
                        'param_name'  => 'spacebetween', //传参变量
                        'value'       => __('30', 'Clayball-lang'), // 数值
                        'description' => __('Distance between slides in px.', 'Clayball-lang'), //说明
                        'admin_label' => false,
                        'weight'      => 0,
                    ),
                    array(
                        'type'       => 'css_editor',
                        'heading'    => __('Css', 'Clayball-lang'),
                        'param_name' => 'css',
                        'group'      => __('Style', 'Clayball-lang'),
                    ),

                ),
            )
        );


    }


    // Element HTML
    public function vc_postslider_html($atts)
    {

        // Params extraction
        extract(
            shortcode_atts(
                array(
                    'param'        => 10,
                    'posttypes'    => '',
                    'spacebetween' => '30',
                    'itemlink'     => 'yes',
                    'taxonomy'     => false,
                    'term'         => false,
                    'autoplay'     => 0,
                ),
                $atts
            )
        );

        if (!is_array($posttypes))
            $posttypes = explode(',', $posttypes);
        $arg = array(
            'post_type'      => $posttypes,
            'posts_per_page' => $param,
        );
        if ($taxonomy && $term) {
            if (!$term) {
                $arg['taxonomy'] = $taxonomy;
            } else {
                $term             = explode(',', $term);
                $arg['tax_query'] = array(
                    array(
                        'taxonomy' => $taxonomy,
                        'field'    => 'slug',
                        'terms'    => $term
                    )
                );
            }
        }
//        if ($term) {
//            $term        = explode(',', $term);
//            $arg['term'] = $term;
//        }
        $post_slider = new WP_Query($arg);

        ob_start();
        ?>

        <div class="swiper-container clayball-slider-container">
            <div class="swiper-wrapper">
                <?php while ($post_slider->have_posts()) : $post_slider->the_post(); ?>
                    <div class="swiper-slide">
                        <div class="thumbnail">
                            <?php if($itemlink=='yes'): ?><a href="<?php the_permalink(); ?>"><?php endif;?>
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                                <?php if($itemlink=='yes'): ?></a><?php endif;?></div>
                        <div class="content">
                            <div class="postdate"><?php echo get_the_date('Y/m'); ?></div>
                            <div class="title"><?php if($itemlink=='YES'): ?><a
                                        href="<?php the_permalink(); ?>"><?php endif;?><?php the_title('<h2 class="slider-title">', '</h2>'); ?><?php if($itemlink=='yes'): ?></a><?php endif;?>
                            </div>
                            <div class="context"></div>
                        </div>

                    </div>
                <?php endwhile; ?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <!-- Initialize Swiper -->
        <script>
            jQuery(document).ready(function ($) {
                var clayball_swiper = new Swiper('.clayball-slider-container', {
                    cssWidthAndHeight: true,
                    visibilityFullFit: true,
                    autoResize: false,
                    slidesPerView: 'auto',
                    centeredSlides: true,
                    spaceBetween: <?php echo $spacebetween;?>,
                    loop: true,
                    <?php if ($autoplay && $autoplay > 0) : ?>
                    autoplay: {
					    delay: <?php echo $autoplay;?>,
					  },
                    <?php endif;?>
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                        // renderBullet: function (index, className) {
                        //     return '<span class="' + className + '">' + (index + 1) + '</span>';
                        // },
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
                <?php if ($autoplay && $autoplay > 0) : ?>
					$('.clayball-slider-container').on('mouseenter', function(e){
					// console.log('stop autoplay');
					clayball_swiper.autoplay.stop();
					})
					$('.clayball-slider-container').on('mouseleave', function(e){
					// console.log('start autoplay');
					clayball_swiper.autoplay.start();
					})
            	<?php endif;?>
            });

        </script>

        <?php
        wp_reset_postdata();
        return ob_get_clean();

    }

    private function return_catelist($cat)
    {
        $args       = array(
            'taxonomy'     => $cat, //'seller_cat',
            'parent'       => 0, // get top level categories
            'orderby'      => 'name',
            'order'        => 'ASC',
            'hierarchical' => 1,
            'hide_empty'   => false,
            'pad_counts'   => 0,
        );
        $categories = get_categories($args);
        $list       = array();
        foreach ($categories as $category) {
            $list[$category->name] = $category->term_id;
        }
        return $list;
    }

    public function Clayball_custom_styles()
    {

        /*Enqueue The Styles*/
        wp_enqueue_style('Clayball-cssgroup-swiper', __CLAYBALLPLUGINURI__ . '/assets/css/swiper.min.css', false, CLAYBALL_VERSION, 'screen, print');
        wp_enqueue_style('Clayball-cssgroup-postslider', __CLAYBALLPLUGINURI__ . '/assets/css/clayball-postslider.css', false, CLAYBALL_VERSION, 'screen, print');
        wp_enqueue_script('Clayball-jsgroup-swiper', __CLAYBALLPLUGINURI__ . '/assets/js/swiper.min.js', array('jquery'), CLAYBALL_VERSION, false);
    }

} // End Element Class

// Element Class Init
new AddonsClayballPostSlider();
