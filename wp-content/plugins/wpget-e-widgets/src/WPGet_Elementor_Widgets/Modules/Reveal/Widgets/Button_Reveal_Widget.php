<?php
namespace WPGet_Elementor_Widgets\Modules\Reveal\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use WPGet_Elementor_Widgets\Lib\Traits\Button_Controls_Trait;


class Button_Reveal_Widget extends Widget_Base
{
   use Button_Controls_Trait;

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        wp_register_script('wpg-reveal', WPG_WIDGETS_URL . 'assets/js/reveal.js');
        wp_register_style('wpg-reveal', WPG_WIDGETS_URL . 'assets/css/reveal.css');
    }

    public function get_script_depends()
    {
        return ['wpg-reveal'];
    }

    public function get_style_depends()
    {
        return ['wpg-reveal'];
    }

    public function get_name()
    {
        return 'button_reveal';
    }

    public function get_title()
    {
        return 'Button Reveal';
    }

    public function get_icon()
    {
        return 'wpg-widget-icon-scroll-sequence-basic';
    }

    public function get_categories()
    {
        return ['wpget'];
    }

    public function get_keywords()
    {
        return ['reveal'];
    }

    protected function _register_controls()
    {
        /*
         * CONTENT
         */
        $this->start_controls_section(
            'section_content',
            [
                'label' => 'Content',
            ]
        );

        $this->add_control(
            'button_reveal_content',
            [
                'label' => esc_html__('Content', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::WYSIWYG,
                'default' => '',
                'description' => 'Content to reveal'
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'reveal_button_button',
            [
                'label' => 'Button',
                'tab' => Controls_Manager::TAB_CONTENT
            ]
        );

        $this->register_button_content_controls(
                [
                    'id_prefix' => 'reveal_button',
                    'button_text' => esc_html__( 'Click here', WPG_WIDGETS_TEXT_DOMAIN ),
                    'control_label_name' => esc_html__( 'Text', WPG_WIDGETS_TEXT_DOMAIN),
                    'prefix_class' => 'wpg_button_reveal-align-',
                    'alignment_default' => '',
                    'exclude_inline_options' => [],
                ]
        );

        $this->end_controls_section();



        /*
         * STYLES
         */
        $this->start_controls_section(
            'reveal_button_wrapper_style',
            [
                'label' => esc_html__('Button Wrapper Style', WPG_WIDGETS_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'reveal_button_wrapper_padding',
            [
                'label' => esc_html__('Wrapper Padding', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpg_button_reveal__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'reveal_button_wrapper_box_shadow',
                'label' => esc_html__('Wrapper Box Shadow', WPG_WIDGETS_PLUGIN_BASE),
                'selector' => '{{WRAPPER}} .wpg_button_reveal__button'
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'reveal_button_wrapper_background',
                'selector' => '{{WRAPPER}} .wpg_button_reveal__button',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'reveal_button_wrapper_border',
                'selector' => '{{WRAPPER}} .wpg_button_reveal__button',
            ]
        );
        $this->add_control(
            'reveal_button_wrapper_border_radius',
            [
                'label' => esc_html__('Border Radius', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'rem'],
                'default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpg_button_reveal__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'reveal_button_button_style',
            [
                'label' => 'Button',
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->register_button_style_controls(
            [
                'id_prefix' => 'reveal_button'
            ]
        );

        $this->end_controls_section();


    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        $wrapper_main = ['wpg_button_reveal'];
        $wrapper_button_wrapper = ['wpg_button_reveal__button'];
        $content_wrapper = ['wpg_button_reveal__content'];

        $this->add_render_attribute('wrapper_main', ['class' => $wrapper_main]);
        $this->add_render_attribute('wrapper_button_wrapper', ['class' => $wrapper_button_wrapper]);
        $this->add_render_attribute('content_wrapper', ['class' => $content_wrapper]);

        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper_main') ?>>
            <div <?php echo $this->get_render_attribute_string('wrapper_button_wrapper') ?>>
                <?php $this->render_button(['id_prefix' => 'reveal_button' ]); ?>
            </div>
            <div <?php echo $this->get_render_attribute_string('content_wrapper') ?>>
                <?php echo $settings['button_reveal_content'] ?>
            </div>
        </div>
        <?php
    }
}