<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 2019/6/5
 * Time: 11:31
 */

//add_action( 'admin_init', 'clayball_custom_admin_menu');
function clayball_custom_admin_menu()
{
    $current_user = wp_get_current_user();
    global $menu, $submenu;
    if ($current_user->user_login != 'ryan') :
        foreach ($menu as $mkey => $mval) {
            if (in_array($mval[2], [
                'edit.php?post_type=project',
                'edit-comments.php',
                'tools.php',
                // 'options-general.php',
                'et_divi_options',
                'vc-general',
                'about-ultimate',
                'sfsi-options',
                'Wordfence',
                'wpfastestcacheoptions',
                'jetpack',
                'ai1wm_export',
                'responsive-menu',
                'revslider',
                // 'wpseo_dashboard',
            ])) {
                unset($menu[$mkey]);
            }
        }
    endif;
}
