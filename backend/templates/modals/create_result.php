<div id="guidant_results_create" style="display: none;">
    <div class="guidant-modal">
        <div class="guidant-modalheader">
            <h3> Create a New Result Attribute</h3>
            <span class="dashicons dashicons-no-alt target" onclick="guidant_results_create_close('<?php echo esc_attr(GUIDANT_URL); ?>')"></span>
        </div>
        <div class="guidant-modalbody">
            <div class="guidant-modalform">
                <div class="guidant_form_group">
                    <label for="guidant-fdes"> Attribute </label>
                    <select id="guidant_result_create_attribute">
                        <option value="">Select</option>
                    </select>
                    <p class="guidant_field_error" id="guidant_result_create_attribute_empty">Attribute Can't be Empty</p>
                </div>



                <div id="guidant_results_create_prefix_container" style="display: none;">
                    <div class="guidant_form_group">
                        <label for="guidant-fdes"> Prefix (Optional) </label>
                        <input type="text" id="guidant_result_create_prefix" placeholder="">
                    </div>
                </div>

                <div id="guidant_results_create_image_container" style="display: none;">
                    <div class="guidant_form_group">
                        <label for="guidant-fdes"> Image Height (px) </label>
                        <input type="number" id="guidant_result_create_image_height" value="200">
                    </div>
                </div>


                <div id="guidant_results_create_button_container" style="display: none;">
                    <div class="guidant_form_group">
                        <label for="guidant-fdes"> Button Text </label>
                        <input type="text" id="guidant_result_create_button_text" value="View">
                    </div>
                </div>


            </div>
            <button class="guidant-btn guidant_result_create_btn" onclick="guidant_result_create('<?php echo esc_attr(GUIDANT_URL); ?>')"> Create</button>
        </div>
    </div>
</div>