<?php

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['element_id'])) {

        $element_id = sanitize_text_field($_REQUEST['element_id']);


        if(isset($_REQUEST['element_label'])){
            $element_label = sanitize_text_field($_REQUEST['element_label']);
            $this->settings->updateElementSettings($element_id, "element_label", $element_label);
        }

        if(isset($_REQUEST['input_type'])){
            $input_type = sanitize_text_field($_REQUEST['input_type']);
            $this->settings->updateElementSettings($element_id, "input_type", $input_type);
        }

        if(isset($_REQUEST['input_field_type'])){
            $input_field_type = sanitize_text_field($_REQUEST['input_field_type']);
            $this->settings->updateElementSettings($element_id, "input_field_type", $input_field_type);
        }

        if(isset($_REQUEST['select_items'])){
            $select_items = sanitize_text_field($_REQUEST['select_items']);
            $this->settings->updateElementSettings($element_id, "select_items", $select_items);
        }

        if(isset($_REQUEST['checkbox_items'])){
            $checkbox_items = sanitize_text_field($_REQUEST['checkbox_items']);
            $this->settings->updateElementSettings($element_id, "checkbox_items", $checkbox_items);
        }

        if(isset($_REQUEST['radio_items'])){
            $radio_items = sanitize_text_field($_REQUEST['radio_items']);
            $this->settings->updateElementSettings($element_id, "radio_items", $radio_items);
        }

        if(isset($_REQUEST['element_required'])){
            $element_required = sanitize_text_field($_REQUEST['element_required']);
            $this->settings->updateElementSettings($element_id, "element_required", $element_required);
        }

        if(isset($_REQUEST['element_class'])){
            $element_class = sanitize_text_field($_REQUEST['element_class']);
            $this->settings->updateElementSettings($element_id, "element_class", $element_class);
        }



        $result = array("status" => 'true', "msg" => esc_attr__('Element Saved', 'guidant'));
    }else{
        $result = array("status" => 'false');
    }

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);