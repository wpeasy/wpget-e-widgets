<?php

namespace WPGet_Elementor_Widgets\Modules\Reveal;

use WPGet_Elementor_Widgets\Lib\Base\Module_Controller_Base;
use WPGet_Elementor_Widgets\Modules\Reveal\Widgets\Button_Reveal_Widget;

class Module_Controller extends Module_Controller_Base
{

    private static $_instance = null;

    public static function instance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        parent::__construct();
    }


    public function get_config()
    {
        return [
            'plugin_dependencies' => ['elementor/elementor.php'],
            'name' => 'Reveal Content',
            'description' => 'Widgets that reveal content on click or hover',
            'can_disable' => true
        ];
    }

    public function get_widgets()
    {
        return [
            'Reveal with button' => [
                'class' => Button_Reveal_Widget::class,
                'can_disable' => true,
                'description' => 'Reveal Widget with a button',
                'plugin_dependencies' => []
            ]
        ];
    }
}