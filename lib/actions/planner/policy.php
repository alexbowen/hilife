<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

if (isset($_POST['action']) && $_POST['action'] == 'update') {
  $sql = "INSERT INTO events_music (event_id, noplay, requests, cheese, mic)
  VALUES (:event_id, :noplay, :requests, :cheese, :mic)
  ON DUPLICATE KEY UPDATE noplay=VALUES(noplay), requests=VALUES(requests), cheese=VALUES(cheese), mic=VALUES(mic)";

  $query = $database->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

  $query->execute(array(
    ':event_id' => $_POST['id'],
    ':noplay' => $_POST['noplay'],
    ':requests' => $_POST['requests'],
    ':cheese' => $_POST['cheese'],
    ':mic' => $_POST['mic']
  ));

  $utils->setPlannerUpdated($_POST['id'], $_SESSION['auth_roles']);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
