<?php
include $_SERVER['DOCUMENT_ROOT'].'/lib/event.php';

if (isset($_POST['search-term'])) {
  $query = "SELECT id, date FROM events WHERE email = \"" . $_POST['search-term'] . "\"";
  $result = $database->query($query);
}

$adminPage = "search";
?>

<section class="content-section">
  <?php include ($_SERVER['DOCUMENT_ROOT'].'/pages/admin/navigation.php'); ?>

  <div class="content-tabs__container admin">
    <div class="filter-panel">
      <form name="events-sort" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
        <div class="row mb-1 mb-md-3">
          <div class="col-md-6">
            <input type="text" name="search-term" class="form-control" placeholder="enter email address"<?php if(isset($_POST['search-term'])) { ?> value="<?php echo $_POST['search-term']; ?>"<?php } ?> />
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-primary btn-sm">search events</button>
          </div>
        </div>
      </form>
    </div>

    <?php if(isset($result) && $result->rowCount() > 0) { ?>  
    <?php foreach ($result as $key => $eventp) { ?>
    <?php
      $event = EventFactory::create(array(
        'events.id' => $eventp['id']
      ), true);
    ?>
    <?php $date = new DateTime($eventp['date']); ?>
    <div class="card mt-4">
      <div class="card-header">
        <div class="row">
          <dl class="col-6 col-md-3 mb-0">
            <dt class="mb-0"><?php echo $date->format('D M jS Y'); ?></dt>
          </dl>
          <dl class="col-6 col-md-3 mb-0">
            <dt class="mb-0"><?php echo $event->primary_contact; ?></dt>
          </dl>

          <dl class="col-6 col-md-3 mb-0">
            <dt class="mb-0">          
              <?php echo $event->venue_name; ?>
            </dt>
          </dl>

          <dl class="col-6 col-md-2 mb-0">
            <dt class="mb-0">
            <?php echo $event->booking_type; ?> booking
            </dt>
          </dl>

          <div class="d-grid gap-2 d-md-flex col-md-1 my-2 my-md-0">
            <?php if ($event->status !== 'cancelled') { ?>  
            <button class="toggle-control btn btn-sm btn-outline-secondary flex-fill" data-content-id="toggle-content-<?php echo $key; ?>">view</button>
            <?php } ?>
          </div>
        </div>
      </div>

      <div class="card-body toggle-content toggle-content--hidden" id="toggle-content-<?php echo $key; ?>">
      <?php if ($event->inFuture()) { ?>
        <form name="event-update-<?php echo $key; ?>" action="/actions/event" method="post" class="admin-form needs-validation needs-validation-time" novalidate>
          <div class="container">
            <input type="hidden" name="id" value="<?php echo $event->id; ?>" />
            <input type="hidden" name="admin[booking_type]" value="<?php echo $event->booking_type; ?>" />
            <input type="hidden" name="admin[status]" value="<?php echo $event->status; ?>" />

            <?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/event/admin/form.php'); ?>
            <?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/event/form.php'); ?>

            <div class="row text-end">
              <div class="d-grid gap-2 d-md-block mt-2">
                <span class="float-start form-info">* required field</span>
                <button type="submit" name="action" value="update" class="btn btn-secondary btn-sm">update event</button>
              </div>
            </div>
          </div>
        </form>
      <?php } else { ?>
        <?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/event/admin/form.php'); ?>
        <?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/event/form.php'); ?>
      <?php } ?>
      </div>

      <div class="card-footer">
        <div class="row">
          <div class="col-12 col-md-3">
            <dl class="mb-0">
              <dt>Email</dt>
              <dd class="mb-0"><?php echo $event->email; ?></dd>
            </dl>
            <dl class="mb-0">
              <dt>Telephone</dt>
              <dd class="mb-0"><?php echo $event->client_telephone; ?></dd>
            </dl>
          </div>

          <div class="col-6 col-md-3">
            <dl class="mb-0">
              <dt>DJ</dt>
              <dd class="mb-0"><?php echo $utils->field($event->dj); ?></dd>
            </dl>
            <dl class="mb-0">
              <dt>Booking</dt>
              <?php if ($event->booking_type == 'package') { ?>
                <?php $key = array_search($event->package_client_id, array_column($package_clients, 'id')); ?>
                <dd class="mb-0"><a href="/admin/view/client?id=<?php echo $event->package_client_id; ?>"><?php echo $package_clients[$key]['venue_name']; ?></a></dd>
              <?php } else { ?>
                <dd class="mb-0"><?php echo $event->booking_type; ?></dd>
              <?php } ?>
            </dl>
          </div>

          <div class="col-6 col-md-3">
            <dl class="mb-0">
              <dt>Type</dt>
              <dd class="mb-0"><?php echo $utils->field($event->type); ?></dd>
            </dl>
            <dl class="mb-0">
              <dt>Status</dt>
              <dd class="mb-0"><?php echo $event->status; ?></dd>
            </dl>
          </div>

          <?php if ($event->status != 'cancelled') { ?>
          <div class="col-12 col-md-3 admin-actions mt-1">
            <form name="event-update" action="/actions/event" method="post" class="admin-form mb-0">
              <input type="hidden" name="id" value="<?php echo $event->id; ?>" />
              <input type="hidden" name="admin[contract_status]" value="<?php echo $event->contract_status; ?>" />
              <input type="hidden" name="admin[booking_type]" value="<?php echo $event->booking_type; ?>" />
              <input type="hidden" name="event[email]" value="<?php echo $event->email; ?>" />
              <input type="hidden" name="event[primary_contact]" value="<?php echo $event->primary_contact; ?>" />
              <div class="d-grid gap-2 d-md-flex my-2 my-md-0">
                <?php if ($event->status == 'pending' && $event->inFuture()) { ?>
                  <input type="hidden" name="admin[status]" value="confirmed" />
                  <button type="submit" name="action" value="update" class="btn btn-success btn-sm flex-fill">confirm</button>
                <?php } ?>

                <?php if ($event->status == 'enquiry' && $event->inFuture()) { ?>
                  <input type="hidden" name="admin[status]" value="pending" />
                  <button type="submit" name="action" value="update" class="btn btn-success btn-sm flex-fill">accept</button>
                <?php } ?>

                <a href="/planner/view/summary?id=<?php echo $event->id; ?>" class="btn btn-secondary btn-sm flex-fill">planner</a>
                <?php if ($event->inFuture()) { ?>
                <button type="submit" name="action" value="cancel" class="btn btn-danger btn-sm confirm-action flex-fill">cancel</button>
                <?php } ?>
              </div>
            </form>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>

    <?php } elseif (isset($_POST['search-term'])) { ?>
    <p class="lead mt-4">No events for this search</p>
  <?php } ?>
  </div>
</section>
