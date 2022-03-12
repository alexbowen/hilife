<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => constant('FB_ID'),
  'app_secret' => constant('FB_SECRET'),
  'default_graph_version' => 'v2.5',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // optional

try {
  if (isset($_SESSION['fb_access_token'])) {
  $accessToken = $_SESSION['fb_access_token'];
  } else {
    $accessToken = $helper->getAccessToken();
  }
} catch(Facebook\Exceptions\facebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (isset($accessToken)) {
  if (isset($_SESSION['fb_access_token'])) {
    $fb->setDefaultAccessToken($_SESSION['fb_access_token']);
  } else {
    // getting short-lived access token
    $_SESSION['fb_access_token'] = (string) $accessToken;
      // OAuth 2.0 client handler
    $oAuth2Client = $fb->getOAuth2Client();
    // Exchanges a short-lived access token for a long-lived one
    $longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['fb_access_token']);
    $_SESSION['fb_access_token'] = (string) $longLivedAccessToken;
    // setting default access token to be used in script
    $fb->setDefaultAccessToken($_SESSION['fb_access_token']);
  }

  // getting basic info about user
  try {
    $profile_request = $fb->get('/me?fields=name,first_name,last_name,email');
    $profile = $profile_request->getGraphUser();          // To Get Facebook ID
    $fbfullname = $profile->getProperty('name');   // To Get Facebook full name
    $fbemail = $profile->getProperty('email');    //  To Get Facebook email
    # save the user nformation in session variable
    $_SESSION['auth_username'] = $fbfullname;
    $_SESSION['auth_email'] = $fbemail;
    $_SESSION['auth_provider'] = "facebook";
  } catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    session_destroy();
    // redirecting user back to app login page
    header("Location: ./");
    exit;
  } catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}
} else {
  // replace your website URL same as added in the developers.Facebook.com/apps e.g. if you used http instead of https and you used            
  $fbLoginUrl = $helper->getLoginUrl(constant('BASE_URL') . '/facebook/callback', $permissions);
}
?>
