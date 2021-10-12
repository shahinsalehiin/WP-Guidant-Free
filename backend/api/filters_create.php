<?php

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['guide_id']) && isset($_REQUEST['filter_id']) && isset($_REQUEST['filter_name']) && isset($_REQUEST['filter_title']) && isset($_REQUEST['filter_description']) && isset($_REQUEST['filter_type'])) {

        $guide_id = sanitize_text_field($_REQUEST['guide_id']);
        $filter_id = sanitize_text_field($_REQUEST['filter_id']);
        $filter_id = ($filter_id == "0") ? $this->settings->createNewFilter($guide_id) : $filter_id;


        $filter_name = sanitize_text_field($_REQUEST['filter_name']);
        $filter_title = sanitize_text_field($_REQUEST['filter_title']);
        $filter_description = wp_filter_post_kses($_REQUEST['filter_description']);
        $filter_type = sanitize_text_field($_REQUEST['filter_type']);
        $card_type = isset($_REQUEST['card_type']) ? sanitize_text_field($_REQUEST['card_type']) : "checkbox";


        $filter_title = empty($filter_title) ? " " : $filter_title;
        $filter_description = empty($filter_description) ? " " : $filter_description;

        $this->settings->updateFilterSettings($filter_id, "filter_name", $filter_name);
        $this->settings->updateFilterSettings($filter_id, "filter_title", $filter_title);
        $this->settings->updateFilterSettings($filter_id, "filter_description", $filter_description);
        $this->settings->updateFilterSettings($filter_id, "filter_type", $filter_type);
        if($filter_type == "card"){
            $this->settings->updateFilterSettings($filter_id, "card_type", $card_type);
        }


        /* Add increased filter position */
        $list_filters = $this->settings->listAllFilters($guide_id);
        $filter_position = sizeof($list_filters) > 0 ? sizeof($list_filters) : 0;
        $this->settings->updateFilterSettings($filter_id, "position", $filter_position);
        /* Add increased filter position */



        $result = array("status" => 'true',
            "filter_id" => $filter_id,
            "filter_type" => $filter_type,
            "msg" => esc_attr__('Filter Created', 'guidant')
        );
    }else{
        $result = array("status" => 'false');
    }


}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);