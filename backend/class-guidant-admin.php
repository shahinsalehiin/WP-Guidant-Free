<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!class_exists('GuidantAdmin')) {
    class GuidantAdmin
    {
        public $settings;
        public $utils;

        public function __construct()
        {
            $this->settings = new GuidantSettings();
            $this->utils = new GuidantUtils();

            add_action("admin_menu", array($this, 'guidant_admin_menu'));
            add_action('admin_enqueue_scripts', array($this, 'guidant_admin_enqueue'));
            add_action( 'plugin_action_links_' . GUIDANT_BASE_PATH, array( $this, 'guidant_action_links') );
            new GuidantAdminAjax($this);
            new GuidantAdminMeta($this);
        }




        function guidant_admin_menu()
        {
            $icon_url = GUIDANT_IMG_DIR . "guidant-icon.svg";
            add_menu_page("WP Guidant", "WP Guidant", 'manage_options', "guidant-dashboard", array($this, 'guidant_admin_dashboard'), $icon_url, 6);
        }
        function guidant_action_links($links) {
            $settings_url = add_query_arg( 'page', 'guidant-dashboard', get_admin_url() . 'admin.php' );
            $setting_arr = array('<a href="' . esc_url( $settings_url ) . '">Settings</a>');
            $pro_arr = array('<a target="_blank" href="https://wpcommerz.com/guidant"><span style="color: #ff7742; font-weight: bold;">Get Pro</span></a>');
            $links = array_merge($setting_arr, $links, $pro_arr);
            return $links;
        }


        function guidant_admin_enqueue( $page )
        {
            if($page == "toplevel_page_guidant-dashboard"){
                wp_enqueue_style('guidant-admin', GUIDANT_CSS_DIR.'admin.css', array(), GUIDANT_VERSION);
                wp_enqueue_style('guidant-select2', GUIDANT_CSS_DIR.'select2.min.css', array(), GUIDANT_VERSION);
                wp_enqueue_style('guidant-tooltip', GUIDANT_CSS_DIR.'css-tooltip.css', array(), GUIDANT_VERSION);

                wp_enqueue_script( 'guidant-admin-main', GUIDANT_JS_DIR.'admin_main.js', array('jquery'), GUIDANT_VERSION );
                wp_enqueue_script( 'guidant-admin-conditions', GUIDANT_JS_DIR.'admin_conditions.js', array('guidant-admin-main'), GUIDANT_VERSION );
                wp_enqueue_script( 'guidant-admin-cards', GUIDANT_JS_DIR.'admin_cards.js', array('guidant-admin-main'), GUIDANT_VERSION );
                wp_enqueue_script( 'guidant-admin-sliders', GUIDANT_JS_DIR.'admin_sliders.js', array('guidant-admin-main'), GUIDANT_VERSION );
                wp_enqueue_script( 'guidant-admin-forms', GUIDANT_JS_DIR.'admin_forms.js', array('guidant-admin-main'), GUIDANT_VERSION );
                wp_enqueue_script( 'guidant-admin-elements', GUIDANT_JS_DIR.'admin_elements.js', array('guidant-admin-main'), GUIDANT_VERSION );
                wp_enqueue_script( 'guidant-admin-filters', GUIDANT_JS_DIR.'admin_filters.js', array('guidant-admin-main'), GUIDANT_VERSION );
                wp_enqueue_script( 'guidant-admin-guides', GUIDANT_JS_DIR.'admin_guides.js', array('guidant-admin-main'), GUIDANT_VERSION );
                wp_enqueue_script( 'guidant-admin-guide-update', GUIDANT_JS_DIR.'admin_guide_update.js', array('guidant-admin-main'), GUIDANT_VERSION );
                wp_enqueue_script( 'guidant-admin-custom-fields', GUIDANT_JS_DIR.'admin_custom_fields.js', array('guidant-admin-main'), GUIDANT_VERSION );
                wp_enqueue_script( 'guidant-admin-reports', GUIDANT_JS_DIR.'admin_reports.js', array('guidant-admin-main'), GUIDANT_VERSION );

                wp_enqueue_script( 'guidant-select2', GUIDANT_JS_DIR.'select2.min.js', array('jquery'), GUIDANT_VERSION );

                wp_enqueue_media();
                wp_enqueue_editor();
                wp_enqueue_script( 'jquery-ui-core');

            }

        }



        function guidant_field_info($info)
        {
            ?>
            <a href="#" class="t-top t-xl" data-tooltip="<?php echo esc_attr($info); ?>" ><img src="<?php echo esc_url(GUIDANT_URL); ?>/assets/img/info.svg" alt="icon"/> </a>
            <?php
        }

        function guidant_admin_dashboard()
        {
            include_once GUIDANT_PATH . "backend/templates/dashboard.php";
        }

    }
}




function guidant_check_premium_activation() {
    if ( !in_array( 'wp-guidant/wpguidant.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        new GuidantAdmin();
    }
}
add_action( 'guidant_init', 'guidant_check_premium_activation', 10, 2 );
do_action( 'guidant_init');