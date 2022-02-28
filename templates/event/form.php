<?php include ($_SERVER['DOCUMENT_ROOT'].'/config/event.php'); ?>

<div class="row mb-1">
  <div class="col-md-6">
    <div class="row">
      <label for="event-primary-contact" class="col-form-label col-md-3">Primary contact<sup>*</sup></label>
      <div class="col-md-9">
        <input type="text" name="event[primary_contact]" id="event-primary-contact" value="<?php echo $event->primary_contact; ?>" class="form-control form-control-sm" aria-label="primary contact" required/>
        <div class="invalid-feedback">
          This field is required
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <label for="event-secondary-contact" class="col-form-label col-md-3">2nd contact</label>
      <div class="col-md-9">
        <input type="text" name="event[secondary_contact]" id="event-secondary-contact" value="<?php echo $event->secondary_contact; ?>" class="form-control form-control-sm" aria-label="secondary contact" />
      </div>
    </div>
  </div>
</div>

<div class="row mb-1">
  <div class="col-md-6">
    <div class="row">
      <label for="event-client-address" class="col-form-label col-md-3">Contact address</label>
      <div class="col-md-9">
        <input type="text" name="event[client_address]" id="event-client-address" value="<?php echo $event->client_address; ?>" class="form-control form-control-sm" aria-label="client address" />
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <label for="event-telephone" class="col-form-label col-md-3">Telephone</label>
      <div class="col-md-9">
        <input type="tel" id="event-telephone" pattern="(\+)?([ 0-9]){10,16}" name="event[client_telephone]" value="<?php echo $event->client_telephone; ?>" class="form-control form-control-sm" aria-label="client telephone" />
        <div class="invalid-feedback">
        Invalid phone number
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row mb-1">
  <div class="col-md-6">
    <div class="row">
      <label for="event-venue-name" class="col-form-label col-md-3">Venue name</label>
      <div class="col-md-9">
        <input type="text" name="event[venue_name]" id="event-venue-name" value="<?php echo $event->venue_name; ?>" class="form-control form-control-sm" aria-label="venue address" <?php if ($user->isCustomer() && $event->booking_type === 'package') { ?> disabled<?php } ?> />
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <label for="event-venue-address" class="col-form-label col-md-3">Venue address</label>
      <div class="col-md-9">
        <input type="text" name="event[venue_address]" id="event-venue-address" value="<?php echo $event->venue_address; ?>" class="form-control form-control-sm" aria-label="venue address"<?php if ($user->isCustomer() && $event->booking_type === 'package') { ?> disabled<?php } ?> />
      </div>
    </div>
  </div>
</div>

<div class="row mb-1">
  <div class="col-md-6">
    <div class="row">
      <label for="event-location" class="col-form-label col-md-3">Type</label>
      <div class="col-md-9">
        <select name="event[type]" class="form-select form-select-sm col-sm-8">
          <option value="">Select type</option>
          <?php foreach ($event_config['types'] as $key => $type) { ?>
            <option value="<?php echo $type; ?>" <?php if ($event->type == $type) { ?>selected<?php } ?>><?php echo ucfirst($type); ?></option>
          <?php } ?>
          <option value="other">Other</option>
        </select>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <label for="event-start" class="col-form-label col-md-3">Guests</label>
      <div class="col-md-9">
        <select name="event[numbers]" id="event-numbers" class="form-select form-select-sm">
          <option value="" <?php if(empty($event->numbers)) { ?>selected<?php } ?>>unknown</option>
          <option value="Less than 50" <?php if ($event->numbers == 'Less than 50') { ?>selected<?php } ?>>Less than 50</option>
          <option value="50 to 100" <?php if ($event->numbers == '50 to 100') { ?>selected<?php } ?>>50 to 100</option>
          <option value="100 to 150" <?php if ($event->numbers == '100 to 150') { ?>selected<?php } ?>>100 to 150</option>
          <option value="150 to 200" <?php if ($event->numbers == '150 to 200') { ?>selected<?php } ?>>150 to 200</option>
          <option value="200 to 300" <?php if ($event->numbers == '200 to 300') { ?>selected<?php } ?>>200 to 300</option>
          <option value="300 to 400" <?php if ($event->numbers == '300 to 400') { ?>selected<?php } ?>>300 to 400</option>
          <option value="400 plus" <?php if ($event->numbers == '400 plus') { ?>selected<?php } ?>>400 plus</option>
        </select>
      </div>
    </div>
  </div>
</div>

<div class="row mb-1">
  <div class="col-md-6">
    <div class="row">
      <label for="event-date" class="col-form-label col-md-3">Date<sup>*</sup></label>
      <div class="col-md-9">
      <?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/form/date.php'); ?>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <label for="event-setup" class="col-form-label col-md-3">Setup time</label>
      <div class="col-md-9">
        <?php
          $eventTime = array(
            "key" => "setup",
            "order" => 0,
            "hour" => $event->setupHour,
            "minutes" => $event->setupMinute
          );

          include ($_SERVER['DOCUMENT_ROOT'].'/templates/form/time.php');
        ?>
      </div>
    </div>
  </div>
</div>

<div class="row mb-1">
  <div class="col-md-6">
    <div class="row">
      <label for="event-start" class="col-form-label col-md-3">Start time</label>
      <div class="col-md-9">
        <?php
          $eventTime = array(
            "key" => "start",
            "order" => 1,
            "hour" => $event->startHour,
            "minutes" => $event->startMinute
          );

          include ($_SERVER['DOCUMENT_ROOT'].'/templates/form/time.php');
        ?>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="row">
      <label for="event-finish" class="col-form-label col-md-3">Finish time</label>
      <div class="col-md-9">
        <?php
          $eventTime = array(
            "key" => "finish",
            "order" => 2,
            "hour" => $event->finishHour,
            "minutes" => $event->finishMinute
          );

          include ($_SERVER['DOCUMENT_ROOT'].'/templates/form/time.php');
        ?>
      </div>
    </div>
  </div>
</div>

<div class="row mb-1">
  <div class="col">
    <div class="input-group">
      <span class="input-group-text">Notes</span>
      <textarea name="admin[notes]" class="form-control"><?php echo $event->notes; ?></textarea>
    </div>
  </div>
</div>
