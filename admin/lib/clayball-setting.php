<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 2019/6/5
 * Time: 14:42
 */

if (!class_exists('ClayBall_Setting')) {

    class ClayBall_Setting
    {

        public function __construct()
        {
            require_once(__CLAYBALLPLUGINPATH__ . '/admin/lib/' . 'class-clayball-setting-wrap.php');

            $this->menuitem = array(
                'clayball-settings' => __('General Setting', 'clayball-lang'),
                'clayball-settings-base' => __('Informations', 'clayball-lang'),
                'clayball-settings-breadcrumb' => __('Breadcrumb', 'clayball-lang'),
            );

            add_action('admin_menu', array($this, 'ClayballSettingMenuInit'));
            add_action('admin_menu', array($this, 'ClayballSubmenuBaseInit'));
            add_action('admin_menu', array($this, 'ClayballSubmenuBreadcrumbInit'));
        }

        public function ClayballSettingMenuInit()
        {
            require_once(__CLAYBALLPLUGINPATH__ . '/admin/lib/' . 'class-clayball-setting-general.php');
            $this->clayball_general = new ClassClayballSettingGeneral($this->menuitem);

            add_menu_page(
                __('General Setting', 'clayball-lang'),
                __('ClayBall', 'clayball-lang'),
                'edit_posts',
                'clayball-settings',
                array($this->clayball_general, 'index'),
                'dashicons-image-filter'
            );
            add_submenu_page(
                'clayball-settings',
                __('General Setting', 'clayball-lang'),
                __('General Setting', 'clayball-lang'),
                'edit_posts',
                'clayball-settings'
            );

        }

        public function ClayballSubmenuBaseInit()
        {
            require_once(__CLAYBALLPLUGINPATH__ . '/admin/lib/' . 'class-clayball-setting-base.php');
            $this->clayball_base = new ClassClayballSettingBase($this->menuitem);
            add_submenu_page(
                'clayball-settings',
                __('Informations', 'clayball-lang'),
                __('Informations', 'clayball-lang'),
                'edit_posts',
                'clayball-settings-base',
                array($this->clayball_base, 'index')
            );
        }

        public function ClayballSubmenuBreadcrumbInit()
        {
            require_once(__CLAYBALLPLUGINPATH__ . '/admin/lib/' . 'class-clayball-setting-breadcrumb.php');
            $this->clayball_breadcrumb = new ClassClayballSettingBreadcrumb($this->menuitem);
            add_submenu_page(
                'clayball-settings',
                __('Breadcrumb', 'clayball-lang'),
                __('Breadcrumb', 'clayball-lang'),
                'edit_posts',
                'clayball-settings-breadcrumb',
                array($this->clayball_breadcrumb, 'index')
            );
        }

    }

    new ClayBall_Setting();

}