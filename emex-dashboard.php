<?php
/*
 * Add dashboard to the Wordpress Admin Control Panel
 */

add_action('wp_dashboard_setup', 'emex_dashboard_widget');
  
function emex_dashboard_widget() {
global $wp_meta_boxes;
 
wp_add_dashboard_widget('custom_help_widget', 'Events Manager', 'emex_dashboard_content');

}
 
function emex_dashboard_content() {
 
    echo '<p style="font-weight: bold;">Evénements à venir:</p>';
    $sql = "SELECT event_id,event_start_date,event_name,event_spaces 
            FROM wp_em_events AS e
            WHERE event_start_date > curdate() 
                AND event_rsvp > '0'
                AND event_status = '1'
                AND recurrence = '0'
            ORDER by event_start_date
            LIMIT 5;";
    $sql1 = "SELECT SUM(booking_spaces) AS sum
             FROM wp_em_bookings
             WHERE booking_status = '1'
             AND event_id = ";
    global $wpdb;
    $wpdb->show_errors( true );
    $dbresult = $wpdb->get_results($sql);
    echo "<table>";
    echo '<tr><th>Date</th><th>Evénement</th><th>(Res/Tot)</th></tr>';
    foreach($dbresult as $row) {
        $dbresult1 = $wpdb->get_results($sql1."'".$row->event_id."';");
        $sum = $dbresult1[0]->sum;
        $a = '<a href="https:/wp-admin/edit.php?post_type=event&page=events-manager-bookings&event_id='.$row->event_id.'">'.$row->event_name.'</a>'; //.$row-event_id.'">';
        printf("<tr><td>%s</td><td>%s</td><td>(%d/%d)</td></tr>",$row->event_start_date,$a,$sum,$row->event_spaces);
    }
    echo '</table>';

    echo '<p style="font-weight: bold;">Réservations nécessitent une attention:';
    $sql = "SELECT b.booking_id AS booking_id, b.event_id AS event_id, b.booking_date AS booking_date,
                   b.booking_price AS booking_price, u.display_name AS display_name, e.event_start_date AS event_start_date,
                   e.event_name AS event_name, b.booking_spaces AS booking_spaces, b.booking_price AS booking_price
            FROM wp_em_bookings AS b, wp_users AS u, wp_em_events AS e
            WHERE b.booking_status = '5'
            AND b.person_id = u.ID
            AND b.event_id =  e.event_id;";
    $dbresult = $wpdb->get_results($sql);
    echo '<table>';
    echo '<tr><th>Date</th><th>Evénement</th><th>ResDate</th><th>Nom</th><th>Places</th><th>Montant</th></tr>';
    $rowfound=0;
    foreach($dbresult as $row) {
        $rowfound=$rowfound+1;
        $a = '<a href="https:/wp-admin/edit.php?post_type=event&page=events-manager-bookings&event_id='.$row->event_id.'&booking_id='.$row->booking_id.'">';
        printf("<tr><td>%s</td><td>%s</td><td>%s%s</a></td><td>%s</td><td>%d</td><td>%d</td></tr>",
               $row->event_start_date,$row->event_name,$a,$row->booking_date,$row->display_name,$row->booking_spaces,$row->booking_price);
// https://encordages-lemaniques.ch/wp-admin/edit.php?post_type=event&page=events-manager-bookings&event_id=111&booking_id=341
    }
    if ($rowfound==0) { echo "<tr><td colspan=6>Aucune</td></tr>"; }
    echo '</table>';
}

