<div id="guidant_card_tab_page_container" style="display: none;">
    <div class="guidant-body-title">
        <h3> Card Settings </h3>
        <button class="guidant-btn guidant_card_update_btn" onclick="guidant_card_tab_page_save('<?php echo esc_attr(GUIDANT_URL); ?>')">Save Changes</button>
    </div>
    <div class="guidant_loader_block guidant-loader" style="display: none;">
        <div class='loader'></div>
    </div>
    <div class="guidant-card-setting">
        <div class="guidant_tab_menu">
            <ul>
                <li> Card Settings </li>
                <li> Card Conditions </li>
            </ul>
        </div>
        <div class="guidant_tab_body">

            <div class="guidant_tab_item">
                <div class="guidant_form_group">
                    <label for="guidant-gname"> Card Label</label>
                    <input type="text" id="guidant_card_tab_page_label" placeholder="Text to be displayed inside card">
                </div>
                <!--<div class="guidant_form_group">
                    <label for="guidant-gtitle"> Card Image</label>
                    <input type="hidden" id="guidant_card_tab_page_image">
                    <img width="60px" height="60px" id="guidant_card_tab_page_image_shower" >
                    <button onclick="guidant_image_chooser('guidant_card_tab_page_image', 'guidant_card_tab_page_image_shower')">Choose Image</button></br>
                </div>-->


                <div class="guidant_form_group">
                    <label for="guidant-cardfilset-imglab"> Card Image</label>
                    <input type="hidden" id="guidant_card_tab_page_image">
                    <div class="guidant-img-field-container">
                        <img id="guidant_card_tab_page_image_shower"/>
                        <span onclick="guidant_image_chooser('guidant_card_tab_page_image', 'guidant_card_tab_page_image_shower')"> Select Image</span>
                        <span onclick="guidant_image_cleaner('<?php echo GUIDANT_IMG_DIR; ?>', 'guidant_card_tab_page_image', 'guidant_card_tab_page_image_shower')"> Clear Image</span>
                    </div>
                </div>

                <div class="guidant_form_group">
                    <label for="guidant-fdes"> Condition Behavior </label>
                    <select id="guidant_card_tab_page_behavior">
                        <option value="or">OR - Any of the conditions need to be matched</option>
                        <option value="and">AND - All conditions need to be matched</option>
                    </select>
                </div>
            </div>

            <div class="guidant_tab_item">

                <div id="guidant_card_conditions_list" style="display: none;">
                    <div class="guidant_loader_block guidant-loader" style="display: none;">
                        <div class='loader'></div>
                    </div>
                    <div class="guidant_empty_style_2 guidant-empty">
                        <h3>No condition created yet</h3>
                        <button class="guidant-btn" onclick="guidant_conditions_create_show('<?php echo esc_attr(GUIDANT_URL); ?>')">Create New Condition</button>
                    </div>
                    <div id="guidant_card_conditions_list_items">
                        <!--<div class="guidant_card_style_2">
                        <p> Test Card One </p>
                        <div class="guidant_card_action">
                            <a href="#" class="guidant-edit-icon"><img src="<?php /*echo GUIDANT_FRONT_IMG_DIR . "/edit.png" */?>" alt="icon"/> </a>
                            <a href="#" class="guidant-trash-icon"><img src="<?php /*echo GUIDANT_FRONT_IMG_DIR . "/trash.png" */?>" alt="icon"/> </a>
                        </div>
                    </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>