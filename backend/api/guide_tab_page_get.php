<?php


/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['guide_id'])) {


        $guide_id = sanitize_text_field($_REQUEST['guide_id']);



        $guide_name = $this->settings->updateGuideSettings($guide_id, "guide_name");
        $guide_name = ($guide_name == Null) ? "" : $guide_name;

        $submission_tracking = $this->settings->updateGuideSettings($guide_id, "submission_tracking");
        $submission_tracking = ($submission_tracking == Null) ? "enable" : $submission_tracking;

        $guide_title = $this->settings->updateGuideSettings($guide_id, "guide_title");
        $guide_title = ($guide_title == Null) ? "" : $guide_title;

        $guide_description = $this->settings->updateGuideSettings($guide_id, "guide_description");
        $guide_description = ($guide_description == Null) ? "" : $guide_description;




        $guide_title_color = $this->settings->updateGuideSettings($guide_id, "guide_title_color");
        $guide_title_color = ($guide_title_color == Null) ? "##201f1e" : $guide_title_color;

        $guide_title_fontsize = $this->settings->updateGuideSettings($guide_id, "guide_title_fontsize");
        $guide_title_fontsize = ($guide_title_fontsize == Null) ? "30" : $guide_title_fontsize;

        $guide_description_color = $this->settings->updateGuideSettings($guide_id, "guide_description_color");
        $guide_description_color = ($guide_description_color == Null) ? "#787674" : $guide_description_color;

        $guide_description_fontsize = $this->settings->updateGuideSettings($guide_id, "guide_description_fontsize");
        $guide_description_fontsize = ($guide_description_fontsize == Null) ? "16" : $guide_description_fontsize;

        $guide_background_image = $this->settings->updateGuideSettings($guide_id, "guide_background_image");
        $guide_background_image = ($guide_background_image == Null) ? "0" : $guide_background_image;

        $guide_background_startcolor = $this->settings->updateGuideSettings($guide_id, "guide_background_startcolor");
        $guide_background_startcolor = ($guide_background_startcolor == Null) ? "#fff6f1" : $guide_background_startcolor;

        $guide_background_endcolor = $this->settings->updateGuideSettings($guide_id, "guide_background_endcolor");
        $guide_background_endcolor = ($guide_background_endcolor == Null) ? "#fff6f1" : $guide_background_endcolor;

        $guide_background_direction = $this->settings->updateGuideSettings($guide_id, "guide_background_direction");
        $guide_background_direction = ($guide_background_direction == Null) ? "90" : $guide_background_direction;




        $filter_title_color = $this->settings->updateGuideSettings($guide_id, "filter_title_color");
        $filter_title_color = ($filter_title_color == Null) ? "#1f1f20" : $filter_title_color;

        $filter_title_fontsize = $this->settings->updateGuideSettings($guide_id, "filter_title_fontsize");
        $filter_title_fontsize = ($filter_title_fontsize == Null) ? "25" : $filter_title_fontsize;

        $filter_description_color = $this->settings->updateGuideSettings($guide_id, "filter_description_color");
        $filter_description_color = ($filter_description_color == Null) ? "#646261" : $filter_description_color;

        $filter_description_fontsize = $this->settings->updateGuideSettings($guide_id, "filter_description_fontsize");
        $filter_description_fontsize = ($filter_description_fontsize == Null) ? "16" : $filter_description_fontsize;

        $filter_background_color = $this->settings->updateGuideSettings($guide_id, "filter_background_color");
        $filter_background_color = ($filter_background_color == Null) ? "#fbfbfd" : $filter_background_color;

        $filter_border_color = $this->settings->updateGuideSettings($guide_id, "filter_border_color");
        $filter_border_color = ($filter_border_color == Null) ? "#ebe8e7" : $filter_border_color;

        $filter_prev_btn_text = $this->settings->updateGuideSettings($guide_id, "filter_prev_btn_text");
        $filter_prev_btn_text = ($filter_prev_btn_text == Null) ? "Previous" : $filter_prev_btn_text;

        $filter_prev_bg_color = $this->settings->updateGuideSettings($guide_id, "filter_prev_bg_color");
        $filter_prev_bg_color = ($filter_prev_bg_color == Null) ? "#ffffff" : $filter_prev_bg_color;

        $filter_prev_border_color = $this->settings->updateGuideSettings($guide_id, "filter_prev_border_color");
        $filter_prev_border_color = ($filter_prev_border_color == Null) ? "#d9d9db" : $filter_prev_border_color;

        $filter_prev_text_color = $this->settings->updateGuideSettings($guide_id, "filter_prev_text_color");
        $filter_prev_text_color = ($filter_prev_text_color == Null) ? "#1f1f20" : $filter_prev_text_color;

        $filter_next_btn_text = $this->settings->updateGuideSettings($guide_id, "filter_next_btn_text");
        $filter_next_btn_text = ($filter_next_btn_text == Null) ? "Next" : $filter_next_btn_text;

        $filter_next_bg_color = $this->settings->updateGuideSettings($guide_id, "filter_next_bg_color");
        $filter_next_bg_color = ($filter_next_bg_color == Null) ? "#de5819" : $filter_next_bg_color;

        $filter_next_border_color = $this->settings->updateGuideSettings($guide_id, "filter_next_border_color");
        $filter_next_border_color = ($filter_next_border_color == Null) ? "#de5819" : $filter_next_border_color;

        $filter_next_text_color = $this->settings->updateGuideSettings($guide_id, "filter_next_text_color");
        $filter_next_text_color = ($filter_next_text_color == Null) ? "#ffffff" : $filter_next_text_color;


        $filter_submit_btn_text = $this->settings->updateGuideSettings($guide_id, "filter_submit_btn_text");
        $filter_submit_btn_text = ($filter_submit_btn_text == Null) ? "Show Results" : $filter_submit_btn_text;

        $filter_submit_bg_color = $this->settings->updateGuideSettings($guide_id, "filter_submit_bg_color");
        $filter_submit_bg_color = ($filter_submit_bg_color == Null) ? "#de5819" : $filter_submit_bg_color;

        $filter_submit_border_color = $this->settings->updateGuideSettings($guide_id, "filter_submit_border_color");
        $filter_submit_border_color = ($filter_submit_border_color == Null) ? "#de5819" : $filter_submit_border_color;

        $filter_submit_text_color = $this->settings->updateGuideSettings($guide_id, "filter_submit_text_color");
        $filter_submit_text_color = ($filter_submit_text_color == Null) ? "#ffffff" : $filter_submit_text_color;



        $card_label_color = $this->settings->updateGuideSettings($guide_id, "card_label_color");
        $card_label_color = ($card_label_color == Null) ? "#1f1f20" : $card_label_color;

        $card_label_fontsize = $this->settings->updateGuideSettings($guide_id, "card_label_fontsize");
        $card_label_fontsize = ($card_label_fontsize == Null) ? "18" : $card_label_fontsize;

        $card_image_height = $this->settings->updateGuideSettings($guide_id, "card_image_height");
        $card_image_height = ($card_image_height == Null) ? "100" : $card_image_height;

        $card_border_color = $this->settings->updateGuideSettings($guide_id, "card_border_color");
        $card_border_color = ($card_border_color == Null) ? "#e5e5e7" : $card_border_color;

        $card_background_color = $this->settings->updateGuideSettings($guide_id, "card_background_color");
        $card_background_color = ($card_background_color == Null) ? "#ffffff" : $card_background_color;

        $card_border_hover_color = $this->settings->updateGuideSettings($guide_id, "card_border_hover_color");
        $card_border_hover_color = ($card_border_hover_color == Null) ? "#f38857" : $card_border_hover_color;

        $card_border_active_color = $this->settings->updateGuideSettings($guide_id, "card_border_active_color");
        $card_border_active_color = ($card_border_active_color == Null) ? "#de5819" : $card_border_active_color;

        $card_radio_border_color = $this->settings->updateGuideSettings($guide_id, "card_radio_border_color");
        $card_radio_border_color = ($card_radio_border_color == Null) ? "#c7c7ca" : $card_radio_border_color;

        $card_radio_border_hover_color = $this->settings->updateGuideSettings($guide_id, "card_radio_border_hover_color");
        $card_radio_border_hover_color = ($card_radio_border_hover_color == Null) ? "#f38857" : $card_radio_border_hover_color;

        $card_radio_selected_bg_color = $this->settings->updateGuideSettings($guide_id, "card_radio_selected_bg_color");
        $card_radio_selected_bg_color = ($card_radio_selected_bg_color == Null) ? "#de5819" : $card_radio_selected_bg_color;

        $card_radio_selected_icon_color = $this->settings->updateGuideSettings($guide_id, "card_radio_selected_icon_color");
        $card_radio_selected_icon_color = ($card_radio_selected_icon_color == Null) ? "#ffffff" : $card_radio_selected_icon_color;

        $auto_move_to_next_filter = $this->settings->updateGuideSettings($guide_id, "auto_move_to_next_filter");
        $auto_move_to_next_filter = ($auto_move_to_next_filter == Null) ? "disable" : $auto_move_to_next_filter;



        $slider_label_color = $this->settings->updateGuideSettings($guide_id, "slider_label_color");
        $slider_label_color = ($slider_label_color == Null) ? "#1f1f20" : $slider_label_color;

        $slider_label_fontsize = $this->settings->updateGuideSettings($guide_id, "slider_label_fontsize");
        $slider_label_fontsize = ($slider_label_fontsize == Null) ? "18" : $slider_label_fontsize;

        $slider_image_height = $this->settings->updateGuideSettings($guide_id, "slider_image_height");
        $slider_image_height = ($slider_image_height == Null) ? "100" : $slider_image_height;

        $slider_base_bg_color = $this->settings->updateGuideSettings($guide_id, "slider_base_bg_color");
        $slider_base_bg_color = ($slider_base_bg_color == Null) ? "#eeeeee" : $slider_base_bg_color;

        $slider_selected_bg_color = $this->settings->updateGuideSettings($guide_id, "slider_selected_bg_color");
        $slider_selected_bg_color = ($slider_selected_bg_color == Null) ? "#de5819" : $slider_selected_bg_color;





        $form_label_color = $this->settings->updateGuideSettings($guide_id, "form_label_color");
        $form_label_color = ($form_label_color == Null) ? "#585858" : $form_label_color;

        $form_label_fontsize = $this->settings->updateGuideSettings($guide_id, "form_label_fontsize");
        $form_label_fontsize = ($form_label_fontsize == Null) ? "15" : $form_label_fontsize;

        $form_input_bg_color = $this->settings->updateGuideSettings($guide_id, "form_input_bg_color");
        $form_input_bg_color = ($form_input_bg_color == Null) ? "#ffffff" : $form_input_bg_color;

        $form_input_border_color = $this->settings->updateGuideSettings($guide_id, "form_input_border_color");
        $form_input_border_color = ($form_input_border_color == Null) ? "#c4bebe" : $form_input_border_color;

        $form_input_text_color = $this->settings->updateGuideSettings($guide_id, "form_input_text_color");
        $form_input_text_color = ($form_input_text_color == Null) ? "#333333" : $form_input_text_color;

        $form_radio_item_text_color = $this->settings->updateGuideSettings($guide_id, "form_radio_item_text_color");
        $form_radio_item_text_color = ($form_radio_item_text_color == Null) ? "#4f4d4c" : $form_radio_item_text_color;

        $form_radio_border_color = $this->settings->updateGuideSettings($guide_id, "form_radio_border_color");
        $form_radio_border_color = ($form_radio_border_color == Null) ? "#c7c7ca" : $form_radio_border_color;

        $form_radio_selected_bg_color = $this->settings->updateGuideSettings($guide_id, "form_radio_selected_bg_color");
        $form_radio_selected_bg_color = ($form_radio_selected_bg_color == Null) ? "#de5819" : $form_radio_selected_bg_color;

        $form_radio_selected_icon_color = $this->settings->updateGuideSettings($guide_id, "form_radio_selected_icon_color");
        $form_radio_selected_icon_color = ($form_radio_selected_icon_color == Null) ? "#ffffff" : $form_radio_selected_icon_color;




        $display_result = $this->settings->updateGuideSettings($guide_id, "display_result");
        $display_result = ($display_result == Null) ? "true" : $display_result;

        $result_maximum = $this->settings->updateGuideSettings($guide_id, "result_maximum");
        $result_maximum = ($result_maximum == Null) ? "10" : $result_maximum;

        $result_headline_text = $this->settings->updateGuideSettings($guide_id, "result_headline_text");
        $result_headline_text = ($result_headline_text == Null) ? "Your personal result" : $result_headline_text;

        $result_more_text = $this->settings->updateGuideSettings($guide_id, "result_more_text");
        $result_more_text = ($result_more_text == Null) ? "More results that suit you" : $result_more_text;

        $result_empty_text = $this->settings->updateGuideSettings($guide_id, "result_empty_text");
        $result_empty_text = ($result_empty_text == Null) ? "No Result Found" : $result_empty_text;

        $no_result_primary_text = $this->settings->updateGuideSettings($guide_id, "no_result_primary_text");
        $no_result_primary_text = ($no_result_primary_text == Null) ? "Thank You for your feedback" : $no_result_primary_text;

        $no_result_secondary_text = $this->settings->updateGuideSettings($guide_id, "no_result_secondary_text");
        $no_result_secondary_text = ($no_result_secondary_text == Null) ? "We will reach back to you soon." : $no_result_secondary_text;

        $result_start_over_text = $this->settings->updateGuideSettings($guide_id, "result_start_over_text");
        $result_start_over_text = ($result_start_over_text == Null) ? "Back to Guide" : $result_start_over_text;

        $result_start_over_text_color = $this->settings->updateGuideSettings($guide_id, "result_start_over_text_color");
        $result_start_over_text_color = ($result_start_over_text_color == Null) ? "#de5819" : $result_start_over_text_color;



        if(isset($guide_background_image)){
            if(!strlen(trim($guide_background_image)) > 0){
                $guide_background_image = GUIDANT_IMG_DIR . "empty_img.png";
            }
        }else{
            $guide_background_image = GUIDANT_IMG_DIR . "empty_img.png";
        }



        $result = array(
            "status" => 'true',
            "guide_name" => $guide_name,
            "submission_tracking" => $submission_tracking,
            "guide_title" => $guide_title,
            "guide_description" => $guide_description,
            "guide_title_color" => $guide_title_color,
            "guide_title_fontsize" => $guide_title_fontsize,
            "guide_description_color" => $guide_description_color,
            "guide_description_fontsize" => $guide_description_fontsize,
            "guide_background_image" => $guide_background_image,
            "guide_background_startcolor" => $guide_background_startcolor,
            "guide_background_endcolor" => $guide_background_endcolor,
            "guide_background_direction" => $guide_background_direction,
            "filter_title_color" => $filter_title_color,
            "filter_title_fontsize" => $filter_title_fontsize,
            "filter_description_color" => $filter_description_color,
            "filter_description_fontsize" => $filter_description_fontsize,
            "filter_background_color" => $filter_background_color,
            "filter_border_color" => $filter_border_color,
            "filter_prev_btn_text" => $filter_prev_btn_text,
            "filter_prev_bg_color" => $filter_prev_bg_color,
            "filter_prev_border_color" => $filter_prev_border_color,
            "filter_prev_text_color" => $filter_prev_text_color,
            "filter_next_btn_text" => $filter_next_btn_text,
            "filter_next_bg_color" => $filter_next_bg_color,
            "filter_next_border_color" => $filter_next_border_color,
            "filter_next_text_color" => $filter_next_text_color,
            "filter_submit_btn_text" => $filter_submit_btn_text,
            "filter_submit_bg_color" => $filter_submit_bg_color,
            "filter_submit_border_color" => $filter_submit_border_color,
            "filter_submit_text_color" => $filter_submit_text_color,
            "card_label_color" => $card_label_color,
            "card_image_height" => $card_image_height,
            "card_label_fontsize" => $card_label_fontsize,
            "card_border_color" => $card_border_color,
            "card_background_color" => $card_background_color,
            "card_border_hover_color" => $card_border_hover_color,
            "card_border_active_color" => $card_border_active_color,
            "card_radio_border_color" => $card_radio_border_color,
            "card_radio_border_hover_color" => $card_radio_border_hover_color,
            "card_radio_selected_bg_color" => $card_radio_selected_bg_color,
            "card_radio_selected_icon_color" => $card_radio_selected_icon_color,
            "auto_move_to_next_filter" => $auto_move_to_next_filter,
            "slider_label_color" => $slider_label_color,
            "slider_label_fontsize" => $slider_label_fontsize,
            "slider_image_height" => $slider_image_height,
            "slider_base_bg_color" => $slider_base_bg_color,
            "slider_selected_bg_color" => $slider_selected_bg_color,
            "form_label_color" => $form_label_color,
            "form_label_fontsize" => $form_label_fontsize,
            "form_input_bg_color" => $form_input_bg_color,
            "form_input_border_color" => $form_input_border_color,
            "form_input_text_color" => $form_input_text_color,
            "form_radio_item_text_color" => $form_radio_item_text_color,
            "form_radio_border_color" => $form_radio_border_color,
            "form_radio_selected_bg_color" => $form_radio_selected_bg_color,
            "form_radio_selected_icon_color" => $form_radio_selected_icon_color,
            "display_result" => $display_result,
            "result_maximum" => $result_maximum,
            "result_headline_text" => $result_headline_text,
            "result_more_text" => $result_more_text,
            "result_empty_text" => $result_empty_text,
            "no_result_primary_text" => $no_result_primary_text,
            "no_result_secondary_text" => $no_result_secondary_text,
            "result_start_over_text" => $result_start_over_text,
            "result_start_over_text_color" => $result_start_over_text_color);


    }else{
        $result = array("status" => 'false');
    }

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);