<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}


if ( ! class_exists( 'GuidantRenderer' ) ) {
    class GuidantRenderer
    {


        public function queryMatchingTypeValue($matching_type, $value)
        {
            $query = "";
            switch ($matching_type){
                case 'equal':
                    $query = " = '{$value}'";
                    break;
                case 'not_equal':
                    $query = " != '{$value}'";
                    break;
                case 'like':
                    $query = " LIKE '{$value}'";
                    break;
                case 'not_like':
                    $query = " NOT LIKE '{$value}'";
                    break;
                case 'contains':
                    $query = " LIKE '%{$value}%'";
                    break;
                case 'not_contains':
                    $query = " NOT LIKE '%{$value}%'";
                    break;
                case 'greater_than':
                    $query = " > '{$value}'";
                    break;
                case 'less_than':
                    $query = " < '{$value}'";
                    break;
                case 'between':
                    $valueParts = explode(",", $value);
                    $query = " BETWEEN {$valueParts[0]} AND {$valueParts[1]}";
                    break;
                case 'not_between':
                    $valueParts = explode(",", $value);
                    $query = " NOT BETWEEN {$valueParts[0]} AND {$valueParts[1]}";
                    break;
                default:
                    $query = " = '{$value}'";
                    break;
            }

            return $query;
        }




        public function queryBuilder($attribute_type, $matching_type, $value)
        {
            global $wpdb;

            $result = array();
            $matching_type_and_value = $this->queryMatchingTypeValue($matching_type, $value);
            $sql = "SELECT p.ID as post_id FROM {$wpdb->prefix}posts as p, {$wpdb->prefix}postmeta as m, {$wpdb->prefix}terms as t, {$wpdb->prefix}term_taxonomy as tt, {$wpdb->prefix}term_relationships as tr WHERE ";


            if($attribute_type == "woocommerce_price" || $attribute_type == "woocommerce_sale_price"
                || $attribute_type == "woocommerce_regular_price" || $attribute_type == "woocommerce_rating"
                || $attribute_type == "woocommerce_stock_status" || strpos($attribute_type, 'post_meta_') !== false){


                $sql = "SELECT p.ID as post_id FROM {$wpdb->prefix}posts as p, {$wpdb->prefix}postmeta as m WHERE ";


            }else if($attribute_type == "post_category" || $attribute_type == "woocommerce_category" || $attribute_type == "woocommerce_attributes"){

                $sql = "SELECT p.ID as post_id FROM {$wpdb->prefix}posts as p, {$wpdb->prefix}terms as t, {$wpdb->prefix}term_taxonomy as tt, {$wpdb->prefix}term_relationships as tr WHERE ";

            }else if($attribute_type == "post_title" || $attribute_type == "post_type" || $attribute_type == "woocommerce_product"
                || $attribute_type == "post_date" || $attribute_type == "post_modified"){

                $sql = "SELECT p.ID as post_id FROM {$wpdb->prefix}posts as p WHERE ";

            }else if($attribute_type == "post_author"){

                $sql = "SELECT p.ID as post_id FROM {$wpdb->prefix}posts as p, {$wpdb->prefix}users as u WHERE ";

            }


            if($attribute_type == "post_category") {
                $sql .= "(t.name {$matching_type_and_value} AND tt.term_id = t.term_id AND tt.taxonomy = 'category' AND tr.term_taxonomy_id = t.term_id AND p.ID = tr.object_id)";
            }

            if($attribute_type == "post_title") {
                $sql .= "(p.post_title {$matching_type_and_value})";
            }

            if($attribute_type == "post_type") {
                $sql .= "(p.post_type {$matching_type_and_value})";
            }

            if($attribute_type == "post_date") {
                $sql .= "(DATE_FORMAT(p.post_date, %s) {$matching_type_and_value})";
            }

            if($attribute_type == "post_modified") {
                $sql .= "(DATE_FORMAT(p.post_modified, %s) {$matching_type_and_value})";
            }

            if($attribute_type == "post_author") {
                $sql .= "(u.display_name {$matching_type_and_value} AND p.post_author = u.ID)";
            }




            if($attribute_type == "woocommerce_category" && class_exists('WooCommerce')) {
                $sql .= "(t.name {$matching_type_and_value} AND tt.term_id = t.term_id AND tt.taxonomy = 'product_cat' AND tr.term_taxonomy_id = t.term_id AND p.ID = tr.object_id)";
            }

            if($attribute_type == "woocommerce_product" && class_exists('WooCommerce')) {
                $sql .= "(p.post_title {$matching_type_and_value} AND p.post_type = 'product')";
            }

            if($attribute_type == "woocommerce_price" && class_exists('WooCommerce')) {
                $sql .= "(m.meta_value {$matching_type_and_value} AND m.meta_key = '_price' AND p.ID = m.post_id)";
            }

            if($attribute_type == "woocommerce_sale_price" && class_exists('WooCommerce')) {
                $sql .= "(m.meta_value {$matching_type_and_value} AND m.meta_key = '_sale_price' AND p.ID = m.post_id)";
            }

            if($attribute_type == "woocommerce_regular_price" && class_exists('WooCommerce')) {
                $sql .= "(m.meta_value {$matching_type_and_value} AND m.meta_key = '_regular_price' AND p.ID = m.post_id)";
            }

            if($attribute_type == "woocommerce_rating" && class_exists('WooCommerce')) {
                $sql .= "(m.meta_value {$matching_type_and_value} AND m.meta_key = '_wc_average_rating' AND p.ID = m.post_id)";
            }

            if($attribute_type == "woocommerce_stock_status" && class_exists('WooCommerce')) {
                $sql .= "(m.meta_value {$matching_type_and_value} AND m.meta_key = '_stock_status' AND p.ID = m.post_id)";
            }

            if($attribute_type == "woocommerce_attributes" && class_exists('WooCommerce')) {
                $sql .= "(t.slug {$matching_type_and_value} AND tr.term_taxonomy_id = t.term_id AND p.ID = tr.object_id AND p.post_type = 'product' AND p.post_status = 'publish')";
            }


            if (strpos($attribute_type, 'post_meta_') !== false) {
                $attribute_type = str_replace("post_meta_", "", $attribute_type);
                $sql .= "(m.meta_value {$matching_type_and_value} AND m.meta_key = '{$attribute_type}' AND p.ID = m.post_id)";
            }

            $sql .= " GROUP BY p.ID";


            if($attribute_type == "post_date" || $attribute_type == "post_modified") {
                $sql = $wpdb->prepare( $sql, array('%Y-%m-%d'));
            }else{
                $sql = $wpdb->prepare( $sql);
            }


            $listData = $wpdb->get_results($sql);
            if (sizeof($listData) > 0) {
                foreach ($listData as $singleData) {
                    $result[] = $singleData->post_id;
                }
            }


            return $result;
        }


        public function clearUnNecessaryIds($post_id_arr)
        {
            $cleared_post_ids = array();
            global $wpdb;
            $post_id_str = implode("','",$post_id_arr);
            $sql = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}posts WHERE post_status = 'publish' 
                                    AND ID IN ('".$post_id_str."') ORDER BY ID DESC", array() );

            $listPosts = $wpdb->get_results($sql);
            if (sizeof($listPosts) > 0) {
                foreach ($listPosts as $singlePost) {
                    $cleared_post_ids[] = $singlePost->ID;
                }
            }

            return $cleared_post_ids;
        }

        public function resultRender($post_id_arr, $list_result_attributes)
        {

            global $wpdb;
            $post_id_str = implode("','",$post_id_arr);
            $sql = $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}posts WHERE post_status = 'publish' 
                                    AND ID IN ('".$post_id_str."') ORDER BY ID DESC", array() );


            $all_post_html = "";
            $listPosts = $wpdb->get_results($sql);
            if (sizeof($listPosts) > 0) {
                foreach ($listPosts as $singlePost) {

                    $all_post_html .= "<div class=\"single_post\">";

                    //$test_result_attributes = array("post_category", "post_title", "post_date", "post_modified", "post_author", "post_thumbnail", "post_excerpt", "post_permalink",
                      //  "woocommerce_category", "woocommerce_price", "woocommerce_sale_price", "woocommerce_regular_price", "post_meta_guidant_field_438521");
                    $single_post_html = "";
                    foreach ($list_result_attributes as $single_result_attribute) {
                        $attribute_name = $single_result_attribute['attribute_type'];

                        $prefix = $single_result_attribute['prefix'];
                        if(strlen(trim($prefix)) > 0){
                            $prefix = $prefix." ";
                        }

                        $button_text = $single_result_attribute['button_text'];
                        if(strlen(trim($button_text)) == 0){
                            $button_text = "View";
                        }

                        $image_height = $single_result_attribute['image_height'];
                        if(strlen(trim($image_height)) == 0){
                            $image_height = "200";
                        }

                        if($attribute_name == "post_category") {
                            $post_categories = get_the_terms( $singlePost->ID, 'category' );
                            $post_categories_str = join(', ', wp_list_pluck($post_categories, 'name'));
                            $single_post_html .= "<div class=\"post_category\">{$prefix}{$post_categories_str}</div>";
                        }

                        if($attribute_name == "post_title") {
                            $single_post_html .= "<div class=\"post_title\">{$prefix}{$singlePost->post_title}</div>";
                        }

                        if($attribute_name == "post_date") {
                            $single_post_html .= "<div class=\"post_date\">{$prefix}{$singlePost->post_date}</div>";
                        }

                        if($attribute_name == "post_modified") {
                            $single_post_html .= "<div class=\"post_modified\">{$prefix}{$singlePost->post_modified}</div>";
                        }

                        if($attribute_name == "post_author") {
                            $user_info = get_userdata($singlePost->post_author);
                            $user_name = ($user_info) ? $user_info->display_name : "Anonymous";
                            $single_post_html .= "<div class=\"post_author\">{$prefix}{$user_name}</div>";
                        }

                        if($attribute_name == "post_thumbnail") {
                            if(has_post_thumbnail($singlePost->ID)){
                                $image_url = get_the_post_thumbnail_url($singlePost->ID,'post-thumbnail');
                                $single_post_html .= "<div class=\"post_thumbnail\"><img style='height: {$image_height}px !important;' src=\"{$image_url}\"></div>";
                            }
                        }

                        if($attribute_name == "post_excerpt") {
                            $excerpt = get_post_field('post_content', $singlePost->ID);
                            $excerpt = strip_tags($excerpt);
                            $excerpt = substr($excerpt, 0, 150);
                            $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
                            $excerpt = $excerpt.'...';
                            $single_post_html .= "<div class=\"post_excerpt\">{$prefix}{$excerpt}</div>";
                        }

                        if($attribute_name == "post_permalink") {
                            $post_url = get_permalink( $singlePost->ID);
                            $single_post_html .= "<div class=\"post_permalink\"><a target='_blank' href=\"{$post_url}\">{$button_text}</a></div>";
                        }


                        if($attribute_name == "woocommerce_category" && class_exists('WooCommerce')) {
                            if(wc_get_product($singlePost->ID)){
                                $post_categories = get_the_terms( $singlePost->ID, 'product_cat' );
                                $post_categories_str = join(', ', wp_list_pluck($post_categories, 'name'));
                                $single_post_html .= "<div class=\"woocommerce_category\">{$prefix}{$post_categories_str}</div>";
                            }
                        }

                        if($attribute_name == "woocommerce_price" && class_exists('WooCommerce')) {
                            if(wc_get_product($singlePost->ID)){
                                $post_meta_sale = get_post_meta( $singlePost->ID, '_sale_price', true );
                                $post_meta_regular = get_post_meta( $singlePost->ID, '_regular_price', true );
                                $post_meta_price = get_post_meta( $singlePost->ID, '_price', false );
                                $currency_symbol = get_woocommerce_currency_symbol();

                                if(!empty($post_meta_sale) && !empty($post_meta_regular) ){
                                    $single_post_html .= "<div class=\"woocommerce_price\">{$prefix}{$currency_symbol}{$post_meta_sale} <del>{$currency_symbol}{$post_meta_regular}</del></div>";
                                }else if(sizeof($post_meta_price) > 1){
                                    $min = min($post_meta_price);
                                    $max = max($post_meta_price);
                                    $single_post_html .= "<div class=\"woocommerce_price\">{$prefix}{$currency_symbol}{$min} - {$currency_symbol}{$max}</div>";
                                }else{
                                    $single_post_html .= "<div class=\"woocommerce_price\">{$prefix}{$currency_symbol}{$post_meta_regular}</div>";
                                }
                            }
                        }


                        if (strpos($attribute_name, 'post_meta_') !== false) {
                            $attribute_name = str_replace("post_meta_", "", $attribute_name);
                            $post_meta = get_post_meta( $singlePost->ID, $attribute_name, true );
                            $single_post_html .= "<div class=\"custom_meta\">{$prefix}{$post_meta}</div>";
                        }


                    }

                    $all_post_html .= $single_post_html;
                    $all_post_html .= "</div>";

                }
            }


            return $all_post_html;
        }


    }
}