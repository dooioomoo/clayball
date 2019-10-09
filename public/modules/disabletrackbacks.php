<?php

add_filter('xmlrpc_methods', 'clayball_filter_xmlrpc_method', 10, 1);
add_filter('wp_headers', 'clayball_filter_headers', 10, 1);
add_filter('rewrite_rules_array', 'clayball_filter_rewrites');
add_filter('bloginfo_url', 'clayball_kill_pingback_url', 10, 2);
add_action('xmlrpc_call', 'clayball_kill_xmlrpc');

function clayball_filter_xmlrpc_method($methods)
{
    unset($methods['pingback.ping']);
    return $methods;
}

/**
 * Remove pingback header
 */
function clayball_filter_headers($headers)
{
    if (isset($headers['X-Pingback'])) {
        unset($headers['X-Pingback']);
    }
    return $headers;
}

/**
 * Kill trackback rewrite rule
 */
function clayball_filter_rewrites($rules)
{
    foreach ($rules as $rule => $rewrite) {
        if (preg_match('/trackback\/\?\$$/i', $rule)) {
            unset($rules[$rule]);
        }
    }
    return $rules;
}

/**
 * Kill bloginfo('pingback_url')
 */
function clayball_kill_pingback_url($output, $show)
{
    if ($show === 'pingback_url') {
        $output = '';
    }
    return $output;
}

/**
 * Disable XMLRPC call
 */
function clayball_kill_xmlrpc($action)
{
    if ($action === 'pingback.ping') {
        wp_die('Pingbacks are not supported', 'Not Allowed!', ['response' => 403]);
    }
}

