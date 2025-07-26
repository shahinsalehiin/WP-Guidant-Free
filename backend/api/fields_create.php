<?php

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['field_id']) && isset($_REQUEST['field_label']) && isset($_REQUEST['field_placement'])) {

        $field_id = sanitize_text_field($_REQUEST['field_id']);
        $field_id = ($field_id == "0") ? $this->settings->createNewField() : $field_id;


        $field_label = sanitize_text_field($_REQUEST['field_label']);
        $field_placement = sanitize_text_field($_REQUEST['field_placement']);


        $this->settings->updateFieldSettings($field_id, "field_label", $field_label);
        $this->settings->updateFieldSettings($field_id, "field_placement", $field_placement);


        $result = array("status" => 'true', "msg" => esc_attr__('Custom Field Created', 'guidant'));
    }else{
        $result = array("status" => 'false');
    }

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);