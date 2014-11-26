<?php
/*
Plugin Name: Orbis SNOM
Plugin URI: http://pronamic.eu/wp-plugins/orbis-snom/
Description: Extends the Orbis plugin extends the Orbis plugin with some SNOM phone functions.

Version: 1.0.0
Requires at least: 3.0

Author: Pronamic
Author URI: http://www.pronamic.eu/

Text Domain: orbis_snom
Domain Path: /languages/

License: GPL

GitHub URI: https://github.com/wp-orbis/wp-orbis-snom
*/

function orbis_snom_bootstrap() {
	// Classes
	require_once 'classes/orbis-snom-plugin.php';
	require_once 'classes/orbis-snom-admin.php';

	// Initialize
	global $orbis_snom_plugin;

	$orbis_snom_plugin = new Orbis_Snom_Plugin( __FILE__ );
}

add_action( 'orbis_bootstrap', 'orbis_snom_bootstrap' );
