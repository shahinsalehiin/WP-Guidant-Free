<?php


/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['guide_id'])) {

        $filtersList = array();

        $guide_id = sanitize_text_field($_REQUEST['guide_id']);

        $list_filters = $this->settings->listAllFilters($guide_id);
        foreach ($list_filters as $single_filter){
            $filtersList[] = array(
                "filter_id" => esc_attr($single_filter['filter_id']),
                "filter_name" => esc_attr($this->settings->updateFilterSettings($single_filter['filter_id'], "filter_name")),
                "filter_title" => esc_attr($this->settings->updateFilterSettings($single_filter['filter_id'], "filter_title")),
                "filter_description" => esc_attr($this->settings->updateFilterSettings($single_filter['filter_id'], "filter_description")),
                "filter_type" => esc_attr($this->settings->updateFilterSettings($single_filter['filter_id'], "filter_type")),
                "card_type" => esc_attr($this->settings->updateFilterSettings($single_filter['filter_id'], "card_type")),
            );
        }
        $result = array("status" => 'true', "filters" => $filtersList);
    }else{
        $result = array("status" => 'false');
    }

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);