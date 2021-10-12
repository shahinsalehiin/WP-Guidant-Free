function guidant_custom_fields_list(host){
    'use strict';

    jQuery('.guidant-top-menu').find("li a").each(function( index ) {
        jQuery(this).removeClass('active');
    });
    jQuery('#guidant_header_fields_menu').addClass('active');

    guidant_hide_all();
    jQuery("#guidant_custom_field_list").show();
    jQuery("#guidant_custom_field_list_items").empty();
    jQuery("#guidant_custom_field_list .guidant-loader").show();

    jQuery(".guidant-breadcrumb").empty();

    var post_data = {'action': 'guidant_fields_list'};
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                var fields = obj.fields;
                if(fields.length == 0){
                    jQuery("#guidant_custom_field_list .guidant-empty").show();
                }
                for (var i = 0; i < fields.length; i++) {

                    var placement = fields[i].field_placement
                    if(placement === "post"){
                        placement = "Post"
                    }else if(placement === "product"){
                        placement = "Product"
                    }else if(placement === "all"){
                        placement = "Post & Product"
                    }

                    var itemHTML = "<div class=\"guidant_card_style_custom_fields\">\n" +
                        "            <div class='guidant_field_info'>\n" +
                        "               <span> Field Label </span>\n" +
                        "               <p> "+fields[i].field_label+"</p>\n" +
                        "            </div>\n" +
                        "            <div class='guidant_placement_info'>\n" +
                        "               <span> Placement </span>\n" +
                        "               <p> "+placement+" </p>\n" +
                        "            </div>\n" +
                        "            <div class=\"guidant_card_action\">\n" +
                        "                 <a href=\"#\" class=\"t-top t-md guidant-edit-icon\" data-tooltip=\"Edit Field\" onclick='guidant_field_update_show(`"+host+"`, `"+fields[i].field_id+"`, `"+fields[i].field_label+"`, `"+fields[i].field_placement+"`)'><img src=\""+host+"/assets/img/edit.svg\" alt=\"icon\"/> </a>\n" +
                        "                 <a href=\"#\" class=\"t-top t-sm guidant-trash-icon\" data-tooltip=\"Delete Field\" onclick='guidant_fields_delete(`"+host+"`, `"+fields[i].field_id+"`)'><img src=\""+host+"/assets/img/trash.svg\" alt=\"icon\"/> </a>\n" +
                        "            </div>\n" +
                        "        </div>";


                    jQuery("#guidant_custom_field_list_items").append(itemHTML)
                }
            }

            jQuery("#guidant_custom_field_list .guidant-loader").hide();
        }
    })
}



function guidant_field_create_show(host){
    jQuery("#guidant_custom_field_create").show();
}
function guidant_field_create_close(host){
    jQuery("#guidant_custom_field_create").hide();
}
function guidant_field_create(host){
    'use strict';


    var hasError = false
    var field_label = jQuery("#guidant_field_create_field_label").val()
    var field_placement = jQuery("#guidant_field_create_field_placement").val()

    if(field_label.toString().trim().length === 0){
        hasError = true
        jQuery("#guidant_field_create_field_label_empty").show()
    }else{
        jQuery("#guidant_field_create_field_label_empty").hide()
    }

    if(field_placement.toString().trim().length === 0){
        hasError = true
        jQuery("#guidant_field_create_field_placement_empty").show()
    }else{
        jQuery("#guidant_field_create_field_placement_empty").hide()
    }



    if(!hasError){
        jQuery("#guidant_custom_field_create .guidant_custom_field_create_btn").text("Saving...");
        var post_data = {
            'action': 'guidant_fields_create',
            'field_id': '0',
            'field_label': field_label,
            'field_placement': field_placement,
        };
        jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: post_data,
            success: function (data) {
                var obj = JSON.parse(data);

                if(obj.status == "true"){
                    jQuery("#guidant_custom_field_create .guidant_custom_field_create_btn").text("Create Field");
                    guidant_field_create_close(host)
                    guidant_custom_fields_list(host)
                }
            }
        })
    }


}





function guidant_field_update_show(host, field_id, field_label, field_placement){
    jQuery("#guidant_fields_update").show();
    guidant_current_field_id = field_id;

    jQuery("#guidant_field_update_field_label").val(field_label)
    jQuery("#guidant_field_update_field_placement").val(field_placement)
}
function guidant_fields_update_close(host){
    jQuery("#guidant_fields_update").hide();
}


function guidant_field_update(host){
    'use strict';


    var hasError = false
    var field_label = jQuery("#guidant_field_update_field_label").val()
    var field_placement = jQuery("#guidant_field_update_field_placement").val()

    if(field_label.toString().trim().length === 0){
        hasError = true
        jQuery("#guidant_field_update_field_label_empty").show()
    }else{
        jQuery("#guidant_field_update_field_label_empty").hide()
    }

    if(field_placement.toString().trim().length === 0){
        hasError = true
        jQuery("#guidant_field_update_field_placement_empty").show()
    }else{
        jQuery("#guidant_field_update_field_placement_empty").hide()
    }



    if(!hasError){
        jQuery("#guidant_fields_update .guidant_field_update_btn").text("Saving...");
        var post_data = {
            'action': 'guidant_fields_create',
            'field_id': guidant_current_field_id,
            'field_label': field_label,
            'field_placement': field_placement,
        };
        jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: post_data,
            success: function (data) {
                var obj = JSON.parse(data);

                if(obj.status == "true"){
                    jQuery("#guidant_fields_update .guidant_field_update_btn").text("Save");
                    guidant_fields_update_close(host);
                    guidant_custom_fields_list(host);
                }
            }
        })
    }

}





function guidant_fields_delete(host, field_id){
    'use strict';

    jQuery("#guidant_custom_field_list .guidant-loader").show();
    jQuery("#guidant_custom_field_list_items").empty();

    var post_data = {
        'action': 'guidant_fields_delete',
        'field_id': field_id
    };
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                guidant_custom_fields_list(host);
            }
        }
    })
}