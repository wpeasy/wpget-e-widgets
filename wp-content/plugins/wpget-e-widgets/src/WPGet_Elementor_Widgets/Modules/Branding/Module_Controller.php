<?php

namespace WPGet_Elementor_Widgets\Modules\Branding;

use Elementor\Plugin;
use WPGet_Elementor_Widgets\Lib\Base\Module_Controller_Base;
use WPGet_Elementor_Widgets\Lib\Helper\Elementor_Helper;

class Module_Controller extends Module_Controller_Base
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
        // Anything you want to do pre initialisation

        //Module initialisation
        parent::__construct(); //Standard  Module initialisation.

        // Anything you want to do post initialisation
        add_filter('body_class', [$this, 'body_class']);
        add_action('wp_enqueue_scripts', [$this, 'load_scripts'],99);
    }

    public function body_class($classes)
    {
        $post_id = get_the_ID();
        $document = Plugin::$instance->documents->get($post_id, false);
        $state = $document? $document->get_settings('wpg_use_wireframe_styles') : null;

        if($state == 'yes'){
            $classes[] = 'wpg_use_wireframe_styles';
        }

        return $classes;
    }

    public function load_scripts()
    {
        if(Elementor_Helper::is_edit_mode()){
            wp_register_script('WPG-page-settings', plugin_dir_url(__FILE__) . '/assets/js/editor-page-settings.js', ['jquery']);
            wp_enqueue_script('WPG-page-settings');
        }
    }
}