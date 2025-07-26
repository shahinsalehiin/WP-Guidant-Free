<?php


/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['guide_id'])) {

        $logicsList = array();

        $guide_id = sanitize_text_field($_REQUEST['guide_id']);

        $list_logics = $this->settings->listAllLogics($guide_id);
        foreach ($list_logics as $single_logic){


            $selected_element = $this->settings->updateLogicSettings($single_logic['logic_id'], "selected_element");
            $selected_element_text = $this->settings->updateLogicSettings($single_logic['logic_id'], "selected_element_text");
            $card_selection_method = $this->settings->updateLogicSettings($single_logic['logic_id'], "card_selection_method");
            $selected_filter_to_hide = $this->settings->updateLogicSettings($single_logic['logic_id'], "selected_filter_to_hide");
            $selected_filter_to_hide_text = $this->settings->updateLogicSettings($single_logic['logic_id'], "selected_filter_to_hide_text");

            $logicsList[] = array(
                "logic_id" => esc_attr($single_logic['logic_id']),
                "selected_element" => esc_attr($selected_element),
                "selected_element_text" => esc_attr($selected_element_text),
                "card_selection_method" => esc_attr($card_selection_method),
                "selected_filter_to_hide" => esc_attr($selected_filter_to_hide),
                "selected_filter_to_hide_text" => esc_attr($selected_filter_to_hide_text),
            );
        }

        $result = array(
            "status" => 'true',
            "logics" => $logicsList);
    }else{
        $result = array("status" => 'false');
    }

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);