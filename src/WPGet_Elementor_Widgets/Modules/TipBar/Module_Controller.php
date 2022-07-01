<?php

namespace WPGet_Elementor_Widgets\Modules\TipBar;
use Elementor\Plugin;
use WPGet_Elementor_Widgets\Modules\TipBar\Widgets\BasicTipBarWidget;

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
    }

    public function register_widgets()
    {
        $basic = new BasicTipBarWidget();
        Plugin::instance()->widgets_manager->register($basic);
    }
}