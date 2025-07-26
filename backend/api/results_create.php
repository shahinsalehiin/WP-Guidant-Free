<?php

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['guide_id']) && isset($_REQUEST['result_id']) && isset($_REQUEST['attribute_type']) && isset($_REQUEST['attribute_type_text'])) {

        $guide_id = sanitize_text_field($_REQUEST['guide_id']);
        $result_id = sanitize_text_field($_REQUEST['result_id']);
        $result_id = ($result_id == "0") ? $this->settings->createNewResult($guide_id) : $result_id;


        $attribute_type = sanitize_text_field($_REQUEST['attribute_type']);
        $attribute_type_text = sanitize_text_field($_REQUEST['attribute_type_text']);


        $this->settings->updateResultSettings($result_id, "attribute_type", $attribute_type);
        $this->settings->updateResultSettings($result_id, "attribute_type_text", $attribute_type_text);




        if(isset($_REQUEST['prefix'])){
            $prefix = sanitize_text_field($_REQUEST['prefix']);
            $prefix = empty($prefix) ? " " : $prefix;
            $this->settings->updateResultSettings($result_id, "prefix", $prefix);
        }

        if(isset($_REQUEST['button_text'])){
            $button_text = sanitize_text_field($_REQUEST['button_text']);
            $button_text = empty($button_text) ? " " : $button_text;
            $this->settings->updateResultSettings($result_id, "button_text", $button_text);
        }

        if(isset($_REQUEST['image_height'])){
            $image_height = sanitize_text_field($_REQUEST['image_height']);
            $this->settings->updateResultSettings($result_id, "image_height", $image_height);
        }



        $result = array("status" => 'true', "msg" => esc_attr__('Attribute Created', 'guidant'));
    }else{
        $result = array("status" => 'false');
    }


}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);