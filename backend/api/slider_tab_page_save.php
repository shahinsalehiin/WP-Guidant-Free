<?php

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['element_id'])) {

        $element_id = sanitize_text_field($_REQUEST['element_id']);


        if(isset($_REQUEST['slider_type'])){
            $slider_type = sanitize_text_field($_REQUEST['slider_type']);
            $this->settings->updateElementSettings($element_id, "slider_type", $slider_type);
        }

        if(isset($_REQUEST['slider_image'])){
            $slider_image = sanitize_text_field($_REQUEST['slider_image']);
            $this->settings->updateElementSettings($element_id, "slider_image", $slider_image);
        }

        if(isset($_REQUEST['behavior'])){
            $behavior = sanitize_text_field($_REQUEST['behavior']);
            $this->settings->updateElementSettings($element_id, "behavior", $behavior);
        }

        if(isset($_REQUEST['slider_label'])){
            $slider_label = sanitize_text_field($_REQUEST['slider_label']);
            $slider_label = empty($slider_label) ? " " : $slider_label;
            $this->settings->updateElementSettings($element_id, "slider_label", $slider_label);
        }

        if(isset($_REQUEST['min_range'])){
            $min_range = sanitize_text_field($_REQUEST['min_range']);
            $this->settings->updateElementSettings($element_id, "min_range", $min_range);
        }

        if(isset($_REQUEST['max_range'])){
            $max_range = sanitize_text_field($_REQUEST['max_range']);
            $this->settings->updateElementSettings($element_id, "max_range", $max_range);
        }

        if(isset($_REQUEST['slider_step'])){
            $slider_step = sanitize_text_field($_REQUEST['slider_step']);
            $this->settings->updateElementSettings($element_id, "slider_step", $slider_step);
        }

        if(isset($_REQUEST['slider_prefix_text'])){
            $slider_prefix_text = sanitize_text_field($_REQUEST['slider_prefix_text']);
            $slider_prefix_text = empty($slider_prefix_text) ? " " : $slider_prefix_text;
            $this->settings->updateElementSettings($element_id, "slider_prefix_text", $slider_prefix_text);
        }

        if(isset($_REQUEST['slider_postfix_text'])){
            $slider_postfix_text = sanitize_text_field($_REQUEST['slider_postfix_text']);
            $slider_postfix_text = empty($slider_postfix_text) ? " " : $slider_postfix_text;
            $this->settings->updateElementSettings($element_id, "slider_postfix_text", $slider_postfix_text);
        }


        $result = array("status" => 'true', "msg" => esc_attr__('Element Saved', 'guidant'));
    }else{
        $result = array("status" => 'false');
    }

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);