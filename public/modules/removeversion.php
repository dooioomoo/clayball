<?php

/**
 * 清理版本
 */

add_filter('script_loader_src', 'clayball_remove_script_version', 15, 1);
add_filter('style_loader_src', 'clayball_remove_script_version', 15, 1);


function clayball_remove_script_version($src)
{
    return $src ? esc_url(remove_query_arg('ver', $src)) : false;
}