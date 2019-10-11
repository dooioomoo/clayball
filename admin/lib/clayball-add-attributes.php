<?php
if ( !class_exists('Clayball_Add_Attributes') ) {

    class Clayball_Add_Attributes
    {
        public function __construct()
        {
            $this->$clayballsetting_attribute_posttype = !is_array(get_option('clayballsetting_attribute_posttype' , [])) ? ['page'] : get_option('clayballsetting_attribute_posttype' , []);
            add_action('add_meta_boxes' , array ($this , 'AddMetaboxToPosttype'));
            add_action('save_post' , array ($this , 'CustomAttributesSave'));
        }

        public function AddMetaboxToPosttype()
        {
            wp_enqueue_style('Clayball-cssgroup-jquery-ui' , 'http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' , FALSE , CLAYBALL_VERSION , 'screen, print');
            $itemsForm = (array)get_option('clayballsetting_attribute_value' , []);
            if ( isset($itemsForm['name']) )
                foreach ( $this->$clayballsetting_attribute_posttype as $posttype ) {
                    add_meta_box('custom_attributes_meta_box' , __('属性 [clayball_att_array]' , 'clayball-lang') , array ($this , 'CustomAttributesFunc') , $posttype , 'advanced' , 'low');
                }
        }

        public function CustomAttributesFunc( $post )
        {
            $itemsForm = (array)get_option('clayballsetting_attribute_value' , []);
            $items     = get_post_meta($post->ID , 'clayball_att_array' , TRUE);
            if ( !isset($itemsForm['name'])) return;
            ?>
            <div class="items-attributes">
                <ul class="items-attributes-wrap">
                    <?php foreach ( $itemsForm['name'] as $key => $value ): if ( $value == '' ) continue; ?>
                        <li class="items-attributes-item">
                            <div class="item-title">
                                <label><?php echo $value; ?></label>
                            </div>
                            <div class="item-value">
                                <?php
                                    if (isset($items[$value])){
                                        $theVal = $items[$value];
                                    }elseif(count($items)>1){
                                        $theVal = '';
                                    }else{
                                        $theVal = $itemsForm['value'][$key];
                                    }
                                ?>
                                <input type="text" class="large-text"
                                       name="clayballsetting_attribute_value[<?php echo $value; ?>]"
                                       value="<?php echo esc_attr($theVal); ?>">
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <?php
            wp_nonce_field('custom_Attributes_meta_box' , 'custom_Attributes_meta_box_nonce');
        }

        public function CustomAttributesSave( $post_id )
        {
            if ( !current_user_can('edit_posts' , $post_id) ) {
                return 'not permitted';
            }
            if ( isset($_POST['custom_Attributes_meta_box_nonce']) && wp_verify_nonce($_POST['custom_Attributes_meta_box_nonce'] , 'custom_Attributes_meta_box') ) {

                if ( isset($_POST['clayballsetting_attribute_value']) && intval($_POST['clayballsetting_attribute_value']) != '' ) {
                    update_post_meta($post_id , 'clayball_att_array' , esc_attr($_POST['clayballsetting_attribute_value']));
                } else {
                    update_post_meta($post_id , 'clayball_att_array' , '');
                }
            }
        }

        public function enqueue_scripts()
        {

        }

    }

    new Clayball_Add_Attributes();
}