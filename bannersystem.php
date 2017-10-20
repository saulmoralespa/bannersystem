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
if (!defined('ECPT_BANNER_SYSTEM_PLUGIN_VERSION')){
	define('ECPT_BANNER_SYSTEM_PLUGIN_VERSION', '1.0.0');
}

add_action('init','bannersystem_init', 0);
function bannersystem_init() {
	load_plugin_textdomain( 'bannersystem', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	if(!requeriments_banner_system()){
		return;
	}
	ecpt_bansystem()->banner_run();
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
function ecpt_bansystem(){
    static $plugin;
    if (!isset($plugin)){
        require_once( 'includes/class-banner-system-plugin.php' );
        $plugin = new ECPT_Banner_System_Plugin(__FILE__,ECPT_BANNER_SYSTEM_PLUGIN_VERSION,'Banner System');

    }
	return $plugin;
}


function ecpt_activate() {
	$upload_dir = wp_upload_dir();
	$dir = $upload_dir['basedir'] . '/bannersystem/';
	if(!is_dir($dir)){
	    ecpt_bansystem()->createDirUploads($dir);
    }
	add_role( 'user_banner', 'Usuario banner', array( 'read' => true, 'level_0' => true ) );
	wp_schedule_event( time(), 'daily', 'ecpt_user_banner_days' );
}
function ecpt_deactivation(){
	wp_clear_scheduled_hook( 'ecpt_user_banner_days' );
}
register_activation_hook(__FILE__,'ecpt_activate');
register_deactivation_hook( __FILE__, 'ecpt_deactivation' );