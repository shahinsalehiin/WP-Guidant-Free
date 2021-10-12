<?php

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['guide_id'])) {

        $guide_id = sanitize_text_field($_REQUEST['guide_id']);

        $this->settings->deleteGuide($guide_id);

        $result = array("status" => 'true', "msg" => esc_attr__('Guide Deleted', 'guidant'));
    }else{
        $result = array("status" => 'false');
    }


}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);