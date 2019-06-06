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
        $this->regsection = parent::ReturnRegSection() . 'General';
    }

    public function RegFields()
    {
        register_setting($this->regsection, 'clayballsetting_multiple_images_posttype');
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

        $clayballsetting_multiple_images_posttype = (array)get_option('clayballsetting_multiple_images_posttype', []);


        settings_fields($this->regsection);
        do_settings_sections($this->regsection); ?>
        <fieldset>
            <legend><h3><?php echo __('Multiple Image Upload', 'clayball-lang'); ?></h3>
                <small>Option name :
                    clayballsetting_multiple_images_posttype
                </small>
            </legend>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php echo __('POST TYPE', 'clayball-lang'); ?></th>
                    <td>
                        <div class="checkbox" style="display:flex;align-items: center;justify-content: flex-start;">
                            <?php foreach ($checkgroup as $inx => $value): ?>
                                <label for="clayballsetting_multiple_images_posttype_<?php echo $value; ?>"
                                       style="margin-right:20px;">
                                    <input type="checkbox" name="clayballsetting_multiple_images_posttype[]"
                                           class="regular-text"
                                           id="clayballsetting_multiple_images_posttype_<?php echo $value; ?>"
                                        <?php checked(in_array($value, $clayballsetting_multiple_images_posttype), 1); ?>
                                           value="<?php echo $value; ?>"/> <?php echo $value; ?>
                                </label>

                            <?php endforeach; ?>

                        </div>
                        <p class="description"><?php echo __('Enable Multiple images for pages, posts and custom post types. Note: By default pages only.', 'clayball-lang'); ?></p>
                    </td>
                </tr>

            </table>
        </fieldset>
        <hr>
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