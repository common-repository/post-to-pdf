<?php
/**
 * Plugin Name: Post to Pdf
 * Description: Convert Post to pdf in frontend wordress
 * Version:     1.0
 * Author:      Gravity Master
 * License:     GPLv2 or later
 * Text Domain: gmptp
 */

/* Stop immediately if accessed directly. */
if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/* All constants should be defined in this file. */
if ( ! defined( 'GMPTP_PREFIX' ) ) {
	define( 'GMPTP_PREFIX', 'gmptp' );
}
if ( ! defined( 'GMPTP_PLUGINDIR' ) ) {
	define( 'GMPTP_PLUGINDIR', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'GMPTP_PLUGINBASENAME' ) ) {
	define( 'GMPTP_PLUGINBASENAME', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'GMPTP_PLUGINURL' ) ) {
	define( 'GMPTP_PLUGINURL', plugin_dir_url( __FILE__ ) );
}

/* Auto-load all the necessary classes. */
if( ! function_exists( 'gmptp_class_auto_loader' ) ) {
	
	function gmptp_class_auto_loader( $class ) {
		
	 	$includes = GMPTP_PLUGINDIR . 'includes/' . $class . '.php';
		
		if( is_file( $includes ) && ! class_exists( $class ) ) {
			include_once( $includes );
			return;
		}
		
	}
}
spl_autoload_register('gmptp_class_auto_loader');
new GMPTP_Cron();
new GMPTP_Admin();
new GMPTP_Frontend();
new GMPTP_PDF();
?>