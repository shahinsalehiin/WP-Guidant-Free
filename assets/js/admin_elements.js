
/* =========== ELEMENTS OPERATIONS ========== */
function guidant_elements_list(host, filter_id, filter_type){
    'use strict';
    guidant_current_filter_id = filter_id;
    guidant_current_filter_type = filter_type;

    guidant_hide_all();
    jQuery("#guidant_elements_list").show();
    jQuery("#guidant_elements_list_items").empty();
    jQuery("#guidant_elements_list .guidant-loader").show();


    jQuery(".guidant-breadcrumb").empty();
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_guides_list(`"+host+"`)'>All Guides</a></li>");
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_filters_list(`"+host+"`,`"+guidant_current_guide_id+"`)'>Filters</a></li>");
    jQuery(".guidant-breadcrumb").append("<li>All "+filter_type.toString().toUpperCase()+"</li>");


    if(filter_type === "card"){
        jQuery("#guidant_elements_list .guidant-body-title h3").text("Card Items");
        jQuery("#guidant_elements_list .guidant-body-title button").text("Add Card");
        jQuery("#guidant_elements_list .guidant-empty h3").text("You don't have any card created yet");
        jQuery("#guidant_elements_list .guidant-empty button").text("Create New Card");
    }else if(filter_type === "slider"){
        jQuery("#guidant_elements_list .guidant-body-title h3").text("Slider Items");
        jQuery("#guidant_elements_list .guidant-body-title button").text("Add Slider");
        jQuery("#guidant_elements_list .guidant-empty h3").text("You don't have any slider created yet");
        jQuery("#guidant_elements_list .guidant-empty button").text("Create New Slider");
    }else if(filter_type === "form"){
        jQuery("#guidant_elements_list .guidant-body-title h3").text("Form Elements");
        jQuery("#guidant_elements_list .guidant-body-title button").text("Add Item");
        jQuery("#guidant_elements_list .guidant-empty h3").text("You don't have any Form element created yet");
        jQuery("#guidant_elements_list .guidant-empty button").text("Create New Element");
    }



    var post_data = {'action': 'guidant_elements_list', 'filter_id': filter_id, 'filter_type': filter_type};
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                var elements = obj.elements;
                if(elements.length == 0){
                    jQuery("#guidant_elements_list .guidant-empty").show();
                }
                for (var i = 0; i < elements.length; i++) {

                    if(filter_type == "card"){
                        var itemHTML = "<div class=\"guidant_card_style_element\" data-element_id=\""+elements[i].element_id+"\" data-element_type=\"card\">\n" +
                            "            <div class='guidant_element_info'>\n" +
                            "               <span class='guidant_element_position'> Card "+Number(i + 1)+" </span>\n" +
                            "               <p> "+elements[i].card_label+"</p>\n" +
                            "            </div>\n" +
                            "            <div class='guidant_condition_info'>\n" +
                            "               <span> Condition </span>\n" +
                            "               <p> "+elements[i].total_conditions+" </p>\n" +
                            "            </div>\n" +
                            "            <div class=\"guidant_card_action\">\n" +
                            "                 <a href=\"#\" class=\"t-top t-md guidant-edit-icon\" data-tooltip=\"Edit Card\" onclick='guidant_card_tab_page_get(`"+host+"`, `"+elements[i].element_id+"`)'><img src=\""+host+"/assets/img/edit.svg\" alt=\"icon\"/> </a>\n" +
                            "                 <a href=\"#\" class=\"t-top t-sm guidant-trash-icon\" data-tooltip=\"Delete Card\" onclick='guidant_elements_delete(`"+host+"`, `"+elements[i].element_id+"`)'><img src=\""+host+"/assets/img/trash.svg\" alt=\"icon\"/> </a>\n" +
                            "            </div>\n" +
                            "        </div>";


                        jQuery("#guidant_elements_list_items").append(itemHTML)
                    }else if(filter_type == "slider"){
                        var itemHTML = "<div class=\"guidant_card_style_element\" data-element_id=\""+elements[i].element_id+"\" data-element_type=\"slider\">\n" +
                            "            <div class='guidant_element_info'>\n" +
                            "               <span class='guidant_element_position'> Slider "+Number(i + 1)+" </span>\n" +
                            "               <p> "+elements[i].slider_label+"</p>\n" +
                            "            </div>\n" +
                            "            <div class='guidant_condition_info'>\n" +
                            "               <span> Condition </span>\n" +
                            "               <p> "+elements[i].total_conditions+" </p>\n" +
                            "            </div>\n" +
                            "            <div class=\"guidant_card_action\">\n" +
                            "                 <a href=\"#\" class=\"t-top t-md guidant-edit-icon\" data-tooltip=\"Edit Slider\" onclick='guidant_slider_tab_page_get(`"+host+"`, `"+elements[i].element_id+"`)'><img src=\""+host+"/assets/img/edit.svg\" alt=\"icon\"/> </a>\n" +
                            "                 <a href=\"#\" class=\"t-top t-sm guidant-trash-icon\" data-tooltip=\"Delete Slider\" onclick='guidant_elements_delete(`"+host+"`, `"+elements[i].element_id+"`)'><img src=\""+host+"/assets/img/trash.svg\" alt=\"icon\"/> </a>\n" +
                            "            </div>\n" +
                            "        </div>";


                        jQuery("#guidant_elements_list_items").append(itemHTML)
                    }else if(filter_type == "form"){

                        var input_type = elements[i].input_type
                        if(input_type === "input"){
                            input_type = "Input Field"
                        }else if(input_type === "select"){
                            input_type = "Select Field"
                        }else if(input_type === "checkbox"){
                            input_type = "Checkbox"
                        }else if(input_type === "radio"){
                            input_type = "Radio Field"
                        }else if(input_type === "textarea"){
                            input_type = "Textarea"
                        }

                        var itemHTML = "<div class=\"guidant_card_style_element\" data-element_id=\""+elements[i].element_id+"\" data-element_type=\"form\">\n" +
                            "            <div class='guidant_element_info'>\n" +
                            "               <span class='guidant_element_position'> Element "+Number(i + 1)+" </span>\n" +
                            "               <p> "+elements[i].element_label+"</p>\n" +
                            "            </div>\n" +
                            "            <div class='guidant_condition_info'>\n" +
                            "               <span> Element Type </span>\n" +
                            "               <p> "+input_type+" </p>\n" +
                            "            </div>\n" +
                            "            <div class=\"guidant_card_action\">\n" +
                            "                 <a href=\"#\" class=\"t-top t-md guidant-edit-icon\" data-tooltip=\"Edit Card\" onclick='guidant_form_tab_page_get(`"+host+"`, `"+elements[i].element_id+"`)'><img src=\""+host+"/assets/img/edit.svg\" alt=\"icon\"/> </a>\n" +
                            "                 <a href=\"#\" class=\"t-top t-sm guidant-trash-icon\" data-tooltip=\"Delete Card\" onclick='guidant_elements_delete(`"+host+"`, `"+elements[i].element_id+"`)'><img src=\""+host+"/assets/img/trash.svg\" alt=\"icon\"/> </a>\n" +
                            "            </div>\n" +
                            "        </div>";


                        jQuery("#guidant_elements_list_items").append(itemHTML)
                    }

                }
            }
            jQuery("#guidant_elements_list .guidant-loader").hide();
            jQuery( "#guidant_elements_list_items" ).sortable({
                cursor: "grabbing",
                start: function(event, ui) {},
                change: function(event, ui) {},
                update: function(event, ui) {
                    guidant_elements_sort(host)
                }
            });
        }
    })
}


function guidant_elements_sort(host){
    var data_elements_position = [];
    var position = 0;
    jQuery("#guidant_elements_list_items").find(".guidant_card_style_element").each(function( index ) {
        var data_individual_element = {}
        data_individual_element ['element_id'] = jQuery( this ).data('element_id');
        data_individual_element ['position'] = position;
        data_elements_position.push(data_individual_element)
        position++;
    });

    var post_data = {
        'action': 'guidant_elements_sort',
        'data': encodeURIComponent(JSON.stringify(data_elements_position)),
    };
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                var position = 1;
                jQuery("#guidant_elements_list_items").find(".guidant_card_style_element").each(function( index ) {
                    var element_type = jQuery( this ).data('element_type');
                    if(element_type === "card"){
                        jQuery(this).find(".guidant_element_position").text("Card "+position);
                    }else if(element_type === "slider"){
                        jQuery(this).find(".guidant_element_position").text("Slider "+position);
                    }else if(element_type === "form"){
                        jQuery(this).find(".guidant_element_position").text("Element "+position);
                    }
                    position++;
                });
            }
        }
    })
}

function guidant_elements_create(host){
    'use strict';

    jQuery("#guidant_elements_list .guidant-loader").show();
    jQuery("#guidant_elements_list .guidant-empty").hide();
    jQuery("#guidant_elements_list_items").empty();

    var post_data = {
        'action': 'guidant_elements_create',
        'filter_id': guidant_current_filter_id,
        'filter_type': guidant_current_filter_type
    };
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                if(obj.filter_type === "card"){
                    guidant_card_tab_page_get(host, obj.element_id)
                }else if(obj.filter_type === "slider"){
                    guidant_slider_tab_page_get(host, obj.element_id)
                }else if(obj.filter_type === "form"){
                    guidant_form_tab_page_get(host, obj.element_id)
                }
            }
        }
    })
}




function guidant_elements_delete(host, element_id){
    'use strict';

    jQuery("#guidant_elements_list .guidant-loader").show();
    jQuery("#guidant_elements_list_items").empty();

    var post_data = {
        'action': 'guidant_elements_delete',
        'element_id': element_id
    };
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                guidant_elements_list(host, guidant_current_filter_id, guidant_current_filter_type)
            }
        }
    })
}