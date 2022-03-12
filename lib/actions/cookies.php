<?php
if ($_POST['cookies'] == 'accept') {
  setcookie("cookie-consent", 'accepted', time() + 2630000, "/", $_SERVER['HTTP_HOST']);
}

if ($_POST['cookies'] == 'decline') {
  setcookie("cookie-consent", 'declined', time() + 2630000, "/", $_SERVER['HTTP_HOST']);
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
