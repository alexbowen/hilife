<?php
$query="SELECT *, EXTRACT(DAY FROM date) AS day, EXTRACT(MONTH FROM date) AS month, EXTRACT(YEAR FROM date) AS year FROM events INNER JOIN events_admin ON events_admin.event_id = events.id WHERE dj=\"" . $_SESSION['auth_username'] . "\" AND events.date >= CURDATE() ORDER BY CONVERT(DATE, date) ASC";
$result = $database->query($query);
?>

<h1>Dj bookings</h1>

<section class="content-section admin">
<div class="content-border__container">
<?php if($result->rowCount() > 0) { ?>
  <?php foreach ($result as $key => $event) { ?>
    <div class="card">
      <div class="card-body p-2">
        <div class="row">
          <dl class="col-12 col-md-3 mb-0">
            <dt class="mb-0"><?php echo $utils->prettyDateFormat($event['date']); ?></dt>
          </dl>
          <dl class="col-12 col-md-3 mb-0">
            <dd>Contact:</dd>
            <dt class="mb-0"><?php echo $event['primary_contact']; ?></dt>
          </dl>

          <dl class="col-12 col-md-3 mb-0">
            <dd>Venue:</dd>
            <dt class="mb-0"><?php echo $event['venue_name']; ?></dt>
          </dl>
          <div class="col-12 col-md-3 mb-0">
            <a href="/planner/view/summary?id=<?php echo $event['id']; ?>" class="btn btn-primary btn-sm">view music planner</a>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
<?php } else { ?>
  <div class="content-border__container content-section-link">
    <p class="lead">There are currently no events you are booked for</p>
  </div>
<?php } ?>
</div>
</section>

