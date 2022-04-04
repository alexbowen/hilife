<?php
include $_SERVER['DOCUMENT_ROOT'].'/lib/event.php';

if (isset($_POST['search']) && count($_POST['search']) > 0) {
  $query = "SELECT id, date FROM events WHERE email LIKE \"%" . $_POST['search']['email'] . "%\" AND (primary_contact LIKE \"%" . $_POST['search']['contact'] . "%\" OR secondary_contact LIKE \"%" . $_POST['search']['contact'] . "%\")";
  $result = $database->query($query);
}

$adminPage = "search";
?>

<section class="content-section">
  <?php include ($_SERVER['DOCUMENT_ROOT'].'/pages/admin/navigation.php'); ?>

  <div class="content-tabs__container admin">
    <div class="filter-panel">
      <form name="events-sort" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
        <div class="d-grid gap-2 d-md-flex d-block mt-2">
          <input type="text" name="search[email]" class="form-control" placeholder="email address"<?php if(isset($_POST['search']['email'])) { ?> value="<?php echo $_POST['search']['email']; ?>"<?php } ?> />
          <input type="text" name="search[contact]" class="form-control" placeholder="contact name"<?php if(isset($_POST['search']['contact'])) { ?> value="<?php echo $_POST['search']['contact']; ?>"<?php } ?> />
          <button type="submit" class="btn btn-primary btn-sm flex-fill">Search</button>
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
            <dt class="mb-0<?php if (!$event->inFuture()) { ?> event-passed<?php } ?>"><?php echo $date->format('D M jS Y'); ?></dt>
          </dl>
          <dl class="col-6 col-md-3 mb-0">
            <dt class="mb-0"><?php echo $event->primary_contact; if ($event->secondary_contact != " ") echo " / " . $event->secondary_contact; ?></dt>
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
            <dl class="mb-0 initialism">
              <dt>Email: </dt>
              <dd class="mb-0"><?php echo $event->email; ?></dd>
            </dl>
          </div>

          <div class="col-6 col-md-3">
            <dl class="mb-0 initialism">
              <dt>Tel: </dt>
              <dd class="mb-0"><?php echo $event->client_telephone; ?></dd>
            </dl>
          </div>

          <div class="col-6 col-md-3">
            <dl class="mb-0 initialism">
              <dt>DJ: </dt>
              <dd class="mb-0"><?php echo $utils->field($event->dj['dj_name']); ?></dd>
            </dl>
          </div>

          <?php if ($event->status != 'cancelled') { ?>
          <div class="col-12 col-md-3 admin-actions mt-1">
            <form name="event-update" action="/actions/event" method="post" class="admin-form mb-0">
              <input type="hidden" name="id" value="<?php echo $event->id; ?>" />

              <div class="d-grid gap-2 d-md-flex my-2 my-md-0">
              <?php if ($event->status !== 'cancelled') { ?>
                <a href="/admin/edit?id=<?php echo $event->id; ?>" class="btn btn-sm btn-primary flex-fill">Edit</a>
              <?php } ?>
                <a href="/planner/view/summary?id=<?php echo $event->id; ?>" class="btn btn-secondary btn-sm flex-fill">Planner</a>
              </div>
            </form>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>

    <?php } elseif (isset($_POST['search'])) { ?>
    <p class="lead mt-4">No events for this search</p>
  <?php } ?>
  </div>
</section>
