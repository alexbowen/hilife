<?php include ($_SERVER['DOCUMENT_ROOT'].'/config/event.php'); ?>

<section class="introduction content-section content-center">
  <h1>Contact Us</h1>
  <p class="lead">For all booking enquiries, general enquiries and accounts</p>
</section>

<section class="content-section">
  <div class="row">
    <div class="col-sm">
      <div class="card card-full-width clearfix profile-photo">
      <img src="/assets/images/dj/Mark_Hepworth.png" alt="for all booking enquiries contact CEO Mark Hepworth" class="rounded float-end ms-3" />
        <p>You can submit an enquiry using the form below or:</p>
        <ul>
          <li>speak to Mark on <a href="tel:07828688144" class="contact">07828 688144</a></li>
          <li>send email to <a href="mailto:mark@thehi-life.co.uk" class="contact">mark@thehi-life.co.uk</a></li>
        </ul>
        <p>In emails and messages please give as much information as you have regarding:</p>
        <ol>
          <li>Date and times</li>
          <li>Venue or approximate location</li>
          <li>Type of event and any theme or preferred styles of music</li>
        </ol>
        <p>I'm often DJing at weekends and evenings so often better to email me to arrange a chat, letting me know when you are free to talk.</p>
      </div>
    </div>
  </div>
</section>

<section class="content-section">
  <h2>Booking enquiry form</h2>
  <div class="card card-full-width">
    <form name="enquiry-form" action="/actions/event" method="post" class="needs-validation needs-validation-time" novalidate>
      <div class="form-floating mb-3">
        <input type="text" name="event[primary_contact]" id="enquiry-contact" class="form-control form-control-sm" placeholder="your name" required />
        <label for="enquiry-contact">Contact name</label>
        <div class="invalid-feedback">
          This field is required
        </div>
      </div>

      <div class="form-floating mb-3">
        <input type="email" id="enquiry-email" name="event[email]" class="form-control form-control-sm" placeholder="name@example.com" required />
        <label for="enquiry-email">Email address</label>  
        <div class="invalid-feedback">
          Invalid email address
        </div>
      </div>

      <h5>Event Details</h5>

      <div class="row">
        <label for="enquiry-date" class="col-form-label col-md-4">Date</label>
        <div class="col-md-8 mb-3">
        <?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/form/date.php'); ?>
        </div>
      </div>

      <div class="row">
        <label for="enquiry-telephone" class="col-form-label col-md-4">Telephone number <span class="form-optional">(optional)</span></label>
        <div class="col-md-8 mb-3">
          <input type="tel" id="enquiry-telephone" name="event[client_telephone]" class="form-control" pattern="(\+)?([ 0-9]){10,16}" />
          <div class="invalid-feedback">
            Invalid phone number
          </div>
        </div>
      </div>

      <div class="row">
        <label for="enquiry-location" class="col-form-label col-md-4">Type <span class="form-optional">(optional)</span></label>
        <div class="col-md-8">
          <div class="input-group mb-3">
            <select name="event[type]" id="enquiry-location" class="form-select form-select-sm col-sm-8">
            <option value="">Select type</option>
            <?php foreach ($event_config['types'] as $key => $type) { ?>
              <option value="<?php echo $type; ?>"><?php echo ucfirst($type); ?></option>
            <?php } ?>
            <option value="other">Other</option>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <label for="event-venue-name" class="col-form-label col-md-4">Venue name <span class="form-optional">(optional)</span></label>
        <div class="col-md-8 mb-3">
          <input type="text" name="event[venue_name]" id="event-venue-name" class="form-control" aria-label="venue name" />
        </div>
      </div>

      <div class="row">
        <label for="event-venue-address" class="col-form-label col-md-4">Venue address <span class="form-optional">(optional)</span></label>
        <div class="col-md-8 mb-3">
          <input type="text" name="event[venue_address]" id="event-venue-address" class="form-control" aria-label="venue address" />
        </div>
      </div>

      <div class="row">
        <label for="enquiry-date" class="col-form-label col-md-4">Start time <span class="form-optional">(optional)</span></label>
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
        <label for="enquiry-date" class="col-form-label col-md-4">Finish time <span class="form-optional">(optional)</span></label>
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
        <label for="enquiry-notes" class="col-form-label col-md-4">Additional information <span class="form-optional">(optional)</span></label>
        <div class="col-md-8 mb-3">
          <textarea name="admin[notes]" class="form-control" id="enquiry-notes"></textarea>
        </div>
      </div>

      <div class="row text-end">
        <div class="d-grid gap-2 d-md-block">
          <button type="submit" name="action" value="create" class="btn btn-success btn-sm">Submit Enquiry</button>
        </div>
      </div>
      <input type="hidden" name="admin[booking_type]" value="direct" />
      <input type="hidden" name="admin[status]" value="enquiry" />
    </form>
  </div>
</section>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/list/regions.php'); ?>
