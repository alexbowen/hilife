<?php
class User {
  public function isAdmin() {
    return $this->signedIn() && $this->authRoles() === 9;
  }

  public function isCustomer() {
    return $this->signedIn() && $this->authRoles() === 0;
  }

  public function isInternal() {
    return $this->signedIn() && $this->authRoles() > 0;
  }

  public function signedIn() {
    return isset($_SESSION['auth_email']);
  }

  private function authRoles() {
    return isset($_SESSION['auth_roles']) ? $_SESSION['auth_roles'] : null;
  }
}

$user = new User();

function requestedAuth() {
  return isset($_GET['auth']) ? $_GET['auth'] : null;
}

if(!$user->signedIn() && requestedAuth() == 'user') {
  header('Location: /account/sign-in');
}

if(!$user->isInternal() && requestedAuth() == 'user' && isset($_GET['eid'])) {
  header('Location: /');
}

if(!$user->isAdmin() && requestedAuth() == 'admin') {
  header('Location: /account/sign-in');
}
?>
