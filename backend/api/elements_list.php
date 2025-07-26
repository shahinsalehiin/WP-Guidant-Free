<?php


/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['filter_id']) && isset($_REQUEST['filter_type'])) {

        $elementsList = array();

        $filter_id = sanitize_text_field($_REQUEST['filter_id']);
        $filter_type = sanitize_text_field($_REQUEST['filter_type']);

        $list_elements = $this->settings->listAllElements($filter_id, $filter_type);
        foreach ($list_elements as $single_element){
            $element_id = $single_element['element_id'];
            $element_type = $single_element['element_type'];

            $total_conditions = "No Condition Set";
            $list_conditions = $this->settings->listAllConditions($element_id);
            if(is_array($list_conditions)){
                if(sizeof($list_conditions) > 1){
                    $total_conditions = sizeof($list_conditions)." Conditions Set";
                }else{
                    $total_conditions = sizeof($list_conditions)." Condition Set";
                }
            }

            if($element_type == "card"){

                $card_label = $this->settings->updateElementSettings($element_id, "card_label");
                $card_label = ($card_label == Null) ? "No Label Text" : $card_label;

                $elementsList[] = array(
                    "element_id" => esc_attr($element_id),
                    "element_type" => esc_attr($element_type),
                    "card_label" => esc_attr($card_label),
                    "total_conditions" => esc_attr($total_conditions),
                );
            }else if($element_type == "slider"){

                $slider_label = $this->settings->updateElementSettings($element_id, "slider_label");
                $slider_label = ($slider_label == Null) ? "No Label Text" : $slider_label;

                $elementsList[] = array(
                    "element_id" => esc_attr($element_id),
                    "element_type" => esc_attr($element_type),
                    "slider_label" => esc_attr($slider_label),
                    "total_conditions" => esc_attr($total_conditions),
                );
            }else if($element_type == "form"){

                $element_label = $this->settings->updateElementSettings($element_id, "element_label");
                $element_label = ($element_label == Null) ? "No Label Text" : $element_label;

                $input_type = $this->settings->updateElementSettings($element_id, "input_type");
                $input_type = ($input_type == Null) ? "No Element Type Selected" : $input_type;

                $elementsList[] = array(
                    "element_id" => esc_attr($element_id),
                    "element_type" => esc_attr($element_type),
                    "element_label" => esc_attr($element_label),
                    "input_type" => esc_attr($input_type),
                );
            }


        }
        $result = array("status" => 'true', "elements" => $elementsList);
    }else{
        $result = array("status" => 'false');
    }

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);