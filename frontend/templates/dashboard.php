
<?php

$unique_id = rand();



$filter_prev_btn_text = $this->settings->updateGuideSettings($guide_id, "filter_prev_btn_text");
$filter_prev_btn_text = ($filter_prev_btn_text == Null) ? "Previous" : $filter_prev_btn_text;

$filter_next_btn_text = $this->settings->updateGuideSettings($guide_id, "filter_next_btn_text");
$filter_next_btn_text = ($filter_next_btn_text == Null) ? "Next" : $filter_next_btn_text;

$filter_submit_btn_text = $this->settings->updateGuideSettings($guide_id, "filter_submit_btn_text");
$filter_submit_btn_text = ($filter_submit_btn_text == Null) ? "Show Results" : $filter_submit_btn_text;


$card_image_height = $this->settings->updateGuideSettings($guide_id, "card_image_height");
$card_image_height = ($card_image_height == Null) ? "100" : $card_image_height;





$result_headline_text = $this->settings->updateGuideSettings($guide_id, "result_headline_text");
$result_headline_text = ($result_headline_text == Null) ? "Your personal result" : $result_headline_text;

$result_more_text = $this->settings->updateGuideSettings($guide_id, "result_more_text");
$result_more_text = ($result_more_text == Null) ? "More results that suit you" : $result_more_text;

$result_empty_text = $this->settings->updateGuideSettings($guide_id, "result_empty_text");
$result_empty_text = ($result_empty_text == Null) ? "No Result Found" : $result_empty_text;

$no_result_primary_text = $this->settings->updateGuideSettings($guide_id, "no_result_primary_text");
$no_result_primary_text = ($no_result_primary_text == Null) ? "Thank You for your feedback" : $no_result_primary_text;

$no_result_secondary_text = $this->settings->updateGuideSettings($guide_id, "no_result_secondary_text");
$no_result_secondary_text = ($no_result_secondary_text == Null) ? "We will reach back to you soon." : $no_result_secondary_text;


$result_start_over_text = $this->settings->updateGuideSettings($guide_id, "result_start_over_text");
$result_start_over_text = ($result_start_over_text == Null) ? "Back to Guide" : $result_start_over_text;

$result_start_over_text_color = $this->settings->updateGuideSettings($guide_id, "result_start_over_text_color");
$result_start_over_text_color = ($result_start_over_text_color == Null) ? "#de5819" : $result_start_over_text_color;

?>







<div class="guidant_guide guidant_unique_id_<?php echo esc_attr($unique_id); ?>" data-unique_id="<?php echo esc_attr($unique_id); ?>">
    <div class="guidant_front_guide_block">
        <div class="guidant_container">

            <div class="guidantguide_intro">
                <h3><?php echo esc_attr($this->settings->updateGuideSettings($guide_id, "guide_title")) ?></h3>
                <?php echo stripslashes($this->settings->updateGuideSettings($guide_id, "guide_description")) ?>
            </div>

            <div class="guidantguide_filters_container">


                <?php
                $list_filters = $this->settings->listAllFilters($guide_id);
                //$total_filters = (is_array($list_filters) ? sizeof($list_filters) : 0);
                //$count_filter = 0;
                foreach ($list_filters as $single_filter){
                    //$count_filter++;
                    include GUIDANT_PATH . "frontend/templates/views/single_filter.php";
                }
                ?>


            </div>




            <div id="guidantguide_loader_container" style="display: none;">
                <div class="guidant_loader_card">
                    <div class='loader'></div>
                </div>
            </div>


            <div id="guidantguide_empty_container" style="display: none;">
                <h3><?php echo esc_attr($result_empty_text); ?></h3>
            </div>


            <div id="guidantguide_no_result_container" style="display: none;">
                <h3><?php echo esc_attr($no_result_primary_text); ?></h3>
                <p><?php echo esc_attr($no_result_secondary_text); ?></p>
            </div>


            <div id="guidantguide_best_result_container" style="display: none;">
                <h3><?php echo esc_attr($result_headline_text); ?></h3>
                <div class="guidant_result_container">

                </div>
            </div>


            <?php echo base64_decode($this->guidant_free_activation()); ?>



        </div>
    </div>



    <div id="guidant_front_guide_result_block" style="display: none;">
        <h3><?php echo esc_attr($result_more_text); ?></h3>
        <div class="guidant_result_container">

        </div>
    </div>


    <div id="guidantguide_start_over_container" style="display: none;">
        <button onclick="guidant_guide_start_over(`<?php echo esc_attr($unique_id); ?>`)" class="guidantguide_start_over_btn">
            <svg viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="icon/process">
                    <path id="Shape" d="M3.99 5L11 5L11 3L3.99 3L3.99 6.12834e-07L-3.49691e-07 4L3.99 8L3.99 5Z" fill="#FF521D"/>
                </g>
            </svg>

            <span class="guidantguide_start_over_btn_text"><?php echo esc_attr($result_start_over_text); ?></span>
        </button>
    </div>
</div>







<style type="text/css">

    .guidant_unique_id_<?php echo esc_attr($unique_id); ?> .guidant_front_guide_block .guidantguide_filter_cards_container .guidantguide_single_card img{
        height: <?php echo esc_attr($card_image_height); ?>px;
    }

</style>