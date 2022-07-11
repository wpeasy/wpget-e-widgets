<?php

namespace WPGet_Elementor_Widgets\REST_Endpoints;

use WPGet_Elementor_Widgets\Module_Loader;

class Module_REST_Controller extends \WP_REST_Controller
{
    public function register_routes()
    {
        $version = '1';
        $namespace = 'wpget/v' . $version;
        $base = 'modules';

        register_rest_route( $namespace , '/' . $base, [
            'methods' => \WP_REST_Server::READABLE,
            'callback' => [$this, 'get_module_config_callback'],
            'permission_callback' => [$this, 'has_read_permission']
        ]);
    }

    public function has_read_permission()
    {
        return true; //for now
    }

    public function get_module_config_callback(\WP_REST_Request $request)
    {
        return new \WP_REST_Response( Module_Loader::instance()->get_global_module_config(), 200 );
    }
}