<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

$clientID = constant('GOOGLE_ID');
$clientSecret = constant('GOOGLE_SECRET');
$redirectUri = constant('BASE_URL') . '/google/callback';
   
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
  
$googleLoginUrl = $client->createAuthUrl();
?>
