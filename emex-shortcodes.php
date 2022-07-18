<?php
/*
 * Events Manager Extensions by Markus
 */

// Hook the 'admin_menu' action hook, run the function named 'mfp_Add_My_Admin_Link()'
#add_action( 'admin_menu', 'emex_Add_My_Admin_Link' );

// Add a new top level menu link to the ACP
function emex_Add_My_Admin_Link()
{
      add_menu_page(
        'Events manager Extensions by Markus', // Title of the page
        'Events Manager Extentions', // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        'includes/emex-first-acp-page.php' // The 'slug' - file to display when clicking the link
    );
}

/*
 * Add shortcodes:
 * - [emex_participant_list] returns the list of participants of the event
 *                           the shortcode only works on an event page and for logged-in users
*/

add_shortcode( 'emex_participant_list', 'emex_participant_list' );

function emex_shortcodes_init(){
    function emex_participant_list() {
        if (is_user_logged_in()) {
            $post_id = get_the_id();
            $sql = "SELECT wp_users.display_name 
                    from wp_em_events,wp_em_bookings,wp_users
                    where wp_em_events.event_id = wp_em_bookings.event_id
                    and wp_em_bookings.person_id = wp_users.ID
                    and wp_em_bookings.booking_status = '1'
                    and wp_em_events.post_id = '".$post_id."';";
            global $wpdb;
            $wpdb->show_errors( true );
            $dbresult = $wpdb->get_results($sql);
            $list = "";
            foreach($dbresult as $row) {
                $list = $list."<br>".$row->display_name;
            }
            if($list == "") { $list = "Aucune inscription"; }
            return $list;
        } else {
            return "Faut être connecté pour voir les participants";
        }
    }
}
add_action('init', 'emex_shortcodes_init');

?>
