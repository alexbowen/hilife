<?php
session_start();

include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
$auth = new \Delight\Auth\Auth($database, null);

try {
  $auth->confirmEmail($_GET['selector'], $_GET['token']);

  array_push($_SESSION['notifications'], array(
    'type' => 'message',
    'message' => 'Your account has been verified'
  ));
  header('Location: /account/sign-in');
}
catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
  array_push($_SESSION['notifications'], array(
    'type' => 'error',
    'message' => 'Invalid token'
  ));
  header('Location: /');
}
catch (\Delight\Auth\TokenExpiredException $e) {
  array_push($_SESSION['notifications'], array(
    'type' => 'error',
    'message' => 'Token expired'
  ));
  header('Location: /');
}
catch (\Delight\Auth\UserAlreadyExistsException $e) {
  array_push($_SESSION['notifications'], array(
    'type' => 'error',
    'message' => 'Email address already exists'
  ));
  header('Location: /');
}
catch (\Delight\Auth\TooManyRequestsException $e) {
  die('Too many requests');
}

?>