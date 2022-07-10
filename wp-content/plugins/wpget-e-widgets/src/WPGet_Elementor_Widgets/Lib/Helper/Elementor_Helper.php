<?php

namespace WPGet_Elementor_Widgets\Lib\Helper;

class Elementor_Helper
{

    public static function is_elementor_active()
    {
        return is_plugin_active( 'elementor/elementor.php' );
    }

    /**
     * @param $dependancies
     * @return bool
     */
    public static function has_all_dependancies($dependancies)
    {
        if(is_string($dependancies)){
            return is_plugin_active($dependancies);
        }

        /*
         * Handle arrays from config
         * [
         *  "name"=>"Display Name"
         *  "path"=>"WP plugin path"
         * ]
         *
         * @see https://developer.wordpress.org/reference/functions/is_plugin_active/
         */
        foreach($dependancies as $dep){
            if(false === is_plugin_active($dep['path']))
                return false;
        }
        return true;
    }

    public static function is_elementor_pro_active()
    {
        return is_plugin_active( 'elementor-pro/elementor-pro.php' );
    }

    public static function is_edit_mode()
    {
        if (isset($_REQUEST['elementor-preview'])) {
            return true;
        }
        return false;
    }

    public static function is_preview_mode()
    {
        if (isset($_REQUEST['elementor-preview'])) {
            return false;
        }

        if (!empty($_REQUEST['action']) && !self::_check_background_action( sanitize_text_field( $_REQUEST['action'] ) )) {
            return false;
        }
        return true;
    }

    private static function _check_background_action($action_name){
        $allow_action = [
            'subscriptions',
            'mepr_unauthorized',
            'home',
            'subscriptions',
            'payments',
            'newpassword',
            'manage_sub_accounts',
            'ppw_postpass',
        ];
        if (in_array($action_name, $allow_action)){
            return true;
        }
        return false;
    }
}