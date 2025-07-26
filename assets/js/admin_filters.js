
/* =========== FILTER OPERATIONS ========== */

function guidant_filters_list(host, guide_id){
    'use strict';
    guidant_current_guide_id = guide_id;


    guidant_hide_all();
    jQuery("#guidant_filters_list").show();
    jQuery("#guidant_filters_list_items").empty();
    jQuery("#guidant_filters_list .guidant-loader").show();


    jQuery(".guidant-breadcrumb").empty();
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_guides_list(`"+host+"`)'>All Guides</a></li>");
    jQuery(".guidant-breadcrumb").append("<li>Filters</li>");


    var post_data = {'action': 'guidant_filters_list', 'guide_id': guide_id};
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                var filters = obj.filters;
                if(filters.length == 0){
                    jQuery("#guidant_filters_list .guidant-empty").show();
                }
                for (var i = 0; i < filters.length; i++) {


                    var filter_type = filters[i].filter_type.toString()
                    var tooltip_view_btn = ""
                    if(filter_type === "card"){
                        filter_type = "Card Filter";
                        tooltip_view_btn = "Manage Cards"
                    }else if(filter_type === "slider"){
                        filter_type = "Slider Filter";
                        tooltip_view_btn = "Manage Sliders"
                    }else if(filter_type === "form"){
                        filter_type = "Form Filter";
                        tooltip_view_btn = "Manage Form Elements"
                    }

                    var itemHTML = "<div class=\"guidant_card_style_filter\" data-filter_id=\""+filters[i].filter_id+"\">\n" +
                        "            <div class='guidant_guide_info'>\n" +
                        "               <span class='guidant_filter_position'> Filter "+Number(i + 1)+" </span>\n" +
                        "               <p> "+filters[i].filter_name+" </p>\n" +
                        "            </div>\n" +
                        "            <div class='guidant_filter_info'>\n" +
                        "               <span> Type </span>\n" +
                        "               <p> "+filter_type+" </p>\n" +
                        "            </div>\n" +
                        "            <div class=\"guidant_card_action\">\n" +
                        "                 <a href=\"#\" class=\"t-top t-sm guidant-view-icon\" data-tooltip=\""+tooltip_view_btn+"\" onclick='guidant_elements_list(`"+host+"`, `"+filters[i].filter_id+"`, `"+filters[i].filter_type+"`)'><img src=\""+host+"/assets/img/settings.svg\" alt=\"icon\"/> </a>\n" +
                        "                 <a href=\"#\" class=\"t-top t-md guidant-edit-icon\" data-tooltip=\"Edit Filter\" onclick='guidant_filters_update_show(`"+host+"`, `"+filters[i].filter_id+"`, `"+filters[i].filter_name+"`, `"+filters[i].filter_title+"`, `"+filters[i].filter_description+"`, `"+filters[i].filter_type+"`, `"+filters[i].card_type+"`)'><img src=\""+host+"/assets/img/edit.svg\" alt=\"icon\"/> </a>\n" +
                        "                 <a href=\"#\" class=\"t-top t-sm guidant-trash-icon\" data-tooltip=\"Delete Filter\" onclick='guidant_filters_delete(`"+host+"`, `"+filters[i].filter_id+"`)'><img src=\""+host+"/assets/img/trash.svg\" alt=\"icon\"/> </a>\n" +
                        "            </div>\n" +
                        "        </div>";

                    jQuery("#guidant_filters_list_items").append(itemHTML)
                }
            }
            jQuery("#guidant_filters_list .guidant-loader").hide();
            jQuery( "#guidant_filters_list_items" ).sortable({
                cursor: "grabbing",
                start: function(event, ui) {},
                change: function(event, ui) {},
                update: function(event, ui) {
                    guidant_filters_sort(host)
                }
            });
        }
    })
}



function guidant_filters_sort(host){
    var data_filters_position = [];
    var position = 0;
    jQuery("#guidant_filters_list_items").find(".guidant_card_style_filter").each(function( index ) {
        var data_individual_filter = {}
        data_individual_filter ['filter_id'] = jQuery( this ).data('filter_id');
        data_individual_filter ['position'] = position;
        data_filters_position.push(data_individual_filter)
        position++;
    });

    var post_data = {
        'action': 'guidant_filters_sort',
        'data': encodeURIComponent(JSON.stringify(data_filters_position)),
    };
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                var position = 1;
                jQuery("#guidant_filters_list_items").find(".guidant_card_style_filter").each(function( index ) {
                    jQuery(this).find(".guidant_filter_position").text("Filter "+position);
                    position++;
                });
            }
        }
    })
}


function guidant_filters_create_show(host){
    guidant_hide_all();
    jQuery("#guidant_filters_create").show();

    jQuery(".guidant-breadcrumb").empty();
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_guides_list(`"+host+"`)'>All Guides</a></li>");
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_filters_list(`"+host+"`, `"+guidant_current_guide_id+"`)'>Filters</a></li>");
    jQuery(".guidant-breadcrumb").append("<li>New Filter</li>");


    jQuery("#guidant_filters_create_filter_name").val("")
    jQuery("#guidant_filters_create_filter_title").val("")
    tinymce.get("guidant_filters_create_filter_description").setContent("");


    jQuery("#guidant_filters_create_filter_name_empty").hide()
    jQuery("#guidant_filters_create_filter_type_empty").hide()
}

function guidant_filters_create(host){
    'use strict';

    var hasError = false
    var filter_name = jQuery("#guidant_filters_create_filter_name").val()
    var filter_type = jQuery("#guidant_filters_create_filter_type").val()

    if(filter_name.toString().trim().length === 0){
        hasError = true
        jQuery("#guidant_filters_create_filter_name_empty").show()
    }else{
        jQuery("#guidant_filters_create_filter_name_empty").hide()
    }

    if(filter_type.toString().trim().length === 0){
        hasError = true
        jQuery("#guidant_filters_create_filter_type_empty").show()
    }else{
        jQuery("#guidant_filters_create_filter_type_empty").hide()
    }

    if(!hasError){
        jQuery("#guidant_filters_create .guidant_filters_create_btn").text("Creating...");
        var post_data = {
            'action': 'guidant_filters_create',
            'guide_id': guidant_current_guide_id,
            'filter_id': '0',
            'filter_name': filter_name,
            'filter_title': jQuery("#guidant_filters_create_filter_title").val(),
            'filter_description': jQuery("#guidant_filters_create_filter_description").val(),
            'filter_type': filter_type,
            'card_type': jQuery("#guidant_filters_create_card_type").val(),
        };
        jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: post_data,
            success: function (data) {
                var obj = JSON.parse(data);

                if(obj.status == "true"){
                    //guidant_elements_list(host, obj.filter_id, obj.filter_type)
                    guidant_filters_list(host, guidant_current_guide_id)
                }
                jQuery("#guidant_filters_create .guidant_filters_create_btn").text("Create");
            }
        })
    }


}






function guidant_filters_update_show(host, filter_id, filter_name, filter_title, filter_description, filter_type, card_type){
    guidant_hide_all();
    jQuery("#guidant_filters_update").show();
    guidant_current_filter_id = filter_id;


    jQuery(".guidant-breadcrumb").empty();
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_guides_list(`"+host+"`)'>All Guides</a></li>");
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_filters_list(`"+host+"`, `"+guidant_current_guide_id+"`)'>Filters</a></li>");
    jQuery(".guidant-breadcrumb").append("<li>Modify Filter</li>");

    jQuery("#guidant_filters_update_filter_name").val(filter_name)
    jQuery("#guidant_filters_update_filter_title").val(filter_title)
    tinymce.get("guidant_filters_update_filter_description").setContent(filter_description);
    jQuery("#guidant_filters_update_filter_type").val(filter_type).trigger('change');
    jQuery("#guidant_filters_update_card_type").val(card_type)

    jQuery("#guidant_filters_update_filter_name_empty").hide()
    jQuery("#guidant_filters_update_filter_type_empty").hide()
}

function guidant_filters_update(host){
    'use strict';


    var hasError = false
    var filter_name = jQuery("#guidant_filters_update_filter_name").val()
    var filter_type = jQuery("#guidant_filters_update_filter_type").val()

    if(filter_name.toString().trim().length === 0){
        hasError = true
        jQuery("#guidant_filters_update_filter_name_empty").show()
    }else{
        jQuery("#guidant_filters_update_filter_name_empty").hide()
    }

    if(filter_type.toString().trim().length === 0){
        hasError = true
        jQuery("#guidant_filters_update_filter_type_empty").show()
    }else{
        jQuery("#guidant_filters_update_filter_type_empty").hide()
    }



    if(!hasError){
        jQuery("#guidant_filters_update .guidant_filters_update_btn").text("Saving...");

        var post_data = {
            'action': 'guidant_filters_create',
            'guide_id': guidant_current_guide_id,
            'filter_name': filter_name,
            'filter_id': guidant_current_filter_id,
            'filter_title': jQuery("#guidant_filters_update_filter_title").val(),
            'filter_description': jQuery("#guidant_filters_update_filter_description").val(),
            'filter_type': filter_type,
            'card_type': jQuery("#guidant_filters_update_card_type").val(),
        };
        jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: post_data,
            success: function (data) {
                var obj = JSON.parse(data);

                if(obj.status == "true"){
                    guidant_filters_list(host, guidant_current_guide_id);
                }
                jQuery("#guidant_filters_update .guidant_filters_update_btn").text("Save");
            }
        })
    }


}





function guidant_filters_delete(host, filter_id){
    'use strict';

    jQuery("#guidant_filters_list .guidant-loader").show();
    jQuery("#guidant_filters_list_items").empty();

    var post_data = {
        'action': 'guidant_filters_delete',
        'filter_id': filter_id
    };
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                guidant_filters_list(host, guidant_current_guide_id);
            }
        }
    })
}