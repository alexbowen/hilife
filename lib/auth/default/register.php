<?php
// session_start();

include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

include ($_SERVER['DOCUMENT_ROOT'].'/lib/mailer.php');

if ($_POST['action'] == 'register') {
  require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
  $auth = new \Delight\Auth\Auth($database, null);
  try {
    $userId = $auth->register($_POST['email'], $_POST['password'], $_POST['username'], function ($selector, $token) {

      $url = constant('BASE_URL') . '/auth/verify?selector=' . urlencode($selector) . '&token=' . urlencode($token);

      Mailer::send(
        $_POST["email"],
        'Hi-life Entertainment registration confirm email',
        "Click this link to activate your account\n\n" . $url
      );

      array_push($_SESSION['notifications'], array(
        'type' => 'message',
        'message' => 'Check your email to verify your account'
      ));
  
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
      array_push($_SESSION['notifications'], array(
        'type' => 'error',
        'message' => 'User already exists'
      ));
      header('Location: /register');
  }
  catch (\Delight\Auth\TooManyRequestsException $e) {
      die('Too many requests');
  }
}

?>