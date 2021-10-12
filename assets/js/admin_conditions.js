

function guidant_conditions_list(host, element_id){
    'use strict';



    jQuery("#guidant_"+guidant_current_filter_type+"_conditions_list").show();
    jQuery("#guidant_"+guidant_current_filter_type+"_conditions_list_items").empty();
    jQuery("#guidant_"+guidant_current_filter_type+"_tab_page_container .guidant-empty").hide();
    jQuery("#guidant_"+guidant_current_filter_type+"_conditions_list .guidant-loader").show();


    var post_data = {'action': 'guidant_conditions_list', 'element_id': element_id};
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);
            if(obj.status == "true"){
                var conditions = obj.conditions;

                for (var i = 0; i < conditions.length; i++) {
                    var itemHTML = "<div class=\"guidant_card_style_2\">\n" +
                        "               <p> "+conditions[i].attribute_type_text.toString()+" </p>\n" +
                        "               <div class=\"guidant_card_action\">\n" +
                        "                   <a href=\"#\" onclick='guidant_conditions_update_show(`"+host+"`, `"+conditions[i].condition_id+"`, `"+conditions[i].attribute_type+"`, `"+conditions[i].attribute_type_text+"`, `"+conditions[i].matching_type+"`, `"+conditions[i].value_selection+"`, `"+conditions[i].value+"`, `"+conditions[i].value_text+"`)' class=\"guidant-edit-icon\"><img src=\""+host+"/assets/img/edit.svg\" alt=\"icon\"/> </a>\n" +
                        "                   <a href=\"#\" onclick='guidant_condition_delete(`"+host+"`, `"+conditions[i].condition_id+"`)' class=\"guidant-trash-icon\"><img src=\""+host+"/assets/img/trash.svg\" alt=\"icon\"/> </a>\n" +
                        "               </div>\n" +
                        "           </div>";


                    jQuery("#guidant_"+guidant_current_filter_type+"_conditions_list_items").append(itemHTML)
                }

                if(conditions.length == 0){
                    jQuery("#guidant_"+guidant_current_filter_type+"_tab_page_container .guidant-empty").show();
                }else{
                    jQuery("#guidant_"+guidant_current_filter_type+"_conditions_list_items").append("<button class=\"guidant-btn-sm\" onclick=\"guidant_conditions_create_show('"+host+"')\">Add Condition</button>")
                }

            }
            jQuery("#guidant_"+guidant_current_filter_type+"_conditions_list .guidant-loader").hide();

        }
    })
}



function guidant_conditions_create_show(host){
    jQuery("#guidant_conditions_create").show();
    jQuery('#guidant_condition_create_attribute').select2({
        placeholder: "Select", closeOnSelect: true,
        ajax: {
            url: ajaxurl,
            type: "GET",
            data: function (params) {
                var query = {
                    search: params.term,
                    action: 'guidant_attributes_suggestion'
                }
                return query;
            },
            delay: 250, dataType: 'json',
            processResults: function (response) {
                console.log(response)
                return {results: response.attributes};
            }
        }
    });


    if(guidant_current_filter_type == "card"){
        jQuery("#guidant_condition_create_fields_for_card").show();

        jQuery('#guidant_condition_create_matching_type').empty().append("" +
            "                        <option value=\"\">Select</option>\n" +
            "                        <option value=\"equal\">Equal</option>\n" +
            "                        <option value=\"not_equal\">Not equal</option>\n" +
            "                        <option value=\"like\">Like</option>\n" +
            "                        <option value=\"not_like\">Not like</option>\n" +
            "                        <option value=\"contains\">Contains</option>\n" +
            "                        <option value=\"not_contains\">Not Contains</option>\n" +
            "                        <option value=\"greater_than\">Greater than</option>\n" +
            "                        <option value=\"less_than\">Less than</option>")


        jQuery('#guidant_condition_create_attribute').on('change', function() {
            if (jQuery('#guidant_condition_create_value_auto').data('select2')) {
                jQuery('#guidant_condition_create_value_auto').select2('destroy');
            }
            jQuery('#guidant_condition_create_value_auto').select2({
                placeholder: "Select", closeOnSelect: true,
                ajax: {
                    url: ajaxurl,
                    type: "GET",
                    data: function (params) {
                        return {
                            action: 'guidant_attributes_value_suggestion',
                            attribute: jQuery("#guidant_condition_create_attribute").val(),
                            q: params.term
                        };
                    },
                    delay: 250, dataType: 'json',
                    processResults: function (response) {
                        return {results: response.values};
                    }
                }
            });
        });
    }else if(guidant_current_filter_type == "slider"){
        jQuery("#guidant_condition_create_fields_for_card").hide();

        if(jQuery('#guidant_slider_tab_page_slider_type').val() === "single"){

            jQuery('#guidant_condition_create_matching_type').empty().append("" +
                "                        <option value=\"\">Select</option>\n" +
                "                        <option value=\"greater_than\">Greater than</option>\n" +
                "                        <option value=\"less_than\">Less than</option>")

        }else if(jQuery('#guidant_slider_tab_page_slider_type').val() === "range"){

            jQuery('#guidant_condition_create_matching_type').empty().append("" +
                "                        <option value=\"\">Select</option>\n" +
                "                        <option value=\"between\">Between</option>\n" +
                "                        <option value=\"not_between\">Not Between</option>")

        }

    }


}
function guidant_conditions_create_close(host){
    jQuery("#guidant_conditions_create").hide();
}

function guidant_conditions_create(host){
    'use strict';


    var hasError = false
    var attribute_type = jQuery("#guidant_condition_create_attribute").val()
    var matching_type = jQuery("#guidant_condition_create_matching_type").val()

    if(attribute_type.toString().trim().length === 0){
        hasError = true
        jQuery("#guidant_condition_create_attribute_empty").show()
    }else{
        jQuery("#guidant_condition_create_attribute_empty").hide()
    }

    if(matching_type.toString().trim().length === 0){
        hasError = true
        jQuery("#guidant_condition_create_matching_type_empty").show()
    }else{
        jQuery("#guidant_condition_create_matching_type_empty").hide()
    }


    if(!hasError){
        jQuery("#guidant_conditions_create .guidant_conditions_create_btn").text("Saving...");
        if(guidant_current_filter_type == "card"){
            var post_data = {
                'action': 'guidant_conditions_create',
                'element_id': guidant_current_element_id,
                'condition_id': '0',
                'attribute_type': attribute_type,
                'attribute_type_text': jQuery("#guidant_condition_create_attribute").select2('data')[0].text,
                'matching_type': matching_type,
                'value_selection': jQuery("#guidant_condition_create_value_selection").val(),
                'value_auto': jQuery("#guidant_condition_create_value_auto").val(),
                'value_auto_text': jQuery("#guidant_condition_create_value_auto").select2('data')[0].text,
                'value_manual': jQuery("#guidant_condition_create_value_manual").val(),
            };
        }else if(guidant_current_filter_type == "slider"){
            var post_data = {
                'action': 'guidant_conditions_create',
                'element_id': guidant_current_element_id,
                'condition_id': '0',
                'attribute_type': attribute_type,
                'attribute_type_text': jQuery("#guidant_condition_create_attribute").select2('data')[0].text,
                'matching_type': matching_type,
            };
        }
        jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: post_data,
            success: function (data) {
                var obj = JSON.parse(data);

                if(obj.status == "true"){
                    guidant_conditions_list(host, guidant_current_element_id)
                }

                jQuery("#guidant_conditions_create .guidant_conditions_create_btn").text("Create");
                guidant_conditions_create_close(host);
            }
        })
    }

}









function guidant_conditions_update_show(host, condition_id, attribute_type, attribute_type_text, matching_type, value_selection, value, value_text){
    jQuery("#guidant_conditions_update").show();
    guidant_current_condition_id = condition_id;

    jQuery("#guidant_condition_update_attribute").empty();
    jQuery("#guidant_condition_update_value_auto").empty();

    jQuery('#guidant_condition_update_attribute').select2({
        placeholder: "Select", closeOnSelect: true,
        ajax: {
            url: ajaxurl,
            type: "GET",
            data: function (params) {
                var query = {
                    search: params.term,
                    action: 'guidant_attributes_suggestion'
                }
                return query;
            },
            delay: 250, dataType: 'json',
            processResults: function (response) {
                return {results: response.attributes};
            }
        }
    });



    if(guidant_current_filter_type == "card"){

        jQuery("#guidant_condition_update_fields_for_card").show();

        jQuery('#guidant_condition_update_matching_type').empty().append("" +
            "                        <option value=\"\">Select</option>\n" +
            "                        <option value=\"equal\">Equal</option>\n" +
            "                        <option value=\"not_equal\">Not equal</option>\n" +
            "                        <option value=\"like\">Like</option>\n" +
            "                        <option value=\"not_like\">Not like</option>\n" +
            "                        <option value=\"contains\">Contains</option>\n" +
            "                        <option value=\"not_contains\">Not Contains</option>\n" +
            "                        <option value=\"greater_than\">Greater than</option>\n" +
            "                        <option value=\"less_than\">Less than</option>")

        jQuery('#guidant_condition_update_attribute').on('change', function() {
            if (jQuery('#guidant_condition_update_value_auto').data('select2')) {
                jQuery('#guidant_condition_update_value_auto').select2('destroy');
            }
            jQuery('#guidant_condition_update_value_auto').select2({
                placeholder: "Select", closeOnSelect: true,
                ajax: {
                    url: ajaxurl,
                    type: "GET",
                    data: function (params) {
                        return {
                            action: 'guidant_attributes_value_suggestion',
                            attribute: jQuery("#guidant_condition_update_attribute").val(),
                            q: params.term
                        };
                    },
                    delay: 250, dataType: 'json',
                    processResults: function (response) {
                        return {results: response.values};
                    }
                }
            });
        });

        jQuery("#guidant_condition_update_attribute").append("<option value=\""+attribute_type+"\">"+attribute_type_text+"</option>").val(attribute_type).trigger('change')
        jQuery("#guidant_condition_update_matching_type").val(matching_type)
        jQuery("#guidant_condition_update_value_selection").val(value_selection).trigger('change')

        if(value_selection === "auto"){
            jQuery("#guidant_condition_update_value_auto").append("<option value=\""+value+"\">"+value_text+"</option>").val(value)
        }else{
            jQuery("#guidant_condition_update_value_manual").val(value)
        }


    }else if(guidant_current_filter_type == "slider"){


        jQuery("#guidant_condition_update_fields_for_card").hide();

        if(jQuery('#guidant_slider_tab_page_slider_type').val() === "single"){

            jQuery('#guidant_condition_update_matching_type').empty().append("" +
                "                        <option value=\"\">Select</option>\n" +
                "                        <option value=\"greater_than\">Greater than</option>\n" +
                "                        <option value=\"less_than\">Less than</option>")

        }else if(jQuery('#guidant_slider_tab_page_slider_type').val() === "range"){

            jQuery('#guidant_condition_update_matching_type').empty().append("" +
                "                        <option value=\"\">Select</option>\n" +
                "                        <option value=\"between\">Between</option>\n" +
                "                        <option value=\"not_between\">Not Between</option>")

        }


        jQuery("#guidant_condition_update_attribute").append("<option value=\""+attribute_type+"\">"+attribute_type_text+"</option>").val(attribute_type).trigger('change')
        jQuery("#guidant_condition_update_matching_type").val(matching_type)

    }





}
function guidant_condition_update_close(host){
    jQuery("#guidant_conditions_update").hide();
}

function guidant_conditions_update(host){
    'use strict';

    jQuery("#guidant_conditions_update input").prop("disabled", true);
    jQuery("#guidant_conditions_update button").prop("disabled", true);
    jQuery("#guidant_conditions_update textarea").prop("disabled", true);
    jQuery("#guidant_conditions_update select").prop("disabled", true);
    jQuery("#guidant_conditions_update .guidant_condition_update_btn").text("Saving...");





    if(guidant_current_filter_type == "card"){
        var post_data = {
            'action': 'guidant_conditions_create',
            'element_id': guidant_current_element_id,
            'condition_id': guidant_current_condition_id,
            'attribute_type': jQuery("#guidant_condition_update_attribute").val(),
            'attribute_type_text': jQuery("#guidant_condition_update_attribute").select2('data')[0].text,
            'matching_type': jQuery("#guidant_condition_update_matching_type").val(),
            'value_selection': jQuery("#guidant_condition_update_value_selection").val(),
            'value_auto': jQuery("#guidant_condition_update_value_auto").val(),
            'value_auto_text': jQuery("#guidant_condition_update_value_auto").select2('data')[0].text,
            'value_manual': jQuery("#guidant_condition_update_value_manual").val(),
        };
    }else if(guidant_current_filter_type == "slider"){
        var post_data = {
            'action': 'guidant_conditions_create',
            'element_id': guidant_current_element_id,
            'condition_id': guidant_current_condition_id,
            'attribute_type': jQuery("#guidant_condition_update_attribute").val(),
            'attribute_type_text': jQuery("#guidant_condition_update_attribute").select2('data')[0].text,
            'matching_type': jQuery("#guidant_condition_update_matching_type").val(),
        };
    }

    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                jQuery("#guidant_conditions_update input").prop("disabled", false);
                jQuery("#guidant_conditions_update button").prop("disabled", false);
                jQuery("#guidant_conditions_update textarea").prop("disabled", false);
                jQuery("#guidant_conditions_update select").prop("disabled", false);
                jQuery("#guidant_conditions_update .guidant_condition_update_btn").text("Update");

                guidant_condition_update_close(host);
                guidant_conditions_list(host, guidant_current_element_id)
            }
        }
    })
}





function guidant_condition_delete(host, condition_id){
    'use strict';

    jQuery("#guidant_"+guidant_current_filter_type+"_conditions_list .guidant-loader").show();
    jQuery("#guidant_"+guidant_current_filter_type+"_conditions_list_items").empty();

    var post_data = {
        'action': 'guidant_conditions_delete',
        'condition_id': condition_id
    };
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                guidant_conditions_list(host, guidant_current_element_id)
            }
        }
    })
}
