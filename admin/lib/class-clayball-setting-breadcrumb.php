<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 2019/6/12
 * Time: 14:33
 */

class ClassClayballSettingBreadcrumb extends ClassClayballSettingWrap
{
    protected $BreadcrumbCore;

    public function __construct($menuitem = array())
    {
        parent::__construct($menuitem);

        add_action('admin_init', array($this, 'RegFields'));
        $this->regsection     = parent::ReturnRegSection() . 'Breadcrumb';
        if (class_exists('ClassClayballPluginBreadcrumb'))
        $this->BreadcrumbCore = new ClassClayballPluginBreadcrumb;
    }

    public function RegFields()
    {
        register_setting($this->regsection, 'clayballsetting_breadcrumb');
        register_setting($this->regsection, 'clayballsetting_breadcrumb_warpbefore');
        register_setting($this->regsection, 'clayballsetting_breadcrumb_warpafter');
    }

    public function CreatePanel()
    {
        settings_fields($this->regsection);
        do_settings_sections($this->regsection);

        $warpbefore_default = $this->BreadcrumbCore->option['wrap_before'];
        $warpafter_default  = $this->BreadcrumbCore->option['wrap_after'];

        ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php echo __('Wrap before', 'clayball-lang'); ?></th>
                <td><textarea type="text" name="clayballsetting_breadcrumb_warpbefore" class="large-text"
                              row="5"><?php echo $warpbefore_default; ?></textarea>
                </td>
            </tr>

            <tr valign="top">
                <th scope="row"><?php echo __('Wrap after', 'clayball-lang'); ?></th>
                <td><textarea type="text" name="clayballsetting_breadcrumb_warpafter" class="large-text"
                              row="5"><?php echo $warpafter_default; ?></textarea>
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