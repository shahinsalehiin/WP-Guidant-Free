<?php

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['data'])) {

        $data = $_REQUEST['data'];
        $data = urldecode($data);
        $data = stripcslashes($data);
        $obj = json_decode($data, TRUE);


        foreach ($obj as $single_element){
            $element_id = sanitize_text_field($single_element['element_id']);
            $position = sanitize_text_field($single_element['position']);

            $this->settings->updateElementSettings($element_id, "position", $position);
        }

        $result = array("status" => 'true');
    }else{
        $result = array("status" => 'false');
    }


}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);