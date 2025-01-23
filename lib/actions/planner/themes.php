<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

if (isset($_POST['action']) && $_POST['action'] == 'update') {
  $database->connection->beginTransaction();
  $query = $database->prepare("INSERT INTO events_music (event_id, additional, first_dance, last_dance) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE additional=VALUES(additional), first_dance=VALUES(first_dance), last_dance=VALUES(last_dance)");
  $query->execute(array($_GET['id'], $_POST['additional'], $_POST['first_dance'], $_POST['last_dance']));
  $database->connection->commit();

  $utils->setPlannerUpdated($_POST['id'], $_SESSION['auth_roles']);
}

if (isset($_POST['action']) && $_POST['action'] == 'update-auto') {
  $query = "DELETE FROM event_music_categories WHERE event_id = \"" . $_GET['id'] . "\"";
  $database->query($query);

  if (isset($_POST['categories'])) {
    $query = "INSERT INTO event_music_categories (event_id, category_id, favourite) VALUES ";

    foreach($_POST['categories'] as $category_id) {
      $query .= "(\"" . $_GET['id'] . "\", \"" . $category_id . "\"";
      if (isset($_POST['category-favourites']) && in_array($category_id, $_POST['category-favourites'])) {
        $query .= ", \"1\" ";
      } else {
        $query .= ", \"0\" ";
      }
      $query .= "), ";
    }

    $query = substr($query, 0, -2);
    $database->query($query);
  }

  $query = "DELETE FROM event_music_decades WHERE event_id = \"" . $_GET['id'] . "\"";
  $database->query($query);

  if (isset($_POST['decades'])) {
    $query = "INSERT INTO event_music_decades (event_id, decade_id, favourite) VALUES ";

    foreach($_POST['decades'] as $decade_id) {
      $query .= "(\"" . $_GET['id'] . "\", \"" . $decade_id . "\"";
      if (isset($_POST['decade-favourites']) && in_array($decade_id, $_POST['decade-favourites'])) {
        $query .= ", \"1\" ";
      } else {
        $query .= ", \"0\" ";
      }
      $query .= "), ";
    }

    $query = substr($query, 0, -2);
    $database->query($query);
  }

  $utils->setPlannerUpdated($_GET['id'], $_SESSION['auth_roles']);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
