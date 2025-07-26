<?php



/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    $guidesList = array();

    $list_guides = $this->settings->listAllGuides();
    foreach ($list_guides as $single_guide){
        $guidesList[] = array(
            "guide_id" => esc_attr($single_guide['guide_id']),
            "guide_name" => esc_attr($this->settings->updateGuideSettings($single_guide['guide_id'], "guide_name")),
            "guide_title" => esc_attr($this->settings->updateGuideSettings($single_guide['guide_id'], "guide_title")),
            );
    }
    $result = array("status" => 'true', "guides" => $guidesList);

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);