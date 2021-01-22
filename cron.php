<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://makewebbetter.com/
 * @since             1.0.0
 * @package           Cron
 *
 * @wordpress-plugin
 * Plugin Name:       cron
 * Plugin URI:        https://makewebbetter.com/product/cron/
 * Description:       wp_cron task
 * Version:           1.0.0
 * Author:            makewebbetter
 * Author URI:        https://makewebbetter.com/
 * Text Domain:       cron
 * Domain Path:       /languages
 *
 * Requires at least: 4.6
 * Tested up to:      4.9.5
 *
 * License:           GNU General Public License v3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Define plugin constants.
 *
 * @since             1.0.0
 */
function define_cron_constants() {

	cron_constants( 'CRON_VERSION', '1.0.0' );
	cron_constants( 'CRON_DIR_PATH', plugin_dir_path( __FILE__ ) );
	cron_constants( 'CRON_DIR_URL', plugin_dir_url( __FILE__ ) );
	cron_constants( 'CRON_SERVER_URL', 'https://makewebbetter.com' );
	cron_constants( 'CRON_ITEM_REFERENCE', 'cron' );
}


/**
 * Callable function for defining plugin constants.
 *
 * @param   String $key    Key for contant.
 * @param   String $value   value for contant.
 * @since             1.0.0
 */
function cron_constants( $key, $value ) {

	if ( ! defined( $key ) ) {

		define( $key, $value );
	}
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cron-activator.php
 */
function activate_cron() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cron-activator.php';
	Cron_Activator::cron_activate();
	$mwb_c_active_plugin = get_option( 'mwb_all_plugins_active', false );
	if ( is_array( $mwb_c_active_plugin ) && ! empty( $mwb_c_active_plugin ) ) {
		$mwb_c_active_plugin['cron'] = array(
			'plugin_name' => __( 'cron', 'cron' ),
			'active' => '1',
		);
	} else {
		$mwb_c_active_plugin = array();
		$mwb_c_active_plugin['cron'] = array(
			'plugin_name' => __( 'cron', 'cron' ),
			'active' => '1',
		);
	}
	update_option( 'mwb_all_plugins_active', $mwb_c_active_plugin );
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cron-deactivator.php
 */
function deactivate_cron() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cron-deactivator.php';
	Cron_Deactivator::cron_deactivate();
	$mwb_c_deactive_plugin = get_option( 'mwb_all_plugins_active', false );
	if ( is_array( $mwb_c_deactive_plugin ) && ! empty( $mwb_c_deactive_plugin ) ) {
		foreach ( $mwb_c_deactive_plugin as $mwb_c_deactive_key => $mwb_c_deactive ) {
			if ( 'cron' === $mwb_c_deactive_key ) {
				$mwb_c_deactive_plugin[ $mwb_c_deactive_key ]['active'] = '0';
			}
		}
	}
	update_option( 'mwb_all_plugins_active', $mwb_c_deactive_plugin );
}

register_activation_hook( __FILE__, 'activate_cron' );
register_deactivation_hook( __FILE__, 'deactivate_cron' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cron.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cron() {
	define_cron_constants();

	$c_plugin_standard = new Cron();
	$c_plugin_standard->c_run();
	$GLOBALS['c_mwb_c_obj'] = $c_plugin_standard;

}
run_cron();

// Add rest api endpoint for plugin.
add_action( 'rest_api_init', 'c_add_default_endpoint' );

/**
 * Callback function for endpoints.
 *
 * @since    1.0.0
 */
function c_add_default_endpoint() {
	register_rest_route(
		'c-route',
		'/c-dummy-data/',
		array(
			'methods'  => 'POST',
			'callback' => 'mwb_c_default_callback',
			'permission_callback' => 'mwb_c_default_permission_check',
		)
	);
}

/**
 * API validation
 * @param 	Array 	$request 	All information related with the api request containing in this array.
 * @since    1.0.0
 */
function mwb_c_default_permission_check($request) {

	// Add rest api validation for each request.
	$result = true;
	return $result;
}

/**
 * Begins execution of api endpoint.
 *
 * @param   Array $request    All information related with the api request containing in this array.
 * @return  Array   $mwb_c_response   return rest response to server from where the endpoint hits.
 * @since    1.0.0
 */
function mwb_c_default_callback( $request ) {
	require_once CRON_DIR_PATH . 'includes/class-cron-api-process.php';
	$mwb_c_api_obj = new Cron_Api_Process();
	$mwb_c_resultsdata = $mwb_c_api_obj->mwb_c_default_process( $request );
	if ( is_array( $mwb_c_resultsdata ) && isset( $mwb_c_resultsdata['status'] ) && 200 == $mwb_c_resultsdata['status'] ) {
		unset( $mwb_c_resultsdata['status'] );
		$mwb_c_response = new WP_REST_Response( $mwb_c_resultsdata, 200 );
	} else {
		$mwb_c_response = new WP_Error( $mwb_c_resultsdata );
	}
	return $mwb_c_response;
}


// Add settings link on plugin page.
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'cron_settings_link' );

/**
 * Settings link.
 *
 * @since    1.0.0
 * @param   Array $links    Settings link array.
 */
function cron_settings_link( $links ) {

	$my_link = array(
		'<a href="' . admin_url( 'admin.php?page=cron_menu' ) . '">' . __( 'Settings', 'cron' ) . '</a>',
	);
	return array_merge( $my_link, $links );
}
