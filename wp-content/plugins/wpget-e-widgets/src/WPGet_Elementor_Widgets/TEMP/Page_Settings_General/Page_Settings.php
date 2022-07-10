<?php

namespace WPGet_Elementor_Widgets\Modules\Page_Settings_General;

use Elementor\Controls_Manager;
use Elementor\Core\DocumentTypes\PageBase;

class Page_Settings
{
    private static $_instance = null;

    public static function instance(){
        if(null === self::$_instance){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        add_action( 'elementor/documents/register_controls', [$this,'add_elementor_page_settings_controls'] );
    }

    /**
     * @param $element PageBase
     * @return void
     * @note $element is not always PageBase, Elementor has other Types that use this method.
     */
    public function add_elementor_page_settings_controls($element)
    {
        $element->start_controls_section(
            'wpg_page_settings',
            [
                'label' => __('WPGet SiteSettings', WPG_WIDGETS_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_SETTINGS,
            ]
        );

        $element->add_control(
            'wpg_use_wireframe_styles',
            [
                'label' => __('Use Wireframe Styles', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('Yes', WPG_WIDGETS_TEXT_DOMAIN),
                'label_off' => __('No', WPG_WIDGETS_TEXT_DOMAIN),
                'return_value' => 'yes',
                'description' => 'Refresh the editor after changing.'
            ]
        );
        $element->add_control(
            'wireframe_background_color',
            [
                'label' => esc_html__('Background Color', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    ':root' => '--wireframe-bg-color: {{VALUE}}',
                ],
            ]
        );


        $element->end_controls_section();
    }





}