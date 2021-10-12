<?php

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['filter_id'])) {

        $filter_id = sanitize_text_field($_REQUEST['filter_id']);

        $this->settings->deleteFilter($filter_id);

        $result = array("status" => 'true', "msg" => esc_attr__('Filter Deleted', 'guidant'));
    }else{
        $result = array("status" => 'false');
    }


}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);