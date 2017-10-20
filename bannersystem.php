<?php
/*
Plugin Name: Banner System
Description: Venta espacio de publicidad
Version: 1.0.0
Author: Saul Morales Pacheco
Author URI: http://saulmoralespa.com
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
Text Domain: bannersystem
Domain Path: /languages/
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; //Exit if accessed directly
}
if (!defined('BSSMP_BANNER_SYSTEM_PLUGIN_VERSION')){
	define('BSSMP_BANNER_SYSTEM_PLUGIN_VERSION', '1.0.0');
}

add_action('init','bssmp_bannersystem_init', 0);
function bssmp_bannersystem_init() {
	load_plugin_textdomain( 'bannersystem', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	if(!requeriments_banner_system()){
		return;
	}
	bssmp_index_bannersystem()->banner_run();
}
add_action('notices_action_tag_banner', 'bannersystem_notices', 10, 1);
function bannersystem_notices($notice){
	?>
	<div class="error notice">
		<p><?php echo $notice; ?></p>
	</div>
	<?php
}
function requeriments_banner_system()
{

	if ( version_compare( '5.6.0', PHP_VERSION, '>' ) ) {
		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			$php = __( 'Bannersystem: Requires php version 5.6.0 or higher.', 'bannersystem' );
			do_action('notices_action_tag_banner', $php);
		}
		return false;
	}


	if (!function_exists('curl_version')){
		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			$curl = __( 'Bannersystem: Requires cURL extension to be installed.', 'bannersystem' );
			do_action('notices_action_tag_banner', $curl);
		}
		return false;
	}
	$openssl = __( 'Bannersystem: Requires OpenSSL >= 1.0.1 to be installed on your server.', 'bannersystem' );
	if ( ! defined( 'OPENSSL_VERSION_TEXT' ) ) {
		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			do_action('notices_action_tag_banner', $openssl);
		}
		return false;
	}
	preg_match( '/^OpenSSL ([\d.]+)/', OPENSSL_VERSION_TEXT, $matches );
	if ( ! version_compare( $matches[1], '1.0.1', '>=' ) ) {
		if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
			do_action('notices_action_tag_banner', $openssl);
		}
		return false;
	}
	return true;
}
function bssmp_index_bannersystem(){
    static $plugin;
    if (!isset($plugin)){
        require_once( 'includes/class-banner-system-plugin.php' );
        $plugin = new BSSMP_Banner_System_Plugin(__FILE__,BSSMP_BANNER_SYSTEM_PLUGIN_VERSION,'Banner System');

    }
	return $plugin;
}


function bssmp_activate_bannersystem() {
	$upload_dir = wp_upload_dir();
	$dir = $upload_dir['basedir'] . '/bannersystem/';
	if(!is_dir($dir)){
		bssmp_index_bannersystem()->createDirUploads($dir);
    }
	add_role( 'user_banner', 'Usuario banner', array( 'read' => true, 'level_0' => true ) );
	wp_schedule_event( time(), 'daily', 'bssmp_user_banner_days' );
}
function bssmp_deactivation_bannersystem(){
	wp_clear_scheduled_hook( 'bssmp_user_banner_days' );
}
register_activation_hook(__FILE__,'bssmp_activate_bannersystem');
register_deactivation_hook( __FILE__, 'bssmp_user_banner_days' );