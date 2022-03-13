<?php
include $_SERVER['DOCUMENT_ROOT'].'/lib/models/event.php';

$query = "SELECT * FROM package_clients";
$clients = $database->query($query);

if (isset($_POST['action']) && $_POST['action'] == 'select') {
  $query = "SELECT id AS package_client_id, venue_name, venue_address FROM package_clients WHERE id=\"" . $_POST['client'] . "\"";
  $selected_client = $database->query($query)->fetch();
  $event = new Event();
  $event->package_client_id = $selected_client['package_client_id'];
  $event->venue_name = $selected_client['venue_name'];
  $event->venue_address = $selected_client['venue_address'];
}
?>

<section class="content-section">
  <?php echo $utils->backlink("/admin/events", 'back to admin dashboard'); ?>
  <h1>Create package event</h1>
  <form action="/admin/create/package" method="post" class="admin-form" data-auto-submit="true">
    <input type="hidden" name="action" value="select" />
    <div class="row">
      <div class="col-12 col-md-6">
        <select name="client" id="event-location" class="form-select">
        <?php foreach ($clients as $key => $client) { ?>
          <option value="<?php echo $client['id']; ?>" <?php if (isset($_POST['client']) && $_POST['client'] == $client['id']) { ?>selected<?php } ?>><?php echo $client['venue_name']; ?></option>
        <?php } ?>
        </select>
      </div>
      <div class="col-12 col-md-3 mt-2 mt-md-0">
        <div class="d-grid gap-2 d-md-block">
          <button type="submit" name="action" value="select" class="btn btn-secondary btn-sm">select venue</button>
        </div>
      </div>
    </div>
  </form>
  
  <?php if (isset($selected_client)) { ?>
  <div class="content-border__container admin">
    <form action="/actions/event" method="post" class="needs-validation admin-form" novalidate>
      <input type="hidden" name="admin[booking_type]" value="package" />
      <input type="hidden" name="admin[status]" value="confirmed" />
      <input type="hidden" name="admin[package_client_id]" value="<?php echo $event->package_client_id; ?>" />
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/event/admin/form.php'; ?>
      <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/event/form.php'; ?>
      <div class="row text-end">
      <div class="d-grid gap-2 d-md-block mt-1">
        <a class="btn btn-danger btn-sm" href="/admin/create/package">cancel</a>
        <button type="submit" name="action" value="create" class="btn btn-primary btn-sm">create new event</button>
      </div>
      </div>
    </form>
  </div>
  <?php } ?>
</section>
