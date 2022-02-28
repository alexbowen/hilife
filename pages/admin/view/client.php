<?php
$query = "SELECT package_clients.*, COUNT(events_admin.event_id) AS bookings_count FROM package_clients INNER JOIN events_admin ON package_clients.id = events_admin.package_client_id WHERE package_clients.id=\"" . $_GET['id'] . "\" AND events_admin.status <> 'cancelled'";
$client = $database->query($query)->fetch();
?>

<section class="content-section">
  <?php echo $utils->backlink('/admin/events', 'back to events dashboard'); ?>
  <h1>Package event client</h1>
</section>

<section class="content-section">
  <ul class="list-group">
    <li class="list-group-item"><span>Venue name</span> <?php echo $client['venue_name']; ?></li>
    <li class="list-group-item"><span>Venue address</span> <?php echo $client['venue_address']; ?></li>
    <li class="list-group-item"><span>Telephone</span> <?php echo $client['telephone']; ?></li>
    <li class="list-group-item"><span>Email</span> <?php echo $client['email']; ?></li>
    <li class="list-group-item"><span>Contact</span> <?php echo $client['contact']; ?></li>
  </ul>
</section>
<?php if ($client['bookings_count'] > 0) { ?>
<section class="content-section">
    <ul class="list-group">
    <li class="list-group-item"><span>Bookings</span> <?php echo $client['bookings_count']; ?></li>
  </ul>
</section>
<div class="content-border__container content-section-link">
    <span><a href="/bookings/csv?id=<?php echo $client['id']; ?>">Download</a> current bookings spreadsheet</span>
  </div>
<?php } ?>