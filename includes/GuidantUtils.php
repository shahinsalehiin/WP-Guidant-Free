<?php

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

if ( ! class_exists( 'GuidantUtils' ) ) {
    class GuidantUtils
    {

        public function filterBySearch($array, $search = ""){

            if(strlen(trim($search)) == 0){
                return $array;
            }

            $filteredArray = array();
            foreach ($array as $single_row){
                if (strpos(strtolower($single_row['id']), strtolower($search)) !== false) {
                    $filteredArray[] = $single_row;
                }else if (strpos(strtolower($single_row['text']), strtolower($search)) !== false) {
                    $filteredArray[] = $single_row;
                }
            }
            return $filteredArray;
        }

        public function getPostAttributes($search)
        {
            $postAttributes = array();
            $postAttributes[] = array("id" => "post_category", "text" => "[Post] Post Category");
            $postAttributes[] = array("id" => "post_title", "text" => "[Post] Post Title");
            $postAttributes[] = array("id" => "post_type", "text" => "[Post] Post Type");
            $postAttributes[] = array("id" => "post_date", "text" => "[Post] Post Date");
            $postAttributes[] = array("id" => "post_modified", "text" => "[Post] Post Modified");
            $postAttributes[] = array("id" => "post_author", "text" => "[Post] Post Author");
            $postAttributes[] = array("id" => "post_tags", "text" => "[Post] Post Tags");
            return $this->filterBySearch($postAttributes, $search);
        }


        public function getPostAttributesForResult($search)
        {
            $postAttributes = array();
            $postAttributes[] = array("id" => "post_category", "text" => "[Post] Post Category");
            $postAttributes[] = array("id" => "post_title", "text" => "[Post] Post Title");
            $postAttributes[] = array("id" => "post_date", "text" => "[Post] Post Date");
            $postAttributes[] = array("id" => "post_modified", "text" => "[Post] Post Modified");
            $postAttributes[] = array("id" => "post_author", "text" => "[Post] Post Author");
            $postAttributes[] = array("id" => "post_thumbnail", "text" => "[Post] Post Thumbnail");
            $postAttributes[] = array("id" => "post_excerpt", "text" => "[Post] Post Excerpt");
            $postAttributes[] = array("id" => "post_permalink", "text" => "[Post] Post Permalink Button");
            return $this->filterBySearch($postAttributes, $search);
        }

        public function getWoocommerceAttributes($search)
        {
            $wooCommerceAttributes = array();
            if (class_exists('WooCommerce')) {
                $wooCommerceAttributes[] = array("id" => "woocommerce_category", "text" => "[WooCommerce] Product Category");
                $wooCommerceAttributes[] = array("id" => "woocommerce_tags", "text" => "[WooCommerce] Product Tags");
                $wooCommerceAttributes[] = array("id" => "woocommerce_product", "text" => "[WooCommerce] Product");
                $wooCommerceAttributes[] = array("id" => "woocommerce_price", "text" => "[WooCommerce] Price");
                $wooCommerceAttributes[] = array("id" => "woocommerce_sale_price", "text" => "[WooCommerce] Sale Price");
                $wooCommerceAttributes[] = array("id" => "woocommerce_regular_price", "text" => "[WooCommerce] Regular Price");
                $wooCommerceAttributes[] = array("id" => "woocommerce_rating", "text" => "[WooCommerce] Rating");
                $wooCommerceAttributes[] = array("id" => "woocommerce_stock_status", "text" => "[WooCommerce] Stock Status");
                $wooCommerceAttributes[] = array("id" => "woocommerce_attributes", "text" => "[WooCommerce] Product Attributes");
            }
            return $this->filterBySearch($wooCommerceAttributes, $search);
        }

        public function getWoocommerceAttributesForResults($search)
        {
            $wooCommerceAttributes = array();
            if (class_exists('WooCommerce')) {
                $wooCommerceAttributes[] = array("id" => "post_title", "text" => "[WooCommerce] Product Title");
                $wooCommerceAttributes[] = array("id" => "woocommerce_category", "text" => "[WooCommerce] Product Category");
                $wooCommerceAttributes[] = array("id" => "post_thumbnail", "text" => "[WooCommerce] Product Thumbnail");
                $wooCommerceAttributes[] = array("id" => "post_excerpt", "text" => "[WooCommerce] Product Excerpt");
                $wooCommerceAttributes[] = array("id" => "woocommerce_price", "text" => "[WooCommerce] Price");
                $postAttributes[] = array("id" => "post_permalink", "text" => "[WooCommerce] Product Permalink Button");
            }
            return $this->filterBySearch($wooCommerceAttributes, $search);
        }

        public function getAcfFields($search)
        {
            global $wpdb;
            $acfAttributes = array();
            if (class_exists('ACF')) {
                $sql = $wpdb->prepare( "SELECT post_title, post_excerpt FROM {$wpdb->prefix}posts WHERE post_type = 'acf-field' AND post_status = 'publish' ORDER BY ID DESC", array() );
                $listPosts = $wpdb->get_results($sql);
                if (sizeof($listPosts) > 0) {
                    foreach ($listPosts as $singlePost) {
                        $acfAttributes[] = array("id" => "post_meta_".$singlePost->post_excerpt, "text" => $singlePost->post_title);
                    }
                }
            }
            return $this->filterBySearch($acfAttributes, $search);
        }

        public function getGuidantCustomFields($list_fields, $search)
        {
            $guidantCustomFields = array();
            foreach ($list_fields as $single_field){
                $guidantCustomFields[] = array("id" => "post_meta_".$single_field['field_id'], "text" => "[Custom Field] ".$single_field['field_label']);
            }
            return $this->filterBySearch($guidantCustomFields, $search);
        }

        public function getAllMetaFields($post_type, $search)
        {

            global $wpdb;
            $guidantAllMetaFields = array();
            $sql = $wpdb->prepare( "SELECT DISTINCT m.meta_key FROM {$wpdb->prefix}posts as p, {$wpdb->prefix}postmeta as m 
                                    WHERE p.post_type = %s AND p.post_status = 'publish'
                                    AND m.post_id = p.ID", array( $post_type) );
            $listFields = $wpdb->get_results($sql);

            if (sizeof($listFields) > 0) {
                foreach ($listFields as $single_field) {
                    $guidantAllMetaFields[] = array("id" => "post_meta_".$single_field->meta_key, "text" => $single_field->meta_key);
                }
            }

            return $this->filterBySearch($guidantAllMetaFields, $search);
        }



        public function getAttributeValues($attribute_name, $search = "")
        {
            global $wpdb;
            $search = trim($search);
            $attributeValues = array();

            /* *************** POST ATTRIBUTES *************** */
            if($attribute_name == "post_category") {
                $listCategories = get_categories(array('hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC', 'name__like' => $search));
                if (sizeof($listCategories) > 0) {
                    foreach ($listCategories as $singleCategory) {
                        $attributeValues[] = array("id" => $singleCategory->name, "text" => $singleCategory->name);
                    }
                }
            }



            if($attribute_name == "post_title") {
                $sql = $wpdb->prepare( "SELECT DISTINCT post_title FROM {$wpdb->prefix}posts WHERE post_title LIKE %s ORDER BY ID DESC LIMIT 40", array( '%'.$search.'%' ) );
                $listPosts = $wpdb->get_results($sql);
                if (sizeof($listPosts) > 0) {
                    foreach ($listPosts as $singlePost) {
                        $attributeValues[] = array("id" => $singlePost->post_title, "text" => $singlePost->post_title);
                    }
                }
            }



            if($attribute_name == "post_type") {
                $listPostTypes = get_post_types(array('public' => true), 'objects');
                if (sizeof($listPostTypes) > 0) {
                    foreach ($listPostTypes as $singlePostType) {
                        $labels = get_post_type_labels( $singlePostType );
                        $attributeValues[] = array("id" => $singlePostType->name, "text" => "[".$singlePostType->name."] ".$labels->name);
                    }
                }
            }


            if($attribute_name == "post_date") {
                $sql = $wpdb->prepare( "SELECT DATE_FORMAT(post_date, %s) AS p_date FROM {$wpdb->prefix}posts WHERE DATE_FORMAT(post_date, %s) LIKE %s GROUP BY DATE_FORMAT(post_date, %s) ORDER BY post_date DESC LIMIT 10" ,
                    array('%Y-%m-%d', '%Y-%m-%d', '%'.$search.'%', '%Y-%m-%d') );
                $listPosts = $wpdb->get_results($sql);
                if (sizeof($listPosts) > 0) {
                    foreach ($listPosts as $singlePost) {
                        $attributeValues[] = array("id" => $singlePost->p_date, "text" => $singlePost->p_date);
                    }
                }
            }

            if($attribute_name == "post_modified") {
                $sql = $wpdb->prepare( "SELECT DATE_FORMAT(post_modified, %s) AS p_date FROM {$wpdb->prefix}posts WHERE DATE_FORMAT(post_modified, %s) LIKE %s GROUP BY DATE_FORMAT(post_modified, %s) ORDER BY post_modified DESC LIMIT 10" ,
                    array('%Y-%m-%d', '%Y-%m-%d', '%'.$search.'%', '%Y-%m-%d') );
                $listPosts = $wpdb->get_results($sql);
                if (sizeof($listPosts) > 0) {
                    foreach ($listPosts as $singlePost) {
                        $attributeValues[] = array("id" => $singlePost->p_date, "text" => $singlePost->p_date);
                    }
                }
            }


            if($attribute_name == "post_author") {
                $listUsers = get_users(array( 'search' => '*'.$search.'*' ));
                if (sizeof($listUsers) > 0) {
                    foreach ($listUsers as $singleUser) {
                        $attributeValues[] = array("id" => $singleUser->display_name, "text" => $singleUser->display_name);
                    }
                }
            }


            if($attribute_name == "post_tags") {
                $listTags = get_tags(array('hide_empty' => false));
                if (sizeof($listTags) > 0) {
                    foreach ($listTags as $singleTag) {
                        $attributeValues[] = array("id" => $singleTag->name, "text" => $singleTag->name);
                    }
                }
            }

            /* *************** WOOCOMMERCE ATTRIBUTES *************** */

            if($attribute_name == "woocommerce_category") {
                if (class_exists('WooCommerce')) {
                    $listCategories = get_terms('product_cat', array('hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC', 'name__like' => $search));
                    if (sizeof($listCategories) > 0) {
                        foreach ($listCategories as $singleCategory) {
                            $attributeValues[] = array("id" => $singleCategory->name, "text" => $singleCategory->name);
                        }
                    }
                }
            }


            if($attribute_name == "woocommerce_tags") {
                if (class_exists('WooCommerce')) {
                    $sql = $wpdb->prepare( "SELECT terms.name as tag FROM {$wpdb->prefix}posts as posts, {$wpdb->prefix}terms as terms,
                                                    {$wpdb->prefix}term_relationships as relationship, {$wpdb->prefix}term_taxonomy as taxonomies
                                                    WHERE posts.post_type = 'product' AND posts.post_status = 'publish' 
                                                    AND relationship.object_id = posts.ID AND taxonomies.term_taxonomy_id = relationship.term_taxonomy_id
                                                    AND taxonomies.taxonomy = 'product_tag' AND terms.term_id = taxonomies.term_id AND terms.name LIKE %s GROUP BY terms.name LIMIT 10", array( '%'.$search.'%' ) );
                    $listTags = $wpdb->get_results($sql);
                    if (sizeof($listTags) > 0) {
                        foreach ($listTags as $singleTag) {
                            $attributeValues[] = array("id" => $singleTag->tag, "text" => $singleTag->tag);
                        }
                    }
                }
            }

            if($attribute_name == "woocommerce_product") {
                if (class_exists('WooCommerce')) {
                    $sql = $wpdb->prepare( "SELECT ID, post_title FROM {$wpdb->prefix}posts WHERE post_type = 'product' AND post_status = 'publish' AND post_title LIKE %s ORDER BY ID DESC LIMIT 10", array( '%'.$search.'%' ) );
                    $listPosts = $wpdb->get_results($sql);
                    if (sizeof($listPosts) > 0) {
                        foreach ($listPosts as $singlePost) {
                            $attributeValues[] = array("id" => $singlePost->post_title, "text" => $singlePost->post_title);
                        }
                    }
                }
            }

            if($attribute_name == "woocommerce_price") {
                if (class_exists('WooCommerce')) {
                    $sql = $wpdb->prepare( "SELECT meta.meta_value as price FROM {$wpdb->prefix}posts as posts, {$wpdb->prefix}postmeta as meta WHERE posts.post_type = 'product'
                                                    AND posts.post_status = 'publish' AND meta.post_id = posts.ID AND meta.meta_key = '_price' AND meta.meta_value LIKE %s GROUP BY meta.meta_value LIMIT 10", array( '%'.$search.'%' ) );
                    $listPrices = $wpdb->get_results($sql);
                    if (sizeof($listPrices) > 0) {
                        foreach ($listPrices as $singlePrice) {
                            $attributeValues[] = array("id" => $singlePrice->price, "text" => $singlePrice->price);
                        }
                    }
                }
            }

            if($attribute_name == "woocommerce_sale_price") {
                if (class_exists('WooCommerce')) {
                    $sql = $wpdb->prepare( "SELECT meta.meta_value as sale_price FROM {$wpdb->prefix}posts as posts, {$wpdb->prefix}postmeta as meta WHERE posts.post_type = 'product'
                                                    AND posts.post_status = 'publish' AND meta.post_id = posts.ID AND meta.meta_key = '_sale_price' AND meta.meta_value LIKE %s GROUP BY meta.meta_value LIMIT 10", array( '%'.$search.'%' ) );
                    $listPrices = $wpdb->get_results($sql);
                    if (sizeof($listPrices) > 0) {
                        foreach ($listPrices as $singlePrice) {
                            $attributeValues[] = array("id" => $singlePrice->sale_price, "text" => $singlePrice->sale_price);
                        }
                    }
                }
            }

            if($attribute_name == "woocommerce_regular_price") {
                if (class_exists('WooCommerce')) {
                    $sql = $wpdb->prepare( "SELECT meta.meta_value as regular_price FROM {$wpdb->prefix}posts as posts, {$wpdb->prefix}postmeta as meta WHERE posts.post_type = 'product'
                                                    AND posts.post_status = 'publish' AND meta.post_id = posts.ID AND meta.meta_key = '_regular_price' AND meta.meta_value LIKE %s GROUP BY meta.meta_value LIMIT 10", array( '%'.$search.'%' ) );
                    $listPrices = $wpdb->get_results($sql);
                    if (sizeof($listPrices) > 0) {
                        foreach ($listPrices as $singlePrice) {
                            $attributeValues[] = array("id" => $singlePrice->regular_price, "text" => $singlePrice->regular_price);
                        }
                    }
                }
            }

            if($attribute_name == "woocommerce_rating") {
                if (class_exists('WooCommerce')) {
                    $sql = $wpdb->prepare( "SELECT meta.meta_value as average_rating FROM {$wpdb->prefix}posts as posts, {$wpdb->prefix}postmeta as meta WHERE posts.post_type = 'product'
                                                    AND posts.post_status = 'publish' AND meta.post_id = posts.ID AND meta.meta_key = '_wc_average_rating' AND meta.meta_value LIKE %s GROUP BY meta.meta_value LIMIT 10", array( '%'.$search.'%' ) );
                    $listPrices = $wpdb->get_results($sql);
                    if (sizeof($listPrices) > 0) {
                        foreach ($listPrices as $singlePrice) {
                            $attributeValues[] = array("id" => $singlePrice->average_rating, "text" => $singlePrice->average_rating);
                        }
                    }
                }
            }

            if($attribute_name == "woocommerce_stock_status") {
                if (class_exists('WooCommerce')) {
                    $sql = $wpdb->prepare( "SELECT meta.meta_value as stock_status FROM {$wpdb->prefix}posts as posts, {$wpdb->prefix}postmeta as meta WHERE posts.post_type = 'product'
                                                    AND posts.post_status = 'publish' AND meta.post_id = posts.ID AND meta.meta_key = '_stock_status' AND meta.meta_value LIKE %s GROUP BY meta.meta_value LIMIT 10", array( '%'.$search.'%' ) );
                    $listPrices = $wpdb->get_results($sql);
                    if (sizeof($listPrices) > 0) {
                        foreach ($listPrices as $singlePrice) {
                            $attributeValues[] = array("id" => $singlePrice->stock_status, "text" => $singlePrice->stock_status);
                        }
                    }
                }
            }

            if($attribute_name == "woocommerce_attributes") {
                if (class_exists('WooCommerce')) {

                    $sql = $wpdb->prepare( "SELECT attributes.attribute_name as attribute_slug FROM {$wpdb->prefix}woocommerce_attribute_taxonomies as attributes", array() );
                    $listAttributes = $wpdb->get_results($sql);
                    if (sizeof($listAttributes) > 0) {
                        foreach ($listAttributes as $singleAttribute) {
                            $sql = $wpdb->prepare( "SELECT terms.slug as slug, terms.name as name FROM {$wpdb->prefix}term_taxonomy as ttaxonomy, {$wpdb->prefix}terms as terms WHERE ttaxonomy.taxonomy = 'pa_".$singleAttribute->attribute_slug."'
                                                    AND terms.term_id = ttaxonomy.term_id AND terms.name LIKE %s GROUP BY terms.term_id LIMIT 10", array( '%'.$search.'%' ) );
                            $listVariations = $wpdb->get_results($sql);
                            if (sizeof($listVariations) > 0) {
                                foreach ($listVariations as $singleVariation) {
                                    $attributeValues[] = array("id" => $singleVariation->slug, "text" => $singleVariation->name);
                                }
                            }
                        }
                    }
                }
            }

            if($attribute_name == "woocommerce_on_sale") {
                if (class_exists('WooCommerce')) {
                    $attributeValues[] = array("id" => 1, "text" => "Products On Sale");
                    $attributeValues[] = array("id" => 0, "text" => "Products Not On Sale");
                }
            }




            /* *************** WP Guidant Custom Field ATTRIBUTES *************** */

            if (strpos($attribute_name, 'post_meta_') !== false) {
                $attribute_name = str_replace("post_meta_", "", $attribute_name);
                $sql = $wpdb->prepare( "SELECT meta.meta_value as feild_value FROM {$wpdb->prefix}posts as posts, {$wpdb->prefix}postmeta as meta WHERE posts.post_status = 'publish' 
                                                AND meta.post_id = posts.ID AND meta.meta_key = %s AND meta.meta_value LIKE %s GROUP BY meta.meta_value LIMIT 10", array( $attribute_name, '%'.$search.'%' ) );
                $listValues = $wpdb->get_results($sql);
                if (sizeof($listValues) > 0) {
                    foreach ($listValues as $singleValue) {
                        $attributeValues[] = array("id" => $singleValue->feild_value, "text" => $singleValue->feild_value);
                    }
                }
            }

            return $attributeValues;
        }



    }
}
