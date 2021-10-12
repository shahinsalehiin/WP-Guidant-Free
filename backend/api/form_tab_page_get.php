<?php


/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['element_id'])) {


        $element_id = sanitize_text_field($_REQUEST['element_id']);

        $element_label = $this->settings->updateElementSettings($element_id, "element_label");
        $element_label = ($element_label == Null) ? "" : $element_label;

        $input_type = $this->settings->updateElementSettings($element_id, "input_type");
        $input_type = ($input_type == Null) ? "input" : $input_type;

        $input_field_type = $this->settings->updateElementSettings($element_id, "input_field_type");
        $input_field_type = ($input_field_type == Null) ? "text" : $input_field_type;

        $select_items = $this->settings->updateElementSettings($element_id, "select_items");
        $select_items = ($select_items == Null) ? "" : $select_items;



        $checkbox_items = $this->settings->updateElementSettings($element_id, "checkbox_items");
        $checkbox_items = ($checkbox_items == Null) ? "" : $checkbox_items;



        $radio_items = $this->settings->updateElementSettings($element_id, "radio_items");
        $radio_items = ($radio_items == Null) ? "" : $radio_items;

        $element_required = $this->settings->updateElementSettings($element_id, "element_required");
        $element_required = ($element_required == Null) ? "required" : $element_required;


        $result = array(
            "status" => 'true',
            "element_label" => $element_label,
            "input_type" => $input_type,
            "input_field_type" => $input_field_type,
            "select_items" => $select_items,
            "checkbox_items" => $checkbox_items,
            "radio_items" => $radio_items,
            "element_required" => $element_required);
    }else{
        $result = array("status" => 'false');
    }

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);