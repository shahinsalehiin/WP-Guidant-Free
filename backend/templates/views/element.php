<div id="guidant_elements_list" style="display: none;">
    <div class="guidant-body-title">
        <h3> Card Items </h3>

        <div style="display: flex;">
            <button style="margin-right: 12px" class="guidant-btn-light-img" onclick="guidant_elements_back_to_filters('<?php echo esc_attr(GUIDANT_URL); ?>')"> <img src="<?php echo esc_attr(GUIDANT_IMG_DIR); ?>/guidant-back-icon.svg" > Back to All Filters</button>
            <button class="guidant-btn" onclick="guidant_elements_create('<?php echo esc_attr(GUIDANT_URL); ?>')"> Add Card</button>
        </div>
    </div>
    <div class="guidant_loader_block guidant-loader" style="display: none;">
        <div class='loader'></div>
    </div>
    <div class="guidant_empty_style_1 guidant-empty">
        <h3>You don't have any card created yet</h3>
        <button class="guidant-btn" onclick="guidant_elements_create('<?php echo esc_attr(GUIDANT_URL); ?>')">Create New Card</button>
    </div>
    <div id="guidant_elements_list_items">
    </div>
</div>