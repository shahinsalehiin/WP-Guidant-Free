
<div id="guidant_custom_field_list" style="display: none;">
    <div class="guidant-body-title">
        <h3> All Fields </h3>
        <button class="guidant-btn" onclick="guidant_field_create_show('<?php echo esc_attr(GUIDANT_URL); ?>')"> Create Field</button>
    </div>
    <div class="guidant_loader_block guidant-loader" style="display: none;">
        <div class='loader'></div>
    </div>
    <div class="guidant_empty_style_1 guidant-empty">
        <h3>You haven't created any Custom Field</h3>
        <button class="guidant-btn" onclick="guidant_field_create_show('<?php echo esc_attr(GUIDANT_URL); ?>')">Create Custom Field</button>
    </div>
    <div id="guidant_custom_field_list_items">
    </div>
</div>