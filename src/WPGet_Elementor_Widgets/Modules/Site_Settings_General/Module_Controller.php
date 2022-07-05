<?php
namespace WPGet_Elementor_Widgets\Modules\Site_Settings_General;

use Elementor\Core\Kits\Documents\Kit;
use Elementor\Plugin;
use WPGet_Elementor_Widgets\Helper\ElementorHelper;
use WPGet_Elementor_Widgets\Lib\Module_Controller_Base;

class Module_Controller extends Module_Controller_Base
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
        parent::__construct();
        add_action('init', [$this, 'wp_init']);
        add_action( 'elementor/editor/footer', [$this, 'print_settings']);
    }

    /*
     * Widgets registered here will register when init() is called
     */
    public function get_widgets()
    {
        return [];
    }

    /*
     * Used by Module_Loader to check for plugin dependencies
     * Also, will be used for info on the Admin panel
     */
    public function get_config()
    {
        return [
            'plugin_dependencies' => ['elementor/elementor.php'],
            'name' => 'Common Site Settings',
            'description' => 'WPGet settings for the Site',
            'can_disable' => false
        ];
    }

    public function wp_init(){
        if(ElementorHelper::is_elementor_pro_active()){
            add_action( 'elementor/kit/register_tabs', [ $this, 'init_site_settings' ], 1, 40 );
        }
    }

    public function init_site_settings(Kit $kit){
        $kit->register_tab( 'settings-wpget', Site_Settings::class );
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


