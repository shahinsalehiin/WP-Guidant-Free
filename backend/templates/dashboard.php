<div class="guidant-main">
    <div class="guidant-container">

        <?php include GUIDANT_PATH . "backend/templates/views/header.php"; ?>

        <div class="guidant-breadcrumb-container">
            <ul class="guidant-breadcrumb"></ul>
        </div>

        <div class="guidant-body-wrap">

            <?php include GUIDANT_PATH . "backend/templates/views/guide.php"; ?>
            <?php include GUIDANT_PATH . "backend/templates/views/guide_update.php"; ?>
            <?php include GUIDANT_PATH . "backend/templates/views/filter.php"; ?>
            <?php include GUIDANT_PATH . "backend/templates/views/element.php"; ?>
            <?php include GUIDANT_PATH . "backend/templates/views/card.php"; ?>
            <?php include GUIDANT_PATH . "backend/templates/views/slider.php"; ?>
            <?php include GUIDANT_PATH . "backend/templates/views/form.php"; ?>
            <?php include GUIDANT_PATH . "backend/templates/views/custom_fields.php"; ?>
            <?php include GUIDANT_PATH . "backend/templates/views/reports.php"; ?>

        </div>
    </div>


    <?php include GUIDANT_PATH . "backend/templates/modals/create_field.php"; ?>
    <?php include GUIDANT_PATH . "backend/templates/modals/update_field.php"; ?>
    <?php include GUIDANT_PATH . "backend/templates/modals/create_condition.php"; ?>
    <?php include GUIDANT_PATH . "backend/templates/modals/update_condition.php"; ?>
    <?php include GUIDANT_PATH . "backend/templates/modals/create_result.php"; ?>
    <?php include GUIDANT_PATH . "backend/templates/modals/update_result.php"; ?>
    <?php include GUIDANT_PATH . "backend/templates/modals/single_submission.php"; ?>
    <?php include GUIDANT_PATH . "backend/templates/modals/create_logic.php"; ?>
    <?php include GUIDANT_PATH . "backend/templates/modals/update_logic.php"; ?>
    <?php include GUIDANT_PATH . "backend/templates/modals/popup_pro.php"; ?>

</div>


<script type="text/javascript">

    jQuery(document).ready(function($){
        'use strict';


        var host = "<?php echo GUIDANT_URL; ?>";

        $( "#guidant_filters_create_filter_type" ).change(function() {
            if($(this).val() == "card"){
                $("#guidant_filters_create_card_type_container").show()
            }else if($(this).val() == "slider"){
                $("#guidant_filters_create_card_type_container").hide()
            }else if($(this).val() == "form"){
                $("#guidant_filters_create_card_type_container").hide()
            }
        });

        $( "#guidant_filters_update_filter_type" ).change(function() {
            if($(this).val() == "card"){
                $("#guidant_filters_update_card_type_container").show()
            }else if($(this).val() == "slider"){
                $("#guidant_filters_update_card_type_container").hide()
            }else if($(this).val() == "form"){
                $("#guidant_filters_update_card_type_container").hide()
            }
        });

        $( "#guidant_condition_create_value_selection" ).change(function() {
            if($(this).val() == "auto"){
                $("#guidant_condition_create_value_auto_container").show()
                $("#guidant_condition_create_value_manual_container").hide()
                jQuery('.select2-container').css('width','100%');
            }else if($(this).val() == "manual"){
                $("#guidant_condition_create_value_auto_container").hide()
                $("#guidant_condition_create_value_manual_container").show()
            }
        });


        $( "#guidant_condition_update_value_selection" ).change(function() {
            if($(this).val() == "auto"){
                $("#guidant_condition_update_value_auto_container").show()
                $("#guidant_condition_update_value_manual_container").hide()
                jQuery('.select2-container').css('width','100%');
            }else if($(this).val() == "manual"){
                $("#guidant_condition_update_value_auto_container").hide()
                $("#guidant_condition_update_value_manual_container").show()
            }
        });


        $( "#guidant_form_tab_page_input_type" ).change(function() {
            if($(this).val() == "input"){
                $("#guidant_form_tab_page_input_field_type_container").show()
                $("#guidant_form_tab_page_input_type_select_container").hide()
                $("#guidant_form_tab_page_input_type_checkbox_container").hide()
                $("#guidant_form_tab_page_input_type_radio_container").hide()
            }else if($(this).val() == "select"){
                $("#guidant_form_tab_page_input_type_select_container").show()
                $("#guidant_form_tab_page_input_type_checkbox_container").hide()
                $("#guidant_form_tab_page_input_type_radio_container").hide()
                $("#guidant_form_tab_page_input_field_type_container").hide()
            }else if($(this).val() == "checkbox"){
                $("#guidant_form_tab_page_input_type_select_container").hide()
                $("#guidant_form_tab_page_input_type_checkbox_container").show()
                $("#guidant_form_tab_page_input_type_radio_container").hide()
                $("#guidant_form_tab_page_input_field_type_container").hide()
            }else if($(this).val() == "radio"){
                $("#guidant_form_tab_page_input_type_select_container").hide()
                $("#guidant_form_tab_page_input_type_checkbox_container").hide()
                $("#guidant_form_tab_page_input_field_type_container").hide()
                $("#guidant_form_tab_page_input_type_radio_container").show()
            }else if($(this).val() == "textarea"){
                $("#guidant_form_tab_page_input_type_select_container").hide()
                $("#guidant_form_tab_page_input_type_checkbox_container").hide()
                $("#guidant_form_tab_page_input_type_radio_container").hide()
                $("#guidant_form_tab_page_input_field_type_container").hide()
            }
        });




        $( "#guidant_guides_update_display_result" ).change(function() {
            if($(this).val() == "true"){
                $("#guidant_guides_update_display_result_container").show()
                $("#guidant_guides_update_no_result_container").hide()
            }else{
                $("#guidant_guides_update_display_result_container").hide()
                $("#guidant_guides_update_no_result_container").show()
            }
        });

        $( "#guidant_reports_list_guide_items" ).change(function() {
            guidant_reports_list(host, $(this).val(), 1)
        });




        $( "#guidant_result_create_attribute" ).change(function() {
            if(jQuery.inArray($(this).val(), ["post_permalink", "post_thumbnail"]) !== -1){
                $("#guidant_results_create_prefix_container").hide()
            }else{
                $("#guidant_results_create_prefix_container").show()
            }

            if(jQuery.inArray($(this).val(), ["post_permalink"]) !== -1){
                $("#guidant_results_create_button_container").show()
            }else{
                $("#guidant_results_create_button_container").hide()
            }

            if(jQuery.inArray($(this).val(), ["post_thumbnail"]) !== -1){
                $("#guidant_results_create_image_container").show()
            }else{
                $("#guidant_results_create_image_container").hide()
            }
        });


        $( "#guidant_result_update_attribute" ).change(function() {
            if(jQuery.inArray($(this).val(), ["post_permalink", "post_thumbnail"]) !== -1){
                $("#guidant_results_update_prefix_container").hide()
            }else{
                $("#guidant_results_update_prefix_container").show()
            }

            if(jQuery.inArray($(this).val(), ["post_permalink"]) !== -1){
                $("#guidant_results_update_button_container").show()
            }else{
                $("#guidant_results_update_button_container").hide()
            }

            if(jQuery.inArray($(this).val(), ["post_thumbnail"]) !== -1){
                $("#guidant_results_update_image_container").show()
            }else{
                $("#guidant_results_update_image_container").hide()
            }
        });



        $( ".pro_field" ).click(function(e) {
            e.preventDefault()
            $("#guidant_popup_pro").show();
        });

        $( "#guidant_popup_pro .close" ).click(function(e) {
            $("#guidant_popup_pro").hide();
        });



        // If an event gets to the body
        $("body").click(function(){
            $("#guidant_popup_pro").hide();
        });

        // Prevent events from getting pass .popup
        $(".pro_field").click(function(e){
            e.stopPropagation();
        });
        // Prevent events from getting pass .popup
        $(".guidant_modal_pro").click(function(e){
            e.stopPropagation();
        });




        enable_tinymce('#guidant_guides_create_guide_description')
        enable_tinymce('#guidant_guides_update_guide_description')
        enable_tinymce('#guidant_filters_create_filter_description')
        enable_tinymce('#guidant_filters_update_filter_description')


        guidant_guides_list(host);

    });

</script>