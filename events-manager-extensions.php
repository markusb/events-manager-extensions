<?php
/*
 * Events Manager Extensions
 *
 * Plugin Name: Events Manager Extensions
 * Plugin URI:  https://github.com/markusb/wp-events-manager-extensions
 * Description: Extensions for events manager
 * Author: Markus Baertschi
*/

require_once plugin_dir_path(__FILE__) . 'emex-shortcodes.php';

require_once plugin_dir_path(__FILE__) . 'emex-dashboard.php';

// Hook the 'admin_menu' action hook, run the function named 'mfp_Add_My_Admin_Link()'
#add_action( 'admin_menu', 'emex_Add_My_Admin_Link' );


