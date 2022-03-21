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
          <div class="col-6">
            <input type="text" name="search-term" class="form-control" placeholder="enter email address"<?php if(isset($_POST['search-term'])) { ?> value="<?php echo $_POST['search-term']; ?>"<?php } ?> />
          </div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-sm">Search events</button>
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
            <dt class="mb-0"><?php echo $event->primary_contact; if (!empty($event->secondary_contact)) echo " / " . $event->secondary_contact; ?></dt>
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
        </div>
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
            <div class="d-grid gap-2 d-md-flex my-2 my-md-0">
            <?php if ($event->status !== 'cancelled') { ?>  
            <a href="/admin/edit?id=<?php echo $event->id; ?>" class="btn btn-sm btn-primary flex-fill">Edit event</a>
            <?php } ?>
              <a href="/planner/view/summary?id=<?php echo $event->id; ?>" class="btn btn-secondary btn-sm flex-fill">Event planner</a>
            </div>
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
