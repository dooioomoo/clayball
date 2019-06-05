<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 2019/6/5
 * Time: 16:12
 */

class ClassClayballSettingBase extends ClassClayballSettingWrap
{
    public function __construct($menuitem = array())
    {
        parent::__construct($menuitem);
        add_action('admin_init', array($this, 'RegFields'));
    }

    public function RegFields()
    {
        register_setting(parent::ReturnRegSection(), 'clayballsetting_name');
        register_setting(parent::ReturnRegSection(), 'clayballsetting_telphone');
        register_setting(parent::ReturnRegSection(), 'clayballsetting_zipcode');
        register_setting(parent::ReturnRegSection(), 'clayballsetting_address');
    }

    public function CreatePanel()
    {
        settings_fields(parent::ReturnRegSection());
        do_settings_sections(parent::ReturnRegSection()); ?>

        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php echo __('NAME', 'clayball-lang'); ?></th>
                <td><input type="text" name="clayballsetting_name" class="regular-text"
                           value="<?php echo esc_attr(get_option('clayballsetting_name')); ?>"/></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php echo __('TEL', 'clayball-lang'); ?></th>
                <td><input type="text" name="clayballsetting_telphone" class="regular-text"
                           value="<?php echo esc_attr(get_option('clayballsetting_telphone')); ?>"/></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php echo __('ZIPCODE', 'clayball-lang'); ?></th>
                <td><input type="text" name="clayballsetting_zipcode" class="regular-text"
                           value="<?php echo esc_attr(get_option('clayballsetting_zipcode')); ?>"/></td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php echo __('ADDRESS', 'clayball-lang'); ?></th>
                <td>
                    <textarea type="text" name="clayballsetting_address" class="regular-text" row="5"><?php echo esc_attr(get_option('clayballsetting_address')); ?></textarea></td>
            </tr>

        </table>

        <?php
    }

    public function index()
    {
        parent::HeaderInit();
        parent::NavInit();
        $this->CreatePanel();
        parent::FooterInit();
    }


}