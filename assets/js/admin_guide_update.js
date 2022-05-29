function guidant_guide_update_tab_page_get(host, guide_id){
    'use strict';
    guidant_current_guide_id = guide_id;

    guidant_hide_all();
    jQuery("#guidant_guide_update_tab_page_container").show();
    jQuery("#guidant_card_results_list_items").empty();
    jQuery("#guidant_guide_logic_list_items").empty();

    jQuery("#guidant_guide_update_tab_page_container .guidant-loader").show();
    jQuery("#guidant_guide_update_tab_page_container .guidant-card-setting").hide();


    jQuery(".guidant-breadcrumb").empty();
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_guides_list(`"+host+"`)'>All Guides</a></li>");
    jQuery(".guidant-breadcrumb").append("<li>Guide Settings #"+guide_id+"</li>");


    const tabs = document.querySelectorAll("#guidant_guide_update_tab_page_container .guidant_tab_menu li");
    const contents =  document.querySelectorAll("#guidant_guide_update_tab_page_container .guidant_tab_item");

    tabs.forEach((tab, index) => {
        tab.addEventListener("click", () => {
            tabs.forEach((tab) =>  tab.classList.remove("active"));
            tab.classList.add("active");
            contents.forEach((c) =>  c.classList.remove("active"));
            contents[index].classList.add("active");
        });
    });
    tabs[0].click();


    var post_data = {'action': 'guidant_guides_tab_page_get', 'guide_id': guidant_current_guide_id};
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                jQuery("#guidant_guides_update_guide_name").val(obj.guide_name);
                jQuery("#guidant_guides_update_guide_submission_tracking").val(obj.submission_tracking);
                jQuery("#guidant_guides_update_guide_title").val(obj.guide_title);
                tinymce.get("guidant_guides_update_guide_description").setContent(obj.guide_description);

                jQuery("#guidant_guides_update_guide_title_color").val(obj.guide_title_color);
                jQuery("#guidant_guides_update_guide_title_fontsize").val(obj.guide_title_fontsize);
                jQuery("#guidant_guides_update_guide_description_color").val(obj.guide_description_color);
                jQuery("#guidant_guides_update_guide_description_fontsize").val(obj.guide_description_fontsize);


                if (obj.guide_background_image.toLowerCase().indexOf("empty_img.png") >= 0){
                    jQuery("#guidant_guides_update_guide_background_image").val("");
                }else{
                    jQuery("#guidant_guides_update_guide_background_image").val(obj.guide_background_image);
                }

                jQuery("#guidant_guides_update_guide_background_image_shower").attr("src", obj.guide_background_image);

                jQuery("#guidant_guides_update_guide_background_startcolor").val(obj.guide_background_startcolor);
                jQuery("#guidant_guides_update_guide_background_endcolor").val(obj.guide_background_endcolor);
                jQuery("#guidant_guides_update_guide_background_direction").val(obj.guide_background_direction);

                jQuery("#guidant_guides_update_filter_title_color").val(obj.filter_title_color);
                jQuery("#guidant_guides_update_filter_title_fontsize").val(obj.filter_title_fontsize);
                jQuery("#guidant_guides_update_filter_description_color").val(obj.filter_description_color);
                jQuery("#guidant_guides_update_filter_description_fontsize").val(obj.filter_description_fontsize);
                jQuery("#guidant_guides_update_filter_background_color").val(obj.filter_background_color);
                jQuery("#guidant_guides_update_filter_border_color").val(obj.filter_border_color);
                jQuery("#guidant_guides_update_filter_prev_btn_text").val(obj.filter_prev_btn_text);
                jQuery("#guidant_guides_update_filter_prev_bg_color").val(obj.filter_prev_bg_color);
                jQuery("#guidant_guides_update_filter_prev_border_color").val(obj.filter_prev_border_color);
                jQuery("#guidant_guides_update_filter_prev_text_color").val(obj.filter_prev_text_color);
                jQuery("#guidant_guides_update_filter_next_btn_text").val(obj.filter_next_btn_text);
                jQuery("#guidant_guides_update_filter_next_bg_color").val(obj.filter_next_bg_color);
                jQuery("#guidant_guides_update_filter_next_border_color").val(obj.filter_next_border_color);
                jQuery("#guidant_guides_update_filter_next_text_color").val(obj.filter_next_text_color);
                jQuery("#guidant_guides_update_filter_submit_btn_text").val(obj.filter_submit_btn_text);
                jQuery("#guidant_guides_update_filter_submit_bg_color").val(obj.filter_submit_bg_color);
                jQuery("#guidant_guides_update_filter_submit_border_color").val(obj.filter_submit_border_color);
                jQuery("#guidant_guides_update_filter_submit_text_color").val(obj.filter_submit_text_color);

                jQuery("#guidant_guides_update_card_label_color").val(obj.card_label_color);
                jQuery("#guidant_guides_update_card_label_fontsize").val(obj.card_label_fontsize);
                jQuery("#guidant_guides_update_card_image_height").val(obj.card_image_height);
                jQuery("#guidant_guides_update_card_border_color").val(obj.card_border_color);
                jQuery("#guidant_guides_update_card_background_color").val(obj.card_background_color);
                jQuery("#guidant_guides_update_card_border_hover_color").val(obj.card_border_hover_color);
                jQuery("#guidant_guides_update_card_border_active_color").val(obj.card_border_active_color);
                jQuery("#guidant_guides_update_card_radio_border_color").val(obj.card_radio_border_color);
                jQuery("#guidant_guides_update_card_radio_border_hover_color").val(obj.card_radio_border_hover_color);
                jQuery("#guidant_guides_update_card_radio_selected_bg_color").val(obj.card_radio_selected_bg_color);
                jQuery("#guidant_guides_update_card_radio_selected_icon_color").val(obj.card_radio_selected_icon_color);
                jQuery("#guidant_guides_update_guide_auto_move_to_next_filter").val(obj.auto_move_to_next_filter);

                jQuery("#guidant_guides_update_slider_label_color").val(obj.slider_label_color);
                jQuery("#guidant_guides_update_slider_label_fontsize").val(obj.slider_label_fontsize);
                jQuery("#guidant_guides_update_slider_image_height").val(obj.slider_image_height);
                jQuery("#guidant_guides_update_slider_base_bg_color").val(obj.slider_base_bg_color);
                jQuery("#guidant_guides_update_slider_selected_bg_color").val(obj.slider_selected_bg_color);

                jQuery("#guidant_guides_update_form_label_color").val(obj.form_label_color);
                jQuery("#guidant_guides_update_form_label_fontsize").val(obj.form_label_fontsize);
                jQuery("#guidant_guides_update_form_input_bg_color").val(obj.form_input_bg_color);
                jQuery("#guidant_guides_update_form_input_border_color").val(obj.form_input_border_color);
                jQuery("#guidant_guides_update_form_input_text_color").val(obj.form_input_text_color);
                jQuery("#guidant_guides_update_form_radio_item_text_color").val(obj.form_radio_item_text_color);
                jQuery("#guidant_guides_update_form_radio_border_color").val(obj.form_radio_border_color);
                jQuery("#guidant_guides_update_form_radio_selected_bg_color").val(obj.form_radio_selected_bg_color);
                jQuery("#guidant_guides_update_form_radio_selected_icon_color").val(obj.form_radio_selected_icon_color);

                jQuery("#guidant_guides_update_display_result").val(obj.display_result).trigger('change');
                jQuery("#guidant_guides_update_result_maximum").val(obj.result_maximum);
                jQuery("#guidant_guides_update_result_headline_text").val(obj.result_headline_text);
                jQuery("#guidant_guides_update_result_more_text").val(obj.result_more_text);
                jQuery("#guidant_guides_update_result_empty_text").val(obj.result_empty_text);
                jQuery("#guidant_guides_update_no_result_primary_text").val(obj.no_result_primary_text);
                jQuery("#guidant_guides_update_no_result_secondary_text").val(obj.no_result_secondary_text);
                jQuery("#guidant_guides_update_result_start_over_text").val(obj.result_start_over_text);
                jQuery("#guidant_guides_update_result_start_over_text_color").val(obj.result_start_over_text_color);


            }
            jQuery("#guidant_guide_update_tab_page_container .guidant-loader").hide();
            jQuery("#guidant_guide_update_tab_page_container .guidant-card-setting").show();
        }
    })

    guidant_results_list(host, guide_id)
    guidant_logic_list(host, guide_id)


}



function guidant_guides_update(host){
    'use strict';

    var hasError = false
    var guide_name = jQuery("#guidant_guides_update_guide_name").val()
    var guide_title = jQuery("#guidant_guides_update_guide_title").val()

    if(guide_name.toString().trim().length === 0){
        hasError = true
        jQuery("#guidant_guides_update_guide_name_empty").show()
    }else{
        jQuery("#guidant_guides_update_guide_name_empty").hide()
    }



    if(!hasError){

        jQuery("#guidant_guide_update_tab_page_container input").prop("disabled", true);
        jQuery("#guidant_guide_update_tab_page_container button").prop("disabled", true);
        jQuery("#guidant_guide_update_tab_page_container textarea").prop("disabled", true);
        jQuery("#guidant_guide_update_tab_page_container select").prop("disabled", true);
        jQuery("#guidant_guide_update_tab_page_container .guidant_guide_update_btn").text("Saving...");

        var post_data = {
            'action': 'guidant_guides_create',
            'guide_id': guidant_current_guide_id,
            'guide_name': guide_name,
            'guide_title': guide_title,
            'guide_description': jQuery("#guidant_guides_update_guide_description").val(),
            'submission_tracking': jQuery("#guidant_guides_update_guide_submission_tracking").val(),

            'guide_title_color': jQuery("#guidant_guides_update_guide_title_color").val(),
            'guide_title_fontsize': jQuery("#guidant_guides_update_guide_title_fontsize").val(),
            'guide_description_color': jQuery("#guidant_guides_update_guide_description_color").val(),
            'guide_description_fontsize': jQuery("#guidant_guides_update_guide_description_fontsize").val(),
            'guide_background_image': jQuery("#guidant_guides_update_guide_background_image").val(),
            'guide_background_startcolor': jQuery("#guidant_guides_update_guide_background_startcolor").val(),
            'guide_background_endcolor': jQuery("#guidant_guides_update_guide_background_endcolor").val(),
            'guide_background_direction': jQuery("#guidant_guides_update_guide_background_direction").val(),

            'filter_title_color': jQuery("#guidant_guides_update_filter_title_color").val(),
            'filter_title_fontsize': jQuery("#guidant_guides_update_filter_title_fontsize").val(),
            'filter_description_color': jQuery("#guidant_guides_update_filter_description_color").val(),
            'filter_description_fontsize': jQuery("#guidant_guides_update_filter_description_fontsize").val(),
            'filter_background_color': jQuery("#guidant_guides_update_filter_background_color").val(),
            'filter_border_color': jQuery("#guidant_guides_update_filter_border_color").val(),
            'filter_prev_btn_text': jQuery("#guidant_guides_update_filter_prev_btn_text").val(),
            'filter_prev_bg_color': jQuery("#guidant_guides_update_filter_prev_bg_color").val(),
            'filter_prev_border_color': jQuery("#guidant_guides_update_filter_prev_border_color").val(),
            'filter_prev_text_color': jQuery("#guidant_guides_update_filter_prev_text_color").val(),
            'filter_next_btn_text': jQuery("#guidant_guides_update_filter_next_btn_text").val(),
            'filter_next_bg_color': jQuery("#guidant_guides_update_filter_next_bg_color").val(),
            'filter_next_border_color': jQuery("#guidant_guides_update_filter_next_border_color").val(),
            'filter_next_text_color': jQuery("#guidant_guides_update_filter_next_text_color").val(),
            'filter_submit_btn_text': jQuery("#guidant_guides_update_filter_submit_btn_text").val(),
            'filter_submit_bg_color': jQuery("#guidant_guides_update_filter_submit_bg_color").val(),
            'filter_submit_border_color': jQuery("#guidant_guides_update_filter_submit_border_color").val(),
            'filter_submit_text_color': jQuery("#guidant_guides_update_filter_submit_text_color").val(),

            'card_label_color': jQuery("#guidant_guides_update_card_label_color").val(),
            'card_label_fontsize': jQuery("#guidant_guides_update_card_label_fontsize").val(),
            'card_image_height': jQuery("#guidant_guides_update_card_image_height").val(),
            'card_border_color': jQuery("#guidant_guides_update_card_border_color").val(),
            'card_background_color': jQuery("#guidant_guides_update_card_background_color").val(),
            'card_border_hover_color': jQuery("#guidant_guides_update_card_border_hover_color").val(),
            'card_border_active_color': jQuery("#guidant_guides_update_card_border_active_color").val(),
            'card_radio_border_color': jQuery("#guidant_guides_update_card_radio_border_color").val(),
            'card_radio_border_hover_color': jQuery("#guidant_guides_update_card_radio_border_hover_color").val(),
            'card_radio_selected_bg_color': jQuery("#guidant_guides_update_card_radio_selected_bg_color").val(),
            'card_radio_selected_icon_color': jQuery("#guidant_guides_update_card_radio_selected_icon_color").val(),
            'auto_move_to_next_filter': jQuery("#guidant_guides_update_guide_auto_move_to_next_filter").val(),

            'slider_label_color': jQuery("#guidant_guides_update_slider_label_color").val(),
            'slider_label_fontsize': jQuery("#guidant_guides_update_slider_label_fontsize").val(),
            'slider_image_height': jQuery("#guidant_guides_update_slider_image_height").val(),
            'slider_base_bg_color': jQuery("#guidant_guides_update_slider_base_bg_color").val(),
            'slider_selected_bg_color': jQuery("#guidant_guides_update_slider_selected_bg_color").val(),


            'form_label_color': jQuery("#guidant_guides_update_form_label_color").val(),
            'form_label_fontsize': jQuery("#guidant_guides_update_form_label_fontsize").val(),
            'form_input_bg_color': jQuery("#guidant_guides_update_form_input_bg_color").val(),
            'form_input_border_color': jQuery("#guidant_guides_update_form_input_border_color").val(),
            'form_input_text_color': jQuery("#guidant_guides_update_form_input_text_color").val(),
            'form_radio_item_text_color': jQuery("#guidant_guides_update_form_radio_item_text_color").val(),
            'form_radio_border_color': jQuery("#guidant_guides_update_form_radio_border_color").val(),
            'form_radio_selected_bg_color': jQuery("#guidant_guides_update_form_radio_selected_bg_color").val(),
            'form_radio_selected_icon_color': jQuery("#guidant_guides_update_form_radio_selected_icon_color").val(),

            'display_result': jQuery("#guidant_guides_update_display_result").val(),
            'result_maximum': jQuery("#guidant_guides_update_result_maximum").val(),
            'result_headline_text': jQuery("#guidant_guides_update_result_headline_text").val(),
            'result_more_text': jQuery("#guidant_guides_update_result_more_text").val(),
            'result_empty_text': jQuery("#guidant_guides_update_result_empty_text").val(),
            'no_result_primary_text': jQuery("#guidant_guides_update_no_result_primary_text").val(),
            'no_result_secondary_text': jQuery("#guidant_guides_update_no_result_secondary_text").val()
        };



        jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: post_data,
            success: function (data) {
                var obj = JSON.parse(data);

                if(obj.status == "true"){
                    jQuery("#guidant_guide_update_tab_page_container input").prop("disabled", false);
                    jQuery("#guidant_guide_update_tab_page_container button").prop("disabled", false);
                    jQuery("#guidant_guide_update_tab_page_container textarea").prop("disabled", false);
                    jQuery("#guidant_guide_update_tab_page_container select").prop("disabled", false);
                    jQuery("#guidant_guide_update_tab_page_container .guidant_guide_update_btn").text("Save Changes");
                }
            }
        })
    }


}








function guidant_logic_list(host, guide_id){
    'use strict';

    jQuery("#guidant_guide_logic_list").show();
    jQuery("#guidant_guide_logic_list_items").empty();
    jQuery("#guidant_guide_update_tab_page_container .guidant-empty-logic").hide();
    jQuery("#guidant_guide_logic_list .guidant-loader").show();


    var post_data = {'action': 'guidant_logic_list', 'guide_id': guide_id};
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);
            if(obj.status == "true"){
                var logics = obj.logics;

                for (var i = 0; i < logics.length; i++) {
                    var itemHTML = "<div class=\"guidant_card_style_results\" data-logic_id=\""+logics[i].logic_id+"\">\n" +
                        "               <p> "+logics[i].selected_element_text.toString()+" </p>\n" +
                        "               <div class=\"guidant_card_action\">\n" +
                        "                   <a href=\"#\" onclick='guidant_logic_update_show(`"+host+"`, `"+logics[i].logic_id+"`, `"+logics[i].selected_element+"`, `"+logics[i].selected_element_text+"`, `"+logics[i].card_selection_method+"`, `"+logics[i].selected_filter_to_hide+"`, `"+logics[i].selected_filter_to_hide_text+"`)' class=\"guidant-edit-icon\"><img src=\""+host+"/assets/img/edit.svg\" alt=\"icon\"/> </a>\n" +
                        "                   <a href=\"#\" onclick='guidant_logic_delete(`"+host+"`, `"+logics[i].logic_id+"`)' class=\"guidant-trash-icon\"><img src=\""+host+"/assets/img/trash.svg\" alt=\"icon\"/> </a>\n" +
                        "               </div>\n" +
                        "           </div>";


                    jQuery("#guidant_guide_logic_list_items").append(itemHTML)
                }

                if(logics.length == 0){
                    jQuery("#guidant_guide_update_tab_page_container .guidant-empty-logic").show();
                }else{
                    jQuery("#guidant_guide_logic_list_items").append("<button class=\"guidant-btn-sm\" onclick=\"guidant_logic_create_show('"+host+"')\">Add Another Logic</button>")
                }

            }
            jQuery("#guidant_guide_logic_list .guidant-loader").hide();


        }
    })
}


function guidant_logic_create_show(host){
    jQuery("#guidant_logic_create").show();
    jQuery('#guidant_logic_create_selected_element').select2({
        placeholder: "Select", closeOnSelect: true,
        ajax: {
            url: ajaxurl,
            type: "GET",
            data: 'action=guidant_logic_elements_suggestions&guide_id='+guidant_current_guide_id,
            delay: 250, dataType: 'json',
            processResults: function (response) {
                return {results: response.filterelements};
            }
        }
    });

    jQuery('#guidant_logic_create_selected_filter_to_hide').select2({
        placeholder: "Select", closeOnSelect: true,
        ajax: {
            url: ajaxurl,
            type: "GET",
            data: 'action=guidant_logic_filter_suggestions&guide_id='+guidant_current_guide_id,
            delay: 250, dataType: 'json',
            processResults: function (response) {
                return {results: response.filters};
            }
        }
    });

}
function guidant_logic_create_close(host){
    jQuery("#guidant_logic_create").hide();
}
function guidant_logic_create(host){
    'use strict';

    var hasError = false
    var selected_element = jQuery("#guidant_logic_create_selected_element").val()
    var selected_filter_to_hide = jQuery("#guidant_logic_create_selected_filter_to_hide").val()

    if(selected_element.toString().trim().length === 0){
        hasError = true
        jQuery("#guidant_logic_create_selected_element_empty").show()
    }else{
        jQuery("#guidant_logic_create_selected_element_empty").hide()
    }

    if(selected_filter_to_hide.toString().trim().length === 0){
        hasError = true
        jQuery("#guidant_logic_create_selected_filter_to_hide_empty").show()
    }else{
        jQuery("#guidant_logic_create_selected_filter_to_hide_empty").hide()
    }

    if(!hasError){
        jQuery("#guidant_logic_create .guidant_logic_create_btn").text("Saving...");
        var post_data = {
            'action': 'guidant_logic_create',
            'guide_id': guidant_current_guide_id,
            'logic_id': '0',
            'selected_element': selected_element,
            'selected_element_text': jQuery("#guidant_logic_create_selected_element").select2('data')[0].text,
            'card_selection_method': jQuery("#guidant_logic_create_card_selection_method").val(),
            'selected_filter_to_hide': selected_filter_to_hide,
            'selected_filter_to_hide_text': jQuery("#guidant_logic_create_selected_filter_to_hide").select2('data')[0].text,
        };
        jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: post_data,
            success: function (data) {
                var obj = JSON.parse(data);

                if(obj.status == "true"){
                    guidant_logic_list(host, guidant_current_guide_id)
                }
                jQuery("#guidant_logic_create .guidant_logic_create_btn").text("Create");
                guidant_logic_create_close(host);
            }
        })
    }
}








function guidant_logic_update_show(host, logic_id, selected_element, selected_element_text, card_selection_method, selected_filter_to_hide, selected_filter_to_hide_text){
    jQuery("#guidant_logic_update").show();
    guidant_current_logic_id = logic_id;

    jQuery("#guidant_logic_update_selected_element").empty();
    jQuery("#guidant_logic_update_selected_filter_to_hide").empty();

    jQuery('#guidant_logic_update_selected_element').select2({
        placeholder: "Select", closeOnSelect: true,
        ajax: {
            url: ajaxurl,
            type: "GET",
            data: 'action=guidant_logic_elements_suggestions&guide_id='+guidant_current_guide_id,
            delay: 250, dataType: 'json',
            processResults: function (response) {
                return {results: response.filterelements};
            }
        }
    });

    jQuery('#guidant_logic_update_selected_filter_to_hide').select2({
        placeholder: "Select", closeOnSelect: true,
        ajax: {
            url: ajaxurl,
            type: "GET",
            data: 'action=guidant_logic_filter_suggestions&guide_id='+guidant_current_guide_id,
            delay: 250, dataType: 'json',
            processResults: function (response) {
                return {results: response.filters};
            }
        }
    });


    jQuery("#guidant_logic_update_selected_element").append("<option value=\""+selected_element+"\">"+selected_element_text+"</option>").val(selected_element)
    jQuery("#guidant_logic_update_selected_filter_to_hide").append("<option value=\""+selected_filter_to_hide+"\">"+selected_filter_to_hide_text+"</option>").val(selected_filter_to_hide)
    jQuery("#guidant_logic_update_card_selection_method").val(card_selection_method)

}
function guidant_logic_update_close(host){
    jQuery("#guidant_logic_update").hide();
}

function guidant_logic_update(host){
    'use strict';

    var hasError = false
    var selected_element = jQuery("#guidant_logic_update_selected_element").val()
    var selected_filter_to_hide = jQuery("#guidant_logic_update_selected_filter_to_hide").val()

    if(selected_element.toString().trim().length === 0){
        hasError = true
        jQuery("#guidant_logic_update_selected_element_empty").show()
    }else{
        jQuery("#guidant_logic_update_selected_element_empty").hide()
    }

    if(selected_filter_to_hide.toString().trim().length === 0){
        hasError = true
        jQuery("#guidant_logic_update_selected_filter_to_hide_empty").show()
    }else{
        jQuery("#guidant_logic_update_selected_filter_to_hide_empty").hide()
    }

    if(!hasError){
        jQuery("#guidant_logic_update .guidant_logic_update_btn").text("Saving...");
        var post_data = {
            'action': 'guidant_logic_create',
            'guide_id': guidant_current_guide_id,
            'logic_id': guidant_current_logic_id,
            'selected_element': selected_element,
            'selected_element_text': jQuery("#guidant_logic_update_selected_element").select2('data')[0].text,
            'card_selection_method': jQuery("#guidant_logic_update_card_selection_method").val(),
            'selected_filter_to_hide': selected_filter_to_hide,
            'selected_filter_to_hide_text': jQuery("#guidant_logic_update_selected_filter_to_hide").select2('data')[0].text,
        };
        jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: post_data,
            success: function (data) {
                var obj = JSON.parse(data);

                if(obj.status == "true"){
                    guidant_logic_list(host, guidant_current_guide_id)
                }
                jQuery("#guidant_logic_update .guidant_logic_update_btn").text("Save");
                guidant_logic_update_close(host);
            }
        })
    }
}


function guidant_logic_delete(host, logic_id){
    'use strict';

    jQuery("#guidant_guide_logic_list .guidant-loader").show();
    jQuery("#guidant_guide_logic_list_items").empty();

    var post_data = {
        'action': 'guidant_logic_delete',
        'logic_id': logic_id
    };
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                guidant_logic_list(host, guidant_current_guide_id)
            }
        }
    })
}






function guidant_results_list(host, guide_id){
    'use strict';

    jQuery("#guidant_card_results_list").show();
    jQuery("#guidant_card_results_list_items").empty();
    jQuery("#guidant_guide_update_tab_page_container .guidant-empty").hide();
    jQuery("#guidant_card_results_list .guidant-loader").show();


    var post_data = {'action': 'guidant_results_list', 'guide_id': guide_id};
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);
            if(obj.status == "true"){
                var results = obj.results;

                for (var i = 0; i < results.length; i++) {
                    var itemHTML = "<div class=\"guidant_card_style_results\" data-result_id=\""+results[i].result_id+"\">\n" +
                        "               <p> "+results[i].attribute_type_text.toString()+" </p>\n" +
                        "               <div class=\"guidant_card_action\">\n" +
                        "                   <a href=\"#\" onclick='guidant_results_update_show(`"+host+"`, `"+results[i].result_id+"`, `"+results[i].attribute_type+"`, `"+results[i].attribute_type_text+"`, `"+results[i].prefix+"`, `"+results[i].button_text+"`, `"+results[i].image_height+"`)' class=\"guidant-edit-icon\"><img src=\""+host+"/assets/img/edit.svg\" alt=\"icon\"/> </a>\n" +
                        "                   <a href=\"#\" onclick='guidant_result_delete(`"+host+"`, `"+results[i].result_id+"`)' class=\"guidant-trash-icon\"><img src=\""+host+"/assets/img/trash.svg\" alt=\"icon\"/> </a>\n" +
                        "               </div>\n" +
                        "           </div>";


                    jQuery("#guidant_card_results_list_items").append(itemHTML)
                }

                if(results.length == 0){
                    jQuery("#guidant_guide_update_tab_page_container .guidant-empty").show();
                }else{
                    jQuery("#guidant_card_results_list_items").append("<button class=\"guidant-btn-sm\" onclick=\"guidant_results_create_show('"+host+"')\">Add Result Attribute</button>")
                }

            }
            jQuery("#guidant_card_results_list .guidant-loader").hide();
            jQuery( "#guidant_card_results_list_items" ).sortable({
                cursor: "grabbing",
                start: function(event, ui) {},
                change: function(event, ui) {},
                update: function(event, ui) {
                    guidant_results_sort(host)
                }
            });

        }
    })
}

function guidant_results_sort(host){
    var data_results_position = [];
    var position = 0;
    jQuery("#guidant_card_results_list_items").find(".guidant_card_style_results").each(function( index ) {
        var data_individual_result = {}
        data_individual_result ['result_id'] = jQuery( this ).data('result_id');
        data_individual_result ['position'] = position;
        data_results_position.push(data_individual_result)
        position++;
    });

    var post_data = {
        'action': 'guidant_results_sort',
        'data': encodeURIComponent(JSON.stringify(data_results_position)),
    };
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {

        }
    })
}



function guidant_results_create_show(host){
    jQuery("#guidant_results_create").show();
    jQuery('#guidant_result_create_attribute').select2({
        placeholder: "Select", closeOnSelect: true,
        ajax: {
            url: ajaxurl,
            type: "GET",
            data: function (params) {
                var query = {
                    search: params.term,
                    action: 'guidant_result_attributes_suggestion'
                }
                return query;
            },
            delay: 250, dataType: 'json',
            processResults: function (response) {
                return {results: response.attributes};
            }
        }
    });

}
function guidant_results_create_close(host){
    jQuery("#guidant_results_create").hide();
}

function guidant_result_create(host){
    'use strict';

    var hasError = false
    var attribute_type = jQuery("#guidant_result_create_attribute").val()

    if(attribute_type.toString().trim().length === 0){
        hasError = true
        jQuery("#guidant_result_create_attribute_empty").show()
    }else{
        jQuery("#guidant_result_create_attribute_empty").hide()
    }


    if(!hasError){
        jQuery("#guidant_results_create .guidant_result_create_btn").text("Saving...");
        var post_data = {
            'action': 'guidant_results_create',
            'guide_id': guidant_current_guide_id,
            'result_id': '0',
            'attribute_type': attribute_type,
            'attribute_type_text': jQuery("#guidant_result_create_attribute").select2('data')[0].text,
            'prefix': jQuery("#guidant_result_create_prefix").val(),
            'button_text': jQuery("#guidant_result_create_button_text").val(),
            'image_height': jQuery("#guidant_result_create_image_height").val(),
        };
        jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: post_data,
            success: function (data) {
                var obj = JSON.parse(data);

                if(obj.status == "true"){
                    guidant_results_list(host, guidant_current_guide_id)
                }
                jQuery("#guidant_results_create .guidant_result_create_btn").text("Create");
                guidant_results_create_close(host);
            }
        })
    }



}










function guidant_results_update_show(host, result_id, attribute_type, attribute_type_text, prefix, button_text, image_height){
    jQuery("#guidant_results_update").show();
    guidant_current_result_id = result_id;

    jQuery("#guidant_result_update_attribute").empty();

    jQuery('#guidant_result_update_attribute').select2({
        placeholder: "Select", closeOnSelect: true,
        ajax: {
            url: ajaxurl,
            type: "GET",
            data: function (params) {
                var query = {
                    search: params.term,
                    action: 'guidant_result_attributes_suggestion'
                }
                return query;
            },
            delay: 250, dataType: 'json',
            processResults: function (response) {
                return {results: response.attributes};
            }
        }
    });


    jQuery("#guidant_result_update_attribute").append("<option value=\""+attribute_type+"\">"+attribute_type_text+"</option>").val(attribute_type).trigger('change')

    jQuery("#guidant_result_update_prefix").val(prefix)
    jQuery("#guidant_result_update_button_text").val(button_text)
    jQuery("#guidant_result_update_image_height").val(image_height)

}
function guidant_result_update_close(host){
    jQuery("#guidant_results_update").hide();
}

function guidant_results_update(host){
    'use strict';

    jQuery("#guidant_results_update input").prop("disabled", true);
    jQuery("#guidant_results_update button").prop("disabled", true);
    jQuery("#guidant_results_update textarea").prop("disabled", true);
    jQuery("#guidant_results_update select").prop("disabled", true);
    jQuery("#guidant_results_update .guidant_result_update_btn").text("Saving...");


    var post_data = {
        'action': 'guidant_results_create',
        'guide_id': guidant_current_guide_id,
        'result_id': guidant_current_result_id,
        'attribute_type': jQuery("#guidant_result_update_attribute").val(),
        'attribute_type_text': jQuery("#guidant_result_update_attribute").select2('data')[0].text,
        'prefix': jQuery("#guidant_result_update_prefix").val(),
        'button_text': jQuery("#guidant_result_update_button_text").val(),
        'image_height': jQuery("#guidant_result_update_image_height").val(),
    };

    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                jQuery("#guidant_results_update input").prop("disabled", false);
                jQuery("#guidant_results_update button").prop("disabled", false);
                jQuery("#guidant_results_update textarea").prop("disabled", false);
                jQuery("#guidant_results_update select").prop("disabled", false);
                jQuery("#guidant_results_update .guidant_result_update_btn").text("Update");

                guidant_result_update_close(host);
                guidant_results_list(host, guidant_current_guide_id)
            }
        }
    })
}



function guidant_result_delete(host, result_id){
    'use strict';

    jQuery("#guidant_card_results_list .guidant-loader").show();
    jQuery("#guidant_card_results_list_items").empty();

    var post_data = {
        'action': 'guidant_results_delete',
        'result_id': result_id
    };
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                guidant_results_list(host, guidant_current_guide_id)
            }
        }
    })
}



function guidant_export_guide(host) {
    'use strict';

    alert('fd')
}