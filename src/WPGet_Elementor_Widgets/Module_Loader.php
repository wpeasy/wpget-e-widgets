<?php

namespace WPGet_Elementor_Widgets;

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

            //@todo add logic to load only if enabled
            $class_name =  __NAMESPACE__ . '\\Modules\\' . $dir . '\\'. 'Module_Controller';

            if(class_exists($class_name)){
                $class_name::instance();
            }else{
                // report warning here.
            }

        }

    }
}