function guidant_form_tab_page_get(host, element_id){
    'use strict';
    guidant_current_element_id = element_id;

    guidant_hide_all();
    jQuery("#guidant_form_tab_page_container").show();

    jQuery("#guidant_form_tab_page_container .guidant-loader").show();
    jQuery("#guidant_form_tab_page_container .guidant-card-setting").hide();

    jQuery(".guidant-breadcrumb").empty();
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_guides_list(`"+host+"`)'>All Guides</a></li>");
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_filters_list(`"+host+"`,`"+guidant_current_guide_id+"`)'>Filters</a></li>");
    jQuery(".guidant-breadcrumb").append("<li><a href=\"#\" onclick='guidant_elements_list(`"+host+"`,`"+guidant_current_filter_id+"`,`"+guidant_current_filter_type+"`)'>Form Elements</a></li>");
    jQuery(".guidant-breadcrumb").append("<li>Form Element Settings</li>");

    const tabs = document.querySelectorAll("#guidant_form_tab_page_container .guidant_tab_menu li");
    const contents =  document.querySelectorAll("#guidant_form_tab_page_container .guidant_tab_item");

    tabs.forEach((tab, index) => {
        tab.addEventListener("click", () => {
            tabs.forEach((tab) =>  tab.classList.remove("active"));
            tab.classList.add("active");
            contents.forEach((c) =>  c.classList.remove("active"));
            contents[index].classList.add("active");
        });
    });
    tabs[0].click();



    jQuery("#guidant_form_tab_page_checkbox_options_container").empty()
    jQuery("#guidant_form_tab_page_radio_options_container").empty()
    jQuery("#guidant_form_tab_page_select_options_container").empty()

    var post_data = {'action': 'guidant_form_tab_page_get', 'element_id': guidant_current_element_id};
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                jQuery("#guidant_form_tab_page_element_label").val(obj.element_label);
                jQuery("#guidant_form_tab_page_input_type").val(obj.input_type).trigger('change');
                jQuery("#guidant_form_tab_page_element_required").val(obj.element_required);


                jQuery("#guidant_form_tab_page_input_field_type").val(obj.input_field_type);


                jQuery.each( obj.checkbox_items.split('[:::]'), function( key, value ) {
                    guidant_form_tab_page_add_checkbox_option(value)
                });
                jQuery.each( obj.radio_items.split('[:::]'), function( key, value ) {
                    guidant_form_tab_page_add_radio_option(value)
                });
                jQuery.each( obj.select_items.split('[:::]'), function( key, value ) {
                    guidant_form_tab_page_add_select_option(value)
                });

            }
            jQuery("#guidant_form_tab_page_container .guidant-loader").hide();
            jQuery("#guidant_form_tab_page_container .guidant-card-setting").show();
        }
    })

}


function guidant_form_tab_page_add_checkbox_option(value){
    jQuery("#guidant_form_tab_page_checkbox_options_container").append("<div style=\"margin-top: 5px;\" class=\"guidant_form_group\">\n" +
        "                            <div class=\"w-flex\">\n" +
        "                                <input type=\"text\" placeholder=\"Add New Option\" value=\""+value+"\">\n" +
        "                                <span class=\"del_option\" onclick=\"guidant_form_tab_page_remove_checkbox_option(this)\">X</span>\n" +
        "                            </div>\n" +
        "                        </div>")
}
function guidant_form_tab_page_remove_checkbox_option(element){
    jQuery(element).closest(".guidant_form_group").remove()
}





function guidant_form_tab_page_add_radio_option(value){
    jQuery("#guidant_form_tab_page_radio_options_container").append("<div style=\"margin-top: 5px;\" class=\"guidant_form_group\">\n" +
        "                            <div class=\"w-flex\">\n" +
        "                                <input type=\"text\" placeholder=\"Add New Option\" value=\""+value+"\">\n" +
        "                                <span class=\"del_option\" onclick=\"guidant_form_tab_page_remove_radio_option(this)\">X</span>\n" +
        "                            </div>\n" +
        "                        </div>")
}
function guidant_form_tab_page_remove_radio_option(element){
    jQuery(element).closest(".guidant_form_group").remove()
}





function guidant_form_tab_page_add_select_option(value){
    jQuery("#guidant_form_tab_page_select_options_container").append("<div style=\"margin-top: 5px;\" class=\"guidant_form_group\">\n" +
        "                            <div class=\"w-flex\">\n" +
        "                                <input type=\"text\" placeholder=\"Add New Option\" value=\""+value+"\">\n" +
        "                                <span class=\"del_option\" onclick=\"guidant_form_tab_page_remove_select_option(this)\">X</span>\n" +
        "                            </div>\n" +
        "                        </div>")
}
function guidant_form_tab_page_remove_select_option(element){
    jQuery(element).closest(".guidant_form_group").remove()
}


function guidant_form_tab_page_save(host){
    'use strict';

    jQuery("#guidant_form_tab_page_container input").prop("disabled", true);
    jQuery("#guidant_form_tab_page_container button").prop("disabled", true);
    jQuery("#guidant_form_tab_page_container textarea").prop("disabled", true);
    jQuery("#guidant_form_tab_page_container select").prop("disabled", true);
    jQuery("#guidant_form_tab_page_container .guidant_card_update_btn").text("Saving...");


    var checkbox_items = []
    jQuery("#guidant_form_tab_page_checkbox_options_container").find("input").each(function( index ) {
        var this_option = this
        checkbox_items.push(jQuery(this_option).val())
    })


    var radio_items = []
    jQuery("#guidant_form_tab_page_radio_options_container").find("input").each(function( index ) {
        var this_option = this
        radio_items.push(jQuery(this_option).val())
    })

    var select_items = []
    jQuery("#guidant_form_tab_page_select_options_container").find("input").each(function( index ) {
        var this_option = this
        select_items.push(jQuery(this_option).val())
    })



    var post_data = {
        'action': 'guidant_form_tab_page_save',
        'element_id': guidant_current_element_id,
        'element_label': jQuery("#guidant_form_tab_page_element_label").val(),
        'input_type': jQuery("#guidant_form_tab_page_input_type").val(),
        'input_field_type': jQuery("#guidant_form_tab_page_input_field_type").val(),
        'select_items': select_items.join("[:::]"),
        'checkbox_items': checkbox_items.join("[:::]"),
        'radio_items': radio_items.join("[:::]"),
        'element_required': jQuery("#guidant_form_tab_page_element_required").val()
    };
    jQuery.ajax({
        url: ajaxurl,
        type: "POST",
        data: post_data,
        success: function (data) {
            console.log(data)
            var obj = JSON.parse(data);

            if(obj.status == "true"){
                jQuery("#guidant_form_tab_page_container input").prop("disabled", false);
                jQuery("#guidant_form_tab_page_container button").prop("disabled", false);
                jQuery("#guidant_form_tab_page_container textarea").prop("disabled", false);
                jQuery("#guidant_form_tab_page_container select").prop("disabled", false);
                jQuery("#guidant_form_tab_page_container .guidant_card_update_btn").text("Save Changes");
            }
        }
    })
}