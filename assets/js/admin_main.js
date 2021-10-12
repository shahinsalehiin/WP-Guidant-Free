/* =========== GLOBAL OPERATIONS ========== */

var guidant_current_field_id = ""
var guidant_current_guide_id = ""
var guidant_current_filter_id = ""
var guidant_current_filter_type = ""
var guidant_current_element_id = ""
var guidant_current_condition_id = ""
var guidant_current_result_id = ""
var guidant_current_logic_id = ""


function guidant_pro_popup_open(){
    jQuery("#guidant_popup_pro").show();
}

function guidant_pro_popup_close(){
    jQuery("#guidant_popup_pro").hide();
}

function guidant_hide_all(){

    jQuery("#guidant_reports_list").hide();
    jQuery("#guidant_single_submission").hide();

    jQuery("#guidant_custom_field_create").hide();
    jQuery("#guidant_custom_field_list").hide();
    jQuery("#guidant_fields_update").hide();

    jQuery("#guidant_guides_create").hide();
    jQuery("#guidant_guides_list").hide();
    jQuery("#guidant_guide_update_tab_page_container").hide();

    jQuery("#guidant_results_create").hide();
    jQuery("#guidant_results_update").hide();
    jQuery("#guidant_card_results_list").hide();


    jQuery("#guidant_logic_create").hide();
    jQuery("#guidant_logic_update").hide();
    jQuery("#guidant_guide_logic_list").hide();


    jQuery("#guidant_filters_create").hide();
    jQuery("#guidant_filters_update").hide();
    jQuery("#guidant_filters_list").hide();

    jQuery("#guidant_elements_list").hide();

    jQuery("#guidant_card_tab_page_container").hide();
    jQuery("#guidant_slider_tab_page_container").hide();
    jQuery("#guidant_form_tab_page_container").hide();

    jQuery("#guidant_conditions_create").hide();
    jQuery("#guidant_conditions_update").hide();
    jQuery("#guidant_card_conditions_list").hide();
    jQuery("#guidant_slider_conditions_list").hide();




    jQuery("#guidant_popup_pro").hide();
    jQuery(".guidant-empty").hide();
    jQuery(".guidant-loader").hide();
}








function guidant_image_chooser(input_field_id, img_tag_id){
    'use strict';
    var image_frame;
    if(image_frame){
        image_frame.open();
    }
    image_frame = wp.media({
        title: 'Select Media',
        multiple : false,
        library : {
            type : 'image',
        }
    });
    image_frame.on('close',function() {
        var selection =  image_frame.state().get('selection');
        var gallery_ids = new Array();
        var my_index = 0;
        selection.each(function(attachment) {
            gallery_ids[my_index] = attachment['id'];
            my_index++;
        });
        var ids = gallery_ids.join(",");
        jQuery('#'+input_field_id).val(ids);
        jQuery("#"+img_tag_id).attr("src", selection.models[0].attributes.url);
    });
    image_frame.on('open',function() {
        var selection =  image_frame.state().get('selection');
        var ids = jQuery('#'+input_field_id).val().split(',');
        ids.forEach(function(id) {
            var attachment = wp.media.attachment(id);
            attachment.fetch();
            selection.add( attachment ? [ attachment ] : [] );
        });
    });

    image_frame.open();
}



function guidant_image_cleaner(img_dir, input_field_id, img_tag_id){
    'use strict';

    jQuery('#'+input_field_id).val('0');
    jQuery("#"+img_tag_id).attr("src", img_dir+'/empty_img.png');

}


<!-- TinyMCE Script -->
function enable_tinymce(field_name){
    tinymce.init({
        selector: field_name,
        setup: function (editor) {
            editor.on('change', function () {
                editor.save();
            });
        },
        width: "100%",
        height: 300,
        branding: false,
        menubar:false,

        // ==== Display Full url ===
        relative_urls : false,
        remove_script_host : false,
        convert_urls : true,

        // ==== Display Full url ===
        image_dimensions: false,
        image_class_list: [
            {title: 'Responsive', value: 'img-fluid'}
        ],

        /*plugins: 'link wordcount image lists preview ', */ // required by the code menu item
        toolbar: 'bold italic underline | bullist numlist | link blockquote',

    });

}

