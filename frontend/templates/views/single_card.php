<?php

$card_image_tag = "";
$card_image = $this->settings->updateElementSettings($single_element['element_id'], "card_image");
if(isset($card_image)){
    if(strlen(trim($card_image)) > 0){
        if($card_image > 0){
            $card_image_tag = "<img src=\"".wp_get_attachment_url($card_image)."\" width=\"100px\" height=\"100px\">";
        }
    }
}

$filter_to_hide = array();
$list_logics = $this->settings->listAllLogics($guide_id);
foreach ($list_logics as $single_logic){
    $selected_element = $this->settings->updateLogicSettings($single_logic['logic_id'], "selected_element");
    $selected_filter_to_hide = $this->settings->updateLogicSettings($single_logic['logic_id'], "selected_filter_to_hide");

    if($selected_element == $single_element['element_id']){
        $filter_to_hide[] = $selected_filter_to_hide;
    }
}
$filter_to_hide_arr_str = implode(', ', $filter_to_hide);

?>


<div class="guidantguide_single_card guidantguide_element"
     data-element_id="<?php echo esc_attr($single_element['element_id']) ?>"
     data-filter_to_hide="<?php echo esc_attr($filter_to_hide_arr_str) ?>">
    <?php echo isset($card_image_tag) ? $card_image_tag : ""; ?>
    <h4><?php echo esc_attr($this->settings->updateElementSettings($single_element['element_id'], "card_label")) ?></h4>
    <span class="<?php echo esc_attr($this->settings->updateFilterSettings($single_filter['filter_id'], "card_type")) ?>"></span>
</div>