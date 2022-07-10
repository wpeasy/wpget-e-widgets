<?php

namespace WPGet_Elementor_Widgets\Modules\Page_Settings_General;

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
        parent::__construct();
        Page_Settings::instance();
        add_filter('body_class', [$this, 'body_class']);
        add_action('wp_enqueue_scripts', [$this, 'load_scripts'],99);
    }

    /*
     * Widgets registered here will register when init() is called
     */
    public function get_widgets()
    {
        return [];
    }

    /*
     * Used by Module_Loader to check for plugin dependencies
     * Also, will be used for info on the Admin panel
     */
    public function get_config()
    {
        return [
            'plugin_dependencies' => ['elementor/elementor.php'],
            'name' => 'Common Page Settings',
            'description' => 'WPGet settings for the Page',
            'can_disable' => false
        ];
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
            wp_register_script('WPG-page-settings', WPG_WIDGETS_URL . '/assets/js/editor-page-settings.js', ['jquery']);
            wp_enqueue_script('WPG-page-settings');
        }
    }

}