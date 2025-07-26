<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!class_exists('GuidantUtils')) {
    class GuidantUtils
    {

        public function filterBySearch($array, $search = "")
        {

            if (strlen(trim($search)) == 0) {
                return $array;
            }

            $filteredArray = array();
            foreach ($array as $single_row) {
                if (strpos(strtolower($single_row['id']), strtolower($search)) !== false) {
                    $filteredArray[] = $single_row;
                } else if (strpos(strtolower($single_row['text']), strtolower($search)) !== false) {
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

        // public function getAcfFields($search)
        // {
        //     global $wpdb;
        //     $acfAttributes = array();
        //     if (class_exists('ACF')) {
        //         $sql = $wpdb->prepare( "SELECT post_title, post_excerpt FROM {$wpdb->prefix}posts WHERE post_type = 'acf-field' AND post_status = 'publish' ORDER BY ID DESC", array() );
        //         $listPosts = $wpdb->get_results($sql);
        //         if (sizeof($listPosts) > 0) {
        //             foreach ($listPosts as $singlePost) {
        //                 $acfAttributes[] = array("id" => "post_meta_".$singlePost->post_excerpt, "text" => $singlePost->post_title);
        //             }
        //         }
        //     }
        //     return $this->filterBySearch($acfAttributes, $search);
        // }

        public function getAcfFields($search)
        {
            $acfAttributes = array();
            if (class_exists('ACF')) {
                $args = array(
                    'post_type'      => 'acf-field',
                    'post_status'    => 'publish',
                    'posts_per_page' => -1, // Retrieve all posts
                    'orderby'        => 'ID',
                    'order'          => 'DESC',
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) {
                    while ($query->have_posts()) {
                        $query->the_post();
                        $acfAttributes[] = array(
                            'id'   => 'post_meta_' . get_post_field('post_excerpt', get_the_ID()),
                            'text' => get_the_title(),
                        );
                    }
                    wp_reset_postdata(); // Restore global post data
                }
            }
            return $this->filterBySearch($acfAttributes, $search);
        }

        public function getGuidantCustomFields($list_fields, $search)
        {
            $guidantCustomFields = array();
            foreach ($list_fields as $single_field) {
                $guidantCustomFields[] = array("id" => "post_meta_" . $single_field['field_id'], "text" => "[Custom Field] " . $single_field['field_label']);
            }
            return $this->filterBySearch($guidantCustomFields, $search);
        }

        // public function getAllMetaFields($post_type, $search)
        // {

        //     global $wpdb;
        //     $guidantAllMetaFields = array();
        //     $sql = $wpdb->prepare( "SELECT DISTINCT m.meta_key FROM {$wpdb->prefix}posts as p, {$wpdb->prefix}postmeta as m 
        //                             WHERE p.post_type = %s AND p.post_status = 'publish'
        //                             AND m.post_id = p.ID", array( $post_type) );
        //     $listFields = $wpdb->get_results($sql);

        //     if (sizeof($listFields) > 0) {
        //         foreach ($listFields as $single_field) {
        //             $guidantAllMetaFields[] = array("id" => "post_meta_".$single_field->meta_key, "text" => $single_field->meta_key);
        //         }
        //     }

        //     return $this->filterBySearch($guidantAllMetaFields, $search);
        // }

        public function getAllMetaFields($post_type, $search)
        {
            $wpguidantAllMetaFields = array();

            $args = array(
                'post_type'      => $post_type,
                'post_status'    => 'publish',
                'meta_query'     => array(
                    'relation' => 'AND',
                    array(
                        'key'     => '',
                        'compare' => 'EXISTS', // Ensures meta exists for the post
                    ),
                ),
                'meta_key'       => '',
                'orderby'        => 'meta_key',
                'order'          => 'ASC',
                'posts_per_page' => -1, // Get all posts
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
                    $meta_keys = get_post_custom_keys(get_the_ID());
                    if ($meta_keys) {
                        foreach ($meta_keys as $meta_key) {
                            $wpguidantAllMetaFields[] = array("id" => "post_meta_" . $meta_key, "text" => $meta_key);
                        }
                    }
                }
            }

            wp_reset_postdata();

            return $this->filterBySearch($wpguidantAllMetaFields, $search);
        }

        // public function getAttributeValues($attribute_name, $search = "")
        // {
        //     global $wpdb;
        //     $search = trim($search);
        //     $attributeValues = array();

        //     /* *************** POST ATTRIBUTES *************** */
        //     if($attribute_name == "post_category") {
        //         $listCategories = get_categories(array('hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC', 'name__like' => $search));
        //         if (sizeof($listCategories) > 0) {
        //             foreach ($listCategories as $singleCategory) {
        //                 $attributeValues[] = array("id" => $singleCategory->name, "text" => $singleCategory->name);
        //             }
        //         }
        //     }



        //     if($attribute_name == "post_title") {
        //         $sql = $wpdb->prepare( "SELECT DISTINCT post_title FROM {$wpdb->prefix}posts WHERE post_title LIKE %s ORDER BY ID DESC LIMIT 40", array( '%'.$search.'%' ) );
        //         $listPosts = $wpdb->get_results($sql);
        //         if (sizeof($listPosts) > 0) {
        //             foreach ($listPosts as $singlePost) {
        //                 $attributeValues[] = array("id" => $singlePost->post_title, "text" => $singlePost->post_title);
        //             }
        //         }
        //     }



        //     if($attribute_name == "post_type") {
        //         $listPostTypes = get_post_types(array('public' => true), 'objects');
        //         if (sizeof($listPostTypes) > 0) {
        //             foreach ($listPostTypes as $singlePostType) {
        //                 $labels = get_post_type_labels( $singlePostType );
        //                 $attributeValues[] = array("id" => $singlePostType->name, "text" => "[".$singlePostType->name."] ".$labels->name);
        //             }
        //         }
        //     }


        //     if($attribute_name == "post_date") {
        //         $sql = $wpdb->prepare( "SELECT DATE_FORMAT(post_date, %s) AS p_date FROM {$wpdb->prefix}posts WHERE DATE_FORMAT(post_date, %s) LIKE %s GROUP BY DATE_FORMAT(post_date, %s) ORDER BY post_date DESC LIMIT 10" ,
        //             array('%Y-%m-%d', '%Y-%m-%d', '%'.$search.'%', '%Y-%m-%d') );
        //         $listPosts = $wpdb->get_results($sql);
        //         if (sizeof($listPosts) > 0) {
        //             foreach ($listPosts as $singlePost) {
        //                 $attributeValues[] = array("id" => $singlePost->p_date, "text" => $singlePost->p_date);
        //             }
        //         }
        //     }

        //     if($attribute_name == "post_modified") {
        //         $sql = $wpdb->prepare( "SELECT DATE_FORMAT(post_modified, %s) AS p_date FROM {$wpdb->prefix}posts WHERE DATE_FORMAT(post_modified, %s) LIKE %s GROUP BY DATE_FORMAT(post_modified, %s) ORDER BY post_modified DESC LIMIT 10" ,
        //             array('%Y-%m-%d', '%Y-%m-%d', '%'.$search.'%', '%Y-%m-%d') );
        //         $listPosts = $wpdb->get_results($sql);
        //         if (sizeof($listPosts) > 0) {
        //             foreach ($listPosts as $singlePost) {
        //                 $attributeValues[] = array("id" => $singlePost->p_date, "text" => $singlePost->p_date);
        //             }
        //         }
        //     }


        //     if($attribute_name == "post_author") {
        //         $listUsers = get_users(array( 'search' => '*'.$search.'*' ));
        //         if (sizeof($listUsers) > 0) {
        //             foreach ($listUsers as $singleUser) {
        //                 $attributeValues[] = array("id" => $singleUser->display_name, "text" => $singleUser->display_name);
        //             }
        //         }
        //     }


        //     if($attribute_name == "post_tags") {
        //         $listTags = get_tags(array('hide_empty' => false));
        //         if (sizeof($listTags) > 0) {
        //             foreach ($listTags as $singleTag) {
        //                 $attributeValues[] = array("id" => $singleTag->name, "text" => $singleTag->name);
        //             }
        //         }
        //     }

        //     /* *************** WOOCOMMERCE ATTRIBUTES *************** */

        //     if($attribute_name == "woocommerce_category") {
        //         if (class_exists('WooCommerce')) {
        //             $listCategories = get_terms('product_cat', array('hide_empty' => false, 'orderby' => 'name', 'order' => 'ASC', 'name__like' => $search));
        //             if (sizeof($listCategories) > 0) {
        //                 foreach ($listCategories as $singleCategory) {
        //                     $attributeValues[] = array("id" => $singleCategory->name, "text" => $singleCategory->name);
        //                 }
        //             }
        //         }
        //     }


        //     if($attribute_name == "woocommerce_tags") {
        //         if (class_exists('WooCommerce')) {
        //             $sql = $wpdb->prepare( "SELECT terms.name as tag FROM {$wpdb->prefix}posts as posts, {$wpdb->prefix}terms as terms,
        //                                             {$wpdb->prefix}term_relationships as relationship, {$wpdb->prefix}term_taxonomy as taxonomies
        //                                             WHERE posts.post_type = 'product' AND posts.post_status = 'publish' 
        //                                             AND relationship.object_id = posts.ID AND taxonomies.term_taxonomy_id = relationship.term_taxonomy_id
        //                                             AND taxonomies.taxonomy = 'product_tag' AND terms.term_id = taxonomies.term_id AND terms.name LIKE %s GROUP BY terms.name LIMIT 10", array( '%'.$search.'%' ) );
        //             $listTags = $wpdb->get_results($sql);
        //             if (sizeof($listTags) > 0) {
        //                 foreach ($listTags as $singleTag) {
        //                     $attributeValues[] = array("id" => $singleTag->tag, "text" => $singleTag->tag);
        //                 }
        //             }
        //         }
        //     }

        //     if($attribute_name == "woocommerce_product") {
        //         if (class_exists('WooCommerce')) {
        //             $sql = $wpdb->prepare( "SELECT ID, post_title FROM {$wpdb->prefix}posts WHERE post_type = 'product' AND post_status = 'publish' AND post_title LIKE %s ORDER BY ID DESC LIMIT 10", array( '%'.$search.'%' ) );
        //             $listPosts = $wpdb->get_results($sql);
        //             if (sizeof($listPosts) > 0) {
        //                 foreach ($listPosts as $singlePost) {
        //                     $attributeValues[] = array("id" => $singlePost->post_title, "text" => $singlePost->post_title);
        //                 }
        //             }
        //         }
        //     }

        //     if($attribute_name == "woocommerce_price") {
        //         if (class_exists('WooCommerce')) {
        //             $sql = $wpdb->prepare( "SELECT meta.meta_value as price FROM {$wpdb->prefix}posts as posts, {$wpdb->prefix}postmeta as meta WHERE posts.post_type = 'product'
        //                                             AND posts.post_status = 'publish' AND meta.post_id = posts.ID AND meta.meta_key = '_price' AND meta.meta_value LIKE %s GROUP BY meta.meta_value LIMIT 10", array( '%'.$search.'%' ) );
        //             $listPrices = $wpdb->get_results($sql);
        //             if (sizeof($listPrices) > 0) {
        //                 foreach ($listPrices as $singlePrice) {
        //                     $attributeValues[] = array("id" => $singlePrice->price, "text" => $singlePrice->price);
        //                 }
        //             }
        //         }
        //     }

        //     if($attribute_name == "woocommerce_sale_price") {
        //         if (class_exists('WooCommerce')) {
        //             $sql = $wpdb->prepare( "SELECT meta.meta_value as sale_price FROM {$wpdb->prefix}posts as posts, {$wpdb->prefix}postmeta as meta WHERE posts.post_type = 'product'
        //                                             AND posts.post_status = 'publish' AND meta.post_id = posts.ID AND meta.meta_key = '_sale_price' AND meta.meta_value LIKE %s GROUP BY meta.meta_value LIMIT 10", array( '%'.$search.'%' ) );
        //             $listPrices = $wpdb->get_results($sql);
        //             if (sizeof($listPrices) > 0) {
        //                 foreach ($listPrices as $singlePrice) {
        //                     $attributeValues[] = array("id" => $singlePrice->sale_price, "text" => $singlePrice->sale_price);
        //                 }
        //             }
        //         }
        //     }

        //     if($attribute_name == "woocommerce_regular_price") {
        //         if (class_exists('WooCommerce')) {
        //             $sql = $wpdb->prepare( "SELECT meta.meta_value as regular_price FROM {$wpdb->prefix}posts as posts, {$wpdb->prefix}postmeta as meta WHERE posts.post_type = 'product'
        //                                             AND posts.post_status = 'publish' AND meta.post_id = posts.ID AND meta.meta_key = '_regular_price' AND meta.meta_value LIKE %s GROUP BY meta.meta_value LIMIT 10", array( '%'.$search.'%' ) );
        //             $listPrices = $wpdb->get_results($sql);
        //             if (sizeof($listPrices) > 0) {
        //                 foreach ($listPrices as $singlePrice) {
        //                     $attributeValues[] = array("id" => $singlePrice->regular_price, "text" => $singlePrice->regular_price);
        //                 }
        //             }
        //         }
        //     }

        //     if($attribute_name == "woocommerce_rating") {
        //         if (class_exists('WooCommerce')) {
        //             $sql = $wpdb->prepare( "SELECT meta.meta_value as average_rating FROM {$wpdb->prefix}posts as posts, {$wpdb->prefix}postmeta as meta WHERE posts.post_type = 'product'
        //                                             AND posts.post_status = 'publish' AND meta.post_id = posts.ID AND meta.meta_key = '_wc_average_rating' AND meta.meta_value LIKE %s GROUP BY meta.meta_value LIMIT 10", array( '%'.$search.'%' ) );
        //             $listPrices = $wpdb->get_results($sql);
        //             if (sizeof($listPrices) > 0) {
        //                 foreach ($listPrices as $singlePrice) {
        //                     $attributeValues[] = array("id" => $singlePrice->average_rating, "text" => $singlePrice->average_rating);
        //                 }
        //             }
        //         }
        //     }

        //     if($attribute_name == "woocommerce_stock_status") {
        //         if (class_exists('WooCommerce')) {
        //             $sql = $wpdb->prepare( "SELECT meta.meta_value as stock_status FROM {$wpdb->prefix}posts as posts, {$wpdb->prefix}postmeta as meta WHERE posts.post_type = 'product'
        //                                             AND posts.post_status = 'publish' AND meta.post_id = posts.ID AND meta.meta_key = '_stock_status' AND meta.meta_value LIKE %s GROUP BY meta.meta_value LIMIT 10", array( '%'.$search.'%' ) );
        //             $listPrices = $wpdb->get_results($sql);
        //             if (sizeof($listPrices) > 0) {
        //                 foreach ($listPrices as $singlePrice) {
        //                     $attributeValues[] = array("id" => $singlePrice->stock_status, "text" => $singlePrice->stock_status);
        //                 }
        //             }
        //         }
        //     }

        //     if($attribute_name == "woocommerce_attributes") {
        //         if (class_exists('WooCommerce')) {

        //             $sql = $wpdb->prepare( "SELECT attributes.attribute_name as attribute_slug FROM {$wpdb->prefix}woocommerce_attribute_taxonomies as attributes", array() );
        //             $listAttributes = $wpdb->get_results($sql);
        //             if (sizeof($listAttributes) > 0) {
        //                 foreach ($listAttributes as $singleAttribute) {
        //                     $sql = $wpdb->prepare( "SELECT terms.slug as slug, terms.name as name FROM {$wpdb->prefix}term_taxonomy as ttaxonomy, {$wpdb->prefix}terms as terms WHERE ttaxonomy.taxonomy = 'pa_".$singleAttribute->attribute_slug."'
        //                                             AND terms.term_id = ttaxonomy.term_id AND terms.name LIKE %s GROUP BY terms.term_id LIMIT 10", array( '%'.$search.'%' ) );
        //                     $listVariations = $wpdb->get_results($sql);
        //                     if (sizeof($listVariations) > 0) {
        //                         foreach ($listVariations as $singleVariation) {
        //                             $attributeValues[] = array("id" => $singleVariation->slug, "text" => $singleVariation->name);
        //                         }
        //                     }
        //                 }
        //             }
        //         }
        //     }

        //     if($attribute_name == "woocommerce_on_sale") {
        //         if (class_exists('WooCommerce')) {
        //             $attributeValues[] = array("id" => 1, "text" => "Products On Sale");
        //             $attributeValues[] = array("id" => 0, "text" => "Products Not On Sale");
        //         }
        //     }




        //     /* *************** WP Guidant Custom Field ATTRIBUTES *************** */

        //     if (strpos($attribute_name, 'post_meta_') !== false) {
        //         $attribute_name = str_replace("post_meta_", "", $attribute_name);
        //         $sql = $wpdb->prepare( "SELECT meta.meta_value as feild_value FROM {$wpdb->prefix}posts as posts, {$wpdb->prefix}postmeta as meta WHERE posts.post_status = 'publish' 
        //                                         AND meta.post_id = posts.ID AND meta.meta_key = %s AND meta.meta_value LIKE %s GROUP BY meta.meta_value LIMIT 10", array( $attribute_name, '%'.$search.'%' ) );
        //         $listValues = $wpdb->get_results($sql);
        //         if (sizeof($listValues) > 0) {
        //             foreach ($listValues as $singleValue) {
        //                 $attributeValues[] = array("id" => $singleValue->feild_value, "text" => $singleValue->feild_value);
        //             }
        //         }
        //     }

        //     return $attributeValues;
        // }

        public function getAttributeValues($attribute_name, $search = "")
        {
            $search = trim($search);
            $attributeValues = array();

            switch ($attribute_name) {
                case "post_category":
                    $args = array(
                        'hide_empty' => false,
                        'orderby' => 'name',
                        'order' => 'ASC',
                        'name__like' => $search
                    );
                    $terms = get_terms('category', $args);
                    foreach ($terms as $term) {
                        $attributeValues[] = array("id" => $term->name, "text" => $term->name);
                    }
                    break;

                case "post_title":
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 40,
                        'orderby' => 'ID',
                        'order' => 'DESC',
                        's' => $search
                    );
                    $posts = get_posts($args);
                    foreach ($posts as $post) {
                        $attributeValues[] = array("id" => $post->post_title, "text" => $post->post_title);
                    }
                    break;

                case "post_type":
                    $post_types = get_post_types(array('public' => true), 'objects');
                    foreach ($post_types as $post_type) {
                        $labels = get_post_type_labels($post_type);
                        $attributeValues[] = array("id" => $post_type->name, "text" => "[" . $post_type->name . "] " . $labels->name);
                    }
                    break;

                case "post_date":
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 10,
                        'orderby' => 'date',
                        'order' => 'DESC',
                        'date_query' => array(
                            array(
                                'after' => $search . ' 00:00:00',
                                'before' => $search . ' 23:59:59',
                                'inclusive' => true,
                            ),
                        ),
                        'groupby' => 'DATE(post_date)',
                        'fields' => 'ids', // Only fetch post IDs
                    );
                    $query = new WP_Query($args);
                    if ($query->posts) {
                        foreach ($query->posts as $post_id) {
                            $post_date = get_the_date('Y-m-d', $post_id);
                            $attributeValues[] = array("id" => $post_date, "text" => $post_date);
                        }
                    }
                    wp_reset_postdata();
                    break;

                case "post_modified":
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => 10,
                        'orderby' => 'modified',
                        'order' => 'DESC',
                        'date_query' => array(
                            array(
                                'after' => $search . ' 00:00:00',
                                'before' => $search . ' 23:59:59',
                                'inclusive' => true,
                            ),
                        ),
                        'groupby' => 'DATE(post_modified)',
                        'fields' => 'ids', // Only fetch post IDs
                    );
                    $query = new WP_Query($args);
                    if ($query->posts) {
                        foreach ($query->posts as $post_id) {
                            $post_modified = get_the_modified_date('Y-m-d', $post_id);
                            $attributeValues[] = array("id" => $post_modified, "text" => $post_modified);
                        }
                    }
                    wp_reset_postdata();
                    break;

                case "post_author":
                    $users = get_users(array('search' => $search));
                    foreach ($users as $user) {
                        $attributeValues[] = array("id" => $user->display_name, "text" => $user->display_name);
                    }
                    break;

                case "post_tags":
                    $tags = get_tags(array('hide_empty' => false, 'search' => $search));
                    foreach ($tags as $tag) {
                        $attributeValues[] = array("id" => $tag->name, "text" => $tag->name);
                    }
                    break;

                    // WooCommerce attributes
                case "woocommerce_category":
                    if (class_exists('WooCommerce')) {
                        $args = array(
                            'taxonomy' => 'product_cat',
                            'hide_empty' => false,
                            'orderby' => 'name',
                            'order' => 'ASC',
                            'name__like' => $search
                        );
                        $terms = get_terms($args);
                        foreach ($terms as $term) {
                            $attributeValues[] = array("id" => $term->name, "text" => $term->name);
                        }
                    }
                    break;

                case "woocommerce_tags":
                    if (class_exists('WooCommerce')) {
                        $args = array(
                            'post_type' => 'product',
                            'post_status' => 'publish',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_tag',
                                    'field' => 'name',
                                    'terms' => $search,
                                    'operator' => 'LIKE'
                                )
                            ),
                            'groupby' => 'terms.name',
                            'fields' => 'ids', // Only fetch post IDs
                            'posts_per_page' => 10
                        );
                        $query = new WP_Query($args);
                        if ($query->posts) {
                            foreach ($query->posts as $post_id) {
                                $tags = wp_get_post_terms($post_id, 'product_tag');
                                foreach ($tags as $tag) {
                                    $attributeValues[] = array("id" => $tag->name, "text" => $tag->name);
                                }
                            }
                        }
                        wp_reset_postdata();
                    }
                    break;

                case "woocommerce_product":
                    if (class_exists('WooCommerce')) {
                        $args = array(
                            'post_type' => 'product',
                            'post_status' => 'publish',
                            'posts_per_page' => 10,
                            'orderby' => 'ID',
                            'order' => 'DESC',
                            's' => $search
                        );
                        $products = get_posts($args);
                        foreach ($products as $product) {
                            $attributeValues[] = array("id" => $product->post_title, "text" => $product->post_title);
                        }
                    }
                    break;

                    // WooCommerce price
                case "woocommerce_price":
                    if (class_exists('WooCommerce')) {
                        $args = array(
                            'post_type'      => 'product',
                            'post_status'    => 'publish',
                            'meta_query'     => array(
                                'relation' => 'AND',
                                array(
                                    'key'     => '_price',
                                    'value'   => $search,
                                    'compare' => 'LIKE'
                                ),
                            ),
                            'orderby'        => 'meta_value_num',
                            'order'          => 'ASC',
                            'meta_key'       => '_price',
                            'fields'         => 'ids',
                            'posts_per_page' => 10
                        );

                        $query = new WP_Query($args);
                        if ($query->posts) {
                            foreach ($query->posts as $post_id) {
                                $price = get_post_meta($post_id, '_price', true);
                                $attributeValues[] = array("id" => $price, "text" => $price);
                            }
                        }
                        wp_reset_postdata();
                    }
                    break;

                    // WooCommerce sale price
                case "woocommerce_sale_price":
                    if (class_exists('WooCommerce')) {
                        $args = array(
                            'post_type'      => 'product',
                            'post_status'    => 'publish',
                            'meta_query'     => array(
                                'relation' => 'AND',
                                array(
                                    'key'     => '_sale_price',
                                    'value'   => $search,
                                    'compare' => 'LIKE'
                                ),
                            ),
                            'orderby'        => 'meta_value_num',
                            'order'          => 'ASC',
                            'meta_key'       => '_sale_price',
                            'fields'         => 'ids',
                            'posts_per_page' => 10
                        );

                        $query = new WP_Query($args);
                        if ($query->posts) {
                            foreach ($query->posts as $post_id) {
                                $sale_price = get_post_meta($post_id, '_sale_price', true);
                                $attributeValues[] = array("id" => $sale_price, "text" => $sale_price);
                            }
                        }
                        wp_reset_postdata();
                    }
                    break;

                    // WooCommerce regular price

                case "woocommerce_regular_price":
                    if (class_exists('WooCommerce')) {

                        $args = array(
                            'post_type'      => 'product',
                            'post_status'    => 'publish',
                            'meta_query'     => array(
                                'relation' => 'AND',
                                array(
                                    'key'     => '_regular_price',
                                    'value'   => $search,
                                    'compare' => 'LIKE'
                                ),
                            ),
                            'orderby'        => 'meta_value_num',
                            'order'          => 'ASC',
                            'meta_key'       => '_regular_price',
                            'fields'         => 'ids',
                            'posts_per_page' => 10
                        );

                        $query = new WP_Query($args);
                        if ($query->posts) {
                            foreach ($query->posts as $post_id) {
                                $regular_price = get_post_meta($post_id, '_regular_price', true);
                                $attributeValues[] = array("id" => $regular_price, "text" => $regular_price);
                            }
                        }
                        wp_reset_postdata();
                    }
                    break;
                    // WooCommerce rating
                case "woocommerce_rating":
                    if (class_exists('WooCommerce')) {

                        $args = array(
                            'post_type'      => 'product',
                            'post_status'    => 'publish',
                            'meta_query'     => array(
                                array(
                                    'key'     => '_wc_average_rating',
                                    'value'   => '%' . $search . '%',
                                    'compare' => 'LIKE',
                                ),
                            ),
                            'meta_key'       => '_wc_average_rating',
                            'orderby'        => 'meta_value_num',
                            'order'          => 'DESC',
                            'posts_per_page' => 10,
                        );
                        $query = new WP_Query($args);
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                $average_rating = get_post_meta(get_the_ID(), '_wc_average_rating', true);
                                $attributeValues[] = array("id" => $average_rating, "text" => $average_rating);
                            }
                        }
                        wp_reset_postdata();
                    }
                    break;
                    // WooCommerce stock status
                case "woocommerce_stock_status":
                    if (class_exists('WooCommerce')) {
                        $args = array(
                            'post_type'      => 'product',
                            'post_status'    => 'publish',
                            'meta_query'     => array(
                                array(
                                    'key'     => '_stock_status',
                                    'value'   => '%' . $search . '%',
                                    'compare' => 'LIKE',
                                ),
                            ),
                            'meta_key'       => '_stock_status',
                            'orderby'        => 'meta_value',
                            'order'          => 'ASC',
                            'posts_per_page' => 10,
                        );
                        $query = new WP_Query($args);
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                $stock_status = get_post_meta(get_the_ID(), '_stock_status', true);
                                $attributeValues[] = array("id" => $stock_status, "text" => $stock_status);
                            }
                        }
                        wp_reset_postdata();
                    }

                    break;
                    //  WooCommerce attributes
                case "woocommerce_attributes":
                    if (class_exists('WooCommerce')) {

                        global $wpdb;
                        $attributes = $wpdb->get_results("SELECT attribute_name FROM {$wpdb->prefix}woocommerce_attribute_taxonomies");
                        foreach ($attributes as $attribute) {
                            $terms = get_terms(array(
                                'taxonomy'   => 'pa_' . $attribute->attribute_name,
                                'hide_empty' => false,
                                'name__like' => $search,
                                'orderby'    => 'name',
                                'order'      => 'ASC',
                                'number'     => 10,
                            ));
                            foreach ($terms as $term) {
                                $attributeValues[] = array("id" => $term->slug, "text" => $term->name);
                            }
                        }
                    }

                    break;
                    // WooCommerce on sale
                case "woocommerce_on_sale":
                    if (class_exists('WooCommerce')) {

                        $attributeValues[] = array("id" => 1, "text" => "Products On Sale");
                        $attributeValues[] = array("id" => 0, "text" => "Products Not On Sale");
                    }

                    break;

                    // Post Meta custom fields
                case "post_meta":

                    if (class_exists('WooCommerce')) {

                        $attribute_name = str_replace("post_meta_", "", $attribute_name);
                        $args = array(
                            'post_status' => 'publish',
                            'meta_query'  => array(
                                array(
                                    'key'     => $attribute_name,
                                    'value'   => '%' . $search . '%',
                                    'compare' => 'LIKE',
                                ),
                            ),
                            'meta_key'    => $attribute_name,
                            'orderby'     => 'meta_value',
                            'order'       => 'ASC',
                            'posts_per_page' => 10,
                        );
                        $query = new WP_Query($args);
                        if ($query->have_posts()) {
                            while ($query->have_posts()) {
                                $query->the_post();
                                $field_value = get_post_meta(get_the_ID(), $attribute_name, true);
                                $attributeValues[] = array("id" => $field_value, "text" => $field_value);
                            }
                        }
                        wp_reset_postdata();
                    }

                    break;

                default:
                    // Handle default case if necessary
            }

            return $attributeValues;
        }
    }
}
