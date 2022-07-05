<?php

namespace WPGet_Elementor_Widgets\Lib;

use Elementor\Plugin;

abstract class Module_Controller_Base
{
    public function __construct()
    {

    }

    /* Moved out of constructor so we can check for status first */
    public function init(){
        add_action('elementor/widgets/widgets_registered' , [$this, 'register_widgets']);
    }

    abstract public function get_config();

    abstract public function get_widgets();

    public function register_widgets()
    {
        foreach ($this->get_widgets() as $name=>$conf){
            $instance = new $conf['class']();
            //@todo check if enabled once Admin panel is done
            Plugin::instance()->widgets_manager->register($instance);
        }

    }
}