<?php

namespace WPGet_Elementor_Widgets;

use Elementor\Elements_Manager;
use WPGet_Elementor_Widgets\REST_Endpoints\Module_REST_Controller;

class Application
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
        add_action('elementor/editor/after_enqueue_scripts', [ $this, 'editor_enqueue_scripts'] );
        add_action('wp_enqueue_scripts', [$this, 'wp_enqueue_scripts']);
        add_action('elementor/elements/categories_registered', [$this, 'register_categories']);
        Module_Loader::instance();

        add_action('rest_api_init', [$this, 'rest_api_init']);
    }

    /*
     * Widget Category for all of our Widgets
     */
    public function register_categories( Elements_Manager $elements_manager )
    {
        $elements_manager->add_category(
            'wpget',
            [
                'title' => __('WPGet', WPG_WIDGETS_TEXT_DOMAIN),
                'icon' => 'fa fa-plug'
            ]
        );
    }

    public function editor_enqueue_scripts()
    {
        /* CSS just for the Elementor Editor */
        wp_enqueue_style('wpg-style-editor', WPG_WIDGETS_URL . 'assets/css/editor.css');
    }

    public function wp_enqueue_scripts()
    {
        /* Single CSS file for all Widgets, Alternately, you can add individual CSS files as Widget Dependencies */
        wp_enqueue_style('wpg-style-widgets', WPG_WIDGETS_URL . 'assets/css/ui-default.css');
    }

    public function rest_api_init(){
        $dirs = scandir(__DIR__ . '/REST_Endpoints');
        foreach ($dirs as $dir){
            if( in_array($dir, ['.', '..'])) continue;
            $parts = pathinfo($dir);
            $class_name = __NAMESPACE__ . '\\REST_Endpoints\\' . $parts['filename'] ;
            $cont = new $class_name();
            $cont->register_routes();
        }
    }



}