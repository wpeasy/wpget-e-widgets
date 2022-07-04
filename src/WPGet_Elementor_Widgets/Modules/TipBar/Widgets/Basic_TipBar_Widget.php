<?php

namespace WPGet_Elementor_Widgets\Modules\TipBar\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

class Basic_TipBar_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'basic_tipbar';
    }

    public function get_title()
    {
        return 'Basic TipBar';
    }

    public function get_icon()
    {
        return 'wpg-widget-icon-tip-basic';
    }

    public function get_categories()
    {
        return ['wpget'];
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
            'tip_label',
            [
                'label' => esc_html__('Label', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::TEXT,
                'default' => 'TIP'
            ]
        );


        $this->add_control(
            'tip_content',
            [
                'label' => esc_html__('Copy', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::WYSIWYG,
                'default' => 'Message Here'
            ]
        );

        $this->end_controls_section();

        /*
         * STYLES
         */
        $this->start_controls_section(
            'label_style',
            [
                'label' => esc_html__('Label Style', WPG_WIDGETS_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        /* ------ Label ---- */
        $this->add_control(
            'label_width',
            [
                'label' => esc_html__('Inline / Full Width', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Full', WPG_WIDGETS_TEXT_DOMAIN),
                'label_off' => esc_html__('Inline', WPG_WIDGETS_TEXT_DOMAIN),
                'return_value' => 'yes',
                'default' => 'yes',
                'description' => 'If Yes, renders label full width'
            ]
        );
        $this->add_control(
            'label_align',
            [
                'label' => esc_html__('Alignment', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', WPG_WIDGETS_TEXT_DOMAIN),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', WPG_WIDGETS_TEXT_DOMAIN),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', WPG_WIDGETS_TEXT_DOMAIN),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
            ]
        );

        $this->add_control(
            'distance',
            [
                'label' => esc_html__('Offset', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'rem'],
                'range' => [
                    'px' => [
                        'min' => -50,
                        'max' => 50,
                        'step' => 1,
                    ],
                    'rem' => [
                        'min' => -5,
                        'max' => 5,
                        'step' => 0.1
                    ],
                ],
                'default' => [
                    'unit' => 'rem',
                    'size' => -0.5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpg_tipbar_basic__label' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .wpg_tipbar_basic__label',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpg_tipbar_basic__label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'label_background',
                'selector' => '{{WRAPPER}} .wpg_tipbar_basic__label',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'label_border',
                'selector' => '{{WRAPPER}} .wpg_tipbar_basic__label',
            ]
        );
        $this->add_control(
            'label_border_radius',
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
                    '{{WRAPPER}} .wpg_tipbar_basic__label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'label_box_shadow',
                'label' => esc_html__('Box Shadow', WPG_WIDGETS_PLUGIN_BASE),
                'selector' => '{{WRAPPER}} .wpg_tipbar_basic__label'
            ]
        );

        $this->add_control(
            'label_padding',
            [
                'label' => esc_html__('Padding', WPG_WIDGETS_TEXT_DOMAIN),
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
                    '{{WRAPPER}} .wpg_tipbar_basic__label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        /* ------ Label Icon ---- */

        $this->start_controls_section(
            'label_icon_style',
            [
                'label' => esc_html__('Label Icon Style', WPG_WIDGETS_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'label_icon',
            [
                'label' => esc_html__('Icon', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'solid',
                ],
            ]
        );

        $this->add_control(
            'icon-distance',
            [
                'label' => esc_html__('Right Margin', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1
                    ],
                ],
                'default' => [
                    'unit' => 'rem',
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpg_tipbar_basic__label .wpg-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'label_icon_color',
            [
                'label' => esc_html__('Icon Color', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpg_tipbar_basic__label .wpg-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();


        $this->end_controls_section();

        /* ------ Content ---- */
        $this->start_controls_section(
            'content_style',
            [
                'label' => esc_html__('Content Style', WPG_WIDGETS_TEXT_DOMAIN),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .wpg_tipbar_basic__content',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__('Content Color', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpg_tipbar_basic__content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .wpg_tipbar_basic__content',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'selector' => '{{WRAPPER}} .wpg_tipbar_basic__content',
            ]
        );
        $this->add_control(
            'content_border_radius',
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
                    '{{WRAPPER}} .wpg_tipbar_basic__content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'label' => esc_html__('Box Shadow', WPG_WIDGETS_PLUGIN_BASE),
                'selector' => '{{WRAPPER}} .wpg_tipbar_basic__content'
            ]
        );

        $this->add_control(
            'content_padding',
            [
                'label' => esc_html__('Padding', WPG_WIDGETS_TEXT_DOMAIN),
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
                    '{{WRAPPER}} .wpg_tipbar_basic__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();
    }


    protected function render()
    {
        wp_enqueue_style('elementor-icons-fa-solid');

        $settings = $this->get_settings_for_display();
        $wrapper_main = ['wpg_tipbar_basic'];
        $wrapper_label = ['wpg_tipbar_basic__label', 'wpg-label-wrapper-with-icon'];;

        $content_wrapper = ['wpg_tipbar_basic__content'];

        @$settings['label_width'] === 'yes' ? $wrapper_label[] = 'wpg-width-min-full' : $wrapper_label[] = 'wpg-fit-content';
        @$settings['label_align'] === 'left' && $wrapper_label[] = 'wpg-align-self-start';
        @$settings['label_align'] === 'center' && $wrapper_label[] = 'wpg-align-self-center';
        @$settings['label_align'] === 'right' && $wrapper_label[] = 'wpg-align-self-end';

        $this->add_render_attribute('wrapper_main', ['class' => $wrapper_main]);
        $this->add_render_attribute('wrapper_label', ['class' => $wrapper_label]);
        $this->add_render_attribute('tip_content', ['class' => $content_wrapper]);

        $this->add_inline_editing_attributes('tip_label', 'basic');
        $this->add_inline_editing_attributes('tip_content', 'basic');


        ?>
        <div <?= $this->get_render_attribute_string('wrapper_main') ?>>
            <div <?= $this->get_render_attribute_string('wrapper_label') ?>>
                <div class="wpg-icon"><?php Icons_Manager::render_icon($settings['label_icon'], ['aria-hidden' => 'true']); ?></div>
                <div <?= $this->get_render_attribute_string('tip_label') ?>><?= $settings['tip_label'] ?></div>
            </div>
            <div <?= $this->get_render_attribute_string('tip_content') ?>><?= $settings['tip_content'] ?></div>
            <div>

            </div>
        </div>
        <?php
    }

    protected function _content_template()
    {
        ?>
        <#
        let wrapperMain = ['wpg_tipbar_basic'];
        let wrapperLabel = ['wpg_tipbar_basic__label'];
        let wrapperContent = ['wpg_tipbar_basic__content'];


        //Label
        if(settings.label_width !== 'yes') {
            wrapperLabel.push('wpg-fit-content')
        }else{
            wrapperLabel.push('wpg-width-min-full')
        };

        if(settings.label_align === 'left') { wrapperLabel.push('wpg-align-self-start') };
        if(settings.label_align === 'center') { wrapperLabel.push('wpg-align-self-center') };
        if(settings.label_align === 'right' ) { wrapperLabel.push('wpg-align-self-end') };

        view.addRenderAttribute('wrapper_main', 'class' , wrapperMain);
        view.addRenderAttribute('wrapper_label', 'class' , wrapperLabel);
        view.addRenderAttribute('tip_content', 'class' , wrapperContent) ;

        view.addInlineEditingAttributes('tip_label', 'basic');
        view.addInlineEditingAttributes('tip_content', 'advanced');

        #>
        <div {{{ view.getRenderAttributeString( 'wrapper_main' ) }}}>
            <div {{{ view.getRenderAttributeString( 'wrapper_label' ) }}}>
                <div class='wpg-icon'><i aria-hidden="true" class="{{{ settings.label_icon.value }}}"></i></div>
                <div>
                    {{{ settings.tip_label }}}
                </div>
            </div>

        <div {{{ view.getRenderAttributeString( 'tip_content' ) }}}>{{{ settings.tip_content }}}</div>
        </div>

        <?php
    }
}