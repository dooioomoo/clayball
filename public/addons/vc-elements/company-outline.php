<?php
/*
Element Description: VC Info Box
*/
if (!class_exists('Clayball_Company_outline')) {

// Element Class
    class Clayball_Company_outline extends WPBakeryShortCode
    {


        // Element Init
        public function __construct()
        {
            add_action('init', array($this, 'Clayball_Company_outline_map'));
            add_shortcode('Clayball_Company_outline', array($this, 'Clayball_Company_outline_html'));
            add_action('wp_enqueue_scripts', array($this, 'Clayball_custom_styles'), 1);
        }

        // Element Mapping
        public function Clayball_Company_outline_map()
        {
            // Stop all if VC is not enabled
            if (!defined('WPB_VC_VERSION')) {
                return;
            }
            // Map the block with vc_map()
            vc_map(
                array(
                    'name' => __('会社概要', 'Clayball-lang'),//VC元件名称
                    'base' => 'Clayball_Company_outline', //对应shortcode
                    'description' => __('会社概要排列', 'Clayball-lang'), //远见说明
                    'category' => __('CLAYBALL', 'Clayball-lang'), //VC元件标签设置
                    'icon' => __CLAYBALLPLUGINURI__ . '/assets/img/vc-icon.png',
                    'params' => array(
                        array(
                            'type' => 'textfield', //表单类型
                            'holder' => 'div', //包裹
                            'heading' => __('custome class name', 'Clayball-lang'), // 标题
                            'param_name' => 'classname', //传参变量
                            'value' => '', // 数值
                            'description' => __('set custome class name', 'Clayball-lang'), //说明
                            'admin_label' => false,
                            'weight' => 0,
                            'group' => __('normal', 'Clayball-lang'), // 组标签
                        ),
                        array(
                            'type' => 'dropdown',
                            'heading' => __('Style', 'Clayball-lang'),
                            'param_name' => 'changestyle',
                            'admin_label' => true,
                            'value' => array(
                                'NONE STYLE' => '',
                                'TABLE STYLE' => 'table-style',
                                'LINE STYLE' => 'line-style',
                            ),
                            'std' => '', // 默认选项
                            'description' => __('Choice a NEWS type', 'Clayball-lang'),
                            'group' => __('normal', 'Clayball-lang'),
                        ),
                        // params group
                        array(
                            'type' => 'param_group',
                            'value' => '',
                            'param_name' => 'company_outlines',
                            // Note params is mapped inside param-group:
                            'params' => array(
                                array(
                                    'type' => 'textfield',
                                    'value' => '',
                                    'heading' => __('Title', 'Clayball-lang'),
                                    'param_name' => 'comp_title',
                                ),
                                array(
                                    'type' => 'textarea',
                                    'value' => '',
                                    'heading' => __('content', 'Clayball-lang'),
                                    'param_name' => 'comp_content',
                                )
                            ),
                            'group' => __('normal', 'Clayball-lang'),
                        ),
                        array(
                            'type' => 'css_editor',
                            'heading' => __('Css', 'my-text-domain'),
                            'param_name' => 'css',
                            'group' => __('Style Setting', 'Clayball-lang'),
                        ),

                    ),
                )
            );


        }


        // Element HTML
        public function Clayball_Company_outline_html($atts)
        {

            if (!defined('WPB_VC_VERSION')) {
                return;
            }
            global $post;


            // Params extraction
            extract(
                shortcode_atts(
                    array(
                        'classname' => '',
                        'changestyle' => '',
                    ),
                    $atts
                )
            );
            $comp_outlines = vc_param_group_parse_atts($atts['company_outlines']);
            wp_enqueue_style('Clayball-cssgroup-compout');
            ob_start();
            ?>
            <div class="<?php echo esc_attr($classname); ?>">
                <dl class="Clayball-company_outlines_list <?php echo esc_attr($changestyle); ?>">
                    <?php
                    foreach ($comp_outlines as $comp_columns) {
                        echo '<dt class="Clayball-compout_title">' . $comp_columns['comp_title'] . '</dt>';
                        echo $comp_columns['comp_content'] != null || $comp_columns['comp_content'] != '' ? '<dd class="Clayball-compout_value">' . nl2br($comp_columns['comp_content']) . '</dd>' : '<dd class="Clayball-compout_value">&nbsp;</dd>';
                    }
                    ?>
                </dl>
            </div>

            <?php
            wp_reset_postdata();
            return ob_get_clean();

        }

        public function Clayball_custom_styles()
        {
        
            /*Enqueue The Styles*/
            wp_enqueue_style('Clayball-cssgroup-compout', __CLAYBALLPLUGINURI__ . '/assets/css/company-outlines.css', false, CLAYBALL_ADDONS_VERSION, 'screen, print');
        }

    } // End Element Class

// Element Class Init
    new Clayball_Company_outline();


}