<?php
include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

class Utils {
  public function field($value) {
    return !empty($value) ? $value : '<span class="field-empty">not specified</span>';
  }

  public function backlink($path, $text) {
    return '<div class="back-link"><a href="' . $path . '">' . $text . '</a></div>';
  }

  public function normaliseDate($parts) {
    return implode('-', array($parts['year'], $parts['month'], $parts['day']));
  }

  public function normaliseTime($parts) {
    return implode(':', array($parts['hours'], $parts['minutes'], "00"));
  }

  public function prettyDateFormat($date) {
    $dateObj = new DateTime($date);
    return $dateObj->format('D jS M Y');
  }

  public function prettyTimeFormat($time) {

    if (empty($time)) {
      return false;
    }
    
    $parts = explode(':', $time);
    return date('g.ia', mktime($parts[0], $parts[1], 0, 0, 0, 0));
  }

  public function templateString(&$template, $values) {
    foreach ($values as $key => $value) {
      $template = str_replace('%' . $key . '%', $value, $template);
    }

    return $template;
  }

  public function setPlannerUpdated($event_id, $user_role) {
    global $database;

    $sql = "INSERT INTO events_planner (event_id, user_role, last_updated)
    VALUES (:event_id, :user_role, :last_updated)
    ON DUPLICATE KEY UPDATE event_id=VALUES(event_id), user_role=VALUES(user_role), last_updated=VALUES(last_updated)";
  
    $query = $database->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $query->execute(array(':event_id' => $event_id, ':user_role' => $user_role, ":last_updated" => date("Y-m-d H:i:s")));
  }
}

$utils = new Utils();

?>