<?php
namespace WseAddons;
/**
 * The admin class
 */
class Widgets {
	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */
	const MINIMUM_PHP_VERSION = '7.2';
    	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}

	}

	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function is_compatible() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.aaaaabhvahahahha ki r korar boss', 'wse-addons' ),
			'<strong>' . esc_html__( 'Wse Addons', 'wse-addons' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'wse-addons' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'wse-addons' ),
			'<strong>' . esc_html__( 'Wse Addons', 'wse-addons' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'wse-addons' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'wse-addons' ),
			'<strong>' . esc_html__( 'Wse Addons', 'Wse_addons' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'Wse_addons' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {

		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		add_action( 'elementor/elements/categories_registered', [$this, 'wse_addons_categories' ] );

	    add_action( 'elementor/frontend/after_enqueue_styles', [$this, 'frontend_style'] );
		//add_filter( 'elementor/utils/get_placeholder_image_src', 'custom_elementor_placeholder_image' );

		// add_action( 'elementor/frontend/after_register_scripts', [$this , 'ele_frontend_scripts'] );

	}

	// function custom_elementor_placeholder_image() {
	// 	//return plugins_url( '/includes/assets/image/boss.jpg', __FILE__ );
	// }

	public function frontend_style() {
		wp_enqueue_style( 'team-style', WSE_ADDONS_ASSETS.'/css/team.css', $version);
	}

	public function register_widgets( $widgets_manager ) {

		require_once(WSE_ADDONS_PATH.'/includes/Widgets/Team.php' );
        //require_once( __DIR__ . '/Widgets/wid.php' );

       // $widgets_manager->register( new \Elementor_List_Widget() );

		$widgets_manager->register( new Widgets\Team() );
	}

	function wse_addons_categories( $elements_manager ) {
		//$categories = [];
		$categories['wse-addons'] =
			[
				'title' => __( 'Wse Addons', 'wse-addons' ),
				'icon'  => 'fa fa-plug'
			];
		$old_categories = $elements_manager->get_categories();
		$categories = array_merge($categories, $old_categories);
	
		$set_categories = function ( $categories ) {
			$this->categories = $categories;
		};
	
		$set_categories->call( $elements_manager, $categories );
	
	}





}