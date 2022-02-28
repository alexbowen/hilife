<?php
session_start();

include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
$auth = new \Delight\Auth\Auth($database, null);

try {
  $auth->admin()->deleteUserByEmail($_POST['email']);

  array_push($_SESSION['notifications'], array(
    'type' => 'message',
    'message' => 'Account deleted for ' . $_POST['email']
  ));
  header('Location: /');
}
catch (\Delight\Auth\InvalidEmailException $e) {
  array_push($_SESSION['notifications'], array(
    'type' => 'error',
    'message' => "Account could not be deleted for " . $_POST['email'] . "\r\nPlease contact Mark"
  ));
}
?>