<?php
session_start();

include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
  constant('SPOTIFY_ID'),
  constant('SPOTIFY_SECRET'),
  constant('BASE_URL') . '/spotify/callback'
);

$state = $_GET['state'];

if ($state !== $_SESSION['spotify_state']) {
    // The state returned isn't the same as the one we've stored, we shouldn't continue
    die('State mismatch');
}

// Request a access token using the code from Spotify
$session->requestAccessToken($_GET['code']);

$accessToken = $session->getAccessToken();
$refreshToken = $session->getRefreshToken();

$_SESSION['accessToken'] = $accessToken;
$_SESSION['refreshToken'] = $refreshToken;

header('Location: ' . constant('BASE_URL') . $_SESSION['spotify_redirect']);
die();