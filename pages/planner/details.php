<?php
include $_SERVER['DOCUMENT_ROOT'].'/lib/event.php';

$event = EventFactory::create(array(
  'events.id' => $_GET['id'],
  'email' => $_SESSION['auth_email']
), true);
?>

<section class="content-section">
  <?php echo $utils->backlink('/planner', 'back to main page'); ?>
  <h1>Event details</h1>
  <div class="admin">

  <?php if ($event->status === 'confirmed') { ?>
    <?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/event/show.php'); ?>
  <?php } else { ?>
    <div class="content-border__container">
      <form name="eventactions" action="/actions/event" method="post" class="admin-form needs-validation needs-validation-time" novalidate>
        <input type="hidden" name="id" value="<?php echo $event->id; ?>" />
        <input type="hidden" name="email" value="<?php echo $event->email; ?>" />
        <input type="hidden" name="booking_type" value="<?php echo $event->booking_type; ?>" />
        <?php include ($_SERVER['DOCUMENT_ROOT'] . '/templates/event/form.php'); ?>
        <div class="row text-end mt-2">
          <div class="d-grid gap-2 d-md-block">
            <span class="float-start form-info">* required field</span>
            <button type="submit" name="action" value="update" class="btn btn-sm btn-outline-secondary">Update event</button>
          </div>
        </div>
      </form>
    </div>
  <?php } ?>

  </div>
</section>
