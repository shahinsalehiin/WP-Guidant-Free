<div id="guidant_elements_list" style="display: none;">
    <div class="guidant-body-title">
        <h3> Card Items </h3>
        <button class="guidant-btn" onclick="guidant_elements_create('<?php echo esc_attr(GUIDANT_URL); ?>')"> Add Card</button>
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