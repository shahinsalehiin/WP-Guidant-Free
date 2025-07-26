<div id="guidant_guides_create" style="display: none;">
    <div class="guidant-body-title">
        <h3> Create New Guide </h3>
        <button class="guidant-btn guidant_guide_create_btn" onclick="guidant_guides_create('<?php echo esc_attr(GUIDANT_URL); ?>')"> Create</button>
    </div>
    <div class="guidant_block_1">
        <div class="guidant_form_group">
            <label for="guidant_guides_create_guide_name">Guide Name <?php $this->guidant_field_info("Name to identify the guide. Not visible in the front-end area."); ?></label>
            <input type="text" id="guidant_guides_create_guide_name" placeholder="Name your guide name here...">
            <p class="guidant_field_error" id="guidant_guides_create_guide_name_empty">Guide Name Can't be Empty</p>
        </div>
        <div class="guidant_form_group">
            <label for="guidant_guides_create_guide_title">Guide Title <?php $this->guidant_field_info("Title of your guide, can be empty. Visible in guide front-end design."); ?></label>
            <input type="text" id="guidant_guides_create_guide_title" placeholder="Add title here...">
        </div>
        <div class="guidant_form_group">
            <label for="guidant_guides_create_guide_description">Guide Description <?php $this->guidant_field_info("You can add a short description to display it after the title."); ?></label>
            <textarea id="guidant_guides_create_guide_description"></textarea>
        </div>
    </div>
</div>


<div id="guidant_guides_list" style="display: none;">
    <div class="guidant-body-title">
        <h3> All Guides </h3>

        <div>
            <button class="guidant-btn" onclick="guidant_guides_create_show('<?php echo esc_attr(GUIDANT_URL); ?>')"> Create Guide</button>
        </div>
    </div>
    <div class="guidant_loader_block guidant-loader" style="display: none;">
        <div class='loader'></div>
    </div>
    <div class="guidant_empty_style_1 guidant-empty">
        <h3>You don't have any guide yet</h3>
        <button class="guidant-btn" onclick="guidant_guides_create_show('<?php echo esc_attr(GUIDANT_URL); ?>')">Create New Guide</button>
    </div>
    <div id="guidant_guides_list_items">
        <!--<div class="guidant_card_style_1">
            <p> Test Card One </p>
            <span> Active </span>
            <div class="guidant_card_action">
                <a href="#" class="guidant-view-icon"><img src="<?php /*echo GUIDANT_FRONT_IMG_DIR . "/view.png" */?>" alt="icon"/> </a>
                <a href="#" class="guidant-edit-icon"><img src="<?php /*echo GUIDANT_FRONT_IMG_DIR . "/edit.png" */?>" alt="icon"/> </a>
                <a href="#" class="guidant-trash-icon"><img src="<?php /*echo GUIDANT_FRONT_IMG_DIR . "/trash.png" */?>" alt="icon"/> </a>
            </div>
        </div>-->
    </div>
</div>