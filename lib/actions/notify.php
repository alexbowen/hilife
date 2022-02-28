<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/utils.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/config/event.php');

class Notify {
  public static function queue($target, $event) {

    global $event_config, $utils;
    
    $config = $event_config[$target][$event['status']];

    array_push($_SESSION['notifications'], array(
      'type' => $config['notification']['type'],
      'message' => $utils->templateString($config['notification']['text'], $event)
    ));
  }
}
?>