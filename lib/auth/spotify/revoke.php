<?php
session_start();

$_SESSION['accessToken'] = null;
$_SESSION['refreshToken'] = null;

header('Location: ' . $_SERVER['HTTP_REFERER']);
?>