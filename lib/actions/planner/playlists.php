<?php
include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
  
if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $insertFields = '';
    $parameters = '';
    $updateValues = '';
  
    for ($x = 1; $x <= 25; $x++) {
      $insertFields .= "t" . $x . ", ";
      $parameters .= ":t" . $x . ", ";
      $updateValues .= "t" . $x . "=VALUES(t" . $x . "), ";
    }
    
    $sql = "INSERT INTO events_music_top_25 (event_id, " . rtrim($insertFields, ", ") . ")
    VALUES (:event_id, " . rtrim($parameters, ", ") . ")
    ON DUPLICATE KEY UPDATE " . rtrim($updateValues, ", ");
  
    $query = $database->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
  
    $trackArray = array();
  
    foreach ($_POST['tracks'] as $key => $track) {
      $trackNumber = $key + 1;
      $trackArray[':t' . $trackNumber] = $track;
    }
  
    $query->execute(array_merge(array(':event_id' => $_POST['id']), $trackArray));
  
    $utils->setPlannerUpdated($_POST['id'], $_SESSION['auth_roles']);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
