function guidant_reports_list(host, guide_id, page){
    'use strict';

    jQuery('.guidant-top-menu').find("li a").each(function( index ) {
        jQuery(this).removeClass('active');
    });
    jQuery('#guidant_header_reports_menu').addClass('active');

    guidant_hide_all();
    jQuery("#guidant_reports_list").show();
    jQuery("#guidant_reports_list_items").empty();
    jQuery("#guidant_reports_list .guidant-loader").show();
    jQuery(".guidant-breadcrumb").empty();


    jQuery("#guidant_reports_list_guide_items").val(guide_id);


    var post_data = {'action': 'guidant_reports_list', 'guide_id': guide_id, 'page': page};
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){

                var submissions = obj.submissions;
                if(submissions.length == 0){
                    jQuery("#guidant_reports_list .guidant-empty").show();
                }
                for (var i = 0; i < submissions.length; i++) {
                    var itemHTML = "<div class=\"guidant_card_style_submission\">\n" +
                        "            <div class='guidant_guide_info'>\n" +
                        "               <span> Guide </span>\n" +
                        "               <p> "+submissions[i].guide_name+" </p>\n" +
                        "            </div>\n" +
                        "            <div class='guidant_user_info'>\n" +
                        "               <span> User </span>\n" +
                        "               <a href=\""+submissions[i].user_profile+"\" target='_blank' class=\"t-top t-lg\" data-tooltip=\"Click to View Profile\"> "+submissions[i].user_name+" </a>\n" +
                        "            </div>\n" +
                        "            <div class='guidant_time_info'>\n" +
                        "               <span> Time </span>\n" +
                        "               <a href=\"#\"> "+submissions[i].time+" </a>\n" +
                        "            </div>\n" +
                        "            <div class=\"guidant_card_action\">\n" +
                        "                 <a href=\"#\" class=\"t-top t-sm guidant-view-icon\" data-tooltip=\"View Detailed Submission\" onclick='guidant_pro_popup_open()'><img src=\""+host+"/assets/img/settings.svg\" alt=\"icon\"/> </a>\n" +
                        "                 <a href=\"#\" class=\"t-top t-sm guidant-trash-icon\" data-tooltip=\"Delete Submission\" onclick='guidant_single_submission_delete(`"+host+"`, `"+guide_id+"`, `"+submissions[i].submission_id+"`)'><img src=\""+host+"/assets/img/trash.svg\" alt=\"icon\"/> </a>\n" +
                        "            </div>\n" +
                        "        </div>";

                    jQuery("#guidant_reports_list_items").append(itemHTML)
                }

                if(page > 1){
                    var prev_page = Number(page) - 1
                    jQuery("#guidant_reports_list_items").append("<button style='margin-right: 10px;' class=\"guidant-btn-sm\" onclick=\"guidant_reports_list('"+host+"', '"+guide_id+"', '"+prev_page+"')\">Previous Page</button>")
                }

                if(page < obj.total_page){
                    var next_page = Number(page) + 1
                    jQuery("#guidant_reports_list_items").append("<button class=\"guidant-btn-sm\" onclick=\"guidant_reports_list('"+host+"', '"+guide_id+"', '"+next_page+"')\">Next Page</button>")
                }


            }

            jQuery("#guidant_reports_list .guidant-loader").hide();
        }
    })
}


function guidant_single_submission_delete(host, guide_id, submission_id){
    'use strict';

    var post_data = {
        'action': 'guidant_submission_delete',
        'submission_id': submission_id
    };
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                guidant_reports_list(host, guide_id, 1);
            }
        }
    })
}



