<?php


/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['element_id'])) {

        $conditionsList = array();

        $element_id = sanitize_text_field($_REQUEST['element_id']);

        $list_conditions = $this->settings->listAllConditions($element_id);
        foreach ($list_conditions as $single_condition){

            $attribute_type = $this->settings->updateConditionSettings($single_condition['condition_id'], "attribute_type");
            $attribute_type_text = $this->settings->updateConditionSettings($single_condition['condition_id'], "attribute_type_text");
            $matching_type = $this->settings->updateConditionSettings($single_condition['condition_id'], "matching_type");
            $value_selection = $this->settings->updateConditionSettings($single_condition['condition_id'], "value_selection");
            $value = $this->settings->updateConditionSettings($single_condition['condition_id'], "value");
            $value_text = $this->settings->updateConditionSettings($single_condition['condition_id'], "value_text");

            $conditionsList[] = array(
                "condition_id" => esc_attr($single_condition['condition_id']),
                "attribute_type" => esc_attr($attribute_type),
                "attribute_type_text" => esc_attr($attribute_type_text),
                "matching_type" => esc_attr($matching_type),
                "value_selection" => esc_attr($value_selection),
                "value" => esc_attr($value),
                "value_text" => esc_attr($value_text),
            );
        }

        $result = array(
            "status" => 'true',
            "conditions" => $conditionsList);
    }else{
        $result = array("status" => 'false');
    }

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);