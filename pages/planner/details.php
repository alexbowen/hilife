<?php
if (isset($_POST['action']) && $_POST['action'] == 'update') {
  $query = "UPDATE events SET ";
  $query .= "location = \"" . $_POST['location'] . "\", ";
  $query .= "venue_name = \"" . $_POST['venue_name'] . "\", ";
  $query .= "venue_address = \"" . $_POST['venue_address'] . "\", ";
  $query .= "client_address = \"" . $_POST['client_address'] . "\", ";
  $query .= "client_telephone = \"" . $_POST['client_telephone'] . "\", ";
  $query .= "primary_contact = \"" . $_POST['primary_contact'] . "\", ";
  $query .= "secondary_contact = \"" . $_POST['secondary_contact'] . "\", ";
  $query .= "start_time = \"" . $_POST['start_time'] . "\", ";
  $query .= "finish_time = \"" . $_POST['finish_time'] . "\", ";
  $query .= "setup_time = \"" . $_POST['setup_time'] . "\" ";
  $query .= "WHERE id = \"" . $_POST['event_id'] . "\"";

  $database->query($query);
}

include $_SERVER['DOCUMENT_ROOT'].'/lib/event.php';

$event = EventFactory::create(array(
  'events.id' => $_GET['id'],
  'email' => $_SESSION['auth_email']
), true);
?>

<section class="content-section">
  <?php echo $utils->backlink('/planner', 'back to main page'); ?>
  <h1>Event details</h1>
  <?php if ($event->status === 'confirmed') { ?>
    <?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/event/show.php'); ?>
  <?php } else { ?>
    <div class="content-border__container admin">
      <form name="eventactions" action="/actions/event" method="post" class="admin-form needs-validation needs-validation-time" novalidate>
        <input type="hidden" name="event_id" value="<?php echo $event->id; ?>" />
        <input type="hidden" name="email" value="<?php echo $event->email; ?>" />
        <input type="hidden" name="booking_type" value="<?php echo $event->booking_type; ?>" />
        <?php include ($_SERVER['DOCUMENT_ROOT'] . '/templates/event/form.php'); ?>
        <div class="row text-end mt-2">
          <div class="d-grid gap-2 d-md-block">
            <span class="float-start form-info">* required field</span>
            <button type="submit" name="action" value="update" class="btn btn-sm btn-secondary">update</button>
          </div>
        </div>
      </form>
    </div>
  <?php } ?>
</section>