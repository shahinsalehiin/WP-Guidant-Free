<div id="guidant_custom_field_create" style="display: none;">
    <div class="guidant-modal">
        <div class="guidant-modalheader">
            <h3> Create Custom Field</h3>
            <span class="dashicons dashicons-no-alt target" onclick="guidant_field_create_close('<?php echo esc_attr(GUIDANT_URL); ?>')"></span>
        </div>
        <div class="guidant-modalbody">
            <div class="guidant-modalform">
                <div class="guidant_form_group">
                    <label for="guidant-ftitle"> Field Label <?php $this->guidant_field_info("Label of the custom field."); ?></label>
                    <input type="text" name="ftitle" id="guidant_field_create_field_label" placeholder="">
                    <p class="guidant_field_error" id="guidant_field_create_field_label_empty">Field Label can't be empty</p>
                </div>
                <div class="guidant_form_group">
                    <label for="guidant-fdes"> Placement <?php $this->guidant_field_info("Where to show the field? ie. Post Edit Page."); ?></label>
                    <select id="guidant_field_create_field_placement">
                        <option value="">Select</option>
                        <option value="post">Post</option>
                        <option value="product">Product</option>
                        <option value="all">Post & Product</option>
                    </select>
                    <p class="guidant_field_error" id="guidant_field_create_field_placement_empty">No placement selected</p>
                </div>
            </div>
            <button class="guidant-btn guidant_custom_field_create_btn" onclick="guidant_field_create('<?php echo esc_attr(GUIDANT_URL); ?>')"> Create Field</button>
        </div>
    </div>
</div>