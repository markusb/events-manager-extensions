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

if ( is_admin() ) { // admin actions

    // Add a new top level menu link to the ACP
    function emex_add_admin_page() {
        add_submenu_page( 
            'edit.php?post_type=event', //emex-admin-page.php',
            __('Events Manager Extensions','emex'),
            __('Events Manager Extentions','emex'), 
            'manage_options' , 
            '../wp-content/plugins/events-manager-extensions/emex-admin-page.php');
    }
    add_action( 'admin_menu', 'emex_add_admin_page' );

    function register_emex_settings() { // whitelist options
        register_setting( 'emex', 'emex_dbnumevents' );
        register_setting( 'emex', 'some_other_option' );
        register_setting( 'emex', 'option_etc' );
    }
    add_action('admin_init', 'register_emex_settings');
}

