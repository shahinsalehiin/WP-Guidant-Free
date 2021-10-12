<?php


/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['element_id'])) {


        $element_id = sanitize_text_field($_REQUEST['element_id']);

        $slider_type = $this->settings->updateElementSettings($element_id, "slider_type");
        $slider_type = ($slider_type == Null) ? "single" : $slider_type;

        $slider_image = $this->settings->updateElementSettings($element_id, "slider_image");
        $slider_image = ($slider_image == Null) ? "0" : $slider_image;

        $behavior = $this->settings->updateElementSettings($element_id, "behavior");
        $behavior = ($behavior == Null) ? "or" : $behavior;



        $slider_label = $this->settings->updateElementSettings($element_id, "slider_label");
        $slider_label = ($slider_label == Null) ? "" : $slider_label;

        $min_range = $this->settings->updateElementSettings($element_id, "min_range");
        $min_range = ($min_range == Null) ? "0" : $min_range;

        $max_range = $this->settings->updateElementSettings($element_id, "max_range");
        $max_range = ($max_range == Null) ? "100" : $max_range;

        $slider_step = $this->settings->updateElementSettings($element_id, "slider_step");
        $slider_step = ($slider_step == Null) ? "10" : $slider_step;

        $slider_prefix_text = $this->settings->updateElementSettings($element_id, "slider_prefix_text");
        $slider_prefix_text = ($slider_prefix_text == Null) ? "" : $slider_prefix_text;

        $slider_postfix_text = $this->settings->updateElementSettings($element_id, "slider_postfix_text");
        $slider_postfix_text = ($slider_postfix_text == Null) ? "" : $slider_postfix_text;



        $slider_image_url = "";
        if(isset($slider_image)){
            if(strlen(trim($slider_image)) > 0){
                $slider_image_url = ($slider_image > 0) ? wp_get_attachment_url($slider_image) : GUIDANT_IMG_DIR . "empty_img.png";
            }else{
                $slider_image_url = GUIDANT_IMG_DIR . "empty_img.png";
            }
        }else{
            $slider_image_url = GUIDANT_IMG_DIR . "empty_img.png";
        }

        $result = array(
            "status" => 'true',
            "slider_type" => $slider_type,
            "slider_image" => $slider_image,
            "slider_image_url" => $slider_image_url,
            "behavior" => $behavior,
            "slider_label" => $slider_label,
            "min_range" => $min_range,
            "max_range" => $max_range,
            "slider_step" => $slider_step,
            "slider_prefix_text" => $slider_prefix_text,
            "slider_postfix_text" => $slider_postfix_text);
    }else{
        $result = array("status" => 'false');
    }

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);