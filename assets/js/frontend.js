
var guidantguide_current_filter_position = []
var guidantguide_submissions = []
var mySlider = []

jQuery(document).ready(function($){
    'use strict';


    jQuery('.guidant_guide').each(function( index ) {
        var this_guide = this
        var unique_id = jQuery(this_guide).data('unique_id')


        guidantguide_current_filter_position[unique_id] = 0
        guidantguide_submissions[unique_id] = {}
        mySlider[unique_id] = {}

        initGuideFilter(unique_id, 0)
        initGuideSubmission(unique_id)
        renderElements(unique_id)
        initGuideActionBtn(unique_id)


    })

});





function initGuideFilter(unique_id, filter_position){
    guidantguide_current_filter_position[unique_id] = filter_position;

    if(jQuery(".guidant_unique_id_"+unique_id).find( ".guidantguide_footer").length > 0){

        if(jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_footer").is(":visible")){
            jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_filter").each(function(i, object) {
                if(i === filter_position){
                    jQuery(this).show();
                }else{
                    jQuery(this).hide()
                }
            })
        }

    }
}

function isCurrentFilterRequiredSubmitted(unique_id)
{
    var is_all_required_field_checked = true;
    var current_filter = jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_filter[data-is_hidden_by_logic='no']")[guidantguide_current_filter_position[unique_id]]
    var filter_id = jQuery( current_filter ).data('filter_id');
    var filter_type = jQuery( current_filter ).data('filter_type');


    if(filter_type === "card"){
        is_all_required_field_checked = false;
        jQuery.each(guidantguide_submissions[unique_id][filter_id], function( index, elements ) {
            if(elements['element_value'] != null){

                is_all_required_field_checked = true

            }
        });
        if(!is_all_required_field_checked){
            /* Animate */
            var view = jQuery(current_filter).find('.guidantguide_filter_cards_container')
            var count = 1;
            var intervalId = setInterval(function() {
                if(view.hasClass( "animate" )){
                    view.removeClass( "animate" )
                }else{
                    view.addClass( "animate" )
                }
                if (count++ === 12) {
                    clearInterval(intervalId);
                }
            }, 50);
            /* Animate */
        }
    }else{
        jQuery(current_filter).find(".guidantguide_element").each(function( index ) {
            var this_element = this

            jQuery.each(guidantguide_submissions[unique_id][filter_id], function( index, elements ) {
                if(elements['element_id'] === jQuery( this_element ).data('element_id') &&
                    jQuery( this_element ).data('required') === "required" &&
                    elements['element_value'] == null){

                    is_all_required_field_checked = false

                    /* Animate */
                    var view = jQuery(this_element)
                    var count = 1;
                    var intervalId = setInterval(function() {
                        if(view.hasClass( "animate" )){
                            view.removeClass( "animate" )
                        }else{
                            view.addClass( "animate" )
                        }
                        if (count++ === 12) {
                            clearInterval(intervalId);
                        }
                    }, 50);
                    /* Animate */

                }
            });

        })
    }



    return is_all_required_field_checked;
}




function initGuideActionBtn(unique_id)
{
    jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_action_btn").hide()


    var total_filter = jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_filter[data-is_hidden_by_logic='no']").get().length


    if(guidantguide_current_filter_position[unique_id] > 0){
        jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_filter[data-is_hidden_by_logic='no']")
            .eq(guidantguide_current_filter_position[unique_id])
            .find('.guidantguide_btn_prev').show()
    }

    if(guidantguide_current_filter_position[unique_id] < total_filter - 1){
        jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_filter[data-is_hidden_by_logic='no']")
            .eq(guidantguide_current_filter_position[unique_id])
            .find('.guidantguide_btn_next').show()
    }

    if(guidantguide_current_filter_position[unique_id] === total_filter - 1){
        jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_filter[data-is_hidden_by_logic='no']")
            .eq(guidantguide_current_filter_position[unique_id])
            .find('.guidantguide_btn_submit').show()
    }


}

function nextGuideFilter(unique_id){

    if(isCurrentFilterRequiredSubmitted(unique_id)){
        jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_filter").hide()
        jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_filter[data-is_hidden_by_logic='no']").each(function(i, object) {
            if(i === guidantguide_current_filter_position[unique_id] + 1){

                guidantguide_current_filter_position[unique_id] = guidantguide_current_filter_position[unique_id] + 1;
                jQuery(this).show();
                initGuideActionBtn(unique_id)
                renderElements(unique_id)
                return false;

            }
        })
    }

}



function previousGuideFilter(unique_id){
    jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_filter").hide()
    jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_filter[data-is_hidden_by_logic='no']").each(function(i, object) {

        if(i === guidantguide_current_filter_position[unique_id] - 1){
            guidantguide_current_filter_position[unique_id] = guidantguide_current_filter_position[unique_id] - 1;
            jQuery(this).show();
            initGuideActionBtn(unique_id)
            renderElements(unique_id)
            return false;
        }
    })
}

function initGuideSubmission(unique_id)
{
    jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_filter[data-is_hidden_by_logic='no']").each(function( index ) {
        var this_filter = this;
        var filter_type = jQuery( this_filter ).data('filter_type');

        var guidantguide_submissions_elements = []
        jQuery(this_filter).find(".guidantguide_element").each(function( index ) {
            var this_element = this
            var guidantguide_submissions_element = {}
            guidantguide_submissions_element ['element_id'] = jQuery( this_element ).data('element_id');
            guidantguide_submissions_element ['element_type'] = filter_type;
            guidantguide_submissions_element ['element_value'] = null;
            guidantguide_submissions_element ['element_required'] = jQuery( this_element ).data('required');
            guidantguide_submissions_elements.push(guidantguide_submissions_element)
        });

        guidantguide_submissions[unique_id][jQuery( this ).data('filter_id')] = guidantguide_submissions_elements
    });
}


function logicGuideHideShow(unique_id, filter_to_hide_str, checked)
{


    if(filter_to_hide_str.toString().length > 1){
        var filter_to_hide = filter_to_hide_str.toString().split(", ");
        for (var i = 0; i < filter_to_hide.length; i++) {

            if(checked){
                jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_filter[data-filter_id='"+filter_to_hide[i]+"']").attr('data-is_hidden_by_logic', 'yes')
            }else{
                jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_filter[data-filter_id='"+filter_to_hide[i]+"']").attr('data-is_hidden_by_logic', 'no')
            }

        }
    }


}


function renderElements(unique_id)
{
    jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_filter").each(function( index ) {
        var this_filter = this;
        var filter_id = jQuery( this ).data('filter_id');
        var filter_type = jQuery( this ).data('filter_type');
        var card_type = jQuery( this ).data('card_type');


        jQuery(this_filter).find(".guidantguide_element").each(function( index ) {
            var this_element = this
            var input_type = jQuery( this_element ).data('input_type');



            if(filter_type === "card" && card_type === "radio"){
                jQuery(this_element).unbind('click');
                jQuery(this_element).click(function() {
                    jQuery(this_filter).find(".guidantguide_element").removeClass('active')
                    jQuery(this_element).addClass('active')


                    /* === Conditional Logic ==== */
                    jQuery(this_filter).find(".guidantguide_element").each(function( index ) {
                        var this_element_for_logic = this
                        if (jQuery(this_element_for_logic).hasClass('active')) {
                            logicGuideHideShow(unique_id, jQuery(this_element_for_logic).data('filter_to_hide'), true)
                            return false;
                        } else {
                            logicGuideHideShow(unique_id, jQuery(this_element_for_logic).data('filter_to_hide'), false)
                        }
                    })

                    /* === Update Submission Array Values ==== */
                    jQuery.each(guidantguide_submissions[unique_id][filter_id], function( index, elements ) {
                        if(elements['element_id'] === jQuery( this_element ).data('element_id')){
                            elements['element_value'] = 1;
                            //logicGuideHideShow(unique_id, jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_element[data-element_id='"+elements['element_id']+"']").data('filter_to_hide'), true)
                        }else{
                            elements['element_value'] = null;
                            //logicGuideHideShow(unique_id, jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_element[data-element_id='"+elements['element_id']+"']").data('filter_to_hide'), false)
                        }
                    });
                    /* === Update Submission Array Values ==== */
                });
            }




            if(filter_type === "card" && card_type === "checkbox"){
                jQuery(this_element).unbind('click');
                jQuery(this_element).click(function() {
                    jQuery(this_element).toggleClass('active')

                    /* === Conditional Logic ==== */
                    jQuery(this_filter).find(".guidantguide_element").each(function( index ) {
                        var this_element_for_logic = this
                        if (jQuery(this_element_for_logic).hasClass('active')) {
                            logicGuideHideShow(unique_id, jQuery(this_element_for_logic).data('filter_to_hide'), true)
                            return false;
                        } else {
                            logicGuideHideShow(unique_id, jQuery(this_element_for_logic).data('filter_to_hide'), false)
                        }
                    })

                    /* === Update Submission Array Values ==== */
                    jQuery.each(guidantguide_submissions[unique_id][filter_id], function( index, elements ) {
                        if(elements['element_id'] === jQuery( this_element ).data('element_id')){
                            if(jQuery(this_element).hasClass('active')){
                                elements['element_value'] = 1;
                                //logicGuideHideShow(unique_id, jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_element[data-element_id='"+elements['element_id']+"']").data('filter_to_hide'), true)
                            }else{
                                elements['element_value'] = null;
                                //logicGuideHideShow(unique_id, jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_element[data-element_id='"+elements['element_id']+"']").data('filter_to_hide'), false)
                            }

                        }
                    });
                    /* === Update Submission Array Values ==== */
                });
            }



            if(filter_type === "slider"){
                var slider_type = jQuery( this_element ).data('slider_type');
                var element_id = jQuery( this_element ).data('element_id');
                var min_range = jQuery( this_element ).data('min_range');
                var max_range = jQuery( this_element ).data('max_range');
                var slider_step = jQuery( this_element ).data('slider_step');
                var slider_prefix_text = jQuery( this_element ).data('slider_prefix_text');
                var slider_postfix_text = jQuery( this_element ).data('slider_postfix_text');

                if(mySlider[element_id]){
                    mySlider[element_id].destroy();
                }
                var oldValueArr = []
                jQuery.each(guidantguide_submissions[unique_id][filter_id], function( index, elements ) {
                    if(elements['element_id'] === element_id){
                        if(elements['element_value'] != null){
                            var oldArrData = elements['element_value'].toString().split(",");
                            if(oldArrData.length>1){
                                oldValueArr.push(parseInt(oldArrData[0]))
                                oldValueArr.push(parseInt(oldArrData[1]))
                            }else{
                                oldValueArr.push(parseInt(oldArrData[0]))
                            }
                        }

                    }
                });
                mySlider[element_id] = new rSlider({
                    target: '#guidant_slider_'+element_id, values: {min: min_range, max: max_range},
                    slider_prefix : slider_prefix_text, slider_postfix: slider_postfix_text,
                    set: oldValueArr, step: slider_step, scale: false, labels: false,
                    range: slider_type === "range",
                    onChange: function (values) {
                        /* === Update Submission Array Values ==== */
                        jQuery.each(guidantguide_submissions[unique_id][filter_id], function( index, elements ) {
                            if(elements['element_id'] === jQuery( this_element ).data('element_id')){
                                elements['element_value'] = values;
                            }
                        });
                        /* === Update Submission Array Values ==== */
                    }
                });
            }






            if(filter_type === "form" && input_type === "checkbox"){
                jQuery(this_element).find(".guidantguide_form_checkbox_radio_single").each(function( index ) {
                    var this_option = this
                    jQuery(this_option).unbind('click');
                    jQuery(this_option).click(function() {
                        jQuery(this_option).toggleClass('active')
                        /* === Update Submission Array Values ==== */
                        jQuery.each(guidantguide_submissions[unique_id][filter_id], function( index, elements ) {
                            if(elements['element_id'] === jQuery( this_element ).data('element_id')){

                                var is_anything_selected = false;
                                elements['element_value'] = null;
                                jQuery(this_element).find(".guidantguide_form_checkbox_radio_single").each(function( index ) {
                                    if(jQuery(this).hasClass('active')){
                                        is_anything_selected = true;

                                       if( elements['element_value'] != null ){
                                           elements['element_value'] = elements['element_value'] + "[:::]" + jQuery( this ).data('value');
                                       }else{
                                           elements['element_value'] = jQuery( this ).data('value');
                                       }


                                    }
                                })
                                if(!is_anything_selected) elements['element_value'] = null

                            }
                        });
                        /* === Update Submission Array Values ==== */
                    })
                })
            }




            if(filter_type === "form" && input_type === "radio"){
                jQuery(this_element).find(".guidantguide_form_checkbox_radio_single").each(function( index ) {
                    var this_option = this
                    jQuery(this_option).unbind('click');
                    jQuery(this_option).click(function() {
                        jQuery(this_element).find(".guidantguide_form_checkbox_radio_single").removeClass('active')
                        jQuery(this_option).toggleClass('active')
                        /* === Update Submission Array Values ==== */
                        jQuery.each(guidantguide_submissions[unique_id][filter_id], function( index, elements ) {
                            if(elements['element_id'] === jQuery( this_element ).data('element_id')){

                                var is_anything_selected = false
                                jQuery(this_element).find(".guidantguide_form_checkbox_radio_single").each(function( index ) {
                                    if(jQuery(this).hasClass('active')){
                                        is_anything_selected = true;
                                        elements['element_value'] = jQuery( this ).data('value');
                                    }
                                })
                                if(!is_anything_selected) elements['element_value'] = null

                            }
                        });
                        /* === Update Submission Array Values ==== */
                    })
                })
            }




            if(filter_type === "form" && input_type === "input"){
                jQuery(this_element).unbind('input');
                jQuery(this_element).on('input',function(e){



                    var input_field_type = jQuery( this_element ).data('input_field_type');
                    var latest_input_data = jQuery(this_element).find("input").val();


                    /* === Update Submission Array Values ==== */
                    jQuery.each(guidantguide_submissions[unique_id][filter_id], function( index, elements ) {
                        if(elements['element_id'] === jQuery( this_element ).data('element_id')){


                            if(input_field_type === "text"){
                                elements['element_value'] = latest_input_data;
                            }else if(input_field_type === "password"){
                                elements['element_value'] = latest_input_data;
                            }else if(input_field_type === "email"){
                                if(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(latest_input_data)){
                                    elements['element_value'] = latest_input_data;
                                }else{
                                    elements['element_value'] = null
                                }
                            }else if(input_field_type === "number"){
                                if(/^[0-9.]*$/.test(latest_input_data)){
                                    elements['element_value'] = latest_input_data;
                                }else{
                                    elements['element_value'] = null
                                }
                            }else if(input_field_type === "date"){
                                if(/^(\d{4})-(\d{1,2})-(\d{1,2})$/.test(latest_input_data)){
                                    elements['element_value'] = latest_input_data;
                                }else{
                                    elements['element_value'] = null
                                }
                            }else if(input_field_type === "time"){
                                if(/^(\d{1,2}):(\d{1,2})$/.test(latest_input_data)){
                                    elements['element_value'] = latest_input_data;
                                }else{
                                    elements['element_value'] = null
                                }
                            }



                        }
                    });
                    /* === Update Submission Array Values ==== */
                });
            }


            if(filter_type === "form" && input_type === "textarea"){
                jQuery(this_element).unbind('input');
                jQuery(this_element).on('input',function(e){
                    /* === Update Submission Array Values ==== */
                    jQuery.each(guidantguide_submissions[unique_id][filter_id], function( index, elements ) {
                        if(elements['element_id'] === jQuery( this_element ).data('element_id')){
                            elements['element_value'] = jQuery(this_element).find("textarea").val();
                        }
                    });
                    /* === Update Submission Array Values ==== */
                });
            }

            if(filter_type === "form" && input_type === "select"){
                jQuery(this_element).unbind('change');
                jQuery(this_element).on('change',function(e){
                    /* === Update Submission Array Values ==== */
                    jQuery.each(guidantguide_submissions[unique_id][filter_id], function( index, elements ) {
                        if(elements['element_id'] === jQuery( this_element ).data('element_id')){
                            elements['element_value'] = jQuery(this_element).find("select").val();
                        }
                    });
                    /* === Update Submission Array Values ==== */
                });
            }



        })



    })
}





function guidant_guide_submission(unique_id, guide_id){
    'use strict';

    if(isCurrentFilterRequiredSubmitted(unique_id)){
        jQuery(".guidant_unique_id_"+unique_id+" #guidantguide_loader_container").show();
        jQuery(".guidant_unique_id_"+unique_id+" .guidantguide_filters_container").hide();
        jQuery(".guidant_unique_id_"+unique_id+" #guidantguide_empty_container").hide();
        jQuery(".guidant_unique_id_"+unique_id+" #guidantguide_no_result_container").hide();
        jQuery(".guidant_unique_id_"+unique_id+" #guidantguide_best_result_container").hide();
        jQuery(".guidant_unique_id_"+unique_id+" #guidant_front_guide_result_block").hide();
        jQuery(".guidant_unique_id_"+unique_id+" #guidant_front_guide_result_block .guidant_result_container").empty()

        var post_data = {
            'action': 'guidant_guide_submission',
            'security' : guidant_guide_submission_object.security,
            'guide_id' : guide_id,
            'submissions': encodeURIComponent(JSON.stringify(guidantguide_submissions[unique_id])),
        };
        jQuery.ajax({
            url: guidant_guide_submission_object.ajaxurl,
            type: "POST",
            data: post_data,
            success: function (data) {
                //console.log(data)
                var obj = JSON.parse(data);

                if(obj.status == "true"){

                    jQuery(".guidant_unique_id_"+unique_id+" #guidantguide_loader_container").hide();

                    if(obj.hasOwnProperty("best_result")){
                        if(obj.best_result.toString().length > 5){
                            jQuery(".guidant_unique_id_"+unique_id+" #guidantguide_best_result_container").show();
                            jQuery(".guidant_unique_id_"+unique_id+" #guidantguide_best_result_container .guidant_result_container").append(obj.best_result);
                        }else{
                            jQuery(".guidant_unique_id_"+unique_id+" #guidantguide_empty_container").show();
                        }
                    }else{
                        jQuery(".guidant_unique_id_"+unique_id+" #guidantguide_no_result_container").show();
                    }


                    if(obj.hasOwnProperty("other_results")){
                        if(obj.other_results.toString().length > 5){
                            jQuery(".guidant_unique_id_"+unique_id+" #guidant_front_guide_result_block").show();
                            jQuery(".guidant_unique_id_"+unique_id+" #guidant_front_guide_result_block .guidant_result_container").append(obj.other_results);
                        }
                    }

                }
            }
        })
    }


}
