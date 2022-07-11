<?php

namespace WPGet_Elementor_Widgets\Lib\Base;

use Elementor\Plugin;


abstract class Module_Controller_Base
{
    protected $config = null;

    public function __construct()
    {
        $this->get_config();
    }

    /* Moved out of constructor so we can check for status first */
    public function init(){

        /*@todo move to init */
        add_action('elementor/widgets/widgets_registered' , [$this, 'register_widgets']);

        add_action( 'init', [$this, 'register_extensions']);

        do_action($this->get_id(). '_initialised');
        //e.g "Scroll_Sequence_Basic_Widget_initialised"  check config.php for the "id"
    }

    public function get_config()
    {
        if(null === $this->config){
            //Get config.php from the directory of the caller class.
            $instance_dir = dirname(debug_backtrace()[1]['file']);;
            $this->config = require_once $instance_dir . '/config.php';
        }
        //update counts
        $this->config['widget_count'] = @$this->config['widgets'] ? count($this->config['widgets'] ) : 0;
        $this->config['extension_count'] = @$this->config['extensions'] ? count($this->config['extensions']): 0;
        return $this->config;
    }

    public function get_widgets(){
        return @$this->get_config()['widgets'];
    }

    public function get_id(){
        return $this->get_config()['id'];
    }

    public function get_extensions(){
        return @$this->get_config()['extensions'];
    }

    public function get_dependencies(){
        return @$this->get_config()['dependencies'];
    }

    public function get_name(){
        return $this->get_config()['name'];
    }

    public function description(){
        return $this->get_config()['description'];
    }

    public function register_widgets()
    {

        if($this->get_widgets()){
            foreach ($this->get_widgets() as $widget_config){
                $instance = new $widget_config['class']();
                //@todo check if enabled once Admin panel is done
                Plugin::instance()->widgets_manager->register($instance);
            }
        }
    }

    public function register_extensions()
    {
        if($this->get_extensions()){
            foreach ($this->get_extensions() as $config){
                //@todo check if enabled once Admin panel is done
                $instance = $config['class']::instance();
            }
        }
    }
}