<div id="guidant_conditions_create" style="display: none;">
    <div class="guidant-modal">
        <div class="guidant-modalheader">
            <h3> Create a New Condition</h3>
            <span class="dashicons dashicons-no-alt target" onclick="guidant_conditions_create_close('<?php echo esc_attr(GUIDANT_URL); ?>')"></span>
        </div>
        <div class="guidant-modalbody">
            <div class="guidant-modalform">
                <div class="guidant_form_group">
                    <label for="guidant-fdes"> Attribute </label>
                    <select id="guidant_condition_create_attribute">
                        <option value="">Select</option>
                    </select>
                    <p class="guidant_field_error" id="guidant_condition_create_attribute_empty">Attribute Not Selected</p>
                </div>




                <div class="guidant_form_group">
                    <label for="guidant-fdes"> Matching Type </label>
                    <select id="guidant_condition_create_matching_type">

                    </select>
                    <p class="guidant_field_error" id="guidant_condition_create_matching_type_empty">Matching Type Not Selected</p>
                </div>

                <div id="guidant_condition_create_fields_for_card" style="display: none;">
                    <div class="guidant_form_group">
                        <label for="guidant-fdes"> Value Selection </label>
                        <select id="guidant_condition_create_value_selection">
                            <option value="">Select</option>
                            <option value="auto">From WordPress Settings</option>
                            <option value="manual">Manual Entry</option>
                        </select>
                    </div>

                    <div id="guidant_condition_create_value_auto_container" style="display: none;">
                        <div class="guidant_form_group">
                            <label for="guidant-fdes"> Value </label>
                            <select id="guidant_condition_create_value_auto">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>

                    <div id="guidant_condition_create_value_manual_container" style="display: none;">
                        <div class="guidant_form_group">
                            <label for="guidant-fdes"> Value </label>
                            <input type="text" id="guidant_condition_create_value_manual" placeholder="Add manual value here...">
                        </div>
                    </div>
                </div>





            </div>
            <button class="guidant-btn guidant_conditions_create_btn" onclick="guidant_conditions_create('<?php echo esc_attr(GUIDANT_URL); ?>')"> Create</button>
        </div>
    </div>
</div>