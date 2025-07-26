<?php

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['filter_id']) && isset($_REQUEST['filter_type'])) {

        $filter_id = sanitize_text_field($_REQUEST['filter_id']);
        $filter_type = sanitize_text_field($_REQUEST['filter_type']);

        $element_id = $this->settings->createNewElement($filter_id, $filter_type);


        /* Add increased filter position */
        $list_elements = $this->settings->listAllElements($filter_id, $filter_type);
        $element_position = sizeof($list_elements) > 0 ? sizeof($list_elements) : 0;
        $this->settings->updateElementSettings($element_id, "position", $element_position);
        /* Add increased filter position */


        $result = array("status" => 'true',
            "filter_type" => $filter_type,
            "element_id" => $element_id,
            "msg" => esc_attr__('Element Created', 'guidant'));
    }else{
        $result = array("status" => 'false');
    }


}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);