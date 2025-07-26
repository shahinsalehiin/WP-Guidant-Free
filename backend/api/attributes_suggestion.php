<?php

$result = array();

/* Check if user has admin capabilities */
if(current_user_can('manage_options')){


    if(isset($_REQUEST['search'])){
        $search = sanitize_text_field($_REQUEST['search']);
    }else{
        $search = "";
    }


    $attributesList = array();


    $attributesList[] = array("text" => "Posts", "children" => $this->utils->getPostAttributes($search));
    $attributesList[] = array("text" => "WooCommerce", "children" => $this->utils->getWoocommerceAttributes($search));



    /* Guidant Custom Fields */
    $total_custom_fields = 0;
    $list_fields_formatted = array();
    $list_fields = $this->settings->listAllFields();
    foreach ($list_fields as $single_field){
        $list_fields_formatted[] = array(
            "field_id" => esc_attr($single_field['field_id']),
            "field_label" => esc_attr($this->settings->updateFieldSettings($single_field['field_id'], "field_label")),
            "field_placement" => esc_attr($this->settings->updateFieldSettings($single_field['field_id'], "field_placement")),
        );
        $total_custom_fields++;
    }

    if($total_custom_fields > 0){
        $attributesList[] = array("text" => "WP Guidant - Custom Fields", "children" => $this->utils->getGuidantCustomFields($list_fields_formatted, $search));
    }
    /* Guidant Custom Fields */


    /* ACF Fields */
    if (class_exists('ACF')) {
        $attributesList[] = array("text" => "ACF", "children" => $this->utils->getAcfFields($search));
    }
    /* ACF Fields */



    /* All Meta Fields */
    $listPostTypes = get_post_types(array('public' => true), 'objects');
    if (sizeof($listPostTypes) > 0) {
        foreach ($listPostTypes as $singlePostType) {
            $labels = get_post_type_labels( $singlePostType );

            $attributesList[] = array("text" => $labels->name." - Meta Fields", "children" => $this->utils->getAllMetaFields($singlePostType->name, $search));

        }
    }
    /* All Meta Fields */




    $result = array("status" => 'true', "attributes" => $attributesList);

}else{
    $result = array("status" => 'false');
}


echo json_encode($result,  JSON_UNESCAPED_UNICODE);