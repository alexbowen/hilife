<?php
$query = "SELECT * FROM users WHERE roles_mask >= 2";
$djs = $database->query($query)->fetchAll();

$query = "SELECT * FROM package_clients";
$package_clients = $database->query($query)->fetchAll();
?>

<div class="row mb-1">
  <div class="col-md-6">
    <div class="row">
      <label for="event-email" class="col-form-label col-md-3">Contact email<sup>*</sup></label>
      <div class="col-md-9">
        <input type="email" name="event[email]" id="event-email" value="<?php echo $event->email; ?>" class="form-control form-control-sm col-sm-8" required />
        <div class="invalid-feedback">
          This field is required
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <label for="event-dj" class="col-form-label col-md-3">Event DJ</label>
      <div class="col-md-9">
      <select name="admin[dj_user_id]" id="event-dj" class="form-select form-select-sm">
        <option value="" <?php if (empty($event->dj_user_id)) { ?>selected<?php } ?>>none</option>
        <?php foreach ($djs as $dj) { ?>
          <option value="<?php echo $dj['id']; ?>" <?php if ($event->dj_user_id == $dj['id']) { ?>selected<?php } ?>><?php echo $dj['username']; ?></option>
        <?php } ?>
        </select>
      </div>
    </div>
  </div>
</div>

<div class="row mb-1">
  <div class="col-md-6">
    <div class="row">
      <label for="event-location" class="col-form-label col-md-3">Location</label>
      <div class="col-md-9">
        <select name="event[location]" id="event-location" class="form-select form-select-sm">
        <option value="">Select area</option>
        <?php foreach ($regions as $key => $detail) { ?>
          <option value="<?php echo $key; ?>" <?php if ($event->location == $key) { ?>selected<?php } ?>><?php echo ucfirst($key); ?></option>
        <?php } ?>
        <option value="other">Other area</option>
        </select>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
    <?php if ($event->booking_type == 'direct' || (isset($_GET['booking_type']) && $_GET['booking_type'] == 'direct')) { ?>
      <label for="event-contract-status" class="col-form-label col-md-3">Status</label>
      <div class="col-md-9">
        <select name="admin[status]" id="event-status" class="form-select form-select-sm">
          <option value="enquiry" <?php if ($event->status == 'enquiry') { ?>selected<?php } ?>>enquiry</option>
          <option value="confirmed" <?php if ($event->status == 'confirmed') { ?>selected<?php } ?>>confirmed</option>
        </select>
      </div>
      <?php } else { ?>
      <label for="event-package-client" class="col-form-label col-md-3">Package client</label>
      <div class="col-md-9">
        <select name="admin[package_client_id]" id="event-package-client" class="form-select form-select-sm">
        <?php foreach ($package_clients as $client) { ?>
          <option value="<?php echo $client['id']; ?>" <?php if ($event->package_client_id == $client['id']) { ?>selected<?php } ?>><?php echo $client['venue_name']; ?></option>
          <?php } ?>
        </select>
      </div>
        <?php } ?>
    </div>
  </div>
</div>
