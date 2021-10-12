<?php

/* Receive post data */
$resultant_post_id_element_wise = array();
if(isset($_REQUEST['security']) && isset($_REQUEST['guide_id']) && isset($_REQUEST['submissions'])) {

    check_ajax_referer( 'guidant_hashkey', 'security' );

    $guide_id = sanitize_text_field($_REQUEST['guide_id']);
    $submissions = $_REQUEST['submissions'];
    $submissions = urldecode($submissions);
    $submissions = stripcslashes($submissions);
    $submissions_obj = json_decode($submissions, TRUE);



    $display_result = $this->settings->updateGuideSettings($guide_id, "display_result");
    $display_result = ($display_result == Null) ? "true" : $display_result;

    $submission_tracking = $this->settings->updateGuideSettings($guide_id, "submission_tracking");
    $submission_tracking = ($submission_tracking == Null) ? "enable" : $submission_tracking;

    /* ========== Record Submission ========== */
    if($submission_tracking == "enable"){
        $submission_id = 0;
        if(is_array($submissions_obj)){
            if(sizeof($submissions_obj)>0){
                $user = wp_get_current_user();
                $user_id = ( isset( $user->ID ) ? (int) $user->ID : 0 );
                $submission_id = $this->settings->recordNewSubmission($guide_id, $user_id, current_time( 'timestamp' ));
                foreach ($submissions_obj as $filter_id=>$elements) {
                    foreach ($elements as $element) {
                        if($element['element_type'] == "card"){
                            $this->settings->insertSubmissionData($submission_id, $element['element_id'], ($element['element_value'] != 0) ? "checked" : "");
                        }else if($element['element_type'] == "slider"){
                            $this->settings->insertSubmissionData($submission_id, $element['element_id'], $element['element_value']);
                        }else if($element['element_type'] == "form"){
                            $this->settings->insertSubmissionData($submission_id, $element['element_id'], $element['element_value']);
                        }
                    }
                }
            }
        }
    }

    /* ========== Record Submission ========== */







    foreach ($submissions_obj as $filter_id=>$elements){
        $filter_wise_resultant_ids = array();
        foreach ($elements as $element){

            $element_wise_resultant_ids = array();


            if($element['element_type'] == "card"){
                if($element['element_value'] != 0){

                    $condition_wise_resultant_ids = array();
                    $behavior = $this->settings->updateElementSettings($element['element_id'], "behavior");
                    $behavior = ($behavior == Null) ? "or" : $behavior;

                    $conditions = $this->settings->listAllConditions($element['element_id']);
                    foreach ($conditions as $single_condition){
                        $attribute_type = $this->settings->updateConditionSettings($single_condition['condition_id'], "attribute_type");
                        $matching_type = $this->settings->updateConditionSettings($single_condition['condition_id'], "matching_type");
                        $value = $this->settings->updateConditionSettings($single_condition['condition_id'], "value");


                        if($display_result == "true"){
                            $condition_wise_resultant_ids[] = $this->renderer->queryBuilder($attribute_type, $matching_type, $value);
                        }

                    }

                    if($behavior == "and"){
                        $condition_wise_resultant_ids = array_filter($condition_wise_resultant_ids); // filter out empty array
                        $element_wise_resultant_ids = array_merge($element_wise_resultant_ids, array_intersect(...$condition_wise_resultant_ids));
                    }else if($behavior == "or"){
                        $element_wise_resultant_ids = array_merge($element_wise_resultant_ids, ...$condition_wise_resultant_ids);
                    }


                }

            }else if($element['element_type'] == "slider"){

                $condition_wise_resultant_ids = array();
                $behavior = $this->settings->updateElementSettings($element['element_id'], "behavior");
                $behavior = ($behavior == Null) ? "or" : $behavior;

                $conditions = $this->settings->listAllConditions($element['element_id']);
                foreach ($conditions as $single_condition){
                    $attribute_type = $this->settings->updateConditionSettings($single_condition['condition_id'], "attribute_type");
                    $matching_type = $this->settings->updateConditionSettings($single_condition['condition_id'], "matching_type");
                    $value = $element['element_value'];

                    if($display_result == "true") {
                        $condition_wise_resultant_ids[] = $this->renderer->queryBuilder($attribute_type, $matching_type, $value);
                    }
                }

                if($behavior == "and"){
                    $condition_wise_resultant_ids = array_filter($condition_wise_resultant_ids); // filter out empty array
                    $element_wise_resultant_ids = array_merge($element_wise_resultant_ids, array_intersect(...$condition_wise_resultant_ids));
                }else if($behavior == "or"){
                    $element_wise_resultant_ids = array_merge($element_wise_resultant_ids, ...$condition_wise_resultant_ids);
                }

            }else if($element['element_type'] == "form"){
                //$this->settings->insertSubmissionData($submission_id, $element['element_id'], $element['element_value']);
            }



            $filter_wise_resultant_ids = array_merge($filter_wise_resultant_ids, $element_wise_resultant_ids);
        }

        if(sizeof($filter_wise_resultant_ids) > 0){
            $resultant_post_id_element_wise[] = $filter_wise_resultant_ids;
        }
    }


    if($display_result == "true") {

        if (sizeof($resultant_post_id_element_wise) > 1) {
            $filtered_post_ids = array_intersect(...$resultant_post_id_element_wise);
        } else {
            $filtered_post_ids = $resultant_post_id_element_wise[0];
        }

        $filtered_post_ids = array_values($filtered_post_ids);




        /* Clear IDs not public/published post, pop the max ID into best result */
        $filtered_post_ids = $this->renderer->clearUnNecessaryIds($filtered_post_ids);
        sort($filtered_post_ids);
        $best_result_id = array();
        $best_result_id[] = array_pop($filtered_post_ids);
        /* Clear IDs not public/published post, pop the max ID into best result */



        $list_result_attributes = array();
        $list_results = $this->settings->listAllResults($guide_id);
        foreach ($list_results as $single_result) {
            $list_result_attributes[] = array(
                "attribute_type" => $this->settings->updateResultSettings($single_result['result_id'], "attribute_type"),
                "prefix" => $this->settings->updateResultSettings($single_result['result_id'], "prefix"),
                "button_text" => $this->settings->updateResultSettings($single_result['result_id'], "button_text"),
                "image_height" => $this->settings->updateResultSettings($single_result['result_id'], "image_height"),
            );
        }

        $result = array("status" => 'true',
            "best_result" => $this->renderer->resultRender($best_result_id, $list_result_attributes),
            "other_results" => $this->renderer->resultRender($filtered_post_ids, $list_result_attributes)
        );
    }else{
        $result = array("status" => 'true');
    }



}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);