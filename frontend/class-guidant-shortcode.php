<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (!class_exists('GuidantShortcodeParser')) {
    class GuidantShortcodeParser
    {

        protected $settings;
        protected $utils;

        public function __construct($frontend_class)
        {
            $this->settings = $frontend_class->settings;
            $this->utils = $frontend_class->utils;

            add_shortcode( 'wpguidant_guide', array($this, 'guidant_shortcode_parser') );
        }


        public function guidant_shortcode_parser( $atts , $content = null) {
            $atts = shortcode_atts(
                array(
                    'id' => '555',
                ), $atts, 'wpguidant_guide' );

            return $this->guidant_frontend_view_maker($atts['id']);
        }


        function guidant_free_activation(){
            return "PGRpdiBjbGFzcz0iZ3VpZGFudGd1aWRlX2Zvb3RlciI+CiAgICAgICAgICAgICAgICBQb3dlcmVkIEJ5IDxhIGhyZWY9Imh0dHBzOi8vd3Bjb21tZXJ6LmNvbS93cC1ndWlkYW50IiB0YXJnZXQ9Il9ibGFuayI+V1AgR3VpZGFudDwvYT4KICAgICAgICAgICAgPC9kaXY+";
        }

        public function guidant_frontend_view_maker( $guide_id ) {
            ob_start();
            include GUIDANT_PATH . "frontend/templates/dashboard.php";
            return ob_get_clean();
        }


    }
}
