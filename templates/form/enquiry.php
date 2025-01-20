<form name="enquiry-form" action="/actions/event" method="post" class="needs-validation needs-validation-time" novalidate>
  <div class="form-floating mb-3">
    <input type="text" name="event[primary_contact]" id="enquiry-contact" class="form-control form-control-sm" placeholder="your name" required maxlength="60" pattern="[a-zA-Z\-]+" />
    <label for="enquiry-contact">Name <span class="form-optional">(required)</span></label>
  </div>

  <div class="form-floating mb-3">
    <input type="email" id="enquiry-email" name="event[email]" class="form-control form-control-sm" placeholder="name@example.com" required <?php if (isset($_SESSION['auth_email'])) { ?>value="<?php echo $_SESSION['auth_email']; ?>"<?php } ?> />
    <label for="enquiry-email">Email address <span class="form-optional">(required)</span></label>  
    <div class="invalid-feedback">
      Invalid email address
    </div>
  </div>

  <div class="row">
    <label for="enquiry-telephone" class="col-form-label col-form-label-sm col-md-4">Telephone number</label>
    <div class="col-md-8 mb-3">
      <input type="tel" id="enquiry-telephone" name="event[client_telephone]" class="form-control form-control-sm" pattern="(\+)?([0-9]){10,16}" />
      <div class="invalid-feedback">
        Invalid phone number
      </div>
    </div>
  </div>

  <div class="row">
    <label for="enquiry-date" class="col-form-label col-form-label-sm col-md-4">Event date <span class="form-optional">(required)</span></label>
    <div class="col-md-8 mb-3">
    <?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/form/date.php'); ?>
    </div>
  </div>

  <div class="row">
    <label for="enquiry-location" class="col-form-label col-form-label-sm col-md-4">Event type</label>
    <div class="col-md-8">
      <div class="input-group mb-3">
        <select name="event[type]" id="enquiry-location" class="form-select form-select-sm col-sm-8">
        <option value=""></option>
        <?php foreach ($event_config['types'] as $key => $type) { ?>
          <option value="<?php echo $type; ?>"><?php echo ucfirst($type); ?></option>
        <?php } ?>
        <option value="other">Other</option>
        </select>
      </div>
    </div>
  </div>

  <div class="row">
    <label for="event-venue-name" class="col-form-label col-form-label-sm col-md-4">Venue name</label>
    <div class="col-md-8 mb-3">
      <input type="text" name="event[venue_name]" id="event-venue-name" class="form-control" aria-label="venue name" maxlength="60" pattern="[a-zA-Z0-9\-]+" />
    </div>
  </div>

  <div class="row">
    <label for="event-venue-address" class="col-form-label col-form-label-sm col-md-4">Venue address</label>
    <div class="col-md-8 mb-3">
      <input type="text" name="event[venue_address]" id="event-venue-address" class="form-control" aria-label="venue address" maxlength="100" pattern="[a-zA-Z0-9,.\-]+" />
    </div>
  </div>

  <div class="row">
    <label for="enquiry-date" class="col-form-label col-form-label-sm col-md-4">Start time</label>
    <div class="col-md-8 mb-3">
      <?php
        $eventTime = array(
          "key" => "start",
          "order" => 0,
          "hour" => "",
          "minutes" => ""
        );
        include ($_SERVER['DOCUMENT_ROOT'].'/templates/form/time.php');
        ?>
    </div>
  </div>

  <div class="row">
    <label for="enquiry-date" class="col-form-label col-form-label-sm col-md-4">Finish time</label>
    <div class="col-md-8 mb-3">
      <?php
        $eventTime = array(
          "key" => "finish",
          "order" => 1,
          "hour" => "",
          "minutes" => ""
        );
        include ($_SERVER['DOCUMENT_ROOT'].'/templates/form/time.php');
        ?>
    </div>
  </div>

  <div class="row">
    <label for="enquiry-notes" class="col-form-label col-form-label-sm col-md-4">Additional information</label>
    <div class="col-md-8 mb-3">
      <textarea name="admin[notes]" class="form-control" id="enquiry-notes" maxlength="300"></textarea>
    </div>
  </div>

  <div class="g-recaptcha" data-sitekey="6LcV-kolAAAAAFJHHRYPvwEEZ2nSpNKdDW2pW8JW"></div>

  <div class="row text-end">
    <div class="d-grid gap-2 d-md-block">
      <button type="submit" name="action" value="create" class="btn btn-success btn-sm">Click to submit enquiry</button>
    </div>
  </div>
  <input type="hidden" name="admin[booking_type]" value="direct" />
  <input type="hidden" name="admin[status]" value="enquiry" />
</form>
