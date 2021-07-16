<?php

/**
 * 清理模板头部
 */

add_action('init', 'clayball_head_cleanup');
add_filter('language_attributes', 'clayball_language_attributes');
add_filter('the_generator', '__return_false');
add_filter('style_loader_tag', 'clayball_clean_style_tag');
//add_filter('script_loader_tag', 'clayball_clean_script_tag');
add_filter('body_class', 'clayball_body_class');
add_filter('embed_oembed_html', 'clayball_embed_wrap');
add_filter('get_avatar', 'clayball_remove_self_closing_tags');
add_filter('comment_id_fields', 'clayball_remove_self_closing_tags');
add_filter('post_thumbnail_html', 'clayball_remove_self_closing_tags');
add_filter('get_bloginfo_rss', 'clayball_remove_default_description');


function clayball_head_cleanup()
{
    // Originally from http://wpengineer.com/1438/wordpress-header/
    remove_action('wp_head', 'feed_links_extra', 3);
    add_action('wp_head', 'ob_start', 1, 0);
    add_action('wp_head', function () {
        $pattern = '/.*' . preg_quote(esc_url(get_feed_link('comments_' . get_default_feed())), '/') . '.*[\r\n]+/';
        echo preg_replace($pattern, '', ob_get_clean());
    }, 3, 0);

    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head', 10);
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('use_default_gallery_style', '__return_false');
    add_filter('emoji_svg_url', '__return_false');
    add_filter('show_recent_comments_widget_style', '__return_false');
}

function clayball_language_attributes()
{
    $attributes = [];

    if (is_rtl()) {
        $attributes[] = 'dir="rtl"';
    }

    $lang = get_bloginfo('language');

    if ($lang) {
        $attributes[] = "lang=\"$lang\"";
    }

    $output = implode(' ', $attributes);
    $output = apply_filters('clayball_language_attributes', $output);

    return $output;
}

function clayball_clean_style_tag($input)
{
    preg_match_all("!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches);
    if (empty($matches[2])) {
        return $input;
    }
    // Only display media if it is meaningful
    $media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
    return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
}

function clayball_clean_script_tag($input)
{
    $input = str_replace("type='text/javascript' ", '', $input);
    return str_replace("'", '"', $input);
}

function clayball_body_class($classes)
{
    // Add post/page slug if not present
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    // Remove unnecessary classes
    $home_id_class = 'page-id-' . get_option('page_on_front');
    $remove_classes = [
        'page-template-default',
        $home_id_class
    ];
    $classes = array_diff($classes, $remove_classes);

    return $classes;
}

function clayball_embed_wrap($cache)
{
    return '<div class="entry-content-asset">' . $cache . '</div>';
}


function clayball_remove_self_closing_tags($input)
{
    return str_replace(' />', '>', $input);
}

function clayball_remove_default_description($bloginfo)
{
    $default_tagline = 'Just another WordPress site';
    return ($bloginfo === $default_tagline) ? '' : $bloginfo;
}
