<?php
include $_SERVER['DOCUMENT_ROOT'].'/lib/event.php';

$event = EventFactory::create(array(
  'events.id' => $_GET['id'],
  'email' => $_SESSION['auth_email']
), true);

$section = 'policy';
?>

<section class="content-section">
  
  <?php include ('navigation.php'); ?>

  <form name="eventmusic" action="/actions/planner/policy?id=<?php echo $event->id; ?>" method="post">
    <div class="content-tabs__container admin">
      <h5>Music Policy</h5>
      <div class="row mb-3">
        <div class="col">
          <fieldset>Is there any music that you don't want playing at your event?</fieldset>
          <label for="event-first-dance" class="col-form-label">Give some examples of the music you don't want playing</label>
          <textarea name="noplay" class="form-control"><?php echo $event->noplay; ?></textarea>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col">
          <fieldset>What is your attitude to cheese / guilty pleasures / ironic songs?</fieldset>
          <label for="" class="col-form-label">If you feel some concessions need to be made in this area, give some examples of what you consider acceptable</label>
          <textarea name="cheese" class="form-control"><?php echo $event->cheese; ?></textarea>
        </div>
      </div>
    </div>

    <div class="content-border__container admin">
      <h5>DJ interaction</h5>
      <div class="row mb-3">
        <div class="col">
          <fieldset>How would you like the DJ to deal with requests on the night?</fieldset>
          <label for="" class="col-form-label">Choose an option</label>
          <div class="form-radio">
            <input type="radio" id="requests-1" name="requests" class="form-check-input" value="strict" <?php if ($event->requests == 'strict') { ?>checked<?php } ?>>
            <label class="form-check-label" for="requests-1">Only play requests that fit our music selection</label>
          </div>

          <div class="form-radio">
            <input type="radio" id="requests-2" name="requests" class="form-check-input" value="discretion" <?php if ($event->requests == 'discretion') { ?>checked<?php } ?>>
            <label class="form-check-label" for="requests-2">Leave it to the discretion of the DJ</label>
          </div>

          <div class="form-radio">
            <input type="radio" id="requests-3" name="requests" class="form-check-input" value="play" <?php if ($event->requests == 'play') { ?>checked<?php } ?>>
            <label class="form-check-label" for="requests-3">Play it, irrespective of our music selection</label>
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col">
          <fieldset>Normally our DJs do not speak on the microphone between songs other than to make announcements.</fieldset>
          <label for="" class="col-form-label">e.g at times like first dance, last orders or when food is ready</label>
          <div class="form-radio">
            <input type="radio" id="mic-1" name="mic" class="form-check-input" value="yes" <?php if ($event->mic == 'yes') { ?>checked<?php } ?> />
            <label class="form-check-label" for="mic-1">Yes, this is what we want</label>
          </div>

          <div class="form-radio">
            <input type="radio" id="mic-2" name="mic" class="form-check-input" value="no" <?php if ($event->mic == 'no') { ?>checked<?php } ?>/>
            <label class="form-check-label" for="mic-2">No, introduce some songs during the night</label>
          </div>
        </div>
      </div>
    </div>

    <div class="row text-end mb-2">
      <div class="d-grid gap-2 d-md-block">
        <input type="hidden" name="id" value="<?php echo $event->id; ?>" />
        <button type="submit" name="action" value="update" class="btn btn-sm btn-secondary">update music policy</button>
      </div>
    </div>
  </form>
</section>
