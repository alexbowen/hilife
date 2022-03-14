<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
include $_SERVER['DOCUMENT_ROOT'].'/lib/event.php';

$filter_parts = array();

array_push($filter_parts, "events.date < CURDATE()");

if (!empty($_GET['booking_type'])) array_push($filter_parts, "events_admin.booking_type=\"" . $_GET['booking_type'] . "\"");
if (!empty($_GET['venue'])) array_push($filter_parts, "events.venue_name=\"" . $_GET['venue'] . "\"");
if (!empty($_GET['dj'])) array_push($filter_parts, "events_admin.dj=\"" . $_GET['dj'] . "\"");
if (!empty($_GET['sort'])) {
  switch ($_GET['sort']) {
    case "asc":
      $sort = " ORDER BY CONVERT(DATE, date) DESC";
      break;

    case "desc":
      $sort = " ORDER BY CONVERT(DATE, date) ASC";
      break;
  }
} else {
  $sort = " ORDER BY CONVERT(DATE, date) DESC";
}

if (count($filter_parts) > 0) {
  $filters = " WHERE " . implode(" AND ", $filter_parts);
}

$query = "SELECT count(*) FROM events INNER JOIN events_admin ON events_admin.event_id = events.id" . $filters;
$count = $database->query($query)->fetchColumn();

$query = "SELECT * FROM package_clients";
$package_clients = $database->query($query)->fetchAll(PDO::FETCH_ASSOC);

$pagination = new \yidas\data\Pagination([
    'totalCount' => $count,
    'perPage' => 5
]);

$query = "SELECT id, date FROM events INNER JOIN events_admin ON events_admin.event_id = events.id LEFT JOIN events_planner ON events_planner.event_id = events.id " . $filters . $sort . " LIMIT {$pagination->offset}, {$pagination->limit}";
$result = $database->query($query);

$adminPage = "archive";
?>

<section class="content-section">
  <?php include ($_SERVER['DOCUMENT_ROOT'].'/pages/admin/navigation.php'); ?>

  <div class="content-tabs__container admin">
    <div class="filter-panel">
      <form name="events-sort" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="get">
        <div class="row">
          <div class="col-md-3 my-0">
            <label for="admin-sort" class="col-form-label">Sort by</label>
            <div class="col">
              <div class="input-group mb-1">
                <select name="sort" id="admin-sort" class="form-select form-select-sm col-sm-8" data-auto-submit="true">
                  <option value="desc" <?php if((isset($_GET['sort']) && $_GET['sort'] == 'desc')) { ?>selected<?php } ?>>event date - oldest first</option>
                  <option value="asc" <?php if(isset($_GET['sort']) && $_GET['sort'] == 'asc' || !isset($_GET['sort'])) { ?>selected<?php } ?>>event created - newest first</option>
                </select>
              </div>
              <noscript>
                <div class="col">
                  <button type="submit" class="btn btn-secondary btn-sm">sort</button>
                </div>
              </noscript>
            </div>
          </div>

          <div class="col-md-3 my-0">
            <?php include ($_SERVER['DOCUMENT_ROOT'].'/pages/admin/events/filter/booking-type.php'); ?>
          </div>

          <div class="col-md-3 my-0">
          <?php include ($_SERVER['DOCUMENT_ROOT'].'/pages/admin/events/filter/venue-name.php'); ?>
          </div>

          <div class="col-md-3 my-0">
          <?php include ($_SERVER['DOCUMENT_ROOT'].'/pages/admin/events/filter/dj.php'); ?>
          </div>
        </div>
      </form>
    </div>

    <?php if($result->rowCount() > 0) { ?>  
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
        <form name="" action="" method="post" class="admin-form needs-validation needs-validation-time" novalidate>
          <div class="container">
            <?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/event/admin/form.php'); ?>
            <?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/event/form.php'); ?>
          </div>
        </form>
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
              <dt>Guests</dt>
              <dd class="mb-0"><?php echo $utils->field($event->numbers); ?></dd>
            </dl>
          </div>

          <?php if ($event->status != 'cancelled') { ?>
          <div class="col-12 col-md-3 admin-actions mt-1">
            <div class="d-grid gap-2 d-md-flex my-2 my-md-0">
              <a href="/planner/view/summary?id=<?php echo $event->id; ?>" class="btn btn-secondary btn-sm flex-fill">planner</a>
            </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php } ?>

    <?php if ($pagination->limit < $count) { ?>
    <div>
    <?=\yidas\widgets\Pagination::widget(['pagination' => $pagination])?>
    </div>
    <?php } ?>

    <?php } else { ?>
    <p class="lead mt-4">No events</p>
  <?php } ?>
  </div>
</section>
