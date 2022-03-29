<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
include $_SERVER['DOCUMENT_ROOT'].'/lib/event.php';

if (isset($_GET['status'])) {
  $_SESSION['admin'] = $_GET['status'];
}

if (empty($_SESSION['admin'])) {
  $_SESSION['admin'] = 'enquiry';
}

$filter_parts = array();

array_push($filter_parts, "events.date >= CURDATE()");

if (!empty($_GET['booking_type'])) array_push($filter_parts, "events_admin.booking_type=\"" . $_GET['booking_type'] . "\"");
if (!empty($_GET['venue'])) array_push($filter_parts, "events.venue_name=\"" . $_GET['venue'] . "\"");
if (!empty($_GET['dj'])) array_push($filter_parts, "events_admin.dj=\"" . $_GET['dj'] . "\"");
if (!empty($_GET['sort'])) {
  switch ($_GET['sort']) {
    case "created":
      $sort = " ORDER BY events.created DESC";
      break;

    case "date":
      $sort = " ORDER BY CONVERT(DATE, date) ASC";
      break;

    case "details":
      $sort = " ORDER BY events.last_updated DESC";
      break;

    case "music":
      $sort = " ORDER BY events_planner.last_updated DESC";
      break;
  }
} else {
  $sort = " ORDER BY CONVERT(DATE, date) ASC";
}

$query = "SELECT count(events_admin.event_id) FROM events_admin INNER JOIN users ON users.email = \"" . $_SESSION['auth_email'] . "\" WHERE events_admin.status = \"enquiry\"";

if (isset($_COOKIE['hilife-admin-logout'])) {
  $query .= " AND UNIX_TIMESTAMP(events_admin.created) > " . $_COOKIE['hilife-admin-logout'];
}

$new_enquiry_count = $database->query($query)->fetchColumn();

$query = "SELECT count(*) FROM events INNER JOIN events_admin ON events_admin.event_id = events.id WHERE " . implode(" AND ", $filter_parts) . " AND events_admin.status = \"pending\"";
$pending_count = $database->query($query)->fetchColumn(); 

$query = "SELECT count(*) FROM events INNER JOIN events_admin ON events_admin.event_id = events.id WHERE " . implode(" AND ", $filter_parts) . " AND events_admin.status = \"confirmed\"";
$confirmed_count = $database->query($query)->fetchColumn();

if (!empty($_SESSION['admin'])) array_push($filter_parts, "events_admin.status=\"" . $_SESSION['admin'] . "\"");

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

$query = "SELECT id, date, events_planner.last_updated FROM events INNER JOIN events_admin ON events_admin.event_id = events.id LEFT JOIN events_planner ON events_planner.event_id = events.id" . $filters . $sort . " LIMIT {$pagination->offset}, {$pagination->limit}";
$result = $database->query($query);

$adminPage = "events";
?>

<section class="content-section">
  <?php include ($_SERVER['DOCUMENT_ROOT'].'/pages/admin/navigation.php'); ?>

  <div class="content-tabs__container admin">
    <div class="filter-panel">
      <form name="events-sort" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="get">
        <div class="row mb-1 mb-md-3">
          <div class="col-md-3 d-grid d-block mb-1 my-md-0">
            <button class="btn <?php if($_SESSION['admin'] == 'enquiry') { ?>btn-success<?php } else { ?>btn-outline-secondary<?php } ?> btn-sm" type="submit" name="status" value="enquiry">Enquiries<?php if ($new_enquiry_count > 0) { echo " (" . $new_enquiry_count . " new)"; } ?></button>
          </div>

          <div class="col-md-3 d-grid d-block mb-1 my-md-0">
            <button class="btn <?php if($_SESSION['admin'] == 'pending') { ?>btn-success<?php } else { ?>btn-outline-secondary<?php } ?> btn-sm" type="submit" name="status" value="pending">Pending events<?php if ($pending_count > 0) { echo " (" . $pending_count . ")"; } ?></button>
          </div>

          <div class="col-md-3 d-grid d-block mb-1 my-md-0">
            <button class="btn <?php if($_SESSION['admin'] == 'confirmed') { ?>btn-success<?php } else { ?>btn-outline-secondary<?php } ?> btn-sm" type="submit" name="status" value="confirmed">Confirmed events<?php if ($confirmed_count > 0) { echo " (" . $confirmed_count . ")"; } ?></button>
          </div>

          <div class="col-md-3 d-grid d-block mb-1 my-md-0">
            <button class="btn <?php if($_SESSION['admin'] == 'cancelled') { ?>btn-success<?php } else { ?>btn-outline-secondary<?php } ?> btn-sm" type="submit" name="status" value="cancelled">Cancelled events</button>
          </div>
        </div>

        <div class="row">
          <div class="col-md-3 my-0">
            <?php include ($_SERVER['DOCUMENT_ROOT'].'/pages/admin/events/sort.php'); ?>
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
            <dt class="mb-0"><?php echo $event->primary_contact; if (!empty($event->secondary_contact)) echo " / " . $event->secondary_contact; ?></dt>
          </dl>

          <dl class="col-6 col-md-3 mb-0">
            <dt class="mb-0">          
              <?php if ($event->booking_type == 'package') { ?>
                <?php $key = array_search($event->package_client_id, array_column($package_clients, 'id')); ?>
                <a href="/admin/view/client?id=<?php echo $event->package_client_id; ?>"><?php echo $package_clients[$key]['venue_name']; ?></a>
              <?php } else { ?>
                <?php echo $event->venue_name; ?>
              <?php } ?>
            </dt>
          </dl>

          <dl class="col-6 col-md-2 mb-0">
            <dt class="mb-0">
            <?php echo $event->booking_type; ?> booking
            </dt>
          </dl>
        </div>
      </div>

      <div class="card-body">
        <div class="row">
          <div class="col-12 col-md-3">
            <dl class="mb-0">
              <dd class="mb-0"><?php echo $event->email; ?></dd>
            </dl>
          </div>

          <div class="col-6 col-md-3">
            <dl class="mb-0">
              <dd class="mb-0"><?php echo $event->client_telephone; ?></dd>
            </dl>
          </div>

          <div class="col-6 col-md-3">
            <dl class="mb-0">
              <dt>DJ</dt>
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

      <?php if ($event->booking_type == 'direct' && $event->contract_status !== 'received') { ?>
      <div class="card-footer">
        <span class="text-danger">** No contract received for this event **</span>
      </div>
      <?php } ?>
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
