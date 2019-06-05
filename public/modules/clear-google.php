<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 2019/6/5
 * Time: 12:45
 */
add_action( 'init', 'clayball_remove_open_sans_from_wp_core',100000) ;
add_filter( 'gettext_with_context', 'clayball_remove_google_fonts', 100000, 4 );
add_filter('wp_resource_hints', 'clayball_remove_dns_prefetch', 10, 2);

function clayball_remove_dns_prefetch($hints, $relation_type){
    foreach ($hints as $k => $googletext){
        if ('fonts.googleapis.com'==$googletext){
            unset($hints[$k]);
        }
    }
    return $hints;
}

function clayball_remove_google_fonts( $translations, $text, $context, $domain ){

    if (

        ( 'Open Sans font: on or off' == $context && 'on' == $text)
        /*for twentyfourteen*/
        ||( 'Lato font: on or off' == $context && 'on' == $text)
        /*for twentyfifteen*/
        ||( 'Noto Sans font: on or off' == $context && 'on' == $text)
        ||( 'Noto Serif font: on or off' == $context && 'on' == $text)
        ||( 'Inconsolata font: on or off' == $context && 'on' == $text)
        /*
        for twentysixteen
         */
        ||( 'Merriweather font: on or off' == $context && 'on' == $text)
        ||( 'Montserrat font: on or off' == $context && 'on' == $text)
        ||( 'Inconsolata font: on or off' == $context && 'on' == $text)
        /*
        for twentyseventeen
         */
        ||( 'Libre Franklin font: on or off' == $context && 'on' == $text)
    ) {

        $translations = 'off';

    }

    return $translations;


}

/*
for WP 4.6-
 */
function clayball_remove_open_sans_from_wp_core() {

    $closearray = array(
        'open-sans',
        'rs-open-sans'
    );
    foreach ($closearray as $cssarray){
        wp_deregister_style( $cssarray );
        wp_register_style( $cssarray, false );
        wp_enqueue_style($cssarray,'');
    }
}