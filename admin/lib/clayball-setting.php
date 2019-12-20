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
                'clayball-settings-attribute' => __('Attribute', 'clayball-lang'),
            );

            add_action('admin_menu', array($this, 'ClayballSettingMenuInit'));
            add_action('admin_menu', array($this, 'ClayballSubmenuBaseInit'));
            add_action('admin_menu', array($this, 'ClayballSubmenuAttributeInit'));
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

        public function ClayballSubmenuAttributeInit()
        {
            require_once(__CLAYBALLPLUGINPATH__ . '/admin/lib/' . 'class-clayball-setting-attribute.php');
            $this->clayball_attribute = new ClassClayballSettingAttribute($this->menuitem);
            add_submenu_page(
                'clayball-settings',
                __('Attribute', 'clayball-lang'),
                __('Attribute', 'clayball-lang'),
                'edit_posts',
                'clayball-settings-attribute',
                array($this->clayball_attribute, 'index')
            );
        }

    }

    new ClayBall_Setting();

}