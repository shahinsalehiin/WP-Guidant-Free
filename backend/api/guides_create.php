<?php

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){

    /* Receive post data */
    if(isset($_REQUEST['guide_id']) && isset($_REQUEST['guide_name'])) {

        $guide_id_initial = sanitize_text_field($_REQUEST['guide_id']);
        $guide_name = sanitize_text_field($_REQUEST['guide_name']);
        $guide_id = ($guide_id_initial == "0") ? $this->settings->createNewGuide($guide_name) : $guide_id_initial;

        if(isset($_REQUEST['guide_name'])){
            $guide_name = sanitize_text_field($_REQUEST['guide_name']);
            $this->settings->updateGuideSettings($guide_id, "guide_name", $guide_name);
        }
        if(isset($_REQUEST['guide_title'])){
            $guide_title = sanitize_text_field($_REQUEST['guide_title']);
            $guide_title = empty($guide_title) ? " " : $guide_title;
            $this->settings->updateGuideSettings($guide_id, "guide_title", $guide_title);
        }
        if(isset($_REQUEST['guide_description'])){
            $guide_description = wp_filter_post_kses($_REQUEST['guide_description']);
            $guide_description = empty($guide_description) ? " " : $guide_description;
            $this->settings->updateGuideSettings($guide_id, "guide_description", $guide_description);

        }
        if(isset($_REQUEST['submission_tracking'])){
            $submission_tracking = wp_filter_post_kses($_REQUEST['submission_tracking']);
            $this->settings->updateGuideSettings($guide_id, "submission_tracking", $submission_tracking);
        }


        if(isset($_REQUEST['guide_title_color'])){
            $guide_title_color = sanitize_text_field($_REQUEST['guide_title_color']);
            $this->settings->updateGuideSettings($guide_id, "guide_title_color", $guide_title_color);
        }
        if(isset($_REQUEST['guide_title_fontsize'])){
            $guide_title_fontsize = sanitize_text_field($_REQUEST['guide_title_fontsize']);
            $this->settings->updateGuideSettings($guide_id, "guide_title_fontsize", $guide_title_fontsize);
        }
        if(isset($_REQUEST['guide_description_color'])){
            $guide_description_color = sanitize_text_field($_REQUEST['guide_description_color']);
            $this->settings->updateGuideSettings($guide_id, "guide_description_color", $guide_description_color);
        }
        if(isset($_REQUEST['guide_description_fontsize'])){
            $guide_description_fontsize = sanitize_text_field($_REQUEST['guide_description_fontsize']);
            $this->settings->updateGuideSettings($guide_id, "guide_description_fontsize", $guide_description_fontsize);
        }
        if(isset($_REQUEST['guide_background_image'])){
            $guide_background_image = sanitize_text_field($_REQUEST['guide_background_image']);
            $this->settings->updateGuideSettings($guide_id, "guide_background_image", $guide_background_image);
        }
        if(isset($_REQUEST['guide_background_startcolor'])){
            $guide_background_startcolor = sanitize_text_field($_REQUEST['guide_background_startcolor']);
            $this->settings->updateGuideSettings($guide_id, "guide_background_startcolor", $guide_background_startcolor);
        }
        if(isset($_REQUEST['guide_background_endcolor'])){
            $guide_background_endcolor = sanitize_text_field($_REQUEST['guide_background_endcolor']);
            $this->settings->updateGuideSettings($guide_id, "guide_background_endcolor", $guide_background_endcolor);
        }
        if(isset($_REQUEST['guide_background_direction'])){
            $guide_background_direction = sanitize_text_field($_REQUEST['guide_background_direction']);
            $this->settings->updateGuideSettings($guide_id, "guide_background_direction", $guide_background_direction);
        }


        if(isset($_REQUEST['filter_title_color'])){
            $filter_title_color = sanitize_text_field($_REQUEST['filter_title_color']);
            $this->settings->updateGuideSettings($guide_id, "filter_title_color", $filter_title_color);
        }
        if(isset($_REQUEST['filter_title_fontsize'])){
            $filter_title_fontsize = sanitize_text_field($_REQUEST['filter_title_fontsize']);
            $this->settings->updateGuideSettings($guide_id, "filter_title_fontsize", $filter_title_fontsize);
        }
        if(isset($_REQUEST['filter_description_color'])){
            $filter_description_color = sanitize_text_field($_REQUEST['filter_description_color']);
            $this->settings->updateGuideSettings($guide_id, "filter_description_color", $filter_description_color);
        }
        if(isset($_REQUEST['filter_description_fontsize'])){
            $filter_description_fontsize = sanitize_text_field($_REQUEST['filter_description_fontsize']);
            $this->settings->updateGuideSettings($guide_id, "filter_description_fontsize", $filter_description_fontsize);
        }
        if(isset($_REQUEST['filter_background_color'])){
            $filter_background_color = sanitize_text_field($_REQUEST['filter_background_color']);
            $this->settings->updateGuideSettings($guide_id, "filter_background_color", $filter_background_color);
        }
        if(isset($_REQUEST['filter_border_color'])){
            $filter_border_color = sanitize_text_field($_REQUEST['filter_border_color']);
            $this->settings->updateGuideSettings($guide_id, "filter_border_color", $filter_border_color);
        }
        if(isset($_REQUEST['filter_prev_btn_text'])){
            $filter_prev_btn_text = sanitize_text_field($_REQUEST['filter_prev_btn_text']);
            $this->settings->updateGuideSettings($guide_id, "filter_prev_btn_text", $filter_prev_btn_text);
        }
        if(isset($_REQUEST['filter_prev_bg_color'])){
            $filter_prev_bg_color = sanitize_text_field($_REQUEST['filter_prev_bg_color']);
            $this->settings->updateGuideSettings($guide_id, "filter_prev_bg_color", $filter_prev_bg_color);
        }
        if(isset($_REQUEST['filter_prev_border_color'])){
            $filter_prev_border_color = sanitize_text_field($_REQUEST['filter_prev_border_color']);
            $this->settings->updateGuideSettings($guide_id, "filter_prev_border_color", $filter_prev_border_color);
        }
        if(isset($_REQUEST['filter_prev_text_color'])){
            $filter_prev_text_color = sanitize_text_field($_REQUEST['filter_prev_text_color']);
            $this->settings->updateGuideSettings($guide_id, "filter_prev_text_color", $filter_prev_text_color);
        }
        if(isset($_REQUEST['filter_next_btn_text'])){
            $filter_next_btn_text = sanitize_text_field($_REQUEST['filter_next_btn_text']);
            $this->settings->updateGuideSettings($guide_id, "filter_next_btn_text", $filter_next_btn_text);
        }
        if(isset($_REQUEST['filter_next_bg_color'])){
            $filter_next_bg_color = sanitize_text_field($_REQUEST['filter_next_bg_color']);
            $this->settings->updateGuideSettings($guide_id, "filter_next_bg_color", $filter_next_bg_color);
        }
        if(isset($_REQUEST['filter_next_border_color'])){
            $filter_next_border_color = sanitize_text_field($_REQUEST['filter_next_border_color']);
            $this->settings->updateGuideSettings($guide_id, "filter_next_border_color", $filter_next_border_color);
        }
        if(isset($_REQUEST['filter_next_text_color'])){
            $filter_next_text_color = sanitize_text_field($_REQUEST['filter_next_text_color']);
            $this->settings->updateGuideSettings($guide_id, "filter_next_text_color", $filter_next_text_color);
        }
        if(isset($_REQUEST['filter_submit_btn_text'])){
            $filter_submit_btn_text = sanitize_text_field($_REQUEST['filter_submit_btn_text']);
            $this->settings->updateGuideSettings($guide_id, "filter_submit_btn_text", $filter_submit_btn_text);
        }
        if(isset($_REQUEST['filter_submit_bg_color'])){
            $filter_submit_bg_color = sanitize_text_field($_REQUEST['filter_submit_bg_color']);
            $this->settings->updateGuideSettings($guide_id, "filter_submit_bg_color", $filter_submit_bg_color);
        }
        if(isset($_REQUEST['filter_submit_border_color'])){
            $filter_submit_border_color = sanitize_text_field($_REQUEST['filter_submit_border_color']);
            $this->settings->updateGuideSettings($guide_id, "filter_submit_border_color", $filter_submit_border_color);
        }
        if(isset($_REQUEST['filter_submit_text_color'])){
            $filter_submit_text_color = sanitize_text_field($_REQUEST['filter_submit_text_color']);
            $this->settings->updateGuideSettings($guide_id, "filter_submit_text_color", $filter_submit_text_color);
        }





        if(isset($_REQUEST['card_label_color'])){
            $card_label_color = sanitize_text_field($_REQUEST['card_label_color']);
            $this->settings->updateGuideSettings($guide_id, "card_label_color", $card_label_color);
        }
        if(isset($_REQUEST['card_label_fontsize'])){
            $card_label_fontsize = sanitize_text_field($_REQUEST['card_label_fontsize']);
            $this->settings->updateGuideSettings($guide_id, "card_label_fontsize", $card_label_fontsize);
        }
        if(isset($_REQUEST['card_image_height'])){
            $card_image_height = sanitize_text_field($_REQUEST['card_image_height']);
            $this->settings->updateGuideSettings($guide_id, "card_image_height", $card_image_height);
        }
        if(isset($_REQUEST['card_border_color'])){
            $card_border_color = sanitize_text_field($_REQUEST['card_border_color']);
            $this->settings->updateGuideSettings($guide_id, "card_border_color", $card_border_color);
        }
        if(isset($_REQUEST['card_background_color'])){
            $card_background_color = sanitize_text_field($_REQUEST['card_background_color']);
            $this->settings->updateGuideSettings($guide_id, "card_background_color", $card_background_color);
        }
        if(isset($_REQUEST['card_border_hover_color'])){
            $card_border_hover_color = sanitize_text_field($_REQUEST['card_border_hover_color']);
            $this->settings->updateGuideSettings($guide_id, "card_border_hover_color", $card_border_hover_color);
        }
        if(isset($_REQUEST['card_border_active_color'])){
            $card_border_active_color = sanitize_text_field($_REQUEST['card_border_active_color']);
            $this->settings->updateGuideSettings($guide_id, "card_border_active_color", $card_border_active_color);
        }
        if(isset($_REQUEST['card_radio_border_color'])){
            $card_radio_border_color = sanitize_text_field($_REQUEST['card_radio_border_color']);
            $this->settings->updateGuideSettings($guide_id, "card_radio_border_color", $card_radio_border_color);
        }
        if(isset($_REQUEST['card_radio_border_hover_color'])){
            $card_radio_border_hover_color = sanitize_text_field($_REQUEST['card_radio_border_hover_color']);
            $this->settings->updateGuideSettings($guide_id, "card_radio_border_hover_color", $card_radio_border_hover_color);
        }
        if(isset($_REQUEST['card_radio_selected_bg_color'])){
            $card_radio_selected_bg_color = sanitize_text_field($_REQUEST['card_radio_selected_bg_color']);
            $this->settings->updateGuideSettings($guide_id, "card_radio_selected_bg_color", $card_radio_selected_bg_color);
        }
        if(isset($_REQUEST['card_radio_selected_icon_color'])){
            $card_radio_selected_icon_color = sanitize_text_field($_REQUEST['card_radio_selected_icon_color']);
            $this->settings->updateGuideSettings($guide_id, "card_radio_selected_icon_color", $card_radio_selected_icon_color);
        }
        if(isset($_REQUEST['auto_move_to_next_filter'])){
            $auto_move_to_next_filter = sanitize_text_field($_REQUEST['auto_move_to_next_filter']);
            $this->settings->updateGuideSettings($guide_id, "auto_move_to_next_filter", $auto_move_to_next_filter);
        }





        if(isset($_REQUEST['slider_label_color'])){
            $slider_label_color = sanitize_text_field($_REQUEST['slider_label_color']);
            $this->settings->updateGuideSettings($guide_id, "slider_label_color", $slider_label_color);
        }
        if(isset($_REQUEST['slider_label_fontsize'])){
            $slider_label_fontsize = sanitize_text_field($_REQUEST['slider_label_fontsize']);
            $this->settings->updateGuideSettings($guide_id, "slider_label_fontsize", $slider_label_fontsize);
        }
        if(isset($_REQUEST['slider_image_height'])){
            $slider_image_height = sanitize_text_field($_REQUEST['slider_image_height']);
            $this->settings->updateGuideSettings($guide_id, "slider_image_height", $slider_image_height);
        }
        if(isset($_REQUEST['slider_base_bg_color'])){
            $slider_base_bg_color = sanitize_text_field($_REQUEST['slider_base_bg_color']);
            $this->settings->updateGuideSettings($guide_id, "slider_base_bg_color", $slider_base_bg_color);
        }
        if(isset($_REQUEST['slider_selected_bg_color'])){
            $slider_selected_bg_color = sanitize_text_field($_REQUEST['slider_selected_bg_color']);
            $this->settings->updateGuideSettings($guide_id, "slider_selected_bg_color", $slider_selected_bg_color);
        }








        if(isset($_REQUEST['form_label_color'])){
            $form_label_color = sanitize_text_field($_REQUEST['form_label_color']);
            $this->settings->updateGuideSettings($guide_id, "form_label_color", $form_label_color);
        }
        if(isset($_REQUEST['form_label_fontsize'])){
            $form_label_fontsize = sanitize_text_field($_REQUEST['form_label_fontsize']);
            $this->settings->updateGuideSettings($guide_id, "form_label_fontsize", $form_label_fontsize);
        }
        if(isset($_REQUEST['form_input_bg_color'])){
            $form_input_bg_color = sanitize_text_field($_REQUEST['form_input_bg_color']);
            $this->settings->updateGuideSettings($guide_id, "form_input_bg_color", $form_input_bg_color);
        }
        if(isset($_REQUEST['form_input_border_color'])){
            $form_input_border_color = sanitize_text_field($_REQUEST['form_input_border_color']);
            $this->settings->updateGuideSettings($guide_id, "form_input_border_color", $form_input_border_color);
        }
        if(isset($_REQUEST['form_input_text_color'])){
            $form_input_text_color = sanitize_text_field($_REQUEST['form_input_text_color']);
            $this->settings->updateGuideSettings($guide_id, "form_input_text_color", $form_input_text_color);
        }
        if(isset($_REQUEST['form_radio_item_text_color'])){
            $form_radio_item_text_color = sanitize_text_field($_REQUEST['form_radio_item_text_color']);
            $this->settings->updateGuideSettings($guide_id, "form_radio_item_text_color", $form_radio_item_text_color);
        }
        if(isset($_REQUEST['form_radio_border_color'])){
            $form_radio_border_color = sanitize_text_field($_REQUEST['form_radio_border_color']);
            $this->settings->updateGuideSettings($guide_id, "form_radio_border_color", $form_radio_border_color);
        }
        if(isset($_REQUEST['form_radio_selected_bg_color'])){
            $form_radio_selected_bg_color = sanitize_text_field($_REQUEST['form_radio_selected_bg_color']);
            $this->settings->updateGuideSettings($guide_id, "form_radio_selected_bg_color", $form_radio_selected_bg_color);
        }
        if(isset($_REQUEST['form_radio_selected_icon_color'])){
            $form_radio_selected_icon_color = sanitize_text_field($_REQUEST['form_radio_selected_icon_color']);
            $this->settings->updateGuideSettings($guide_id, "form_radio_selected_icon_color", $form_radio_selected_icon_color);
        }






        if(isset($_REQUEST['display_result'])){
            $display_result = sanitize_text_field($_REQUEST['display_result']);
            $this->settings->updateGuideSettings($guide_id, "display_result", $display_result);
        }
        if(isset($_REQUEST['result_maximum'])){
            $result_maximum = sanitize_text_field($_REQUEST['result_maximum']);
            $this->settings->updateGuideSettings($guide_id, "result_maximum", $result_maximum);
        }
        if(isset($_REQUEST['result_headline_text'])){
            $result_headline_text = sanitize_text_field($_REQUEST['result_headline_text']);
            $this->settings->updateGuideSettings($guide_id, "result_headline_text", $result_headline_text);
        }
        if(isset($_REQUEST['result_more_text'])){
            $result_more_text = sanitize_text_field($_REQUEST['result_more_text']);
            $result_more_text = empty($result_more_text) ? " " : $result_more_text;
            $this->settings->updateGuideSettings($guide_id, "result_more_text", $result_more_text);
        }
        if(isset($_REQUEST['result_empty_text'])){
            $result_empty_text = sanitize_text_field($_REQUEST['result_empty_text']);
            $result_empty_text = empty($result_empty_text) ? " " : $result_empty_text;
            $this->settings->updateGuideSettings($guide_id, "result_empty_text", $result_empty_text);
        }
        if(isset($_REQUEST['no_result_primary_text'])){
            $no_result_primary_text = sanitize_text_field($_REQUEST['no_result_primary_text']);
            $no_result_primary_text = empty($no_result_primary_text) ? " " : $no_result_primary_text;
            $this->settings->updateGuideSettings($guide_id, "no_result_primary_text", $no_result_primary_text);
        }
        if(isset($_REQUEST['no_result_secondary_text'])){
            $no_result_secondary_text = sanitize_text_field($_REQUEST['no_result_secondary_text']);
            $no_result_secondary_text = empty($no_result_secondary_text) ? " " : $no_result_secondary_text;
            $this->settings->updateGuideSettings($guide_id, "no_result_secondary_text", $no_result_secondary_text);
        }








        /* ========= Auto Create Guide Result Attributes =========== */
        if($guide_id_initial == "0"){

            // Post Thumbnail
            $result_id = $this->settings->createNewResult($guide_id);
            $this->settings->updateResultSettings($result_id, "attribute_type", "post_thumbnail");
            $this->settings->updateResultSettings($result_id, "attribute_type_text", "[Post] Post Thumbnail");
            $this->settings->updateResultSettings($result_id, "image_height", "200");
            $this->settings->updateResultSettings($result_id, "position", "1");

            // Post Title
            $result_id = $this->settings->createNewResult($guide_id);
            $this->settings->updateResultSettings($result_id, "attribute_type", "post_title");
            $this->settings->updateResultSettings($result_id, "attribute_type_text", "[Post] Post Title");
            $this->settings->updateResultSettings($result_id, "prefix", "");
            $this->settings->updateResultSettings($result_id, "position", "2");


            // Woocommerce Pricing
            if (class_exists('WooCommerce')) {
                $result_id = $this->settings->createNewResult($guide_id);
                $this->settings->updateResultSettings($result_id, "attribute_type", "woocommerce_price");
                $this->settings->updateResultSettings($result_id, "attribute_type_text", "[WooCommerce] Price");
                $this->settings->updateResultSettings($result_id, "prefix", "Price: ");
                $this->settings->updateResultSettings($result_id, "position", "3");
            }


            // Post Excerpt
            $result_id = $this->settings->createNewResult($guide_id);
            $this->settings->updateResultSettings($result_id, "attribute_type", "post_excerpt");
            $this->settings->updateResultSettings($result_id, "attribute_type_text", "[Post] Post Excerpt");
            $this->settings->updateResultSettings($result_id, "prefix", "");
            $this->settings->updateResultSettings($result_id, "position", "4");

            // Post Permalink Button
            $result_id = $this->settings->createNewResult($guide_id);
            $this->settings->updateResultSettings($result_id, "attribute_type", "post_permalink");
            $this->settings->updateResultSettings($result_id, "attribute_type_text", "[Post] Post Permalink Button");
            $this->settings->updateResultSettings($result_id, "button_text", "View");
            $this->settings->updateResultSettings($result_id, "position", "5");
        }
        /* ========= Auto Create Guide Result Attributes =========== */





        $result = array("status" => 'true',
            "guide_id" => $guide_id,
            "msg" => esc_attr__('Guide Created', 'guidant')
        );
    }else{
        $result = array("status" => 'false');
    }


}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);