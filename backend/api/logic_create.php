<?php

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['guide_id']) && isset($_REQUEST['logic_id']) && isset($_REQUEST['selected_element']) && isset($_REQUEST['selected_element_text'])
        && isset($_REQUEST['card_selection_method']) && isset($_REQUEST['selected_filter_to_hide']) && isset($_REQUEST['selected_filter_to_hide_text'])) {

        $guide_id = sanitize_text_field($_REQUEST['guide_id']);
        $logic_id = sanitize_text_field($_REQUEST['logic_id']);
        $logic_id = ($logic_id == "0") ? $this->settings->createNewLogic($guide_id) : $logic_id;


        $selected_element = sanitize_text_field($_REQUEST['selected_element']);
        $selected_element_text = sanitize_text_field($_REQUEST['selected_element_text']);
        $card_selection_method = sanitize_text_field($_REQUEST['card_selection_method']);
        $selected_filter_to_hide = sanitize_text_field($_REQUEST['selected_filter_to_hide']);
        $selected_filter_to_hide_text = sanitize_text_field($_REQUEST['selected_filter_to_hide_text']);


        $this->settings->updateLogicSettings($logic_id, "selected_element", $selected_element);
        $this->settings->updateLogicSettings($logic_id, "selected_element_text", $selected_element_text);
        $this->settings->updateLogicSettings($logic_id, "card_selection_method", $card_selection_method);
        $this->settings->updateLogicSettings($logic_id, "selected_filter_to_hide", $selected_filter_to_hide);
        $this->settings->updateLogicSettings($logic_id, "selected_filter_to_hide_text", $selected_filter_to_hide_text);



        $result = array("status" => 'true', "msg" => esc_attr__('Logic Created', 'guidant'));
    }else{
        $result = array("status" => 'false');
    }


}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);