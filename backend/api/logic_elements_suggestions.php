<?php

$result = array();

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){


    $filtersElementsList = array();

    if(isset($_REQUEST['guide_id'])) {
        $guide_id = sanitize_text_field($_REQUEST['guide_id']);

        $list_filters = $this->settings->listAllFilters($guide_id);
        foreach ($list_filters as $single_filter){


            $filter_id = $single_filter['filter_id'];
            $filter_name = $this->settings->updateFilterSettings($single_filter['filter_id'], "filter_name");
            $filter_type = $this->settings->updateFilterSettings($single_filter['filter_id'], "filter_type");
            $elementsList = array();

            if($filter_type == "card"){
                $list_elements = $this->settings->listAllElements($filter_id, $filter_type);
                foreach ($list_elements as $single_element) {
                    $element_id = $single_element['element_id'];
                    $element_type = $single_element['element_type'];
                    if($element_type == "card"){
                        $card_label = $this->settings->updateElementSettings($element_id, "card_label");
                        $card_label = ($card_label == Null) ? "No Label Text" : $card_label;
                        $elementsList[] = array("id" => esc_attr($element_id), "text" => esc_attr($card_label));
                    }
                }
            }

            if(sizeof($elementsList) > 0){
                $filtersElementsList[] = array("text" => "Filter: ".$filter_name, "children" => $elementsList);
            }

        }

        $result = array("status" => 'true', "filterelements" => $filtersElementsList);

    }else{
        $result = array("status" => 'false');
    }

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);