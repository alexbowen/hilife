<?php
// include ($_SERVER['DOCUMENT_ROOT'] . '/config/settings.php');

class Mailer {
  public static function send($to, $subject, $message) {

    if ($to === constant("ADMIN_EMAIL") && constant("ADMIN_MAILER") === 0) {
      return false;
    }

    if ($to !== constant("ADMIN_EMAIL") && constant("CUSTOMER_MAILER") === 0) {
      return false;
    }

    $to      = $to;
    $subject = $subject;
    $message = $message;
    $headers = 'From: ' . constant("ADMIN_EMAIL") . "\r\n" .
        'Reply-To: ' . constant("ADMIN_EMAIL") . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    return mail($to, $subject, $message, $headers);
  }
}
?>