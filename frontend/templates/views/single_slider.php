<?php

$slider_image = $this->settings->updateElementSettings($single_element['element_id'], "slider_image");
if(isset($slider_image)){
    if(strlen(trim($slider_image)) > 0){
        $slider_image = "<img src=\"".$slider_image."\" width=\"100px\" height=\"100px\">";
    }
}

$slider_type = $this->settings->updateElementSettings($single_element['element_id'], "slider_type");
$slider_type = ($slider_type == Null) ? "single" : $slider_type;

$slider_label = $this->settings->updateElementSettings($single_element['element_id'], "slider_label");
$slider_label = ($slider_label == Null) ? "" : $slider_label;

$min_range = $this->settings->updateElementSettings($single_element['element_id'], "min_range");
$min_range = ($min_range == Null) ? "0" : $min_range;

$max_range = $this->settings->updateElementSettings($single_element['element_id'], "max_range");
$max_range = ($max_range == Null) ? "100" : $max_range;

$slider_step = $this->settings->updateElementSettings($single_element['element_id'], "slider_step");
$slider_step = ($slider_step == Null) ? "10" : $slider_step;

$slider_prefix_text = $this->settings->updateElementSettings($single_element['element_id'], "slider_prefix_text");
$slider_prefix_text = ($slider_prefix_text == Null) ? "" : $slider_prefix_text;

$slider_postfix_text = $this->settings->updateElementSettings($single_element['element_id'], "slider_postfix_text");
$slider_postfix_text = ($slider_postfix_text == Null) ? "" : $slider_postfix_text;

?>


<div class="guidantguide_single_slider guidantguide_element" data-element_id="<?php echo esc_attr($single_element['element_id']) ?>"
     data-slider_type="<?php echo esc_attr($slider_type) ?>"
     data-min_range="<?php echo esc_attr($min_range) ?>"
     data-max_range="<?php echo esc_attr($max_range) ?>"
     data-slider_step="<?php echo esc_attr($slider_step) ?>"
     data-slider_prefix_text="<?php echo esc_attr($slider_prefix_text) ?>"
     data-slider_postfix_text="<?php echo esc_attr($slider_postfix_text) ?>">

    <?php echo isset($slider_image) ? $slider_image : ""; ?>
    <h4><?php echo esc_attr($slider_label) ?></h4>
    <input id="guidant_slider_<?php echo esc_attr($single_element['element_id']) ?>" type="text" />

</div>