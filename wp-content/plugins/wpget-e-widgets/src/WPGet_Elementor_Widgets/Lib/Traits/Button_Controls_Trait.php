<?php

namespace WPGet_Elementor_Widgets\Lib\Traits;

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;

trait Button_Controls_Trait
{
    protected function register_button_content_controls( $args = [] ) {
        $default_args = [
            'id_prefix' => 'set_id',
            'section_condition' => [],
            'button_text' => esc_html__( 'Click here', WPG_WIDGETS_TEXT_DOMAIN ),
            'control_label_name' => esc_html__( 'Text', WPG_WIDGETS_TEXT_DOMAIN),
            'prefix_class' => 'elementor%s-align-',
            'alignment_default' => '',
            'exclude_inline_options' => [],
        ];

        $args = wp_parse_args( $args, $default_args );

        $this->add_control(
            $args['id_prefix'] . '_text',
            [
                'label' => $args['control_label_name'],
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => $args['button_text'],
                'placeholder' => $args['button_text'],
                'condition' => $args['section_condition'],
            ]
        );

        $this->add_control(
            $args['id_prefix'] . '_link',
            [
                'label' => esc_html__( 'Link', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'https://your-link.com', WPG_WIDGETS_TEXT_DOMAIN),
                'default' => [
                    'url' => '#',
                ],
                'condition' => $args['section_condition'],
            ]
        );

        $this->add_responsive_control(
            $args['id_prefix'] . '_align',
            [
                'label' => esc_html__( 'Alignment', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start'    => [
                        'title' => esc_html__( 'Left', WPG_WIDGETS_TEXT_DOMAIN),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', WPG_WIDGETS_TEXT_DOMAIN),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__( 'Right', WPG_WIDGETS_TEXT_DOMAIN),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justified', WPG_WIDGETS_TEXT_DOMAIN),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'prefix_class' => $args['prefix_class'],
                'default' => $args['alignment_default'],
                'condition' => $args['section_condition'],
            ]
        );
        

        $this->add_control(
            $args['id_prefix'] . '_selected_icon',
            [
                'label' => esc_html__( 'Icon', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'skin' => 'inline',
                'label_block' => false,
                'condition' => $args['section_condition'],
                'exclude_inline_options' => $args['exclude_inline_options'],
            ]
        );

        $this->add_control(
            $args['id_prefix'] . '_icon_align',
            [
                'label' => esc_html__( 'Icon Position', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__( 'Before', WPG_WIDGETS_TEXT_DOMAIN),
                    'right' => esc_html__( 'After', WPG_WIDGETS_TEXT_DOMAIN),
                ],
                'condition' => array_merge( $args['section_condition'], [ 'selected_icon[value]!' => '' ] ),
            ]
        );

        $this->add_control(
            $args['id_prefix'] . '_icon_indent',
            [
                'label' => esc_html__( 'Icon Spacing', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => $args['section_condition'],
            ]
        );

        $this->add_control(
            $args['id_prefix'] . '_button_css_id',
            [
                'label' => esc_html__( 'Button ID', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => '',
                'title' => esc_html__( 'Add your custom id WITHOUT the Pound key. e.g: my-id', WPG_WIDGETS_TEXT_DOMAIN),
                'description' => esc_html__( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows `A-z 0-9` & underscore chars without spaces.', WPG_WIDGETS_TEXT_DOMAIN),
                'separator' => 'before',
                'condition' => $args['section_condition'],
            ]
        );
    }

    protected function register_button_style_controls( $args = [] ) {
        $default_args = [
            'id_prefix' => 'set_id',
            'section_condition' => [],
        ];

        $args = wp_parse_args( $args, $default_args );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => $args['id_prefix'] . '_typography',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_ACCENT,
                ],
                'selector' => '{{WRAPPER}} .elementor-button',
                'condition' => $args['section_condition'],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => $args['id_prefix'] . '_text_shadow',
                'selector' => '{{WRAPPER}} .elementor-button',
                'condition' => $args['section_condition'],
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style', [
            'condition' => $args['section_condition'],
        ] );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__( 'Normal', WPG_WIDGETS_TEXT_DOMAIN),
                'condition' => $args['section_condition'],
            ]
        );

        $this->add_control(
            $args['id_prefix'] . '_button_text_color',
            [
                'label' => esc_html__( 'Text Color', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
                ],
                'condition' => $args['section_condition'],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => $args['id_prefix'] . '_background',
                'label' => esc_html__( 'Background', WPG_WIDGETS_TEXT_DOMAIN),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .elementor-button',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                    'color' => [
                        'global' => [
                            'default' => Global_Colors::COLOR_ACCENT,
                        ],
                    ],
                ],
                'condition' => $args['section_condition'],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__( 'Hover', WPG_WIDGETS_TEXT_DOMAIN),
                'condition' => $args['section_condition'],
            ]
        );

        $this->add_control(
            $args['id_prefix'] . '_hover_color',
            [
                'label' => esc_html__( 'Text Color', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-button:hover, {{WRAPPER}} .elementor-button:focus' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-button:hover svg, {{WRAPPER}} .elementor-button:focus svg' => 'fill: {{VALUE}};',
                ],
                'condition' => $args['section_condition'],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => $args['id_prefix'] . '_button_background_hover',
                'label' => esc_html__( 'Background', WPG_WIDGETS_TEXT_DOMAIN),
                'types' => [ 'classic', 'gradient' ],
                'exclude' => [ 'image' ],
                'selector' => '{{WRAPPER}} .elementor-button:hover, {{WRAPPER}} .elementor-button:focus',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                ],
                'condition' => $args['section_condition'],
            ]
        );

        $this->add_control(
            $args['id_prefix'] . '_button_hover_border_color',
            [
                'label' => esc_html__( 'Border Color', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-button:hover, {{WRAPPER}} .elementor-button:focus' => 'border-color: {{VALUE}};',
                ],
                'condition' => $args['section_condition'],
            ]
        );

        $this->add_control(
            $args['id_prefix'] . '_hover_animation',
            [
                'label' => esc_html__( 'Hover Animation', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::HOVER_ANIMATION,
                'condition' => $args['section_condition'],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => $args['id_prefix'] . '_border',
                'selector' => '{{WRAPPER}} .elementor-button',
                'separator' => 'before',
                'condition' => $args['section_condition'],
            ]
        );

        $this->add_control(
            $args['id_prefix'] . '_border_radius',
            [
                'label' => esc_html__( 'Border Radius', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => $args['section_condition'],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => $args['id_prefix'] . '_button_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-button',
                'condition' => $args['section_condition'],
            ]
        );

        $this->add_responsive_control(
            $args['id_prefix'] . '_text_padding',
            [
                'label' => esc_html__( 'Padding', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
                'condition' => $args['section_condition'],
            ]
        );
    }

    protected function render_button(  $args ) {
        $default_args = [
            'id_prefix' => 'set_id'
        ];
        $args = wp_parse_args( $args, $default_args );
        $prefix = $args['id_prefix'] . '_';

        $settings = $this->get_settings();
        $this->add_render_attribute( 'wrapper', 'class', 'elementor-button-wrapper' );

        if ( ! empty( $settings[$prefix.'link']['url'] ) ) {
            $this->add_link_attributes( 'button', $settings[$prefix . 'link'] );
            $this->add_render_attribute( 'button', 'class', 'elementor-button-link' );
        }

        $this->add_render_attribute( 'button', 'class', 'elementor-button' );
        $this->add_render_attribute( 'button', 'role', 'button' );

        if ( ! empty( $settings[$prefix . 'button_css_id'] ) ) {
            $this->add_render_attribute( 'button', 'id', $settings[$prefix . 'button_css_id'] );
        }

        if ( $settings[$prefix .'hover_animation'] ) {
            $this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings[$prefix.'hover_animation'] );
        }
        ?>
        <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
            <a <?php $this->print_render_attribute_string( 'button' ); ?>>
                <?php $this->render_text( $prefix ); ?>
            </a>
        </div>
        <?php
    }

    protected function render_text( $prefix ) {
        $settings = $this->get_settings();

        $migrated = isset( $settings[$prefix.'__fa4_migrated']['selected_icon'] );
        $is_new = empty( $settings[$prefix.'icon'] ) && Icons_Manager::is_migration_allowed();

        if ( ! $is_new && empty( $settings[$prefix.'icon_align'] ) ) {
            // @todo: remove when deprecated
            // added as bc in 2.6
            //old default
            $settings[$prefix.'icon_align'] = $this->get_settings( $prefix.'icon_align' );
        }

        $this->add_render_attribute( [
            'content-wrapper' => [
                'class' => 'elementor-button-content-wrapper',
            ],
            'icon-align' => [
                'class' => [
                    'elementor-button-icon',
                    'elementor-align-icon-' . $settings[$prefix.'icon_align'],
                ],
            ],
            'text' => [
                'class' => 'elementor-button-text',
            ],
        ] );

        // TODO: replace the protected with public
        //$this->add_inline_editing_attributes( 'text', 'none' );
        ?>
        <span <?php $this->print_render_attribute_string( 'content-wrapper' ); ?>>
			<?php if ( ! empty( $settings[$prefix.'icon'] ) || ! empty( $settings[$prefix.'selected_icon']['value'] ) ) : ?>
                <span <?php $this->print_render_attribute_string( 'icon-align' ); ?>>
				<?php if ( $is_new || $migrated ) :
                    Icons_Manager::render_icon( $settings[$prefix.'selected_icon'], [ 'aria-hidden' => 'true' ] );
                else : ?>
                    <i class="<?php echo esc_attr( $settings[$prefix.'icon'] ); ?>" aria-hidden="true"></i>
                <?php endif; ?>
			</span>
            <?php endif; ?>
			<span <?php $this->print_render_attribute_string( 'text' ); ?>><?php
                // Todo: Make $this->print_unescaped_setting public.
                Utils::print_unescaped_internal_string( $settings[$prefix.'text'] );
                ?></span>
		</span>
        <?php
    }
}