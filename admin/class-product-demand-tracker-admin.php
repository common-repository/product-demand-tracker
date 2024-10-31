<?php

/**
 * The admin-specific functionality
 *
 * @since      1.0.0
 *
 * @package    Product_Demand_Tracker
 * @subpackage Product_Demand_Tracker/admin
 */

/**
 * The admin-specific functionality
 *
 * @package    Product_Demand_Tracker
 * @subpackage Product_Demand_Tracker/admin
 */
class Product_Demand_Tracker_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		
		// Enqueue DataTables CSS
		wp_enqueue_style( $this->plugin_name . '-data-tables', '//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css' );
		
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/product-demand-tracker-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		
		// Enqueue DataTables JS
		wp_enqueue_script( $this->plugin_name . '-data-tables', '//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js', array( 'jquery' ), '1.13.1', false );
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/product-demand-tracker-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Adding menu page - ProductFlow
	 *
	 * @since    1.0.0
	 */
	public function admin_menu() {

		add_menu_page(
			__( 'ProductFlow', 'product-demand-tracker' ),
			'ProductFlow',
			'manage_options',
			$this->plugin_name,
			array($this,'product_demand_tracker_cart_items'),
			'dashicons-update-alt',
			56
		);

	}

	/**
	 * The callback function of the menu page 'ProductFlow' to display page contents
	 *
	 * @since    1.0.0
	 */
	public function product_demand_tracker_cart_items() {
		
		//Including the admin display file when admin visited the ProductFlow page
		if( isset($_GET['page']) && $_GET['page'] == $this->plugin_name ){
			require plugin_dir_path( __FILE__ ) . 'partials/product-demand-tracker-admin-display.php';
		}

	}

}
