<?php



/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    $fieldsList = array();

    $list_fields = $this->settings->listAllFields();
    foreach ($list_fields as $single_field){
        $fieldsList[] = array(
            "field_id" => esc_attr($single_field['field_id']),
            "field_label" => esc_attr($this->settings->updateFieldSettings($single_field['field_id'], "field_label")),
            "field_placement" => esc_attr($this->settings->updateFieldSettings($single_field['field_id'], "field_placement")),
        );
    }
    $result = array("status" => 'true', "fields" => $fieldsList);

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);