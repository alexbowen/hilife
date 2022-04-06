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

function navigationAuthenticated() {
  if (isset($_SESSION['auth_provider']) && $_SESSION['auth_provider'] != 'default') {
    return "<span class=\"text-capitalize\">Hello " . $_SESSION['auth_username'] . "<i class=\"fa-brands fa-" . $_SESSION['auth_provider'] . " " . $_SESSION['auth_provider'] . "-btn authentication-logo\"></i>";
  } if (isset($_SESSION['auth_email'])) {
    return "<span>Logged in " . $_SESSION['auth_email'] . "</span>";
  }
}

function requestedAuth() {
  return isset($_GET['auth']) ? $_GET['auth'] : null;
}

if(!$user->signedIn() && requestedAuth() == 'user') {
  header('Location: /account/sign-in?redirect=' . $_SERVER['REQUEST_URI']);
}

if(!$user->isInternal() && requestedAuth() == 'user' && isset($_GET['eid'])) {
  header('Location: /');
}

if(!$user->isAdmin() && requestedAuth() == 'admin') {
  header('Location: /account/sign-in?redirect=' . $_SERVER['REQUEST_URI']);
}
?>
