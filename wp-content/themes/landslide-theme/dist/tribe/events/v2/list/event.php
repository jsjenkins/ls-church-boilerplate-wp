<?php
/**
 * View: List Event
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/list/event.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.0.0
 *
 * @var WP_Post $event The event post object with properties added by the `tribe_get_event` function.
 *
 * @see tribe_get_event() For the format of the event object.
 */

$start_date = tribe_get_start_date(NULL, false, 'Ymd G:i:s');
$end_date = tribe_get_end_date(NULL, false, 'Ymd G:i:s');

$dates = array (
	'start_date' => $start_date,
	'end_date' => $end_date
);

get_template_part('partials/event', 'list-item', $dates);

