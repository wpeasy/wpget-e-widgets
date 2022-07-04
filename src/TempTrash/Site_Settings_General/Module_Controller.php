<?php
namespace WPGet_Elementor_Widgets\Modules\Site_Settings_General;

use Elementor\Core\Kits\Documents\Kit;
use WPGet_Elementor_Widgets\Helper\ElementorHelper;

class Module_Controller
{
    private static $_instance = null;

    public static function instance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    public function __construct()
    {
        add_action('init', [$this, 'wp_init']);
    }

    public function wp_init(){
        if(ElementorHelper::is_elementor_pro_active()){
            add_action( 'elementor/kit/register_tabs', [ $this, 'init_site_settings' ], 1, 40 );
        }
    }

    public function init_site_settings(Kit $kit){
        $kit->register_tab( 'settings-wpget', Site_Settings::class );
    }

}


