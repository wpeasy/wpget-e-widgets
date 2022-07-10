<?php

namespace WPGet_Elementor_Widgets;

use WPGet_Elementor_Widgets\Lib\Base\Module_Controller_Base;
use WPGet_Elementor_Widgets\Lib\Helper\Elementor_Helper;

class Module_Loader
{
    private static $_instance = null;


    private $_global_module_config = [];

    /**
     * @return Module_Loader|null
     */
    public static function instance()
    {
        if(null === self::$_instance){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     *
     */
    public function __construct()
    {
        $this->load_modules();
    }

    /**
     * @param $config
     * @return void
     */
    private function _register_module_config($config)
    {
        $this->_global_module_config[] = $config;
    }

    /**
     * @return array
     */
    public function get_global_module_config(){
        return $this->_global_module_config;
    }

    /**
     * @return void
     */
    public function load_modules()
    {
        $sub_dirs = scandir(WPG_WIDGETS_MODULE_DIR);

        //Iterate modules dir
        foreach ($sub_dirs as $dir) {
            if (in_array($dir, ['.', '..'])) continue;
            $class_name = __NAMESPACE__ . '\\Modules\\' . $dir . '\\' . 'Module_Controller';
            if (class_exists($class_name)) {
                /**@var $module Module_Controller_Base */
                $module = $class_name::instance();

                //Check if module has active dependencies
                $module_config = $module->get_config();
                $dependencies = $module->get_dependencies();
                $has_dependencies = $dependencies ? Elementor_Helper::has_all_dependancies($dependencies) : true;
                $module_config['has_all_dependencies_active'] = $has_dependencies;
                //Register the module config in our global config
                $this->_register_module_config($module_config);

                /*@todo add check for enable once admin panel has been done and update "is_enabled"*/
                $module_config['is_enabled'] = true;

                if ($has_dependencies && $module_config['is_enabled']) {
                    $module->init();
                } else {
                    //@todo report warning if dependencies aren't met, or just don't init ?
                }
            }
        }
    }
}