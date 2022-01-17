<div id="guidant_guide_update_tab_page_container" style="display: none; min-height: 800px">
    <div class="guidant-body-title">
        <h3> Guide Settings </h3>
        <div>
            <button class="guidant-btn guidant_guide_update_btn" onclick="guidant_guides_update('<?php echo esc_attr(GUIDANT_URL); ?>')">Save Changes</button>
        </div>

    </div>
    <div class="guidant_loader_block guidant-loader" style="display: none;">
        <div class='loader'></div>
    </div>
    <div class="guidant-card-setting">
        <div class="guidant_tab_menu">
            <ul>
                <li> Guide Basic </li>
                <li> Advanced Settings </li>
                <li> Guide Design </li>
                <li> Filter Design </li>
                <li> Card Design </li>
                <li> Slider Design </li>
                <li> Form Design </li>
                <li> Conditional Logic </li>
                <li> Result </li>
                <li> Result Attributes </li>
            </ul>
        </div>
        <div class="guidant_tab_body">




            <div class="guidant_tab_item">

                <div class="guidant_form_group">
                    <label for="guidant_guides_update_guide_name">Guide Name <?php $this->guidant_field_info("Name to identify the guide. Not visible in the front-end area."); ?></label>
                    <input type="text" id="guidant_guides_update_guide_name" placeholder="Name your guide name here...">
                    <p class="guidant_field_error" id="guidant_guides_update_guide_name_empty">Guide Name Can't be Empty</p>
                </div>

                <!--<div class="guidant_form_group">
                    <label for="guidant_guides_update_guide_submission_tracking">Submission Report Tracking <?php /*$this->guidant_field_info("Enable or Disable tracking of how user's are interacting with this guide in the front-end."); */?></label>
                    <select id="guidant_guides_update_guide_submission_tracking">
                        <option value="enable">Enable - Track users activity</option>
                        <option value="disable">Disable - Do not track</option>
                    </select>
                </div>-->

                <div class="guidant_form_group">
                    <label for="guidant_guides_update_guide_title">Guide Title <?php $this->guidant_field_info("Title of your guide, can be empty. Visible in guide front-end design."); ?></label>
                    <input type="text" id="guidant_guides_update_guide_title" placeholder="Add title here...">
                </div>

                <div class="guidant_form_group">
                    <label for="guidant_guides_update_guide_description">Guide Description <?php $this->guidant_field_info("You can add a short description to display it after the title."); ?></label>
                    <textarea id="guidant_guides_update_guide_description"></textarea>
                </div>

            </div>










            <div class="guidant_tab_item">


                <div class="guidant_form_group_small wider_space">
                    <h4> Submission Report Tracking <?php $this->guidant_field_info("Enable or Disable tracking of how user's are interacting with this guide in the front-end."); ?></h4>
                    <div>
                        <select id="guidant_guides_update_guide_submission_tracking">
                            <option value="enable">Enable</option>
                            <option value="disable">Disable</option>
                        </select>
                    </div>
                </div>


                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Email to User on Submission <?php $this->guidant_field_info("Enable or Disable automatic email sending to user on guide completion."); ?></h4>
                    <div>
                        <select id="guidant_guides_update_guide_email_to_user" disabled>
                            <option value="enable">Enable</option>
                            <option value="disable">Disable</option>
                        </select>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>



                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Mailchimp Integration </h4>
                    <div class="guidant-card-api-integration">
                        <span id="guidant_mailchimp_connect_field_btn" class="guidant-card-api-integration-text-large"> Connect Mailchimp</span>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>


                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Custom CSS </h4>
                    <div class="guidant-card-api-integration">
                        <span class="guidant-card-api-integration-text-large"> Add Custom CSS</span>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Guide on Popup <?php $this->guidant_field_info("Display guide on popup on button click."); ?></h4>
                    <div>
                        <select id="guidant_guides_update_guide_on_popup" disabled>
                            <option value="enable">Enable</option>
                            <option value="disable">Disable</option>
                        </select>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>



            </div>








            <div class="guidant_tab_item">

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Title color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_guide_title_color">
                        <label for="guidant_guides_update_guide_title_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Title Font Size </h4>
                    <div>
                        <input type="number" id="guidant_guides_update_guide_title_fontsize">
                        <span class="guidant-px"> px </span>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Description Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_guide_description_color">
                        <label for="guidant_guides_update_guide_description_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Description Font Size </h4>
                    <div>
                        <input type="number" id="guidant_guides_update_guide_description_fontsize">
                        <span class="guidant-px"> px </span>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>


                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Background Image </h4>
                    <input type="hidden" id="guidant_guides_update_guide_background_image">
                    <div class="guidant-card-guiduploadimg">
                        <img id="guidant_guides_update_guide_background_image_shower" alt="image"/>
                        <span onclick="" class="guidant-guiduploadimg-text"> select image</span>
                        <span onclick="" class="guidant-guiduploadimg-text"> clear image</span>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Background Start Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_guide_background_startcolor">
                        <label for="guidant_guides_update_guide_background_startcolor">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Background End Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_guide_background_endcolor">
                        <label for="guidant_guides_update_guide_background_endcolor">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Background Color Direction </h4>
                    <div>
                        <input type="number" id="guidant_guides_update_guide_background_direction">
                        <span class="guidant-px"> Degree </span>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

            </div>







            <div class="guidant_tab_item">


                <div class="guidant_form_group_small wider_space">
                    <h4> Prev Button Text </h4>
                    <div>
                        <input type="text" id="guidant_guides_update_filter_prev_btn_text">
                    </div>
                </div>

                <div class="guidant_form_group_small wider_space">
                    <h4> Next Button Text </h4>
                    <div>
                        <input type="text" id="guidant_guides_update_filter_next_btn_text">
                    </div>
                </div>

                <div class="guidant_form_group_small wider_space">
                    <h4> Submit Button Text </h4>
                    <div>
                        <input type="text" id="guidant_guides_update_filter_submit_btn_text">
                    </div>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Title Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_filter_title_color">
                        <label for="guidant_guides_update_filter_title_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Title Font Size </h4>
                    <div>
                        <input type="number" id="guidant_guides_update_filter_title_fontsize">
                        <span class="guidant-px"> px </span>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Description Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_filter_description_color">
                        <label for="guidant_guides_update_filter_description_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Description Font Size </h4>
                    <div>
                        <input type="number" id="guidant_guides_update_filter_description_fontsize">
                        <span class="guidant-px"> px </span>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Background Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_filter_background_color">
                        <label for="guidant_guides_update_filter_background_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Border Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_filter_border_color">
                        <label for="guidant_guides_update_filter_border_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>



                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Prev Button Background Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_filter_prev_bg_color">
                        <label for="guidant_guides_update_filter_prev_bg_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Prev Button Border Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_filter_prev_border_color">
                        <label for="guidant_guides_update_filter_prev_border_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Prev Button Text Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_filter_prev_text_color">
                        <label for="guidant_guides_update_filter_prev_text_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Next Button Background Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_filter_next_bg_color">
                        <label for="guidant_guides_update_filter_next_bg_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Next Button Border Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_filter_next_border_color">
                        <label for="guidant_guides_update_filter_next_border_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Next Button Text Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_filter_next_text_color">
                        <label for="guidant_guides_update_filter_next_text_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Submit Button Background Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_filter_submit_bg_color">
                        <label for="guidant_guides_update_filter_submit_bg_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Submit Button Border Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_filter_submit_border_color">
                        <label for="guidant_guides_update_filter_submit_border_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Submit Button Text Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_filter_submit_text_color">
                        <label for="guidant_guides_update_filter_submit_text_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

            </div>







            <div class="guidant_tab_item">


                <div class="guidant_form_group_small wider_space">
                    <h4> Card Image Height </h4>
                    <div>
                        <input type="number" id="guidant_guides_update_card_image_height">
                        <span class="guidant-px"> px </span>
                    </div>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Label Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_card_label_color">
                        <label for="guidant_guides_update_card_label_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>


                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Label Font Size </h4>
                    <div>
                        <input type="number" id="guidant_guides_update_card_label_fontsize">
                        <span class="guidant-px"> px </span>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>



                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Border Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_card_border_color">
                        <label for="guidant_guides_update_card_border_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Border Hover Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_card_border_hover_color">
                        <label for="guidant_guides_update_card_border_hover_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Border Active Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_card_border_active_color">
                        <label for="guidant_guides_update_card_border_active_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Background Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_card_background_color">
                        <label for="guidant_guides_update_card_background_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Radio Border Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_card_radio_border_color">
                        <label for="guidant_guides_update_card_radio_border_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Radio Border Hover Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_card_radio_border_hover_color">
                        <label for="guidant_guides_update_card_radio_border_hover_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Radio Selected Background Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_card_radio_selected_bg_color">
                        <label for="guidant_guides_update_card_radio_selected_bg_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Radio Selected Icon Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_card_radio_selected_icon_color">
                        <label for="guidant_guides_update_card_radio_selected_icon_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

            </div>



            <div class="guidant_tab_item">

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Label Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_slider_label_color">
                        <label for="guidant_guides_update_slider_label_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>


                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Label Font Size </h4>
                    <div>
                        <input type="number" id="guidant_guides_update_slider_label_fontsize">
                        <span class="guidant-px"> px </span>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Slider Image Height </h4>
                    <div>
                        <input type="number" id="guidant_guides_update_slider_image_height">
                        <span class="guidant-px"> px </span>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Slider Base Background Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_slider_base_bg_color">
                        <label for="guidant_guides_update_slider_base_bg_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Slider Selected Background Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_slider_selected_bg_color">
                        <label for="guidant_guides_update_slider_selected_bg_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

            </div>








            <div class="guidant_tab_item">

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Label Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_form_label_color">
                        <label for="guidant_guides_update_form_label_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>


                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Label Font Size </h4>
                    <div>
                        <input type="number" id="guidant_guides_update_form_label_fontsize">
                        <span class="guidant-px"> px </span>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>


                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Input Background Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_form_input_bg_color">
                        <label for="guidant_guides_update_form_input_bg_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Input Border Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_form_input_border_color">
                        <label for="guidant_guides_update_form_input_border_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Input Text Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_form_input_text_color">
                        <label for="guidant_guides_update_form_input_text_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>


                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Radio Option Text Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_form_radio_item_text_color">
                        <label for="guidant_guides_update_form_radio_item_text_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Radio Border Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_form_radio_border_color">
                        <label for="guidant_guides_update_form_radio_border_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>


                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Radio Selected Background Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_form_radio_selected_bg_color">
                        <label for="guidant_guides_update_form_radio_selected_bg_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>

                <div class="guidant_form_group_small wider_space pro_field">
                    <h4> Radio Selected Icon Color </h4>
                    <div class="guidant-color-container">
                        <input type="color" id="guidant_guides_update_form_radio_selected_icon_color">
                        <label for="guidant_guides_update_form_radio_selected_icon_color">Select Color</label>
                    </div>
                    <span class="pro_tag"><strong>Pro</strong></span>
                </div>
            </div>








            <div class="guidant_tab_item">

                <div id="guidant_guide_logic_list" style="display: none;">
                    <div class="guidant_loader_block guidant-loader" style="display: none;">
                        <div class='loader'></div>
                    </div>
                    <div class="guidant_empty_style_2 guidant-empty-logic">
                        <h3>No logic created yet</h3>
                        <button class="guidant-btn" onclick="guidant_logic_create_show('<?php echo esc_attr(GUIDANT_URL); ?>')">Create New Logic</button>
                    </div>
                    <div id="guidant_guide_logic_list_items">

                    </div>
                </div>
            </div>





            <div class="guidant_tab_item">

                <div class="guidant_form_group">
                    <label for="guidant_guides_update_display_result"> Display Result on Completion? </label>
                    <select id="guidant_guides_update_display_result">
                        <option value="true">Yes</option>
                        <option value="false">No</option>
                    </select>
                </div>


                <div id="guidant_guides_update_display_result_container" style="display: none;">
                    <div class="guidant_form_group">
                        <label for="guidant_guides_update_result_maximum"> Maximum Results</label>
                        <input type="number" id="guidant_guides_update_result_maximum">
                    </div>

                    <div class="guidant_form_group">
                        <label for="guidant_guides_update_result_headline_text"> Headline</label>
                        <input type="text" id="guidant_guides_update_result_headline_text">
                    </div>

                    <div class="guidant_form_group">
                        <label for="guidant_guides_update_result_more_text"> More Results Text</label>
                        <input type="text" id="guidant_guides_update_result_more_text">
                    </div>

                    <div class="guidant_form_group">
                        <label for="guidant_guides_update_result_empty_text"> No Results Text</label>
                        <input type="text" id="guidant_guides_update_result_empty_text">
                    </div>
                </div>


                <div id="guidant_guides_update_no_result_container" style="display: none;">

                    <div class="guidant_form_group">
                        <label for="guidant_guides_update_no_result_primary_text"> Primary Text</label>
                        <input type="text" id="guidant_guides_update_no_result_primary_text">
                    </div>

                    <div class="guidant_form_group">
                        <label for="guidant_guides_update_no_result_secondary_text"> Secondary Text</label>
                        <input type="text" id="guidant_guides_update_no_result_secondary_text">
                    </div>

                </div>

            </div>





            <div class="guidant_tab_item">

                <div id="guidant_card_results_list" style="display: none;">
                    <div class="guidant_loader_block guidant-loader" style="display: none;">
                        <div class='loader'></div>
                    </div>
                    <div class="guidant_empty_style_2 guidant-empty">
                        <h3>No result attribute created yet</h3>
                        <button class="guidant-btn" onclick="guidant_results_create_show('<?php echo esc_attr(GUIDANT_URL); ?>')">Create New Result Attribute</button>
                    </div>
                    <div id="guidant_card_results_list_items">

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>