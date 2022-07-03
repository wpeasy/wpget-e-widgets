<?php

namespace WPGet_Elementor_Widgets\Modules\ScrollSequence;

use Elementor\Plugin;
use WPGet_Elementor_Widgets\Modules\ScrollSequence\Widgets\ScrollSequenceBasicWidget;

class Module_Controller
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
        add_action('elementor/widgets/widgets_registered' , [$this, 'register_widgets']);
        add_action('wp_enqueue_scripts', [$this, 'wp_enqueue_scripts']);
    }

    public function register_widgets()
    {
        $basic = new ScrollSequenceBasicWidget();
        Plugin::instance()->widgets_manager->register($basic);
    }

    public function wp_enqueue_scripts(){
        wp_register_script('wpg-scroll-sequence', WPG_WIDGETS_URL . 'assets/js/scroll-sequence-basic.js');
    }
}