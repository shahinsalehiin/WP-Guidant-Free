<div class="guidantguide_filter"
     data-filter_id="<?php echo esc_attr($single_filter['filter_id']) ?>"
     data-filter_type="<?php echo esc_attr($this->settings->updateFilterSettings($single_filter['filter_id'], "filter_type")) ?>"
     data-card_type="<?php echo esc_attr($this->settings->updateFilterSettings($single_filter['filter_id'], "card_type")) ?>"
     data-is_hidden_by_logic="no">

    <div class="guidantguide_filter_intro">
        <h4><?php echo esc_attr($this->settings->updateFilterSettings($single_filter['filter_id'], "filter_title")) ?></h4>
        <?php echo stripslashes($this->settings->updateFilterSettings($single_filter['filter_id'], "filter_description")) ?>
    </div>
    <div class="guidantguide_filter_elements">
        <?php
        $list_elements = $this->settings->listAllElements($single_filter['filter_id'], $this->settings->updateFilterSettings($single_filter['filter_id'], "filter_type"));
        if($this->settings->updateFilterSettings($single_filter['filter_id'], "filter_type") == "card"){
            ?>

            <div class="guidantguide_filter_cards_container">
                <?php
                foreach ($list_elements as $single_element){
                    include GUIDANT_PATH . "frontend/templates/views/single_card.php";
                }
                ?>
            </div>

        <?php
        }else if($this->settings->updateFilterSettings($single_filter['filter_id'], "filter_type") == "slider"){
            ?>

            <div class="guidantguide_filter_slider_container">
                <?php
                foreach ($list_elements as $single_element){
                    include GUIDANT_PATH . "frontend/templates/views/single_slider.php";
                }
                ?>
            </div>

            <?php
        }else if($this->settings->updateFilterSettings($single_filter['filter_id'], "filter_type") == "form"){
            ?>

            <div class="guidantguide_filter_form_container">
                <?php
                foreach ($list_elements as $single_element){
                    include GUIDANT_PATH . "frontend/templates/views/single_form_element.php";
                }
                ?>
            </div>

            <?php
        }
        ?>
    </div>


    <div class="guidantguide_actions_container">
        <?php /*if($count_filter != 1){*/?><!--<button class="guidantguide_btn_prev" id="guidantguide_filter_previous" onclick="previousGuideFilter(`<?php /*echo esc_attr($unique_id) */?>`)"><?php /*echo esc_attr($filter_prev_btn_text) */?></button> <?php /*} */?>
        <?php /*if($count_filter < $total_filters){*/?><button class="guidantguide_btn_next" id="guidantguide_filter_next" onclick="nextGuideFilter(`<?php /*echo esc_attr($unique_id) */?>`)"><?php /*echo esc_attr($filter_next_btn_text) */?></button><?php /*} */?>
        <?php /*if($count_filter == $total_filters){*/?><button class="guidantguide_btn_submit" id="guidantguide_filter_next" onclick="guidant_guide_submission(`<?php /*echo esc_attr($unique_id) */?>`, `<?php /*echo esc_attr($guide_id) */?>`)"><?php /*echo esc_attr($filter_submit_btn_text) */?></button>--><?php /*} */?>

        <button class="guidantguide_action_btn guidantguide_btn_prev" id="guidantguide_filter_previous" onclick="previousGuideFilter(`<?php echo esc_attr($unique_id) ?>`)"><?php echo esc_attr($filter_prev_btn_text) ?></button>
        <button class="guidantguide_action_btn guidantguide_btn_next" id="guidantguide_filter_next" onclick="nextGuideFilter(`<?php echo esc_attr($unique_id) ?>`)"><?php echo esc_attr($filter_next_btn_text) ?></button>
        <button class="guidantguide_action_btn guidantguide_btn_submit" id="guidantguide_filter_next" onclick="guidant_guide_submission(`<?php echo esc_attr($unique_id) ?>`, `<?php echo esc_attr($guide_id) ?>`)"><?php echo esc_attr($filter_submit_btn_text) ?></button>

    </div>


</div>