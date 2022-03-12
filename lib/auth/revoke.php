<?php
include($_SERVER['DOCUMENT_ROOT'] . '/lib/auth/session.php');
include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/lib/notify.php');

require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
$auth = new \Delight\Auth\Auth($database, null);

try {
  if ($user->isAdmin()) {
    setcookie("hilife-admin-logout", time(), time()+2630000, "/", "thehi-life.co.uk");
  }
  $auth->logOut();
  Notify::add('message', 'You have been signed out');
}
catch (\Delight\Auth\NotLoggedInException $e) {
  header('Location: /');
}

session_start();
session_unset();
session_destroy();

header('Location: /');
?>
