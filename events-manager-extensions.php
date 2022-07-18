<?php
/*
 * Events Manager Extensions
 *
 * Plugin Name: Events Manager Extensions
 * Plugin URI:  https://github.com/markusb/wp-events-manager-extensions
 * Description: Extensions for events manager
 * Author: Markus Baertschi
*/

function emex_init(){
    load_plugin_textdomain( 'emex', false, 'events-manager-extensions/languages' );
}
add_action('init', 'emex_init');


require_once plugin_dir_path(__FILE__) . 'emex-shortcodes.php';

require_once plugin_dir_path(__FILE__) . 'emex-dashboard.php';

// Add a new top level menu link to the ACP
function emex_Add_My_Admin_Link()
{
      add_menu_page(
        'Events manager Extensions', // Title of the page
        'Events Manager Extentions', // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        'emex-admin-page.php' // The 'slug' - file to display when clicking the link
    );
}
// Hook the 'admin_menu' action hook, run the function named 'mfp_Add_My_Admin_Link()'
#add_action( 'admin_menu', 'emex_Add_My_Admin_Link' );


