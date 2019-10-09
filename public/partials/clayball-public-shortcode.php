<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 2019/6/6
 * Time: 17:44
 */

add_shortcode('clayball', 'create_clayball_setting_base_shortcode');

function create_clayball_setting_base_shortcode($atts)
{
    $a       = shortcode_atts(array(
        'base' => '',
    ), $atts);
    $options = null !== get_option($a['base']) ? esc_attr(get_option($a['base'])) : '';
    return $options;
}