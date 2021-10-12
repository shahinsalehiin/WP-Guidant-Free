function guidant_card_tab_page_get(host, element_id){
    'use strict';
    guidant_current_element_id = element_id;

    guidant_hide_all();
    jQuery("#guidant_card_tab_page_container").show();
    jQuery("#guidant_conditions_list_items").empty();

    jQuery("#guidant_card_tab_page_container .guidant-loader").show();
    jQuery("#guidant_card_tab_page_container .guidant-card-setting").hide();

    jQuery(".guidant-breadcrumb").empty();
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_guides_list(`"+host+"`)'>All Guides</a></li>");
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_filters_list(`"+host+"`,`"+guidant_current_guide_id+"`)'>Filters</a></li>");
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_elements_list(`"+host+"`,`"+guidant_current_filter_id+"`,`"+guidant_current_filter_type+"`)'>Cards</a></li>");
    jQuery(".guidant-breadcrumb").append("<li>Card Settings</li>");

    const tabs = document.querySelectorAll("#guidant_card_tab_page_container .guidant_tab_menu li");
    const contents =  document.querySelectorAll("#guidant_card_tab_page_container .guidant_tab_item");

    tabs.forEach((tab, index) => {
        tab.addEventListener("click", () => {
            tabs.forEach((tab) =>  tab.classList.remove("active"));
            tab.classList.add("active");
            contents.forEach((c) =>  c.classList.remove("active"));
            contents[index].classList.add("active");
        });
    });
    tabs[0].click();


    var post_data = {'action': 'guidant_card_tab_page_get', 'element_id': guidant_current_element_id};
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                jQuery("#guidant_card_tab_page_label").val(obj.card_label);
                jQuery("#guidant_card_tab_page_behavior").val(obj.behavior);
                jQuery("#guidant_card_tab_page_image").val(obj.card_image);
                jQuery("#guidant_card_tab_page_image_shower").attr("src", obj.card_image_url);

            }
            jQuery("#guidant_card_tab_page_container .guidant-loader").hide();
            jQuery("#guidant_card_tab_page_container .guidant-card-setting").show();
        }
    })

    guidant_conditions_list(host, element_id)


}


function guidant_card_tab_page_save(host){
    'use strict';

    jQuery("#guidant_card_tab_page_container input").prop("disabled", true);
    jQuery("#guidant_card_tab_page_container button").prop("disabled", true);
    jQuery("#guidant_card_tab_page_container textarea").prop("disabled", true);
    jQuery("#guidant_card_tab_page_container select").prop("disabled", true);
    jQuery("#guidant_card_tab_page_container .guidant_card_update_btn").text("Saving...");

    var post_data = {
        'action': 'guidant_card_tab_page_save',
        'element_id': guidant_current_element_id,
        'card_label': jQuery("#guidant_card_tab_page_label").val(),
        'card_image': jQuery("#guidant_card_tab_page_image").val(),
        'behavior': jQuery("#guidant_card_tab_page_behavior").val()
    };
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                jQuery("#guidant_card_tab_page_container input").prop("disabled", false);
                jQuery("#guidant_card_tab_page_container button").prop("disabled", false);
                jQuery("#guidant_card_tab_page_container textarea").prop("disabled", false);
                jQuery("#guidant_card_tab_page_container select").prop("disabled", false);
                jQuery("#guidant_card_tab_page_container .guidant_card_update_btn").text("Save Changes");
            }
        }
    })
}