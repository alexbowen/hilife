<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
  
// init configuration
$clientID = constant('GOOGLE_ID');
$clientSecret = constant('GOOGLE_SECRET');
$redirectUri = constant('BASE_URL') . '/google/callback';
   
// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);

if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);
   
  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;

  $_SESSION['auth_username'] = $google_account_info->name;
  $_SESSION['auth_email'] = $google_account_info->email;
  $_SESSION['auth_provider'] = "google";

  header('Location: /');
}
