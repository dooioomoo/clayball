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
                'clayball-settings' => __('基本設定', 'clayball-lang'),
                'clayball-settings-base'=>  __('サイト情報', 'clayball-lang'),
            );

            add_action('admin_menu', array($this, 'ClayballSettingMenuInit'));
            add_action('admin_menu', array($this, 'ClayballSubmenuBaseInit'));
        }

        public function ClayballSettingMenuInit()
        {
            require_once(__CLAYBALLPLUGINPATH__ . '/admin/lib/' . 'class-clayball-setting-general.php');
            $this->clayball_general = new ClassClayballSettingGeneral($this->menuitem);

            add_menu_page(
                __('基本設定', 'clayball-lang'),
                __('ClayBall Options', 'clayball-lang'),
                'edit_posts',
                'clayball-settings',
                array($this->clayball_general, 'index'),
                'dashicons-image-filter'
            );
            add_submenu_page(
                'clayball-settings',
                __('基本設定', 'clayball-lang'),
                __('基本設定', 'clayball-lang'),
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
                __('サイト情報', 'clayball-lang'),
                __('サイト情報', 'clayball-lang'),
                'edit_posts',
                'clayball-settings-base',
                array($this->clayball_base, 'index')
            );
        }

    }

    new ClayBall_Setting();

}