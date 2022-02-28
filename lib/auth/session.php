<?php
session_start();

class User {

  public function isAdmin() {
    return $this->signedIn() && $_SESSION['auth_roles'] === 9;
  }

  public function isCustomer() {
    return $this->signedIn() && $_SESSION['auth_roles'] === 0;
  }

  public function isInternal() {
    return $this->signedIn() && $_SESSION['auth_roles'] > 0;
  }

  public function signedIn() {
    return $_SESSION['auth_email'];
  }
}

$user = new User();

if(!$user->signedIn() && $_GET['auth'] == 'user') {
  header('Location: /');
}

if(!$user->isInternal() && $_GET['auth'] == 'user' && isset($_GET['eid'])) {
  header('Location: /');
}

if(!$user->isAdmin() && $_GET['auth'] == 'admin') {
  header('Location: /');
}

?>