<div id="guidant_filters_update" style="display: none;">
    <div class="guidant-body-title">
        <h3> Update Filter </h3>

    </div>
    <div class="guidant_block_1">
        <div class="guidant_form_group">
            <label for="guidant_filters_update_filter_name">Filter Name <?php $this->guidant_field_info("Name to identify the filter. Not visible in the front-end area."); ?></label>
            <input type="text" name="ftitle" id="guidant_filters_update_filter_name" placeholder="Give a Name here...">
            <p class="guidant_field_error" id="guidant_filters_update_filter_name_empty">Filter Name Can't be Empty</p>
        </div>
        <div class="guidant_form_group">
            <label for="guidant_filters_update_filter_title">Filter Title <?php $this->guidant_field_info("Title of your filter, this can be empty. Visible in filter front-end design."); ?></label>
            <input type="text" name="ftitle" id="guidant_filters_update_filter_title" placeholder="Add title here...">
        </div>
        <div class="guidant_form_group">
            <label for="guidant_filters_update_filter_description"> Filter Description <?php $this->guidant_field_info("You can add a short description to display it after the title."); ?></label>
            <textarea id="guidant_filters_update_filter_description"></textarea>
        </div>
        <div class="guidant_form_group">
            <label for="guidant_filters_update_filter_type"> Filter Type <?php $this->guidant_field_info("Choose either to display cards or sliders or custom form in your filter."); ?></label>
            <select id="guidant_filters_update_filter_type">
                <option value="">Select</option>
                <option value="card">Card</option>
                <option value="slider">Slider</option>
                <option value="form">Form</option>
            </select>
            <p class="guidant_field_error" id="guidant_filters_update_filter_type_empty">Filter Type must be selected</p>
        </div>

        <div id="guidant_filters_update_card_type_container" style="display: none;">
            <div class="guidant_form_group">
                <label for="guidant_filters_update_card_type"> Card Type <?php $this->guidant_field_info("Choose either multiple cards (Checkbox) can be selected or only one card (Radio)."); ?></label>
                <select id="guidant_filters_update_card_type">
                    <option value="checkbox">Checkbox</option>
                    <option value="radio">Radio</option>
                </select>
            </div>
        </div>

        <button class="guidant-btn guidant_filters_update_btn" style="margin-top: 25px" onclick="guidant_filters_update('<?php echo esc_attr(GUIDANT_URL); ?>')"> Save</button>
    </div>
</div>


<div id="guidant_filters_create" style="display: none;">
    <div class="guidant-body-title">
        <h3> Create New Filter </h3>

    </div>
    <div class="guidant_block_1">
        <div class="guidant_form_group">
            <label for="guidant_filters_create_filter_name">Filter Name <?php $this->guidant_field_info("Name to identify the filter. Not visible in the front-end area."); ?></label>
            <input type="text" name="ftitle" id="guidant_filters_create_filter_name" placeholder="Give a Name here...">
            <p class="guidant_field_error" id="guidant_filters_create_filter_name_empty">Filter Name Can't be Empty</p>
        </div>
        <div class="guidant_form_group">
            <label for="guidant_filters_create_filter_title">Filter Title <?php $this->guidant_field_info("Title of your filter, this can be empty. Visible in filter front-end design."); ?></label>
            <input type="text" name="ftitle" id="guidant_filters_create_filter_title" placeholder="Add title here...">
        </div>
        <div class="guidant_form_group">
            <label for="guidant_filters_create_filter_description">Filter Description <?php $this->guidant_field_info("You can add a short description to display it after the title."); ?></label>
            <textarea id="guidant_filters_create_filter_description"></textarea>
        </div>

        <div class="guidant_form_group">
            <label for="guidant_filters_create_filter_type">Filter Type <?php $this->guidant_field_info("Choose either to display cards or sliders or custom form in your filter."); ?></label>
            <select id="guidant_filters_create_filter_type">
                <option value="">Select</option>
                <option value="card">Card</option>
                <option value="slider">Slider</option>
                <option value="form">Form</option>
            </select>
            <p class="guidant_field_error" id="guidant_filters_create_filter_type_empty">Filter Type must be selected</p>
        </div>

        <div id="guidant_filters_create_card_type_container" style="display: none;">
            <div class="guidant_form_group">
                <label for="guidant_filters_create_card_type"> Card Type <?php $this->guidant_field_info("Choose either multiple cards (Checkbox) can be selected or only one card (Radio)."); ?></label>
                <select id="guidant_filters_create_card_type">
                    <option value="checkbox">Checkbox</option>
                    <option value="radio">Radio</option>
                </select>
            </div>
        </div>

        <button class="guidant-btn guidant_filters_create_btn" style="margin-top: 25px" onclick="guidant_filters_create('<?php echo esc_attr(GUIDANT_URL); ?>')"> Create</button>
    </div>
</div>





<div id="guidant_filters_list" style="display: none;">
    <div class="guidant-body-title">
        <h3> Filters </h3>
        <button class="guidant-btn" onclick="guidant_filters_create_show('<?php echo esc_attr(GUIDANT_URL); ?>')"> Create Filter</button>
    </div>
    <div class="guidant_loader_block guidant-loader" style="display: none;">
        <div class='loader'></div>
    </div>
    <div class="guidant_empty_style_1 guidant-empty">
        <h3>You don't have any filter yet</h3>
        <button class="guidant-btn" onclick="guidant_filters_create_show('<?php echo esc_attr(GUIDANT_URL); ?>')">Create New Filter</button>
    </div>
    <div id="guidant_filters_list_items">
    </div>
</div>