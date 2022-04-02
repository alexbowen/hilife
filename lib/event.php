<?php
include $_SERVER['DOCUMENT_ROOT'].'/lib/models/event.php';

class EventFactory
{
    public static function create($where = array(), $expanded = false)
    {
      global $database;

      $sql = "SELECT *, EXTRACT(MINUTE FROM start_time) AS startMinute, EXTRACT(HOUR FROM start_time) AS startHour, ";
      $sql .= "EXTRACT(MINUTE FROM finish_time) AS finishMinute, EXTRACT(HOUR FROM finish_time) AS finishHour, ";
      $sql .= "EXTRACT(MINUTE FROM setup_time) AS setupMinute, EXTRACT(HOUR FROM setup_time) AS setupHour, ";
      $sql .= "EXTRACT(DAY FROM date) AS day, EXTRACT(MONTH FROM date) AS month, EXTRACT(YEAR FROM date) AS year FROM events ";
      $sql .= "INNER JOIN events_admin ON events_admin.event_id = events.id ";
      $sql .= "LEFT JOIN events_music ON events.id = events_music.event_id";
      $sql .= ' WHERE ';

      foreach ($where as $key => $value) {
        $sql .= $key . "=\"" . $value . "\" AND ";
      }

      $sql = rtrim($sql, " AND ");

      $query = $database->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

      $database->execute($query, $where);

      return $query->fetchObject("Event", array($expanded));
    }
}
?>
