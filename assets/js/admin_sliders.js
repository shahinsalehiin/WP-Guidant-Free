function guidant_slider_back_to_elements(host){
    guidant_elements_list(host, guidant_current_filter_id, guidant_current_filter_type)
}

function guidant_slider_tab_page_get(host, element_id){
    'use strict';
    guidant_current_element_id = element_id;

    guidant_hide_all();
    jQuery("#guidant_slider_tab_page_container").show();
    jQuery("#guidant_conditions_list_items").empty();

    jQuery("#guidant_slider_tab_page_container .guidant-loader").show();
    jQuery("#guidant_slider_tab_page_container .guidant-card-setting").hide();

    jQuery(".guidant-breadcrumb").empty();
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_guides_list(`"+host+"`)'>All Guides</a></li>");
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_filters_list(`"+host+"`,`"+guidant_current_guide_id+"`)'>Filters</a></li>");
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_elements_list(`"+host+"`,`"+guidant_current_filter_id+"`,`"+guidant_current_filter_type+"`)'>Sliders</a></li>");
    jQuery(".guidant-breadcrumb").append("<li>Slider Settings</li>");

    const tabs = document.querySelectorAll("#guidant_slider_tab_page_container .guidant_tab_menu li");
    const contents =  document.querySelectorAll("#guidant_slider_tab_page_container .guidant_tab_item");

    tabs.forEach((tab, index) => {
        tab.addEventListener("click", () => {
            tabs.forEach((tab) =>  tab.classList.remove("active"));
            tab.classList.add("active");
            contents.forEach((c) =>  c.classList.remove("active"));
            contents[index].classList.add("active");
        });
    });
    tabs[0].click();


    var post_data = {'action': 'guidant_slider_tab_page_get', 'element_id': guidant_current_element_id};
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                jQuery("#guidant_slider_tab_page_slider_type").val(obj.slider_type);
                jQuery("#guidant_slider_tab_page_behavior").val(obj.behavior);



                if (obj.slider_image.toLowerCase().indexOf("empty_img.png") >= 0){
                    jQuery("#guidant_slider_tab_page_image").val("");
                }else{
                    jQuery("#guidant_slider_tab_page_image").val(obj.slider_image);
                }
                jQuery("#guidant_slider_tab_page_image_shower").attr("src", obj.slider_image);



                jQuery("#guidant_slider_tab_page_slider_label").val(obj.slider_label);
                jQuery("#guidant_slider_tab_page_min_range").val(obj.min_range);
                jQuery("#guidant_slider_tab_page_max_range").val(obj.max_range);
                jQuery("#guidant_slider_tab_page_slider_step").val(obj.slider_step);
                jQuery("#guidant_slider_tab_page_slider_prefix_text").val(obj.slider_prefix_text.replace("&nbsp;", " "));
                jQuery("#guidant_slider_tab_page_slider_postfix_text").val(obj.slider_postfix_text.replace("&nbsp;", " "));

            }
            jQuery("#guidant_slider_tab_page_container .guidant-loader").hide();
            jQuery("#guidant_slider_tab_page_container .guidant-card-setting").show();
        }
    })

    guidant_conditions_list(host, element_id)


}


function guidant_slider_tab_page_save(host){
    'use strict';

    jQuery("#guidant_slider_tab_page_container input").prop("disabled", true);
    jQuery("#guidant_slider_tab_page_container button").prop("disabled", true);
    jQuery("#guidant_slider_tab_page_container textarea").prop("disabled", true);
    jQuery("#guidant_slider_tab_page_container select").prop("disabled", true);
    jQuery("#guidant_slider_tab_page_container .guidant_slider_update_btn").text("Saving...");


    var post_data = {
        'action': 'guidant_slider_tab_page_save',
        'element_id': guidant_current_element_id,
        'slider_type': jQuery("#guidant_slider_tab_page_slider_type").val(),
        'slider_image': jQuery("#guidant_slider_tab_page_image").val(),
        'behavior': jQuery("#guidant_slider_tab_page_behavior").val(),
        'slider_label': jQuery("#guidant_slider_tab_page_slider_label").val(),
        'min_range': jQuery("#guidant_slider_tab_page_min_range").val(),
        'max_range': jQuery("#guidant_slider_tab_page_max_range").val(),
        'slider_step': jQuery("#guidant_slider_tab_page_slider_step").val(),
        'slider_prefix_text': jQuery("#guidant_slider_tab_page_slider_prefix_text").val().replace(/ /g, "&nbsp;"),
        'slider_postfix_text': jQuery("#guidant_slider_tab_page_slider_postfix_text").val().replace(/ /g, "&nbsp;")
    };
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                jQuery("#guidant_slider_tab_page_container input").prop("disabled", false);
                jQuery("#guidant_slider_tab_page_container button").prop("disabled", false);
                jQuery("#guidant_slider_tab_page_container textarea").prop("disabled", false);
                jQuery("#guidant_slider_tab_page_container select").prop("disabled", false);
                jQuery("#guidant_slider_tab_page_container .guidant_slider_update_btn").text("Save Changes");
            }
        }
    })
}