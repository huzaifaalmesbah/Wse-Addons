<?php
/**
 * Plugin Name: Wse Addons
 * Plugin URI:  https://huzaifa.im
 * Author:      Huzaifa Al Mesbah
 * Author URI:  https://huzaifa.im
 * Description: The Wse Addons is an Elementor addons package for WordPress.
 * Version:     1.0.0
 * License:     GPL-2.0+
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: wse-addons
 * Domain Path: i18n
*/

if (!defined('ABSPATH')){
    exit;
}

//require_once __DIR__ . '/vendor/autoload.php';


final class Wse_Addons {
     /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0.0';

    

    /**
     * Class construcotr
     */
    private function __construct() {
        $this->define_constants();
        
        register_activation_hook( __FILE__, [ $this, 'activate' ] );
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }
    /**
     * Initializes Instance 
     *
     * @return \Wse_Addons
     */
    public static function init() {
        static $instance = false;

        if ( ! $instance ) {
            $instance = new self();
        }

        return $instance;
    }
        /**
     * Define the required plugin constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'WSE_ADDONS_VERSION', self::version );
        define( 'WSE_ADDONS_FILE', __FILE__ );
        define( 'WSE_ADDONS_PATH', __DIR__ );
        define( 'WSE_ADDONS_URL', plugins_url( '', WSE_ADDONS_FILE ) );
        define( 'WSE_ADDONS_ASSETS', WSE_ADDONS_URL . '/assets' );
    }

    /**
     * Initialize the plugin
     *
     * @return void
     */
    public function init_plugin() {
	   //require_once( __DIR__ . '/includes/Widgets.php' );
	   require WSE_ADDONS_PATH.'/includes/Widgets.php';
	   new WseAddons\Widgets();

        if ( is_admin() ) {
           // new WseAddons\Admin();
        } else {
          //  new WseAddons\Frontend();
        }

    }
    /**
     * Do stuff upon plugin activation
     *
     * @return void
     */
    public function activate() {
        $installed = get_option( 'wse_addons_installed' );

        if ( ! $installed ) {
            update_option( 'wse_addons_installed', time() );
        }

        update_option( 'wse_addons_version', WSE_ADDONS_VERSION );
    }
}
/**
 * Initializes the main plugin
 *
 * @return \Wse_Addons
 */
function wse_addons() {
    return Wse_Addons::init();
}

// kick of the plugins

wse_addons();