<?php
include $_SERVER['DOCUMENT_ROOT'].'/lib/event.php';

$query = "SELECT id, date, events_planner.last_updated FROM events INNER JOIN events_admin ON events_admin.event_id = events.id LEFT JOIN events_planner ON events_planner.event_id = events.id WHERE events.date >= CURDATE() AND events.email=\"" . $_SESSION['auth_email'] . "\"";
if (isset($_GET['id'])) {
  $query .= " OR events.id=\"" . $_GET['id'] . "\"";
}

$result = $database->query($query);
?>

<h1>Your upcoming Hi-Life events</h1>

<?php if($result->rowCount() > 0) { ?>  
<?php foreach ($result as $e) { ?>
<?php
  $event = EventFactory::create(array(
    'events.id' => $e['id']
  ));
?>

<?php if ($event && $event->status !== 'cancelled') { ?>
<section class="introduction content-section">
  <p class="lead">Event planner
    <?php if ($event && !empty($event->venue_name)) { ?> for <b><?php echo $event->venue_name; ?></b><?php } ?>
    on <b><?php echo $event->prettyDate(); ?></b>
    <?php if ($event && !empty($event->start_time)) { ?>at <b><?php echo $event->prettyTime('start'); ?></b><?php } ?>
  </p>
  <?php if ($event && $event->status !== 'confirmed') { ?>
  <p class="text-danger">Please note this event is not yet confirmed.</p>
  <?php } ?>
</section>

<section class="content-section">
  <div class="row">
    <div class="col-sm">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Details</h5>
          <p class="card-text">View your event details.</p>
          <ul>
            <li>Location</li>
            <li>Timings</li>
            <li>Contact details</li>
          </ul>
          <div class="d-grid gap-2">
            <a href="/planner/details?id=<?php echo $event->id; ?>" class="btn btn-<?php if ($event->status === 'confirmed') { ?>primary<?php } else { ?>success<?php } ?>"><?php if ($event->status === 'confirmed') { ?>view<?php } else { ?>edit<?php } ?> details</a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Music</h5>
          <p class="card-text">Manage the music for your event.</p>
          <ul>
            <li>Playlists</li>
            <li>Themes</li>
            <li>Policy</li>
          </ul>
          <div class="d-grid gap-2">
            <a href="/planner/music/playlists?id=<?php echo $event->id; ?>" class="btn btn-success">manage music</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php } ?>

<?php } ?>

<?php } else { ?>
  <div class="content-border__container content-section-link">
    <p class="lead">You have no events created - submit an enquiry on our <a href="/contact">contact page</a></p>
  </div>
<?php } ?>

<?php if (!isset($_SESSION['fb_access_token']) && $user->isCustomer()) { ?>
  <a href="/account/delete">Delete your account</a>
<?php } ?>
