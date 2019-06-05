<?php
/**
 * Created by PhpStorm.
 * User: Ryan
 * Date: 2019/6/5
 * Time: 16:12
 */

class ClassClayballSettingGeneral extends ClassClayballSettingWrap
{
    public function __construct($menuitem = array())
    {
        parent::__construct($menuitem);
        add_action('admin_init', array($this, 'RegFields'));
    }

    public function RegFields()
    {
        register_setting(parent::ReturnRegSection(), 'clayballsetting_multiple_images');
    }

    public function CreatePanel()
    {
        $checkgroup = array(
            'post',
            'page'
        );
        $args       = array(
            'public' => true,
            '_builtin' => false
        );
        $output     = 'names'; // 'names' or 'objects' (default: 'names')
        $operator   = 'and'; // 'and' or 'or' (default: 'and')
        $post_types = get_post_types($args, $output, $operator);
        if ($post_types) { // If there are any custom public post types.
            foreach ($post_types as $post_type) {
                array_push($checkgroup, $post_type);
            }
        }

        $clayballsetting_multiple_images = get_option('clayballsetting_multiple_images', []);


        settings_fields(parent::ReturnRegSection());
        do_settings_sections(parent::ReturnRegSection()); ?>

        <table class="form-table">
            <tr valign="top">
                <th scope="row"><?php echo __('MULTIPLE IMAGE POST TYPE', 'clayball-lang'); ?></th>
                <td>
                    <div class="checkbox" style="display:flex;align-items: center;justify-content: flex-start;">
                        <?php foreach ($checkgroup as $inx => $value): ?>
                            <label for="clayballsetting_multiple_images_<?php echo $value; ?>" style="margin-right:20px;">
                                <input type="checkbox" name="clayballsetting_multiple_images[]" class="regular-text"
                                       id="clayballsetting_multiple_images_<?php echo $value; ?>"
                                    <?php checked(in_array($value, $clayballsetting_multiple_images), 1); ?>
                                       value="<?php echo $value; ?>"/> <?php echo $value; ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
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