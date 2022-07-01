<?php

namespace WPGet_Elementor_Widgets;

use Elementor\Elements_Manager;

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

        /*@todo check for dependencies first */

        Module_Loader::instance();
    }

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
        wp_enqueue_style('wpg-style-editor', WPG_WIDGETS_URL . 'assets/css/editor.css');
    }

    public function wp_enqueue_scripts()
    {
        wp_enqueue_style('wpg-style-widgets', WPG_WIDGETS_URL . 'assets/css/ui-default.css');
    }

}