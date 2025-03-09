<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
include $_SERVER['DOCUMENT_ROOT'].'/lib/event.php';

$event = EventFactory::create(array(
  'events.id' => $_GET['id']
), true);

$query = "SELECT * FROM package_clients";
$package_clients = $database->query($query)->fetchAll();
?>

<section class="content-section">
  <?php echo $utils->backlink("/admin/events", 'back to admin page'); ?>
  <h2>Convert event to package</h2>
  <div class="admin">

        <form name="event-update" action="/actions/event" method="post" class="admin-form needs-validation" novalidate>
          <input type="hidden" name="id" value="<?php echo $event->id; ?>" />
          <input type="hidden" name="referrer" value="/admin/edit?id=<?php echo $event->id; ?>" />

          <div class="row text-end">
            <div class="d-grid gap-2 d-md-block mt-2">
              <input type="hidden" name="admin[booking_type]" value="package" />
              <select name="admin[package_client_id]" id="event-package-client-<?php echo $event->id; ?>" class="form-select form-select-sm" required>
              <option value="" selected>Select venue</option>
              <?php foreach ($package_clients as $client) { ?>
                <option value="<?php echo $client['id']; ?>" <?php if ($event->package_client_id == $client['id']) { ?>selected<?php } ?>><?php echo $client['venue_name']; ?></option>
              <?php } ?>
              </select>
              <input type="submit" name="action" value="update" class="btn btn-primary btn-sm mt-2" />
            </div>
          </div>
        </form>

    </div>
  </div>
</section>
