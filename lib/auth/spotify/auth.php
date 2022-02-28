<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
    '6d92d325771e403da886e73f609a9846',
    'b1d42b4a222e4e34a63ce7c70b12f43e',
    constant('BASE_URL') . '/spotify/callback'
);

$state = $session->generateState();

$_SESSION['spotify_state'] = $state;
$_SESSION['spotify_redirect'] = $_GET['redirect'];

$options = [
    'scope' => [
        'playlist-read-private',
        'user-read-private',
    ],
    'state' => $state,
];

header('Location: ' . $session->getAuthorizeUrl($options));
die();
?>