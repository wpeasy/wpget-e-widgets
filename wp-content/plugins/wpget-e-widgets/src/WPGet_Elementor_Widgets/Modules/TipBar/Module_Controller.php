<?php

namespace WPGet_Elementor_Widgets\Modules\TipBar;
use WPGet_Elementor_Widgets\Lib\Base\Module_Controller_Base;
use WPGet_Elementor_Widgets\Modules\TipBar\Widgets\Basic_TipBar_Widget;

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
    }

    /*
     * Used by Module_Loader to check for plugin dependencies
     * Also, will be used for info on the Admin panel
     */
    public function get_config()
    {
        return [
            'plugin_dependencies' => 'elementor/elementor.php',
            'name' => 'Tip Bar Widgets',
            'description' => 'Widgets for displaying tips',
            'can_disable' => true
        ];
    }

    /*
     * Widgets registered here will register when init() is called
     */
    public function get_widgets()
    {
        return [
            'Basic Tip Bar' => [
                'class' => Basic_TipBar_Widget::class,
                'can_disable' => true,
                'description' => 'Basic Tip Bar Widget',
                'plugin_dependencies' => []
            ]
        ];
    }

}