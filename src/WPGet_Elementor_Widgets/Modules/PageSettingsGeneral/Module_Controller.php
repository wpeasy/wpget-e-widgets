<?php

namespace WPGet_Elementor_Widgets\Modules\PageSettingsGeneral;

use Elementor\Plugin;
use WPGet_Elementor_Widgets\Helper\ElementorHelper;


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
        Page_Settings::instance();
        add_filter('body_class', [$this, 'body_class']);
        add_action('wp_enqueue_scripts', [$this, 'load_scripts'],99);
    }

    public function body_class($classes)
    {
        $post_id = get_the_ID();
        $document = Plugin::$instance->documents->get($post_id, false);
        $state = $document->get_settings('wpg_use_wireframe_styles');
        if($state == 'yes'){
            $classes[] = 'wpg_use_wireframe_styles';
        }

        return $classes;
    }

    public function load_scripts()
    {
        if(ElementorHelper::is_edit_mode()){
            wp_register_script('WPG-page-settings', WPG_WIDGETS_URL . '/assets/js/editor-page-settings.js', ['jquery']);
            wp_enqueue_script('WPG-page-settings');
        }
    }

}