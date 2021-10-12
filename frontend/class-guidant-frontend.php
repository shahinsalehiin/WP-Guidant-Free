<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!class_exists('GuidantFront')) {
    class GuidantFront
    {
        public $settings;
        public $utils;

        public function __construct()
        {
            $this->settings = new GuidantSettings();
            $this->renderer = new GuidantRenderer();

            add_action( 'wp_enqueue_scripts', array( $this, 'guidant_frontend_enqueue' ) );
            new GuidantShortcodeParser($this);
            new GuidantFrontendAjax($this);

        }


        function guidant_frontend_enqueue()
        {
            wp_enqueue_style('guidant-frontend-slider', GUIDANT_CSS_DIR.'rSlider.css', array(), GUIDANT_VERSION);
            wp_enqueue_style('guidant-frontend', GUIDANT_CSS_DIR.'frontend.css', array(), GUIDANT_VERSION);

            wp_enqueue_script( 'guidant-frontend-slider', GUIDANT_JS_DIR.'rSlider.js', array('jquery'), GUIDANT_VERSION,true );
            wp_enqueue_script( 'guidant-frontend-main', GUIDANT_JS_DIR.'frontend.js', array('jquery'), GUIDANT_VERSION,true );

            wp_localize_script( 'guidant-frontend-main', 'guidant_guide_submission_object', array(
                'ajaxurl' => admin_url( 'admin-ajax.php' ),
                'security' => wp_create_nonce( 'guidant_hashkey' )
            ));
        }

    }
}





if ( !in_array( 'wp-guidant/wpguidant.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    new GuidantFront();
}