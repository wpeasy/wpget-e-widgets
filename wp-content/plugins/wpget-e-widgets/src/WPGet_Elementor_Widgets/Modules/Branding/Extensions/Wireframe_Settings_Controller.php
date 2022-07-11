<?php

namespace WPGet_Elementor_Widgets\Modules\Branding\Extensions;

class Wireframe_Settings_Controller
{

    private $_extension_instance;
    /*
     * Use Singleton because there will only ever be one of these
     */
    private static $_instance = null;
    public static function instance(){
        if(null === self::$_instance){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct()
    {
        $this->_extension_instance = new Wireframe_Settings_Elementor();
    }
}