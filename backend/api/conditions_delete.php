<?php

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['condition_id'])) {

        $condition_id = sanitize_text_field($_REQUEST['condition_id']);

        $this->settings->deleteCondition($condition_id);

        $result = array("status" => 'true', "msg" => esc_attr__('Condition Deleted', 'guidant'));
    }else{
        $result = array("status" => 'false');
    }


}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);