<?php

// If this file is called directly, exit.
if (!defined('WPINC')) {
    die;
}

if (!class_exists('GuidantAdmin')) {
    class GuidantAdmin
    {
        public $settings;
        public $utils;
        public $offer_setting_key = 'guidant_offer_notice_dismissed';
        public $offer_dismissed = 'offer_dismissed';
        public $admin_slug = 'guidant-dashboard';
        
        public function __construct()
        {
            $this->settings = new GuidantSettings();
            $this->utils = new GuidantUtils();

            add_action("admin_menu", array($this, 'guidant_admin_menu'));
            add_action('admin_enqueue_scripts', array($this, 'guidant_admin_enqueue'));
            add_action( 'plugin_action_links_' . GUIDANT_BASE_PATH, array( $this, 'guidant_action_links') );
            new GuidantAdminAjax($this);
            new GuidantAdminMeta($this);
            
            add_filter('admin_footer_text', [$this,'guidant_admin_footer_text']);
            
            add_action( 'admin_notices', [$this, 'guidant_admin_offer_notice'] );
            // add_action( 'admin_notices', [$this, 'guidant_admin_review_notice'] );
            
            add_action('wp_ajax_dismiss_guidant_offer_notice', [$this,'dismiss_guidant_offer_notice']);
            add_action('wp_ajax_nopriv_dismiss_guidant_offer_notice', [$this,'dismiss_guidant_offer_notice']);
            
            
            // Remove transient
            // $this->delete_guidant_offer_notice_transient();
            
        }
        public function guidant_admin_review_notice2()
        {
            ?>
            <div class="notice notice-success is-dismissible">
                <p><?php _e( 'Done!', 'sample-text-domain' ); ?></p>
            </div>
            <div class="updated"><p>Want to help make <strong>WP Dark Mode</strong> even more awesome? Allow WP Dark Mode to collect non-sensitive diagnostic data and usage information. (<a class="wp-dark-mode-insights-data-we-collect" href="#">what we collect</a>)</p><p class="description" style="display:none;">Server environment details (php, mysql, server, WordPress versions), Number of users in your site, Site language, Number of active and inactive plugins, Site name and URL, Your name and email address. No sensitive data is tracked. We are using Appsero to collect your data. <a href="#" target="_blank">Learn more</a> about how Appsero collects and handle your data.</p><p></p><p class="submit">&nbsp;<a href="#" class="button-primary button-large">Allow</a>&nbsp;<a href="#" class="button-secondary button-large">No thanks</a></p></div>
                
            <?php
        }
        public function guidant_admin_review_notice()
        {
            $reviewLink = 'https://wordpress.org/support/plugin/guidant/reviews/';
            ?>
            <div class="updatedX">
                <p>Thank you for choosing WP Guidant. We would greatly appreciate it, if you could take a moment to share your experience and leave a review for us on WordPress.org. Your feedback motivates us to enhance the plugin and provide an improved user experience.</p>
                <p class="submit">
                    <a href="<?php echo esc_url($reviewLink);?>" class="button-primary button-large" target="_blank">Give Feedback</a>
                </p>
            </div>
                
            <?php
        }
        public function guidant_admin_offer_notice()
        {
            
            $dismissed = get_option( $this->offer_setting_key );
            if ($dismissed == $this->offer_dismissed )  return;
            
            // $class = 'notice notice-info is-dismissible guidant-offer--notice';
            // $class = 'notice notice-info is-dismissible';
            $class = 'updated notice notice-success is-dismissible guidant-review--notice';
            if(wp_is_mobile()){
                $img_link = GUIDANT_URL."assets/img/haloween-guidant-mobile.jpg";
            }else{
                $img_link = GUIDANT_URL."assets/img/haloween-guidant.jpg";
            }
            $notice_url = 'https://wpcommerz.com/discount-deal/';
            $admin_url = admin_url('admin-ajax.php');
            
            // printf( '<div class="%1$s"><div class="guidant-offer-notice--inner"><a href="%2$s" target="_blank"><img src="%3$s" alt="Buy Now"></a></div></div>', esc_attr( $class ), esc_url( $notice_url ),esc_url( $img_link ) );
            
            printf( '<div class="%1$s">', esc_attr( $class ) );
            
            $this->guidant_admin_review_notice();
            
            printf( '</div>' );
            
            
            ?>
            <script>
                // let noticeClass = '.guidant-offer--notice button.notice-dismiss';
                let noticeClass = '.guidant-review--notice button.notice-dismiss';
                jQuery(document).on('click', noticeClass, function () {
                    let  guidantAdminAjaxUrl = '<?php echo $admin_url; ?>';
                    jQuery.ajax({
                        type: 'POST',
                        data: {
                            action: 'dismiss_guidant_offer_notice',
                        },
                        url: guidantAdminAjaxUrl
                    });
                });
            </script>
            <?php
    
        }
        public function guidant_admin_offer_notice2()
        {
            
            $dismissed = get_option( $this->offer_setting_key );
            if ($dismissed == $this->offer_dismissed )  return;
            
            $class = 'notice notice-info is-dismissible guidant-offer--notice';
            if(wp_is_mobile()){
                $img_link = GUIDANT_URL."assets/img/haloween-guidant-mobile.jpg";
            }else{
                $img_link = GUIDANT_URL."assets/img/haloween-guidant.jpg";
            }
            $notice_url = 'https://wpcommerz.com/discount-deal/';
            $admin_url = admin_url('admin-ajax.php');
            
            printf( '<div class="%1$s"><div class="guidant-offer-notice--inner"><a href="%2$s" target="_blank"><img src="%3$s" alt="Buy Now"></a></div></div>', esc_attr( $class ), esc_url( $notice_url ),esc_url( $img_link ) );
            ?>
            <script>
                jQuery(document).on('click', '.guidant-offer--notice button.notice-dismiss', function () {
                    let  guidantAdminAjaxUrl = '<?php echo $admin_url; ?>';
                    jQuery.ajax({
                        type: 'POST',
                        data: {
                            action: 'dismiss_guidant_offer_notice',
                        },
                        url: guidantAdminAjaxUrl
                    });
                });
            </script>
            <?php
    
        }
        function dismiss_guidant_offer_notice() {
            
            if ( get_option( $this->offer_setting_key ) !== false ) {
                // The option already exists, so update it.
                update_option( $this->offer_setting_key, $this->offer_dismissed );
            } else {
                // The option hasn't been created yet, so add it with $autoload set to 'no'.
                $deprecated = null;
                $autoload = 'no';
                add_option( $this->offer_setting_key, $this->offer_dismissed, $deprecated, $autoload );
            }
            
        }
        function delete_guidant_offer_notice_transient() {
            update_option( $this->offer_setting_key, '' );
        }

        function guidant_admin_footer_text($text) {
            $link_attr = 'target="_blank" style="color: #FD723B;text-decoration:none;"';
            $my_html = '<p>If you appreciate our plugin, kindly give WP Guidant <a href="https://wordpress.org/support/plugin/guidant/reviews/" '.$link_attr.'> ★★★★★ </a> review on <a href="https://wordpress.org/support/plugin/guidant/reviews/" '.$link_attr.' > WordPress.org </a>to help us spread the word ❤️ from the WP Guidant team.</p>';
            
            if (isset($_GET['page']) && $_GET['page'] === 'guidant-dashboard') {
                return $my_html;
            }
            return $text;
        }
        
        function guidant_admin_menu()
        {
            $icon_url = GUIDANT_IMG_DIR . "guidant-icon.svg";
            add_menu_page("WP Guidant", "WP Guidant", 'manage_options', $this->admin_slug, array($this, 'guidant_admin_dashboard'), $icon_url, 6);
            
            add_submenu_page(
                $this->admin_slug,
                __( 'Useful Plugins', 'guidant' ),
                __( 'Useful Plugins', 'guidant' ),
                'manage_options',
                'guidant-useful-plugins',
                [ $this, 'useful_plugins_page' ],
                50
            );
            
        }
        public function useful_plugins_page()
        {
            // include recomended plugin page
            require_once GUIDANT_PATH . 'backend/useful-plugins.php';
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
            // Guidant global admin CSS
            wp_enqueue_style('guidant-admin-global', GUIDANT_CSS_DIR.'admin-global.css', array(), GUIDANT_VERSION);
            
            
            // Guidant admin settings CSS
            if($page == "toplevel_page_guidant-dashboard"){
                wp_enqueue_style('guidant-admin', GUIDANT_CSS_DIR.'admin.css', array(), GUIDANT_VERSION);
                // wp_enqueue_style('guidant-admin', GUIDANT_CSS_DIR.'admin.css', array(), microtime());
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