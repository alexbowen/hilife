<?php
include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/config/event.php');

$query = "SELECT " . rtrim(implode(", ", $event_config['package']['csv_columns']), ", ") . " FROM events INNER JOIN events_admin ON events_admin.event_id = events.id WHERE package_client_id=\"" . $_GET['id'] . "\" ORDER BY CONVERT(DATE, date) DESC";
$events = $database->query($query)->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT * FROM package_clients WHERE id=\"" . $_GET['id'] . "\"";
$client = $database->query($query)->fetch();

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=' . strtolower(str_replace(' ', '-', $client['venue_name'])) . '-bookings-' . date("Y-m-d") . '.csv');

$output = fopen('php://output', 'w');

fputcsv($output, $event_config['package']['csv_columns']);

foreach ($events as $event) {
  fputcsv($output, $event);
}

fclose($output);
?>