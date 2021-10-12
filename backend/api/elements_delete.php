<?php

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['element_id'])) {

        $element_id = sanitize_text_field($_REQUEST['element_id']);

        $this->settings->deleteElement($element_id);

        $result = array("status" => 'true', "msg" => esc_attr__('Element Deleted', 'guidant'));
    }else{
        $result = array("status" => 'false');
    }


}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);