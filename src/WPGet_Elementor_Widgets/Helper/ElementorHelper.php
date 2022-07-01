<?php

namespace WPGet_Elementor_Widgets\Helper;

class ElementorHelper
{

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