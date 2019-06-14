<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       ryan.asdraw.com
 * @since      1.0.0
 *
 * @package    Clayball
 * @subpackage Clayball/public/partials
 */

/**
 * get custom gallery
 */

function clayball_get_custom_gallery()
{
    global $post;
    $returnimg = array();
    $meta      = get_post_meta($post->ID);
    $imggroup  = unserialize($meta['add_clayball_gallery_array'][0]);
    foreach ($imggroup as $img) {
        $temp['img']   = wp_get_attachment_url($img);
        $temp['title'] = $post->post_title;
        array_push($returnimg, $temp);
    }
    return $returnimg;
}

function clayball_create_custom_gallery_xzoom()
{
    $img      = clayball_get_custom_gallery();
    $template = '<a href="%1$s"><img class="xzoom-gallery" width="80" src="%1$s" xpreview="%1$s" title="%2$s"></a>';
    ?>
    <div class="xzoom-container">
        <?php $thumb = clayball_get_custom_gallery_first($img) ?>
        <div class="xzoom-wrap">
        <?php echo sprintf('<img class="xzoom" src="%1$s" alt="%1$s" xoriginal="%1$s"" xpreview="%1$s" title="%2$s">', $thumb['img'],$thumb['title']);?>
        </div>
        <div class="xzoom-thumbs">
        <?php
        foreach ($img as $k => $list) {
            echo sprintf($template, $list['img'], $list['title']);
        }
        ?>
        </div>
    </div>
    <?php
}

function clayball_get_custom_gallery_first($img){
    if (is_array($img)&&count($img)>1)
    return $img[0];
}
?>

