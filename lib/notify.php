<?php
class Notify {
  public static function add($type, $message) {
    if (!isset($_SESSION['notifications'])) {
      $_SESSION['notifications'] = array();
    }

    array_push($_SESSION['notifications'], array(
      'type' => $type,
      'message' => $message
    ));
  }

  public static function queue() {
    return isset($_SESSION['notifications']) ? $_SESSION['notifications'] : array();
  }

  public static function flush() {
    $_SESSION['notifications'] = array();
  }
}
?>
