<?php

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['element_id']) && isset($_REQUEST['card_label']) && isset($_REQUEST['card_image']) && isset($_REQUEST['behavior'])) {

        $element_id = sanitize_text_field($_REQUEST['element_id']);
        $card_label = sanitize_text_field($_REQUEST['card_label']);
        $card_image = sanitize_text_field($_REQUEST['card_image']);
        $behavior = sanitize_text_field($_REQUEST['behavior']);

        $card_label = empty($card_label) ? " " : $card_label;

        $this->settings->updateElementSettings($element_id, "card_label", $card_label);
        $this->settings->updateElementSettings($element_id, "card_image", $card_image);
        $this->settings->updateElementSettings($element_id, "behavior", $behavior);


        $result = array("status" => 'true', "msg" => esc_attr__('Element Saved', 'guidant'));
    }else{
        $result = array("status" => 'false');
    }

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);