
<div id="guidant_reports_list" style="display: none;">
    <div class="guidant-body-title">
        <h3> All Submission Reports </h3>


        <div class="guidant_header_form">
            <select id="guidant_reports_list_guide_items">
                <option value="0">All Guides</option>

                <?php
                $list_guides = $this->settings->listAllGuides();
                foreach ($list_guides as $single_guide){?>
                    <option value="<?php echo esc_attr($single_guide['guide_id']); ?>"><?php echo esc_attr($this->settings->updateGuideSettings($single_guide['guide_id'], "guide_name")); ?></option>
                    <?php }
                ?>


            </select>

            <!--<button class="guidant-btn" onclick="guidant_field_create_show('<?php /*echo esc_attr(GUIDANT_URL); */?>')"> Create Field</button>-->
        </div>

    </div>
    <div class="guidant_loader_block guidant-loader" style="display: none;">
        <div class='loader'></div>
    </div>
    <div class="guidant_empty_style_1 guidant-empty">
        <h3>No Guide Usages Recorded Yet</h3>
    </div>
    <div id="guidant_reports_list_items">
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