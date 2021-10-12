<?php

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['element_id']) && isset($_REQUEST['condition_id']) && isset($_REQUEST['attribute_type']) && isset($_REQUEST['attribute_type_text'])
        && isset($_REQUEST['matching_type'])) {

        $element_id = sanitize_text_field($_REQUEST['element_id']);
        $condition_id = sanitize_text_field($_REQUEST['condition_id']);
        $condition_id = ($condition_id == "0") ? $this->settings->createNewCondition($element_id) : $condition_id;


        $attribute_type = sanitize_text_field($_REQUEST['attribute_type']);
        $attribute_type_text = sanitize_text_field($_REQUEST['attribute_type_text']);
        $matching_type = sanitize_text_field($_REQUEST['matching_type']);


        $this->settings->updateConditionSettings($condition_id, "attribute_type", $attribute_type);
        $this->settings->updateConditionSettings($condition_id, "attribute_type_text", $attribute_type_text);
        $this->settings->updateConditionSettings($condition_id, "matching_type", $matching_type);



        if(isset($_REQUEST['value_selection']) && isset($_REQUEST['value_auto']) && isset($_REQUEST['value_auto_text']) && isset($_REQUEST['value_manual'])){
            $value_selection = sanitize_text_field($_REQUEST['value_selection']);
            $value_auto = sanitize_text_field($_REQUEST['value_auto']);
            $value_auto_text = sanitize_text_field($_REQUEST['value_auto_text']);
            $value_manual = sanitize_text_field($_REQUEST['value_manual']);

            $value = ($value_selection == "auto") ? $value_auto : $value_manual;
            $value_text = ($value_selection == "auto") ? $value_auto_text : "";

            $this->settings->updateConditionSettings($condition_id, "value_selection", $value_selection);
            $this->settings->updateConditionSettings($condition_id, "value", $value);
            $this->settings->updateConditionSettings($condition_id, "value_text", $value_text);
        }


        $result = array("status" => 'true', "msg" => esc_attr__('Condition Created', 'guidant'));
    }else{
        $result = array("status" => 'false');
    }


}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);