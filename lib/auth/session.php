<?php
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
    return isset($_SESSION['auth_email']);
  }
}

$user = new User();

function requestedAuth() {
  return isset($_GET['auth']) ? $_GET['auth'] : null;
}

if(!$user->signedIn() && requestedAuth() == 'user') {
  header('Location: /');
}

if(!$user->isInternal() && requestedAuth() == 'user' && isset($_GET['eid'])) {
  header('Location: /');
}

if(!$user->isAdmin() && requestedAuth() == 'admin') {
  header('Location: /');
}

?>