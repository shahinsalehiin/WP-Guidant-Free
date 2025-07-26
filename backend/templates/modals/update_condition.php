<div id="guidant_conditions_update" style="display: none;">
    <div class="guidant-modal">
        <div class="guidant-modalheader">
            <h3> Modify Condition</h3>
            <span class="dashicons dashicons-no-alt target" onclick="guidant_condition_update_close('<?php echo esc_attr(GUIDANT_URL); ?>')"></span>
        </div>
        <div class="guidant-modalbody">
            <div class="guidant-modalform">
                <div class="guidant_form_group">
                    <label for="guidant-fdes"> Attribute </label>
                    <select id="guidant_condition_update_attribute" style="min-width: 250px;">
                        <option>Select</option>
                    </select>
                </div>

                <div class="guidant_form_group">
                    <label for="guidant-fdes"> Matching Type </label>
                    <select id="guidant_condition_update_matching_type">

                    </select>
                </div>



                <div id="guidant_condition_update_fields_for_card" style="display: none;">
                    <div class="guidant_form_group">
                        <label for="guidant-fdes"> Value Selection </label>
                        <select id="guidant_condition_update_value_selection">
                            <option value="">Select</option>
                            <option value="auto">From WordPress Settings</option>
                            <option value="manual">Manual Entry</option>
                        </select>
                    </div>

                    <div id="guidant_condition_update_value_auto_container" style="display: none;">
                        <div class="guidant_form_group">
                            <label for="guidant-fdes"> Value </label>
                            <select id="guidant_condition_update_value_auto" style="min-width: 250px;">
                                <option>Select</option>
                            </select>
                        </div>
                    </div>

                    <div id="guidant_condition_update_value_manual_container" style="display: none;">
                        <div class="guidant_form_group">
                            <label for="guidant-fdes"> Value </label>
                            <input type="text" id="guidant_condition_update_value_manual" placeholder="Add manual value here...">
                        </div>
                    </div>
                </div>



            </div>
            <button class="guidant-btn guidant_condition_update_btn" onclick="guidant_conditions_update('<?php echo esc_attr(GUIDANT_URL); ?>')"> Update</button>
        </div>
    </div>
</div>