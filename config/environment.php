<?php
define("PRODUCTION_HOST", 'thehi-life.co.uk');
define("STAGING_HOST", 'staging.thehi-life.co.uk');
define("DEVELOPMENT_HOST", 'dev.thehi-life.co.uk');
define("LOCAL_HOST", 'localhost');

switch ($_SERVER['HTTP_HOST']) {
  case constant('STAGING_HOST'):
    include ($_SERVER['DOCUMENT_ROOT'] . '/config/environment/staging.php');
    break;
  case constant('DEVELOPMENT_HOST'):
    include ($_SERVER['DOCUMENT_ROOT'] . '/config/environment/dev.php');
    break;
  case constant('LOCAL_HOST'):
    include ($_SERVER['DOCUMENT_ROOT'] . '/config/environment/local.php');
    break;
  default:
    include ($_SERVER['DOCUMENT_ROOT'] . '/config/environment/production.php');
}

include ($_SERVER['DOCUMENT_ROOT'] . '/secrets/constants.php');
?>
