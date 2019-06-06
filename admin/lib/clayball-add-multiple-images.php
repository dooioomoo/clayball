<?php
if (!class_exists('Clayball_Add_Multiple_Images')) {

    class Clayball_Add_Multiple_Images
    {
        public function __construct()
        {

            $this->clayballsetting_multiple_images_posttype = !is_array(get_option('clayballsetting_multiple_images_posttype', [])) ? ['page'] : get_option('clayballsetting_multiple_images_posttype', []);
            add_action('add_meta_boxes', array($this, 'AddMetaboxToPosttype'));
            add_action('save_post', array($this, 'CustomPostimageSaveImage'));
        }

        public function AddMetaboxToPosttype()
        {
            wp_enqueue_script('Clayball-js-multipleimages', __CLAYBALLPLUGINURI__ . '/assets/js/multiple-images.js', array('jquery', 'jquery-ui-selectable'), CLAYBALL_ADDONS_VERSION, false);
            wp_enqueue_style('Clayball-cssgroup-jquery-ui', 'http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css', false, CLAYBALL_ADDONS_VERSION, 'screen, print');
            wp_enqueue_style('Clayball-cssgroup-multipleimages', __CLAYBALLPLUGINURI__ . '/assets/css/multiple-images.css', false, CLAYBALL_ADDONS_VERSION, 'screen, print');
            foreach ($this->clayballsetting_multiple_images_posttype as $posttype) {
                add_meta_box('custom_postimage_meta_box', __('Featured Gallery', 'clayball-lang'), array($this, 'CustomPostimagesFunc'), $posttype, 'side', 'low');
            }
        }

        public function CustomPostimagesFunc($post)
        {
            ?>
            <p class="hide-if-no-js">
                <button class="button tagadd" id="clayball_add_multilpleimages">
                    <?php echo __('Set featured gallery', 'clayball-lang'); ?>
                </button>
            </p>
            <p></p>
            <div class="imagesList" id="add_clayball_gallery_section">
                <?php
                $imggroup = get_post_meta($post->ID, 'clayball_gallery_array', true);
                if (is_array($imggroup)) {
                    $image_meta_val = implode(',', $imggroup);
                } else {
                    $image_meta_val = '';
                }
                ?>
                <ul id="add_clayball_gallery_container"><?php
                    if (is_array($imggroup)) {
                        foreach ($imggroup as $img_id) {
                            $img_url = wp_get_attachment_image($img_id);
                            echo '<li class="photo-item ui-state-default" data-id="' . $img_id . '"><span class="delbutton"></span>' . $img_url . '</li>';
                        }
                    }
                    ?></ul>
            </div>
            <input type="hidden" name="clayball_gallery_array" id="clayball_gallery_array"
                   value="<?php echo isset($image_meta_val) ? $image_meta_val : ''; ?>"/>
            <script>
                $(document).ready(function () {
                    $('#clayball_add_multilpleimages').on('click', function (e) {
                        e.preventDefault();
                        custom_postimage_add_image();
                    });
                });

                function custom_postimage_add_image() {
                    custom_postimage_uploader = wp.media.frames.file_frame = wp.media({
                        title: '<?php _e('Select image', 'default'); ?>',
                        button: {
                            text: '<?php _e('Select image', 'default'); ?>'
                        },
                        multiple: true
                    });
                    custom_postimage_uploader.on('select', function () {
                        var selection = custom_postimage_uploader.state().get('selection');
                        var imggroup = '';
                        $('#add_clayball_gallery_section ul').empty();
                        selection.map(function (attachment) {
                            attachment = attachment.toJSON();
                            imggroup = imggroup + attachment.id + ',';
                            $('#add_clayball_gallery_section ul').append('<li class="photo-item ui-state-default" data-id="' + attachment.id + '"><span class="delbutton"></span><img src="' + attachment.url + '"></li>');
                        });
                        imggroup = (imggroup.substring(imggroup.length - 1) == ',') ? imggroup.substring(0, imggroup.length - 1) : imggroup;
                        $('input#clayball_gallery_array').val(imggroup);

                    });
                    custom_postimage_uploader.on('open', function () {
                        var selection = custom_postimage_uploader.state().get('selection');
                        var selected = $('input#clayball_gallery_array').val();
                        if (selected) {
                            selected = selected.split(',');
                            selected.map(function (val) {
                                selection.add(wp.media.attachment(val));
                            });
                        }
                    });
                    custom_postimage_uploader.open();
                    return false;
                }

                $('#add_clayball_gallery_section').on('click', '.photo-item span.delbutton', function (e) {
                    e.preventDefault();
                    var img_id = $(this).parent().data('id');
                    var img_group = $('input#clayball_gallery_array').val();
                    img_group = img_group.split(',');
                    var result = [];
                    for (var i = 0; i < img_group.length; i++) {
                        if (img_group[i] != img_id) {
                            result.push(img_group[i]);
                        }
                    }
                    img_group = result.join(',');
                    $('input#clayball_gallery_array').val(img_group);
                    $(this).parent().hide(300).remove();
                });
            </script>
            <?php
            wp_nonce_field('custom_postimage_meta_box', 'custom_postimage_meta_box_nonce');
        }

        public function CustomPostimageSaveImage($post_id)
        {
            if (!current_user_can('edit_posts', $post_id)) {
                return 'not permitted';
            }
            if (isset($_POST['custom_postimage_meta_box_nonce']) && wp_verify_nonce($_POST['custom_postimage_meta_box_nonce'], 'custom_postimage_meta_box')) {
                if (isset($_POST['clayball_gallery_array']) && intval($_POST['clayball_gallery_array']) != '') {
                    $_POST['clayball_gallery_array'] = explode(",", $_POST['clayball_gallery_array']);
                    update_post_meta($post_id, 'clayball_gallery_array', $_POST['clayball_gallery_array']);
                } else {
                    update_post_meta($post_id, 'clayball_gallery_array', '');
                }
            }
        }

        public function enqueue_scripts()
        {

        }

    }

    new Clayball_Add_Multiple_Images();
}