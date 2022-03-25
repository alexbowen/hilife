<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/utils.php');
include $_SERVER['DOCUMENT_ROOT'].'/lib/models/event.php';

class EventFactory
{
    public static function create($where = array(), $expanded = false)
    {
      global $database;

      $sql = "SELECT events.*, events_admin.*, events_music.*, users.email AS dj_email_address, EXTRACT(MINUTE FROM start_time) AS startMinute, EXTRACT(HOUR FROM start_time) AS startHour, EXTRACT(MINUTE FROM finish_time) AS finishMinute, EXTRACT(HOUR FROM finish_time) AS finishHour, EXTRACT(MINUTE FROM setup_time) AS setupMinute, EXTRACT(HOUR FROM setup_time) AS setupHour, EXTRACT(DAY FROM date) AS day, EXTRACT(MONTH FROM date) AS month, EXTRACT(YEAR FROM date) AS year FROM events INNER JOIN events_admin ON events_admin.event_id = events.id LEFT JOIN users ON events_admin.dj_user_id = users.id LEFT JOIN events_music ON events.id = events_music.event_id";
      $sql .= ' WHERE ';

      foreach ($where as $key => $value) {
        $sql .= $key . "=\"" . $value . "\" AND ";
      }

      $sql = rtrim($sql, " AND ");

      $query = $database->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

      $query->execute($where);

      return $query->fetchObject("Event", array($expanded));
    }
}
?>
