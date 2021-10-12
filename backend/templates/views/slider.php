<div id="guidant_slider_tab_page_container" style="display: none;">
    <div class="guidant-body-title">
        <h3> Slider Settings </h3>
        <button class="guidant-btn guidant_slider_update_btn" onclick="guidant_slider_tab_page_save('<?php echo esc_attr(GUIDANT_URL); ?>')">Save Changes</button>
    </div>
    <div class="guidant_loader_block guidant-loader" style="display: none;">
        <div class='loader'></div>
    </div>
    <div class="guidant-card-setting">
        <div class="guidant_tab_menu">
            <ul>
                <li> Slider Settings </li>
                <li> Slider Conditions </li>
            </ul>
        </div>
        <div class="guidant_tab_body">

            <div class="guidant_tab_item">

                <div class="guidant_form_group">
                    <label for="guidant_slider_tab_page_slider_label"> Slider Label</label>
                    <input type="text" id="guidant_slider_tab_page_slider_label" placeholder="Text to be displayed above slider">
                </div>

                <div class="guidant_form_group">
                    <label for="guidant-fdes"> Slider Type </label>
                    <select id="guidant_slider_tab_page_slider_type">
                        <option value="single">Single</option>
                        <option value="range">Range</option>
                    </select>
                </div>

                <div class="guidant_form_group">
                    <label for="guidant-cardfilset-imglab"> Slider Image</label>
                    <input type="hidden" id="guidant_slider_tab_page_image">
                    <div class="guidant-img-field-container">
                        <img id="guidant_slider_tab_page_image_shower"/>
                        <span onclick="guidant_image_chooser('guidant_slider_tab_page_image', 'guidant_slider_tab_page_image_shower')"> Select Image</span>
                        <span onclick="guidant_image_cleaner('<?php echo GUIDANT_IMG_DIR; ?>', 'guidant_slider_tab_page_image', 'guidant_slider_tab_page_image_shower')"> Clear Image</span>
                    </div>
                </div>

                <div class="guidant_form_group">
                    <label for="guidant_slider_tab_page_min_range"> Minimum Range</label>
                    <input type="number" id="guidant_slider_tab_page_min_range">
                </div>

                <div class="guidant_form_group">
                    <label for="guidant_slider_tab_page_max_range"> Maximum Range</label>
                    <input type="number" id="guidant_slider_tab_page_max_range">
                </div>

                <div class="guidant_form_group">
                    <label for="guidant_slider_tab_page_slider_step">Slider Step</label>
                    <input type="number" id="guidant_slider_tab_page_slider_step">
                </div>

                <div class="guidant_form_group">
                    <label for="guidant_slider_tab_page_slider_prefix_text">Text before Slider Value</label>
                    <input type="text" id="guidant_slider_tab_page_slider_prefix_text">
                </div>

                <div class="guidant_form_group">
                    <label for="guidant_slider_tab_page_slider_postfix_text">Text after Slider Value</label>
                    <input type="text" id="guidant_slider_tab_page_slider_postfix_text">
                </div>


                <div class="guidant_form_group">
                    <label for="guidant-fdes"> Condition Behavior </label>
                    <select id="guidant_slider_tab_page_behavior">
                        <option value="or">OR - Any of the conditions need to be matched</option>
                        <option value="and">AND - All conditions need to be matched</option>
                    </select>
                </div>
            </div>

            <div class="guidant_tab_item">

                <div id="guidant_slider_conditions_list" style="display: none;">
                    <div class="guidant_loader_block guidant-loader" style="display: none;">
                        <div class='loader'></div>
                    </div>
                    <div class="guidant_empty_style_2 guidant-empty">
                        <h3>No condition created yet</h3>
                        <button class="guidant-btn" onclick="guidant_conditions_create_show('<?php echo esc_attr(GUIDANT_URL); ?>')">Create New Condition</button>
                    </div>
                    <div id="guidant_slider_conditions_list_items">
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