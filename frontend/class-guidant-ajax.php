<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!class_exists('GuidantFrontendAjax')) {
    class GuidantFrontendAjax
    {

        protected $settings;
        protected $utils;

        public function __construct($frontend_class)
        {
            $this->settings = $frontend_class->settings;
            $this->renderer = $frontend_class->renderer;
            add_action( 'wp_ajax_guidant_guide_submission', array($this, 'guidant_guide_submission') );
            add_action( 'wp_ajax_nopriv_guidant_guide_submission', array($this, 'guidant_guide_submission') );
        }

        function guidant_guide_submission() {
            include_once GUIDANT_PATH . "frontend/api/guidant_guide_submission.php";
            wp_die();
        }



    }
}
