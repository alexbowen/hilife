<?php
include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

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

    array_push($_SESSION['notifications'], array(
      'type' => 'message',
      'message' => 'You are now signed in'
    ));

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
    array_push($_SESSION['notifications'], array(
      'type' => 'error',
      'message' => 'No email address registered for ' . $_POST['email']
    ));
    header('Location: /sign-in');
  }
  catch (\Delight\Auth\InvalidPasswordException $e) {
    array_push($_SESSION['notifications'], array(
      'type' => 'error',
      'message' => 'Incorrect password'
    ));
    header('Location: /sign-in');
  }
  catch (\Delight\Auth\EmailNotVerifiedException $e) {
    array_push($_SESSION['notifications'], array(
      'type' => 'error',
      'message' => 'Email not verified'
    ));
    header('Location: /sign-in');
  }
  catch (\Delight\Auth\TooManyRequestsException $e) {
    die('Too many requests');
  }
}

?>