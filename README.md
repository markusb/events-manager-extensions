# wp-events-manager-extensions
Extensions for Wordpress Events Manager

Some useful extensions for Wordpress Events Manager

## Prerequisites

This code requires Wordpress Events Manager (https://wordpress.org/plugins/events-manager/). It should work with the free and the pro version of Events Manager. Have tested it with the Pro version.

## Shortcodes

* [emex_participant_list] returns the list of participants of the event
  * only works on an event page
  * limited to logged-in users

## Dashboard panel

Panel in the Wordpress dashboard

* list the upcoming events with reservations and shows the taken and available spaces
* list the reservations where an action is required

## Installation Instructions

* Download the code
* Create the folder/directory wp-content/plugins/events-manager-extensions in your Wordpress installation
* Copy the files from events-manager-extensions-main in the archive into the wp-content/plugins/events-manager-extensions folder of your wordpress installation
* Go to your wordpress plugin mangement page and enable the Events Manager Extensions

If the Events Manager Extensions do not show up in the plugins folder, then you did not correctly place the plugin files in the folder.


## Todo

* Configuration page
  * Number of events to show in dashboard panel
  * Enable link to Events Manager in top row
