<?php
session_start();

include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/lib/notify.php');
include ($_SERVER['DOCUMENT_ROOT'].'/lib/mailer.php');

if ($_POST['action'] == 'register') {
  require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
  $auth = new \Delight\Auth\Auth($database->connection, null);
  try {
    $userId = $auth->register($_POST['email'], $_POST['password'], null, function ($selector, $token) {

      $url = constant('BASE_URL') . '/auth/verify?selector=' . urlencode($selector) . '&token=' . urlencode($token);

      Mailer::send(
        $_POST["email"],
        'Hi-Life Entertainment registration confirm email',
        "Click this link to activate your account\n\n" . $url
      );

      Notify::add('message', 'Check your email to verify your account');
  
      header('Location: /');
    });
  }
  catch (\Delight\Auth\InvalidEmailException $e) {
      die('Invalid email address');
  }
  catch (\Delight\Auth\InvalidPasswordException $e) {
      die('Invalid password');
  }
  catch (\Delight\Auth\UserAlreadyExistsException $e) {
      Notify::add('error', 'User already exists');

      header('Location: /register');
  }
  catch (\Delight\Auth\TooManyRequestsException $e) {
      die('Too many requests');
  }
}

?>