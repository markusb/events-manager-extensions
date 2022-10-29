<?php
/*
 * Events Manager Extensions
 *
 *
 *
 * Add shortcodes:
 * - [emex_participant_list] returns the list of participants of the event
 *                           the shortcode only works on an event page and for logged-in users
*/

add_shortcode( 'emex_participant_list', 'emex_participant_list' );

function emex_shortcodes_init(){
    function emex_participant_list() {
        if (is_user_logged_in()) {
            $post_id = get_the_id();
            $sql = "SELECT wp_users.display_name,wp_em_bookings.booking_spaces 
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
                $list = $list."<br>".$row->display_name." (".$row->booking_spaces.")";
            }
            if($list == "") { $list = __("No registration for this event","emex"); }
            return $list;
        } else {
            return __("You need to be logged in to see participants","emex");
        }
    }
}
add_action('init', 'emex_shortcodes_init');

?>
