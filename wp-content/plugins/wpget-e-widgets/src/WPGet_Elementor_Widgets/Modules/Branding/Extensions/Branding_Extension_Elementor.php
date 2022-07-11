<?php

namespace WPGet_Elementor_Widgets\Modules\Branding\Extensions;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Tab_Base;

class Branding_Extension_Elementor extends Tab_Base
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
        return 'wpg-site-settings-icon';
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
            'branding_icon',
            [
                'label' => esc_html__('Brand Icon', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::MEDIA,
                'description' => 'SVG Brand Icon'
            ]
        );
        $this->end_controls_section();
    }
}