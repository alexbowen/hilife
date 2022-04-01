<?php
session_start();

include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/lib/notify.php');

require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
$auth = new \Delight\Auth\Auth($database->connection, null);

try {
  $auth->confirmEmail($_GET['selector'], $_GET['token']);
  Notify::add('message', 'Your account has been verified');

  header('Location: /account/sign-in');
}
catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
  Notify::add('error', 'Invalid token');

  header('Location: /');
}
catch (\Delight\Auth\TokenExpiredException $e) {
  Notify::add('error', 'Token expired');

  header('Location: /');
}
catch (\Delight\Auth\UserAlreadyExistsException $e) {
  Notify::add('error', 'Email address already exists');

  header('Location: /');
}
catch (\Delight\Auth\TooManyRequestsException $e) {
  die('Too many requests');
}

?>