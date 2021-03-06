<?php
define("PRODUCTION_HOST", 'thehi-life.co.uk');
define("STAGING_HOST", 'staging.thehi-life.co.uk');
define("DEVELOPMENT_HOST", 'dev.thehi-life.co.uk');
define("LOCAL_HOST", 'localhost');

if ($_SERVER['HTTP_HOST'] === constant('PRODUCTION_HOST')) {
  include ($_SERVER['DOCUMENT_ROOT'] . '/config/environment/production.php');
}

if ($_SERVER['HTTP_HOST'] === constant('STAGING_HOST')) {
  include ($_SERVER['DOCUMENT_ROOT'] . '/config/environment/staging.php');
}

if ($_SERVER['HTTP_HOST'] === constant('DEVELOPMENT_HOST')) {
  include ($_SERVER['DOCUMENT_ROOT'] . '/config/environment/dev.php');
}

if ($_SERVER['HTTP_HOST'] === constant('LOCAL_HOST')) {
  include ($_SERVER['DOCUMENT_ROOT'] . '/config/environment/local.php');
}

include ($_SERVER['DOCUMENT_ROOT'] . '/secrets/constants.php');
?>
