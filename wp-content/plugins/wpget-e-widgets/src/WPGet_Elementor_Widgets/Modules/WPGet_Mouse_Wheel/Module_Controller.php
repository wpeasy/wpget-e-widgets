<?php

namespace WPGet_Elementor_Widgets\Modules\WPGet_Mouse_Wheel;

use WPGet_Elementor_Widgets\Lib\Base\Module_Controller_Base;

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
        parent::__construct(); //Standard Widget Module initialisation.

        // Anything you want to do post initialisation
    }



}