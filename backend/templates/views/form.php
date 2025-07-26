<div id="guidant_form_tab_page_container" style="display: none;">
    <div class="guidant-body-title">
        <h3> Form Element Settings </h3>

        <div style="display: flex;">
            <button style="margin-right: 12px" class="guidant-btn-light-img" onclick="guidant_form_back_to_elements('<?php echo esc_attr(GUIDANT_URL); ?>')"> <img src="<?php echo esc_attr(GUIDANT_IMG_DIR); ?>/guidant-back-icon.svg" > Back to All Elements</button>
            <button class="guidant-btn guidant_card_update_btn" onclick="guidant_form_tab_page_save('<?php echo esc_attr(GUIDANT_URL); ?>')">Save Changes</button>
        </div>
    </div>
    <div class="guidant_loader_block guidant-loader" style="display: none;">
        <div class='loader'></div>
    </div>
    <div class="guidant-card-setting">
        <div class="guidant_tab_menu">
            <ul>
                <li> Element Settings </li>
            </ul>
        </div>
        <div class="guidant_tab_body">

            <div class="guidant_tab_item">
                <div class="guidant_form_group">
                    <label for="guidant_form_tab_page_element_label"> Element Label</label>
                    <input type="text" id="guidant_form_tab_page_element_label" placeholder="Text to be displayed as label of the element">
                </div>

                <div class="guidant_form_group">
                    <label for="guidant_form_tab_page_input_type"> Element Type </label>
                    <select id="guidant_form_tab_page_input_type">
                        <option value="input">Input Field</option>
                        <option value="select">Select Field</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="radio">Radio Field</option>
                        <option value="textarea">Textarea</option>
                    </select>
                </div>


                <div id="guidant_form_tab_page_input_field_type_container" style="display: none;">
                    <div class="guidant_form_group">
                        <label for="guidant_form_tab_page_input_field_type"> Input Type </label>
                        <select id="guidant_form_tab_page_input_field_type">
                            <option value="text">Text</option>
                            <option value="number">Number</option>
                            <option value="email">Email</option>
                            <option value="password">Password</option>
                            <option value="date">Date</option>
                            <option value="time">Time</option>
                        </select>
                    </div>
                </div>


                <div id="guidant_form_tab_page_input_type_select_container" style="display: none;">
                    <div class="guidant_form_group">
                        <label for="guidant-gname"> Select Field Options</label>
                    </div>
                    <div id="guidant_form_tab_page_select_options_container"></div>
                    <button class="guidant-btn-sm" style="margin-top: 12px;" onclick="guidant_form_tab_page_add_select_option(``)">Add Option</button>
                </div>

                <div id="guidant_form_tab_page_input_type_checkbox_container" style="display: none;">
                    <div class="guidant_form_group">
                        <label for="guidant-gname"> Checkbox Items</label>
                    </div>
                    <div id="guidant_form_tab_page_checkbox_options_container"></div>
                    <button class="guidant-btn-sm" style="margin-top: 12px;" onclick="guidant_form_tab_page_add_checkbox_option(``)">Add Item</button>
                </div>

                <div id="guidant_form_tab_page_input_type_radio_container" style="display: none;">
                    <div class="guidant_form_group">
                        <label for="guidant-gname"> Radio Items</label>
                    </div>
                    <div id="guidant_form_tab_page_radio_options_container"></div>
                    <button class="guidant-btn-sm" style="margin-top: 12px;" onclick="guidant_form_tab_page_add_radio_option(``)">Add Item</button>
                </div>


                <div class="guidant_form_group">
                    <label for="guidant_form_tab_page_element_required"> Is field required? </label>
                    <select id="guidant_form_tab_page_element_required">
                        <option value="required">Required</option>
                        <option value="optional">Optional</option>
                    </select>
                </div>

                <div class="guidant_form_group">
                    <label for="guidant_form_tab_page_element_label"> Custom Class</label>
                    <input type="text" id="guidant_form_tab_page_element_class" pattern="[^.]" placeholder="Custom Class Names.  Ex: class1 class2">
                </div>


            </div>
        </div>
    </div>
</div>