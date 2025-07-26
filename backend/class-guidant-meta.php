<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!class_exists('GuidantAdminMeta')) {
    class GuidantAdminMeta
    {

        protected $settings;
        protected $utils;

        public function __construct($admin_class)
        {
            $this->settings = $admin_class->settings;
            $this->utils = $admin_class->utils;


            add_action( 'add_meta_boxes', array($this, 'guidant_add_meta_box') );
            add_action( 'save_post', array($this, 'guidant_custom_field_save'));
        }


        function guidant_add_meta_box( $post_type ) {


            $total_fields_in_post = 0;
            $total_fields_in_product = 0;

            $list_fields = $this->settings->listAllFields();
            foreach ($list_fields as $single_field){
                if($this->settings->updateFieldSettings($single_field['field_id'], "field_placement") == "post"){
                    $total_fields_in_post ++;
                }
                if($this->settings->updateFieldSettings($single_field['field_id'], "field_placement") == "product"){
                    $total_fields_in_product ++;
                }
                if($this->settings->updateFieldSettings($single_field['field_id'], "field_placement") == "all"){
                    $total_fields_in_post ++;
                    $total_fields_in_product ++;
                }
            }

            if( ($post_type == 'post' && $total_fields_in_post > 0) || ($post_type == 'product' && $total_fields_in_product > 0) ){
                add_meta_box(
                    'guidant-meta-box',
                    __( 'WP Guidant - Custom Fields', 'textdomain' ),
                    array($this, 'guidant_meta_box_content'),
                    $post_type,
                    'advanced',
                    'high'
                );
            }


        }

        function guidant_meta_box_content( $post ) {
            wp_nonce_field( 'guidant_custom_fields_box', 'guidant_custom_fields_nonce' );

            $list_fields = $this->settings->listAllFields();
            foreach ($list_fields as $single_field){

                if($this->settings->updateFieldSettings($single_field['field_id'], "field_placement") == $post->post_type ||
                    $this->settings->updateFieldSettings($single_field['field_id'], "field_placement") == "all"){

                    ?>

                    <div style="margin-top: 15px;">
                        <label style="display: inline-block; width: 100px; max-width: 100px;  word-wrap: break-word; margin-right: 15px;" for="<?php echo esc_attr($single_field['field_id']) ?>">
                            <?php echo esc_attr($this->settings->updateFieldSettings($single_field['field_id'], "field_label")); ?>
                        </label>
                        <input type="text" style="width: 100%; max-width: 500px; min-width: 20px" id="<?php echo esc_attr($single_field['field_id']) ?>" name="<?php echo esc_attr($single_field['field_id']) ?>" value="<?php echo esc_attr( get_post_meta( $post->ID, $single_field['field_id'], true ) ); ?>" />
                    </div>

                    <?php

                }
            }
        }

        function guidant_custom_field_save( $post_id ) {
            if ( ! isset( $_POST['guidant_custom_fields_nonce'] ) ) {
                return $post_id;
            }
            $nonce = $_POST['guidant_custom_fields_nonce'];
            if ( ! wp_verify_nonce( $nonce, 'guidant_custom_fields_box' ) ) {
                return $post_id;
            }
            if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return $post_id;
            }
            if ( 'page' == $_POST['post_type'] ) {
                if ( ! current_user_can( 'edit_page', $post_id ) ) {
                    return $post_id;
                }
            } else {
                if ( ! current_user_can( 'edit_post', $post_id ) ) {
                    return $post_id;
                }
            }


            $list_fields = $this->settings->listAllFields();
            foreach ($list_fields as $single_field){
                $data = sanitize_text_field( $_POST[$single_field['field_id']] );
                if (strlen(trim($data)) > 0){
                    update_post_meta( $post_id, $single_field['field_id'], $data );
                }
            }
        }



    }
}
