<?php


/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['guide_id'])) {

        $resultsList = array();

        $guide_id = sanitize_text_field($_REQUEST['guide_id']);

        $list_results = $this->settings->listAllResults($guide_id);
        foreach ($list_results as $single_result){


            $attribute_type = $this->settings->updateResultSettings($single_result['result_id'], "attribute_type");
            $attribute_type_text = $this->settings->updateResultSettings($single_result['result_id'], "attribute_type_text");
            $prefix = $this->settings->updateResultSettings($single_result['result_id'], "prefix");
            $button_text = $this->settings->updateResultSettings($single_result['result_id'], "button_text");
            $image_height = $this->settings->updateResultSettings($single_result['result_id'], "image_height");

            $resultsList[] = array(
                "result_id" => esc_attr($single_result['result_id']),
                "attribute_type" => esc_attr($attribute_type),
                "attribute_type_text" => esc_attr($attribute_type_text),
                "prefix" => esc_attr($prefix),
                "button_text" => esc_attr($button_text),
                "image_height" => esc_attr($image_height),
            );
        }

        $result = array(
            "status" => 'true',
            "results" => $resultsList);
    }else{
        $result = array("status" => 'false');
    }

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);