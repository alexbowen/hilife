<?php
include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
include_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/notify.php');

if ($_POST['action'] == 'sign-in') {

  if ($_POST['remember'] == 'on') {
    $rememberDuration = (int) (60 * 60 * 24 * 7);
  } else {
    $rememberDuration = null;
  }

  require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
  $auth = new \Delight\Auth\Auth($database, null);
  include ($_SERVER['DOCUMENT_ROOT'].'/lib/auth/session.php');

  try {
    $auth->login($_POST['email'], $_POST['password'], $rememberDuration);

    $_SESSION['auth_provider'] = "default";

    Notify::add('message', 'You are now signed in');

    if ($_POST['remember'] == 'on') {
      setcookie("hilife-remember-user", '1', time() + 2630000, "/", "thehi-life.co.uk");
    } else {
      unset($_COOKIE['hilife-remember-user']); 
      setcookie('hilife-remember-user', null, time() - 3600, '/', "thehi-life.co.uk"); 
    }

    if ($user->isCustomer()) {
      header('Location: /planner');
    } elseif ($user->isAdmin()) {
      header('Location: /admin/events');
    } else {
      header('Location: /');
    }
  }
  catch (\Delight\Auth\InvalidEmailException $e) {
    Notify::add('error', 'No email address registered for ' . $_POST['email']);

    header('Location: /account/sign-in');
  }
  catch (\Delight\Auth\InvalidPasswordException $e) {
    Notify::add('error', 'Incorrect password');

    header('Location: /account/sign-in');
  }
  catch (\Delight\Auth\EmailNotVerifiedException $e) {
    Notify::add('error', 'Account not verified - please check your email inbox');

    header('Location: /account/sign-in');
  }
  catch (\Delight\Auth\TooManyRequestsException $e) {
    die('Too many requests');
  }
}
?>
