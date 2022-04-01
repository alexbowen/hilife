<?php
session_start();

include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/lib/notify.php');
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
$auth = new \Delight\Auth\Auth($database->connection, null);

try {
  $auth->admin()->deleteUserByEmail($_POST['email']);
  Notify::add('message', 'Account deleted for ' . $_POST['email']);

  header('Location: /');
}
catch (\Delight\Auth\InvalidEmailException $e) {
  Notify::add('error', "Account could not be deleted for " . $_POST['email'] . "\r\nPlease contact us");
}
?>
