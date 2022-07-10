<?php

namespace WPGet_Elementor_Widgets\Modules\WPGet_Mouse_Wheel\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Scroll_Sequence_Basic_Widget extends Widget_Base
{

    public function __construct($data = [], $args = null)
    {
        parent::__construct($data, $args);
        wp_register_script('wpg-scroll-sequence-basic', WPG_WIDGETS_URL . 'assets/js/scroll-sequence-basic.js');
        wp_register_style('wpg-scroll-sequence', WPG_WIDGETS_URL . 'assets/css/scroll-sequence.css');
    }

    public function get_script_depends()
    {
        return [ 'wpg-scroll-sequence-basic' ];
    }

    public function get_style_depends()
    {
        return [ 'wpg-scroll-sequence' ];
    }
    public function get_name()
    {
        return 'basic_scroll_sequence';
    }

    public function get_title()
    {
        return 'Basic Scroll Sequence';
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
        return ['scroll', 'sequence'];
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
            'wrapper_container_id',
            [
                'label' => esc_html__('Scroll Container ID', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'description' => 'ID of the container to monitor mouse wheel scroll on'
            ]
        );
        $this->add_control(
            'scroll_gallery',
            [
                'label' => esc_html__( 'Add Images', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
            ]
        );
        $this->add_control(
            'hide_sequence',
            [
                'label' => esc_html__('Hide Sequence Frames', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', WPG_WIDGETS_TEXT_DOMAIN),
                'label_off' => esc_html__('No', WPG_WIDGETS_TEXT_DOMAIN),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        /*
       * CONTENT
       */
        $this->start_controls_section(
            'scroll_behaviour',
            [
                'label' => 'Scroll Behaviour',
            ]
        );

        $this->add_control(
            'enable_scroll_into_view',
            [
                'label' => esc_html__('Scroll Into View', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', WPG_WIDGETS_TEXT_DOMAIN),
                'label_off' => esc_html__('No', WPG_WIDGETS_TEXT_DOMAIN),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'scroll_block',
            [
                'label' => esc_html__('Block Alignment', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__('Start', WPG_WIDGETS_TEXT_DOMAIN),
                        'icon' => ' eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', WPG_WIDGETS_TEXT_DOMAIN),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'end' => [
                        'title' => esc_html__('End', WPG_WIDGETS_TEXT_DOMAIN),
                        'icon' => 'eicon-v-align-bottom',
                    ]
                ],
                'condition' => [
                    'enable_scroll_into_view' => 'yes',
                ],
                'default' => 'center',
                'toggle' => true,
            ]
        );
        $this->add_control(
            'scroll_smooth',
            [
                'label' => esc_html__('Smooth Scroll', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', WPG_WIDGETS_TEXT_DOMAIN),
                'label_off' => esc_html__('No', WPG_WIDGETS_TEXT_DOMAIN),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'enable_scroll_into_view' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'frames_section',
            [
                'label' => 'Frames Control',
            ]
        );

        $this->add_control(
            'preload_frames',
            [
                'label' => esc_html__('Frames', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::NUMBER,
                'default' => 10,
                'description' => 'Number of frames to preload for smooth behaviour'
            ]
        );

        $this->add_control(
            'frame_loop',
            [
                'label' => esc_html__('Loop', WPG_WIDGETS_TEXT_DOMAIN),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', WPG_WIDGETS_TEXT_DOMAIN),
                'label_off' => esc_html__('No', WPG_WIDGETS_TEXT_DOMAIN),
                'return_value' => 'yes',
                'default' => 'no',
                'description' => 'Note: setting to Yes will stop scrolling at frame endpoints'
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $wrapper_main = ['wpg_scroll_sequence_basic'];
        @$settings['hide_sequence'] == 'yes' && $wrapper_main[] = 'hide_sequence';
        $this->add_render_attribute('wrapper_main', ['class' => $wrapper_main]);

        $config = false;
        if($settings['enable_scroll_into_view'] === 'yes'){
            $config = new \stdClass();
            $config->behavior = @$settings['scroll_smooth'] === 'yes' ? 'smooth' : 'auto';
            $config->block = $settings['scroll_block'];
        }
        $confJSON = json_encode($config);

        $images = '';
        foreach ( $settings['scroll_gallery'] as $image ) {
            $images.= '<img class="image_item nolazy" src="' . esc_attr( $image['url'] ) . '">' . "\r\n";
        }

        $frameLoop = @$settings['frame_loop'] === 'yes'? 'yes' : 'no';
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper_main') ?>>
            <?php echo $images ?>
        </div>
        <script>
            window.addEventListener('wpg/ScrollSequence/load', ()=>{
                const el = new window.wpg.ScrollSequence(
                    "<?php echo $settings['wrapper_container_id'] ?>",
                    <?php echo $confJSON ?>,
                    "<?php echo $frameLoop ?>",
                    <?php echo $settings['preload_frames'] ?>
                );
                el.methods.init();
            })
        </script>
        <?php
    }

    protected function content_template() {
        /* Not needed because we don't edit content in the editor window */
    }
}