<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 2019/6/12
 * Time: 14:33
 */

class ClassClayballSettingAttribute extends ClassClayballSettingWrap
{
    protected $AttributeCore;

    public function __construct( $menuitem = array () )
    {
        parent::__construct($menuitem);

        add_action('admin_init' , array ($this , 'RegFields'));
        $this->regsection = parent::ReturnRegSection() . 'Attribute';

        if ( class_exists('ClassClayballPluginAttribute') )
            $this->AttributeCore = new ClassClayballPluginAttribute;
    }

    public function RegFields()
    {
        register_setting($this->regsection , 'clayballsetting_attribute_posttype');
        register_setting($this->regsection , 'clayballsetting_attribute_value');
    }

    public function CreatePanel()
    {
        $checkgroup                         = get_all_posttype();
        $clayballsetting_attribute_posttype = (array)get_option('clayballsetting_attribute_posttype' , []);
        $clayballsetting_attribute_value    = (array)get_option('clayballsetting_attribute_value' , []);

        settings_fields($this->regsection);
        do_settings_sections($this->regsection);
        ?>
        <fieldset>
            <legend><h3><?php echo __('Add attributes to post' , 'clayball-lang'); ?></h3>
            </legend>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php echo __('POST TYPE' , 'clayball-lang'); ?></th>
                    <td>
                        <div class="checkbox" style="display:flex;align-items: center;justify-content: flex-start;">
                            <?php foreach ( $checkgroup as $inx => $value ): ?>
                                <label for="clayballsetting_attribute_posttype_<?php echo $value; ?>"
                                       style="margin-right:20px;">
                                    <input type="checkbox" name="clayballsetting_attribute_posttype[]"
                                           class="regular-text"
                                           id="clayballsetting_attribute_posttype_<?php echo $value; ?>"
                                        <?php checked(in_array($value , $clayballsetting_attribute_posttype) , 1); ?>
                                           value="<?php echo $value; ?>"/> <?php echo $value; ?>
                                </label>

                            <?php endforeach; ?>

                        </div>
                        <p class="description"><?php echo __('Enable Multiple images for pages, posts and custom post types. Note: By default pages only.' , 'clayball-lang'); ?></p>
                    </td>
                </tr>

            </table>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php echo __('LABEL AND VALUES' , 'clayball-lang'); ?></th>
                    <td>
                        <div class="clayballsetting_attribute_wrap">
                            <ul class="clayballsetting_attribute_itemWrap selector">
                                <?php if ( !isset($clayballsetting_attribute_value['name'])): ?>
                                    <li class="clayballsetting_attribute_item">
                                        <div class="actions">
                                            <label class="handle"><span class="dashicons dashicons-move"></span></label>
                                            <label class=""><?php echo __('タグ'); ?>
                                                <input type="text" value=""
                                                       name="clayballsetting_attribute_value[name][]"></label>
                                            <label class=""><?php echo __('Placeholder'); ?>
                                                <input type="text" value=""
                                                       name="clayballsetting_attribute_value[placeholder][]"></label>
                                            <input type="button" name="del-attribute"
                                                   class="button" value="DELETE">
                                        </div>
                                    </li>
                                <?php else:
                                    foreach ( $clayballsetting_attribute_value['name'] as $key => $value ):
                                        if ( $value == '' ) continue;
                                        ?>
                                        <li class="clayballsetting_attribute_item">
                                            <div class="actions">
                                                <label class="handle"><span class="dashicons dashicons-move"></span></label>
                                                <label class=""><?php echo __('タグ'); ?>
                                                    <input type="text" value="<?php echo $value; ?>"
                                                           name="clayballsetting_attribute_value[name][]"></label>
                                                <label class=""><?php echo __('Normal'); ?>
                                                    <input type="text"
                                                           value="<?php echo $clayballsetting_attribute_value['value'][$key]; ?>"
                                                           name="clayballsetting_attribute_value[value][]"></label>
                                                <input type="button" name="del-attribute"
                                                       class="button" value="DELETE">
                                            </div>
                                        </li>
                                    <?php
                                    endforeach;
                                    ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="clayballsetting_attribute_control" style="">
                            <ul class="list">
                                <li>
                                    <button type="button" data-section="clayballsetting_attribute_addfield"
                                            class="add-field button button-primary"
                                            aria-label="<?php echo __('add field' , 'clayball-lang'); ?>"><?php echo __('ADD FIELD'); ?></button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>

            </table>
        </fieldset>

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