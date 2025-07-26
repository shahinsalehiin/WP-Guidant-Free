<?php


$element_id = $single_element['element_id'];

$element_label = $this->settings->updateElementSettings($element_id, "element_label");
$element_label = ($element_label == Null) ? "" : $element_label;

$input_type = $this->settings->updateElementSettings($element_id, "input_type");
$input_type = ($input_type == Null) ? "input" : $input_type;

$input_field_type = $this->settings->updateElementSettings($element_id, "input_field_type");
$input_field_type = ($input_field_type == Null) ? "text" : $input_field_type;

$select_items = $this->settings->updateElementSettings($element_id, "select_items");
$select_items = ($select_items == Null) ? "" : $select_items;
$select_items_arr = explode("[:::]",$select_items);

$checkbox_items = $this->settings->updateElementSettings($element_id, "checkbox_items");
$checkbox_items = ($checkbox_items == Null) ? "" : $checkbox_items;
$checkbox_items_arr = explode("[:::]",$checkbox_items);

$radio_items = $this->settings->updateElementSettings($element_id, "radio_items");
$radio_items = ($radio_items == Null) ? "" : $radio_items;
$radio_items_arr = explode("[:::]",$radio_items);

$element_required = $this->settings->updateElementSettings($element_id, "element_required");
$element_required = ($element_required == Null) ? "required" : $element_required;

$element_class = $this->settings->updateElementSettings($element_id, "element_class");
$element_class = ($element_class == Null) ? "" : $element_class;


?>


<?php if($input_type == "input"){?>
<div class="guidantguide_single_form_element guidantguide_element"
     data-element_id="<?php echo esc_attr($element_id) ?>"
     data-input_type="input"
     data-input_field_type="<?php echo esc_attr($input_field_type); ?>"
     data-required="<?php echo esc_attr($element_required) ?>">
    <label for="guidant_form_element_<?php echo esc_attr($element_id); ?>"> <?php echo esc_attr($element_label); ?> </label>
    <input type="<?php echo esc_attr($input_field_type); ?>" class="<?php echo esc_attr($element_class); ?>" id="guidant_form_element_<?php echo esc_attr($element_id); ?>">
</div>
<?php }?>


<?php if($input_type == "textarea"){?>
    <div class="guidantguide_single_form_element guidantguide_element" data-element_id="<?php echo esc_attr($element_id) ?>" data-input_type="textarea" data-required="<?php echo esc_attr($element_required) ?>">
        <label for="guidant_form_element_<?php echo esc_attr($element_id); ?>"> <?php echo esc_attr($element_label); ?> </label>
        <textarea type="text" class="<?php echo esc_attr($element_class); ?>" id="guidant_form_element_<?php echo esc_attr($element_id); ?>"></textarea>
    </div>
<?php }?>


<?php if($input_type == "select"){?>
<div class="guidantguide_single_form_element guidantguide_element" data-element_id="<?php echo esc_attr($element_id) ?>" data-input_type="select" data-required="<?php echo esc_attr($element_required) ?>">
    <label for="guidant_form_element_<?php echo esc_attr($element_id); ?>"> <?php echo esc_attr($element_label); ?> </label>
    <select class="<?php echo esc_attr($element_class); ?>" id="guidant_form_element_<?php echo esc_attr($element_id); ?>">
        <option value="">Select</option>
        <?php foreach ($select_items_arr as $item){?>
        <option value="<?php echo esc_attr($item); ?>"><?php echo esc_attr($item); ?></option>
        <?php }?>
    </select>
</div>
<?php }?>


<?php if($input_type == "checkbox"){?>
    <div class="guidantguide_single_form_element guidantguide_element" data-element_id="<?php echo esc_attr($element_id) ?>" data-input_type="checkbox" data-required="<?php echo esc_attr($element_required) ?>">
        <label for="guidant_form_element_<?php echo esc_attr($element_id); ?>"> <?php echo esc_attr($element_label); ?> </label>
        <?php foreach ($checkbox_items_arr as $item){?>
            <div class="guidantguide_form_checkbox_radio_single <?php echo esc_attr($element_class); ?>" data-value="<?php echo esc_attr($item); ?>">
                <span class="checkbox"></span>
                <span class="label"><?php echo esc_attr($item); ?></span>
            </div>
        <?php }?>


    </div>
<?php }?>


<?php if($input_type == "radio"){?>
    <div class="guidantguide_single_form_element guidantguide_element" data-element_id="<?php echo esc_attr($element_id) ?>" data-input_type="radio" data-required="<?php echo esc_attr($element_required) ?>">
        <label for="guidant_form_element_<?php echo esc_attr($element_id); ?>"> <?php echo esc_attr($element_label); ?> </label>
        <?php foreach ($radio_items_arr as $item){?>
            <div class="guidantguide_form_checkbox_radio_single <?php echo esc_attr($element_class); ?>" data-value="<?php echo esc_attr($item); ?>">
                <span class="radio"></span>
                <span class="label"><?php echo esc_attr($item); ?></span>
            </div>
        <?php }?>


    </div>
<?php }?>

