<div id="guidant_logic_create" style="display: none;">
    <div class="guidant-modal">
        <div class="guidant-modalheader">
            <h3> Create a New Logic</h3>
            <span class="dashicons dashicons-no-alt target" onclick="guidant_logic_create_close('<?php echo esc_attr(GUIDANT_URL); ?>')"></span>
        </div>
        <div class="guidant-modalbody">
            <div class="guidant-modalform">
                <div class="guidant_form_group">
                    <label for="guidant-fdes">Choose Element (Card)</label>
                    <select id="guidant_logic_create_selected_element">
                        <option value="">Select</option>
                    </select>
                    <p class="guidant_field_error" id="guidant_logic_create_selected_element_empty">Element Not Selected</p>
                </div>



                <div class="guidant_form_group">
                    <label for="guidant-fdes"> Selection Method </label>
                    <select id="guidant_logic_create_card_selection_method">
                        <option value="selected">Selected</option>
                    </select>
                </div>


                <div class="guidant_form_group">
                    <label for="guidant-fdes">Filter to Hide</label>
                    <select id="guidant_logic_create_selected_filter_to_hide">
                        <option value="">Select</option>
                    </select>
                    <p class="guidant_field_error" id="guidant_logic_create_selected_filter_to_hide_empty">Filter Not Selected</p>
                </div>



            </div>
            <button class="guidant-btn guidant_logic_create_btn" onclick="guidant_logic_create('<?php echo esc_attr(GUIDANT_URL); ?>')"> Create</button>
        </div>
    </div>
</div>