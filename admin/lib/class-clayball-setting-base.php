<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 2019/6/5
 * Time: 16:12
 */

class ClassClayballSettingBase extends ClassClayballSettingWrap
{
    public function __construct( $menuitem = array() )
    {
        parent::__construct($menuitem);
        add_action('admin_init', array($this, 'RegFields'));
        $this->regsection = parent::ReturnRegSection() . 'Base';
    }

    public function RegFields()
    {
        register_setting($this->regsection, 'clayballsetting_name');
        register_setting($this->regsection, 'clayballsetting_email');
        register_setting($this->regsection, 'clayballsetting_telphone');
        register_setting($this->regsection, 'clayballsetting_fax');
        register_setting($this->regsection, 'clayballsetting_zipcode');
        register_setting($this->regsection, 'clayballsetting_address');
        register_setting($this->regsection, 'clayballsetting_openinghours');
    }

    public function CreatePanel()
    {
        settings_fields($this->regsection);
        do_settings_sections($this->regsection); ?>

        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php echo __('COMPANY NAME', 'clayball-lang'); ?></th>
                <td><input type="text" name="clayballsetting_name" class="regular-text"
                           value="<?php echo esc_attr(get_option('clayballsetting_name')); ?>"/> [clayball
                    base='clayballsetting_name']
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php echo __('EMAIL', 'clayball-lang'); ?></th>
                <td><input type="text" name="clayballsetting_email" class="regular-text"
                           value="<?php echo esc_attr(get_option('clayballsetting_email')); ?>"/> [clayball
                    base='clayballsetting_email']
                </td>
            </tr>


            <tr valign="top">
                <th scope="row"><?php echo __('TEL', 'clayball-lang'); ?></th>
                <td><input type="text" name="clayballsetting_telphone" class="regular-text"
                           value="<?php echo esc_attr(get_option('clayballsetting_telphone')); ?>"/> [clayball
                    base='clayballsetting_telphone']
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php echo __('FAX', 'clayball-lang'); ?></th>
                <td><input type="text" name="clayballsetting_fax" class="regular-text"
                           value="<?php echo esc_attr(get_option('clayballsetting_fax')); ?>"/> [clayball
                    base='clayballsetting_fax']
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php echo __('ZIPCODE', 'clayball-lang'); ?></th>
                <td><input type="text" name="clayballsetting_zipcode" class="regular-text"
                           value="<?php echo esc_attr(get_option('clayballsetting_zipcode')); ?>"/> [clayball
                    base='clayballsetting_zipcode']
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php echo __('ADDRESS', 'clayball-lang'); ?></th>
                <td>
                    <textarea type="text" name="clayballsetting_address" class="regular-text"
                              row="5"><?php echo esc_attr(get_option('clayballsetting_address')); ?></textarea>
                    [clayball base='clayballsetting_address']
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php echo __('OPENING HOURS', 'clayball-lang'); ?></th>
                <td>
                    <textarea type="text" name="clayballsetting_openinghours" class="regular-text"
                              row="5"><?php echo esc_attr(get_option('clayballsetting_openinghours')); ?></textarea>
                    [clayball base='clayballsetting_openinghours']
                </td>
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