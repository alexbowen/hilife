<?php
session_start();

include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/lib/notify.php');
include ($_SERVER['DOCUMENT_ROOT'].'/lib/mailer.php');

require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
$auth = new \Delight\Auth\Auth($database, null);

if ($_POST['action'] == 'forgot') {
  try {
    $auth->forgotPassword($_POST['email'], function ($selector, $token) {

      $url = constant('BASE_URL') . '/auth/reset?action=reset&selector=' . \urlencode($selector) . '&token=' . \urlencode($token);

      Mailer::send(
        $_POST["email"],
        'Hi-life Entertainment password reset',
        "Click this link to reset your password\n\n" . $url
      );

      Notify::add('message', 'Check your email for reset password link');

      header('Location: /');
    });
  }
  catch (\Delight\Auth\InvalidEmailException $e) {
    Notify::add('error', 'No email address registered for ' . $_POST['email']);

    header('Location: /');
  }
  catch (\Delight\Auth\EmailNotVerifiedException $e) {
    Notify::add('error', 'Email not verified ' . $_POST['email']);

    header('Location: /');
  }
  catch (\Delight\Auth\TooManyRequestsException $e) {
    die('Too many requests');
  }
}

if ($_GET['action'] == 'reset') {
  if ($auth->canResetPassword($_GET['selector'], $_GET['token'])) {
    header('Location: /account/password-reset?selector=' . $_GET['selector'] . '&token=' . $_GET['token']);
  }
}

if ($_POST['action'] == 'new') {
  try {
    $auth->resetPassword($_POST['selector'], $_POST['token'], $_POST['password']);

    Notify::add('message', 'Password successfully reset');

    header('Location: /');
  }
  catch (\Delight\Auth\InvalidSelectorTokenPairException $e) {
      Notify::add('error', 'Invalid reset link');

      header('Location: /');
  }
  catch (\Delight\Auth\TokenExpiredException $e) {
    header('Location: /');
  }
}
?>
