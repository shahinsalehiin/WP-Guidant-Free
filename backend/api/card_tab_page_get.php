<?php


/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['element_id'])) {


        $element_id = sanitize_text_field($_REQUEST['element_id']);

        $card_label = $this->settings->updateElementSettings($element_id, "card_label");
        $card_label = ($card_label == Null) ? "" : $card_label;

        $card_image = $this->settings->updateElementSettings($element_id, "card_image");
        $card_image = ($card_image == Null) ? "0" : $card_image;

        $behavior = $this->settings->updateElementSettings($element_id, "behavior");
        $behavior = ($behavior == Null) ? "or" : $behavior;


        $card_image_url = "";
        if(isset($card_image)){
            if(strlen(trim($card_image)) > 0){
                $card_image_url = ($card_image > 0) ? wp_get_attachment_url($card_image) : GUIDANT_IMG_DIR . "empty_img.png";
            }else{
                $card_image_url = GUIDANT_IMG_DIR . "empty_img.png";
            }
        }else{
            $card_image_url = GUIDANT_IMG_DIR . "empty_img.png";
        }

        $result = array(
            "status" => 'true',
            "card_label" => $card_label,
            "card_image" => $card_image,
            "card_image_url" => $card_image_url,
            "behavior" => $behavior);
    }else{
        $result = array("status" => 'false');
    }

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);