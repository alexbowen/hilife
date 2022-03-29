<?php
include ($_SERVER['DOCUMENT_ROOT'].'/lib/event.php');

$query = "SELECT * FROM events INNER JOIN events_admin ON events_admin.event_id = events.id WHERE dj_user_id=\"" . $_SESSION['auth_user_id'] . "\" AND events.date >= CURDATE() ORDER BY CONVERT(DATE, date) ASC";
$result = $database->query($query);
?>

<h1>DJ bookings</h1>

<section class="content-section admin">
  <div class="content-border__container">
  <?php if($result->rowCount() > 0) { ?>
    <?php foreach ($result as $key => $event) { ?>
      <?php
      $event = EventFactory::create(array(
        'events.id' => $event['id']
      ), true);
      ?>
      <div class="card">
        <div class="card-body p-2">
          <div class="row">
            <dl class="col-12 col-md-3 mb-0">
              <dt class="mb-0"><?php echo $event->prettyDate(); ?></dt>
            </dl>
            <dl class="col-12 col-md-3 mb-0">
              <dd>Contact:</dd>
              <dt class="mb-0"><?php echo $event->primary_contact; ?></dt>
            </dl>

            <dl class="col-12 col-md-3 mb-0">
              <dd>Venue:</dd>
              <dt class="mb-0"><?php echo $event->venue_name; ?></dt>
            </dl>
            <div class="col-12 col-md-3 mb-0">
              <a href="/planner/view/summary?id=<?php echo $event->id; ?>" class="btn btn-primary btn-sm">view music planner</a>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  <?php } else { ?>
    <p class="lead mb-0">Currently no upcoming events</p>
  <?php } ?>
  </div>
</section>
