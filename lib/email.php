<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/mailer.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/config/event.php');

class Email {
  public static function send($target, $event) {

    global $event_config, $utils;

    $config = $event_config[$target][$event->status];

    $email_body = "";

    foreach ($config['email']['body']['default'] as $line) {
      $email_body .= $utils->templateString($line, $event) . "\r\n\n";
    }

    if (isset($config['email']['body'][$event->booking_type])) {
    foreach ($config['email']['body'][$event->booking_type] as $line) {
      $email_body .= $utils->templateString($line, $event) . "\r\n\n";
    }
  }

    $email_body .= constant("ADMIN_NAME") . "\n";
    $email_body .= constant("ADMIN_COMPANY") . "\n";
    $email_body .= constant("ADMIN_ADDRESS") . "\n";
    $email_body .= constant("ADMIN_EMAIL") . "\n\n";
    $email_body .= constant("ADMIN_TELEPHONE");

    switch ($target) {
      case "admin":
        $email_address = constant("ADMIN_EMAIL");
        break;
      case "dj":      
        $email_address = $event->dj['dj_email_address'];
        break;
      case "customer":
        $email_address = $event->email;
    }

    Mailer::send(
      $email_address,
      $utils->templateString($config['email']['title'], $event),
      $email_body
    );
  }
}
?>