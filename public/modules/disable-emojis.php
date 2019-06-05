<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 2019/6/5
 * Time: 11:25
 */
add_action('init', 'clayball_disable_emojis');
add_filter('pre_option_avatar_default', '__default_local_avatar');

function clayball_disable_emojis()
{
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('tiny_mce_plugins', 'clayball_disable_emojis_tinymce');
    add_filter('wp_resource_hints','clayball_disable_emojis_remove_dns_prefetch', 10, 2);
}

function clayball_disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, array('wpemoji'));
    } else {
        return array();
    }
}

function clayball_disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
    if ('dns-prefetch' == $relation_type&&is_array($urls)) {
        /** This filter is documented in wp-includes/formatting.php */
        $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');
        $urls = array_diff($urls, array($emoji_svg_url));
    }

    return $urls;
}

function __default_local_avatar()
{
    // this assumes default_avatar.png is in wp-content/themes/active-theme/images
    return __CLAYBALLPLUGINURI__ . '/assets/img/default_avatar.png';
}
