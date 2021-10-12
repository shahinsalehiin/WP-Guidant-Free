/* =========== GUIDE OPERATIONS ========== */

function guidant_guides_list(host){
    'use strict';


    jQuery('.guidant-top-menu').find("li a").each(function( index ) {
        jQuery(this).removeClass('active');
    });
    jQuery('#guidant_header_guides_menu').addClass('active');


    guidant_hide_all();
    jQuery("#guidant_guides_list").show();
    jQuery("#guidant_guides_list_items").empty();
    jQuery("#guidant_guides_list .guidant-loader").show();

    jQuery(".guidant-breadcrumb").empty();

    var post_data = {'action': 'guidant_guides_list'};
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                var guides = obj.guides;
                if(guides.length == 0){
                    jQuery("#guidant_guides_list .guidant-empty").show();
                }
                for (var i = 0; i < guides.length; i++) {
                    var itemHTML = "<div class=\"guidant_card_style_guide\">\n" +
                        "            <div class='guidant_guide_info'>\n" +
                        "               <span> Name </span>\n" +
                        "               <p> "+guides[i].guide_name+" </p>\n" +
                        "            </div>\n" +
                        "            <div class='guidant_shortcode_info'>\n" +
                        "               <span> Shortcode </span>\n" +
                        "               <a href=\"#\" class=\"t-top t-lg\" data-tooltip=\"Click to Copy Shortcode\" onclick='guidant_copy_txt(this, `[wpguidant_guide id="+guides[i].guide_id+"]`)'> [wpguidant_guide id="+guides[i].guide_id+"] </a>\n" +
                        "            </div>\n" +
                        "            <div class=\"guidant_card_action\">\n" +
                        "                 <a href=\"#\" class=\"t-top t-sm guidant-view-icon\" data-tooltip=\"Manage Filters\" onclick='guidant_filters_list(`"+host+"`, `"+guides[i].guide_id+"`)'><img src=\""+host+"/assets/img/settings.svg\" alt=\"icon\"/> </a>\n" +
                        "                 <a href=\"#\" class=\"t-top t-md guidant-edit-icon\" data-tooltip=\"Guide Settings and Design\" onclick='guidant_guide_update_tab_page_get(`"+host+"`, `"+guides[i].guide_id+"`)'><img src=\""+host+"/assets/img/edit.svg\" alt=\"icon\"/> </a>\n" +
                        "                 <a href=\"#\" class=\"t-top t-sm guidant-trash-icon\" data-tooltip=\"Delete Guide\" onclick='guidant_guides_delete(`"+host+"`, `"+guides[i].guide_id+"`)'><img src=\""+host+"/assets/img/trash.svg\" alt=\"icon\"/> </a>\n" +
                        "            </div>\n" +
                        "        </div>";
                    jQuery("#guidant_guides_list_items").append(itemHTML)
                }
            }

            jQuery("#guidant_guides_list .guidant-loader").hide();
        }
    })
}



function guidant_guides_create_show(host){
    guidant_hide_all();
    jQuery("#guidant_guides_create").show();

    jQuery(".guidant-breadcrumb").empty();
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_guides_list(`"+host+"`)'>All Guides</a></li>");
    jQuery(".guidant-breadcrumb").append("<li>New Guide</li>");

    jQuery("#guidant_guides_create_guide_name").val("")
    jQuery("#guidant_guides_create_guide_title").val("")
    tinymce.get("guidant_guides_create_guide_description").setContent("");

    jQuery("#guidant_guides_create_guide_name_empty").hide()
}
function guidant_guides_create(host){
    'use strict';

    var hasError = false
    var guide_name = jQuery("#guidant_guides_create_guide_name").val()
    var guide_title = jQuery("#guidant_guides_create_guide_title").val()
    var guide_description = jQuery("#guidant_guides_create_guide_description").val()

    if(guide_name.toString().trim().length === 0){
        hasError = true
        jQuery("#guidant_guides_create_guide_name_empty").show()
    }else{
        jQuery("#guidant_guides_create_guide_name_empty").hide()
    }

    if(!hasError){
        jQuery("#guidant_guides_create .guidant_guide_create_btn").text("Creating...");
        var post_data = {
            'action': 'guidant_guides_create',
            'guide_id': "0",
            'guide_name': guide_name,
            'guide_title': guide_title,
            'guide_description': guide_description
        };
        jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: post_data,
            success: function (data) {
                var obj = JSON.parse(data);

                if(obj.status == "true"){
                    guidant_guides_list(host)
                }
                jQuery("#guidant_guides_create .guidant_guide_create_btn").text("Create");
            }
        })
    }

}

function guidant_guides_delete(host, guide_id){
    'use strict';


    jQuery("#guidant_guides_list .guidant-loader").show();
    jQuery("#guidant_guides_list_items").empty();

    var post_data = {
        'action': 'guidant_guides_delete',
        'guide_id': guide_id
    };
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                guidant_guides_list(host)
            }
        }
    })
}


function guidant_copy_txt(element, text) {
    var temp = jQuery("<input>");
    jQuery("body").append(temp);
    temp.val(text).select();
    document.execCommand("copy");
    temp.remove();
    alert("Copied")
}