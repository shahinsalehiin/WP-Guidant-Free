<div id="guidant_fields_update" style="display: none;">
    <div class="guidant-modal">
        <div class="guidant-modalheader">
            <h3> Modify Custom Field</h3>
            <span class="dashicons dashicons-no-alt target" onclick="guidant_fields_update_close('<?php echo esc_attr(GUIDANT_URL); ?>')"></span>
        </div>
        <div class="guidant-modalbody">
            <div class="guidant-modalform">
                <div class="guidant_form_group">
                    <label for="guidant-ftitle"> Field Label <?php $this->guidant_field_info("Label of the custom field."); ?></label>
                    <input type="text" name="ftitle" id="guidant_field_update_field_label" placeholder="">
                    <p class="guidant_field_error" id="guidant_field_update_field_label_empty">Field Label can't be empty</p>
                </div>
                <div class="guidant_form_group">
                    <label for="guidant-fdes"> Placement <?php $this->guidant_field_info("Where to show the field? ie. Post Edit Page."); ?></label>
                    <select id="guidant_field_update_field_placement">
                        <option>Select</option>
                        <option value="post">Post</option>
                        <option value="product">Product</option>
                        <option value="all">Post & Product</option>
                    </select>
                    <p class="guidant_field_error" id="guidant_field_update_field_placement_empty">No placement selected</p>
                </div>

            </div>
            <button class="guidant-btn guidant_field_update_btn" onclick="guidant_field_update('<?php echo esc_attr(GUIDANT_URL); ?>')"> Save</button>
        </div>
    </div>
</div>