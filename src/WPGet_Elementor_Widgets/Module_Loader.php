<?php

namespace WPGet_Elementor_Widgets;

use WPGet_Elementor_Widgets\Helper\ElementorHelper;
use WPGet_Elementor_Widgets\Lib\Module_Controller_Base;

class Module_Loader
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
        $this->load_modules();
    }


    public function load_modules()
    {
        $sub_dirs = scandir(WPG_WIDGETS_MODULE_DIR);

        foreach ($sub_dirs as $dir){
            if(in_array($dir, ['.','..'])) continue;

            $class_name =  __NAMESPACE__ . '\\Modules\\' . $dir . '\\'. 'Module_Controller';


            if(class_exists($class_name)){
                /**@var $module Module_Controller_Base */
                $module = $class_name::instance();
                $conf = $module->get_config();
                /*@todo add check for enable once admin panel has been done */
                if(!empty($conf['plugin_dependencies'])){
                    $ok = ElementorHelper::has_all_dependancies($conf['plugin_dependencies']);
                    if($ok){
                        $module->init();
                    }else{
                        //@todo report warning if dependencies aren't met, or just don't init ?
                    }
                }

            }else{
                //@todo report warning here if the class doesn't exist?.
            }
        }

    }
}