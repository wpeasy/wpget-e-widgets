<?php

namespace WPGet_Elementor_Widgets\Modules\Site_Settings_General;


use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Tab_Base;

class Site_Settings extends Tab_Base
{


    public function get_id()
    {
        return 'settings-wpget';
    }

    public function get_title()
    {
        return 'WPGet Settings';
    }

    public function get_icon() {
        return 'wpg-widget-icon-site-settings';
    }

    public function get_group() {
        return 'settings';
    }

    protected function register_tab_controls()
    {
        $this->start_controls_section(
            'section_wpget_common',
            [
                'label' => esc_html__( 'WPGet Settings', WPG_WIDGETS_TEXT_DOMAIN ),
                'tab' => $this->get_id(),
            ]
        );
        $this->add_control(
            'woocommerce_pages_intro',
            [
                'raw' => esc_html__( 'Select the pages you want to use as your default WooCommerce shop pages', 'elementor-pro' ),
                'type' => Controls_Manager::RAW_HTML,
                'content_classes' => 'elementor-descriptor',
            ]
        );
        $this->end_controls_section();
    }
}