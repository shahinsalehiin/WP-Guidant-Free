<?php

$result = array();

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    if(isset($_REQUEST['attribute'])) {
        $attribute = sanitize_text_field($_REQUEST['attribute']);
        $q = isset($_REQUEST['q']) ? sanitize_text_field($_REQUEST['q']) : "";


        $valuesList = $this->utils->getAttributeValues($attribute, $q);

        $result = array("status" => 'true', "q" => $q, "values" => $valuesList);

    }else{
        $result = array("status" => 'false');
    }

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);