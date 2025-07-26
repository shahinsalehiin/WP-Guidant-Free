<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!class_exists('GuidantAdminAjax')) {
    class GuidantAdminAjax
    {

        protected $settings;
        protected $utils;

        public function __construct($admin_class)
        {
            $this->settings = $admin_class->settings;
            $this->utils = $admin_class->utils;

            add_action( 'wp_ajax_guidant_reports_list', array($this, 'guidant_reports_list') );
            add_action( 'wp_ajax_guidant_submission_delete', array($this, 'guidant_submission_delete') );

            add_action( 'wp_ajax_guidant_fields_list', array($this, 'guidant_fields_list') );
            add_action( 'wp_ajax_guidant_fields_create', array($this, 'guidant_fields_create') );
            add_action( 'wp_ajax_guidant_fields_delete', array($this, 'guidant_fields_delete') );

            add_action( 'wp_ajax_guidant_guides_list', array($this, 'guidant_guides_list') );
            add_action( 'wp_ajax_guidant_guides_create', array($this, 'guidant_guides_create') );
            add_action( 'wp_ajax_guidant_guides_delete', array($this, 'guidant_guides_delete') );
            add_action( 'wp_ajax_guidant_guides_tab_page_get', array($this, 'guidant_guides_tab_page_get') );

            add_action( 'wp_ajax_guidant_filters_list', array($this, 'guidant_filters_list') );
            add_action( 'wp_ajax_guidant_filters_sort', array($this, 'guidant_filters_sort') );
            add_action( 'wp_ajax_guidant_filters_create', array($this, 'guidant_filters_create') );
            add_action( 'wp_ajax_guidant_filters_delete', array($this, 'guidant_filters_delete') );

            add_action( 'wp_ajax_guidant_elements_list', array($this, 'guidant_elements_list') );
            add_action( 'wp_ajax_guidant_elements_sort', array($this, 'guidant_elements_sort') );
            add_action( 'wp_ajax_guidant_elements_create', array($this, 'guidant_elements_create') );
            add_action( 'wp_ajax_guidant_elements_delete', array($this, 'guidant_elements_delete') );


            add_action( 'wp_ajax_guidant_card_tab_page_get', array($this, 'guidant_card_tab_page_get') );
            add_action( 'wp_ajax_guidant_card_tab_page_save', array($this, 'guidant_card_tab_page_save') );

            add_action( 'wp_ajax_guidant_slider_tab_page_get', array($this, 'guidant_slider_tab_page_get') );
            add_action( 'wp_ajax_guidant_slider_tab_page_save', array($this, 'guidant_slider_tab_page_save') );

            add_action( 'wp_ajax_guidant_form_tab_page_get', array($this, 'guidant_form_tab_page_get') );
            add_action( 'wp_ajax_guidant_form_tab_page_save', array($this, 'guidant_form_tab_page_save') );

            add_action( 'wp_ajax_guidant_conditions_list', array($this, 'guidant_conditions_list') );
            add_action( 'wp_ajax_guidant_conditions_create', array($this, 'guidant_conditions_create') );
            add_action( 'wp_ajax_guidant_conditions_delete', array($this, 'guidant_conditions_delete') );
            add_action( 'wp_ajax_guidant_attributes_suggestion', array($this, 'guidant_attributes_suggestion') );
            add_action( 'wp_ajax_guidant_attributes_value_suggestion', array($this, 'guidant_attributes_value_suggestion') );


            add_action( 'wp_ajax_guidant_results_list', array($this, 'guidant_results_list') );
            add_action( 'wp_ajax_guidant_results_sort', array($this, 'guidant_results_sort') );
            add_action( 'wp_ajax_guidant_results_create', array($this, 'guidant_results_create') );
            add_action( 'wp_ajax_guidant_results_delete', array($this, 'guidant_results_delete') );
            add_action( 'wp_ajax_guidant_result_attributes_suggestion', array($this, 'guidant_result_attributes_suggestion') );

            add_action( 'wp_ajax_guidant_logic_list', array($this, 'guidant_logic_list') );
            add_action( 'wp_ajax_guidant_logic_elements_suggestions', array($this, 'guidant_logic_elements_suggestions') );
            add_action( 'wp_ajax_guidant_logic_filter_suggestions', array($this, 'guidant_logic_filter_suggestions') );
            add_action( 'wp_ajax_guidant_logic_create', array($this, 'guidant_logic_create') );
            add_action( 'wp_ajax_guidant_logic_delete', array($this, 'guidant_logic_delete') );

        }

        function guidant_reports_list() {
            include_once GUIDANT_PATH . "backend/api/reports_list.php";
            wp_die();
        }
        function guidant_submission_delete() {
            include_once GUIDANT_PATH . "backend/api/submission_delete.php";
            wp_die();
        }


        function guidant_fields_list() {
            include_once GUIDANT_PATH . "backend/api/fields_list.php";
            wp_die();
        }
        function guidant_fields_create() {
            include_once GUIDANT_PATH . "backend/api/fields_create.php";
            wp_die();
        }
        function guidant_fields_delete() {
            include_once GUIDANT_PATH . "backend/api/fields_delete.php";
            wp_die();
        }

        function guidant_guides_list() {
            include_once GUIDANT_PATH . "backend/api/guides_list.php";
            wp_die();
        }
        function guidant_guides_create() {
            include_once GUIDANT_PATH . "backend/api/guides_create.php";
            wp_die();
        }
        function guidant_guides_delete() {
            include_once GUIDANT_PATH . "backend/api/guides_delete.php";
            wp_die();
        }
        function guidant_guides_tab_page_get() {
            include_once GUIDANT_PATH . "backend/api/guide_tab_page_get.php";
            wp_die();
        }


        function guidant_filters_list() {
            include_once GUIDANT_PATH . "backend/api/filters_list.php";
            wp_die();
        }
        function guidant_filters_sort() {
            include_once GUIDANT_PATH . "backend/api/filters_sort.php";
            wp_die();
        }
        function guidant_filters_create() {
            include_once GUIDANT_PATH . "backend/api/filters_create.php";
            wp_die();
        }
        function guidant_filters_delete() {
            include_once GUIDANT_PATH . "backend/api/filters_delete.php";
            wp_die();
        }


        function guidant_elements_list() {
            include_once GUIDANT_PATH . "backend/api/elements_list.php";
            wp_die();
        }
        function guidant_elements_sort() {
            include_once GUIDANT_PATH . "backend/api/elements_sort.php";
            wp_die();
        }
        function guidant_elements_create() {
            include_once GUIDANT_PATH . "backend/api/elements_create.php";
            wp_die();
        }
        function guidant_elements_delete() {
            include_once GUIDANT_PATH . "backend/api/elements_delete.php";
            wp_die();
        }



        function guidant_card_tab_page_get() {
            include_once GUIDANT_PATH . "backend/api/card_tab_page_get.php";
            wp_die();
        }
        function guidant_card_tab_page_save() {
            include_once GUIDANT_PATH . "backend/api/card_tab_page_save.php";
            wp_die();
        }




        function guidant_slider_tab_page_get() {
            include_once GUIDANT_PATH . "backend/api/slider_tab_page_get.php";
            wp_die();
        }
        function guidant_slider_tab_page_save() {
            include_once GUIDANT_PATH . "backend/api/slider_tab_page_save.php";
            wp_die();
        }


        function guidant_form_tab_page_get() {
            include_once GUIDANT_PATH . "backend/api/form_tab_page_get.php";
            wp_die();
        }
        function guidant_form_tab_page_save() {
            include_once GUIDANT_PATH . "backend/api/form_tab_page_save.php";
            wp_die();
        }



        function guidant_conditions_list() {
            include_once GUIDANT_PATH . "backend/api/conditions_list.php";
            wp_die();
        }
        function guidant_conditions_create() {
            include_once GUIDANT_PATH . "backend/api/conditions_create.php";
            wp_die();
        }
        function guidant_conditions_delete() {
            include_once GUIDANT_PATH . "backend/api/conditions_delete.php";
            wp_die();
        }
        function guidant_attributes_suggestion() {
            include_once GUIDANT_PATH . "backend/api/attributes_suggestion.php";
            wp_die();
        }
        function guidant_attributes_value_suggestion() {
            include_once GUIDANT_PATH . "backend/api/attributes_value_suggestion.php";
            wp_die();
        }





        function guidant_results_list() {
            include_once GUIDANT_PATH . "backend/api/results_list.php";
            wp_die();
        }
        function guidant_results_sort() {
            include_once GUIDANT_PATH . "backend/api/results_sort.php";
            wp_die();
        }

        function guidant_results_create() {
            include_once GUIDANT_PATH . "backend/api/results_create.php";
            wp_die();
        }
        function guidant_results_delete() {
            include_once GUIDANT_PATH . "backend/api/results_delete.php";
            wp_die();
        }
        function guidant_result_attributes_suggestion() {
            include_once GUIDANT_PATH . "backend/api/result_attributes_suggestion.php";
            wp_die();
        }



        function guidant_logic_list() {
            include_once GUIDANT_PATH . "backend/api/logic_list.php";
            wp_die();
        }
        function guidant_logic_create() {
            include_once GUIDANT_PATH . "backend/api/logic_create.php";
            wp_die();
        }
        function guidant_logic_delete() {
            include_once GUIDANT_PATH . "backend/api/logic_delete.php";
            wp_die();
        }
        function guidant_logic_elements_suggestions() {
            include_once GUIDANT_PATH . "backend/api/logic_elements_suggestions.php";
            wp_die();
        }
        function guidant_logic_filter_suggestions() {
            include_once GUIDANT_PATH . "backend/api/logic_filter_suggestions.php";
            wp_die();
        }


    }
}
