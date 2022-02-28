<?php
include($_SERVER['DOCUMENT_ROOT'] . '/lib/auth/session.php');
include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/lib/validations/event.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/lib/actions/email.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/lib/actions/notify.php');

$event_timings = array();

if (isset($_POST['dateInput'])) {
  $event_timings['date'] = $utils->normaliseDate($_POST['dateInput']);
}

if (isset($_POST['startTimeInput'])) {
  $start_parts = array_filter($_POST['startTimeInput'], function($v) {
    return strlen($v) > 0;
  }, ARRAY_FILTER_USE_BOTH);

  if (count($start_parts) > 0) {
    $event_timings['start_time'] = $utils->normaliseTime($start_parts);
  }
}

if (isset($_POST['finishTimeInput'])) {
  $finish_parts = array_filter($_POST['finishTimeInput'], function($v) {
    return strlen($v) > 0;
  }, ARRAY_FILTER_USE_BOTH);

  if (count($finish_parts) > 0) {
    $event_timings['finish_time'] = $utils->normaliseTime($finish_parts);
  }
}

if (isset($_POST['setupTimeInput'])) {
  $setup_parts = array_filter($_POST['setupTimeInput'], function($v) {
    return strlen($v) > 0;
  }, ARRAY_FILTER_USE_BOTH);

  if (count($setup_parts) > 0) {
    $event_timings['setup_time'] = $utils->normaliseTime($setup_parts);
  }
}

$query = "SELECT status FROM events_admin WHERE event_id=\"" . $_POST['event_id']  . "\"";
$event_orig_status = $database->query($query)->fetchColumn();

if ($_POST['action'] == 'create') {
  $invalid = eventInvalid(array('primary_contact' => $_POST['event']['primary_contact'], 'email' => $_POST['event']['email'], 'date' => $event_timings['date'], 'status' => $_POST['admin']['status']));
  if ($invalid) {
    array_push($_SESSION['notifications'], array(
      'type' => 'error',
      'message' => 'Event cannot be created - ' . $invalid
    ));

    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else {

    $database->beginTransaction();
    $query = $database->prepare("INSERT INTO events (type, email, location, venue_name, venue_address, client_address, client_telephone, primary_contact, secondary_contact, date, numbers, start_time, finish_time, setup_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $query->execute(array($_POST['event']["type"], $_POST['event']["email"], $_POST['event']["location"], $_POST['event']["venue_name"], $_POST['event']["venue_address"], $_POST['event']["client_address"], $_POST['event']["client_telephone"], $_POST['event']["primary_contact"], $_POST['event']["secondary_contact"], $event_timings['date'], $_POST['event']["numbers"], $event_timings['start_time'], $event_timings['finish_time'], $event_timings['setup_time']));
    $event_id = $database->lastInsertId();
    $database->commit();

    if (count($_POST['admin']) > 0) {

      $insertFields = '';
      $parameters = '';
    
      foreach ($_POST['admin'] as $key => $value) {
        $insertFields .= $key . ", ";
        $parameters .= ":" . $key . ", ";
      }
      
      $sql = "INSERT INTO events_admin (event_id, " . rtrim($insertFields, ", ") . ") VALUES (:event_id, " . rtrim($parameters, ", ") . ")";
      $query = $database->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $query->execute(array_merge(array(':event_id' => $event_id), $_POST['admin']));
    }

    $query = "SELECT * FROM events INNER JOIN events_admin ON events_admin.event_id = events.id WHERE id=\"" . $event_id  . "\"";
    $event_updated = $database->query($query)->fetch();

    $event_updated['date'] = $utils->prettyDateFormat($event_updated['date']);

    Email::send('admin', $event_updated);
    Email::send('customer', $event_updated);

    $notification_target = $user->isAdmin() ? 'admin' : 'customer';
    Notify::queue($notification_target, $event_updated);

    $redirect = $user->isAdmin() ? '/admin/events': '/';

    header('Location: ' . $redirect);
  }
}

if ($_POST['action'] == 'update') {

  $to_validate = array_filter(array(array('date' => $event_timings['date']), $_POST['event'], $_POST['admin']));

  $invalid = eventInvalid(array_merge(...$to_validate));
  if ($invalid) {
    array_push($_SESSION['notifications'], array(
      'type' => 'error',
      'message' => 'Event cannot be updated - ' . $invalid
    ));

    header('Location: ' . $_SERVER['HTTP_REFERER']);
  } else {

    if (isset($_POST['event']) && count($_POST['event']) > 0) {

      $updateFields = '';
    
      foreach ($_POST['event'] as $key => $value) {
        $updateFields .= $key . "=:" . $key . ", ";
      }

      foreach ($event_timings as $key => $value) {
        $updateFields .= $key . "=:" . $key . ", ";
      }
      
      $sql = "UPDATE events SET " . rtrim($updateFields, ", ") . " WHERE id = :event_id";
      $query = $database->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $query->execute(array_merge(array(':event_id' => $_POST['event_id']), $_POST['event'], $event_timings));
    }

    if (isset($_POST['admin']) && count($_POST['admin']) > 0) {

      $updateFields = '';
    
      foreach ($_POST['admin'] as $key => $value) {
        $updateFields .= $key . "=:" . $key . ", ";
      }

      $sql = "UPDATE events_admin SET " . rtrim($updateFields, ", ") . " WHERE event_id = :event_id";
      $query = $database->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $query->execute(array_merge(array(':event_id' => $_POST['event_id']), $_POST['admin']));
    }

    $query = "SELECT * FROM events INNER JOIN events_admin ON events_admin.event_id = events.id WHERE events.id=\"" . $_POST['event_id']  . "\"";
    $event_updated = $database->query($query)->fetch();

    if ($event_updated["status"] != $event_orig_status) {

      $event_updated['date'] = $utils->prettyDateFormat($event_updated['date']);

      Email::send('admin', $event_updated);
      Email::send('customer', $event_updated);

      $notification_target = $user->isAdmin() ? 'admin' : 'customer';
      Notify::queue($notification_target, $event_updated);
      
    } else {
      array_push($_SESSION['notifications'], array(
        'type' => 'message',
        'message' => 'Event updated'
      ));
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
  }
}

if ($_POST['action'] == 'cancel') {
  $query = "UPDATE events_admin SET status='cancelled' WHERE event_id=\"" . $_POST['event_id'] . "\"";
  $database->query($query);

  $query = "SELECT * FROM events INNER JOIN events_admin ON events_admin.event_id = events.id WHERE events.id=\"" . $_POST['event_id']  . "\"";
  $event_updated = $database->query($query)->fetch();

  $event_updated['date'] = $utils->prettyDateFormat($event_updated['date']);

  Email::send('admin', $event_updated);
  Email::send('customer', $event_updated);

  $notification_target = $user->isAdmin() ? 'admin' : 'customer';
  Notify::queue($notification_target, $event_updated);

  header('Location: /admin/events');
}
?>