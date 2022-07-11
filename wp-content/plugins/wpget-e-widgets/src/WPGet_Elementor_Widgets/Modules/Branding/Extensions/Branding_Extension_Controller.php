<?php

namespace WPGet_Elementor_Widgets\Modules\Branding\Extensions;

use Elementor\Core\Kits\Documents\Kit;
use Elementor\Plugin;

class Branding_Extension_Controller
{
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
        add_action( 'elementor/editor/footer', [$this, 'print_settings']);
        add_action( 'elementor/kit/register_tabs', [$this, 'register'], 1, 40 );
    }

    public function register(Kit $kit){
        $kit->register_tab( 'settings-wpget', Branding_Extension_Elementor::class );
    }

    public function print_settings()
    {
        $kit = Plugin::$instance->kits_manager->get_active_kit();
        $brand_icon = $kit->get_settings('branding_icon');
        if(!empty($brand_icon['url'])):
            ?>
            <style>
                :root{
                    --wpget-svg-icon: url(<?php echo $brand_icon['url'] ?>);
                }
            </style>
        <?php
        endif;
    }
}