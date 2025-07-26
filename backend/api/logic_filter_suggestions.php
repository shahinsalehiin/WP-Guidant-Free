<?php

$result = array();

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){


    $filtersList = array();

    if(isset($_REQUEST['guide_id'])) {
        $guide_id = sanitize_text_field($_REQUEST['guide_id']);

        $list_filters = $this->settings->listAllFilters($guide_id);
        foreach ($list_filters as $single_filter){


            $filter_id = $single_filter['filter_id'];
            $filter_name = $this->settings->updateFilterSettings($single_filter['filter_id'], "filter_name");
            $filter_type = $this->settings->updateFilterSettings($single_filter['filter_id'], "filter_type");


            $filtersList[] = array("id" => $filter_id, "text" => "Filter: ".$filter_name);

        }

        $result = array("status" => 'true', "filters" => $filtersList);

    }else{
        $result = array("status" => 'false');
    }

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);