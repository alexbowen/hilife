<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/config/event/customer.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/config/event/admin.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/config/event/package.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/config/event/dj.php');

$event_config = array(
  "types" => array(
    "Wedding",
    "Birthday Party",
    "Retirement Party",
    "Leaving Do",
    "Baby Shower",
    "Bar / Bat Mitzvah",
    "Christmas Party",
    "New Year Party",
    "Charity Event",
    "Corporate Event",
    "School / College party",
    "Bar Night",
    "Club Night",
    "Silent Disco"
  ),
  "policy" => array(
    'mic' => array(
      'yes' => 'Yes this is what we want',
      'no' => 'No we want a DJ that will introduce some of the songs during the night.'
    ),
    'requests' => array(
      'strict' => 'Only play requests that fit in with our music selection',
      'discretion' => 'Leave it to the discretion of the DJ',
      'play' => 'If the DJ has the song he should play it irrespective of our music selection'
    )
  ),
  "customer" => $customer_config,
  "admin" => $admin_config,
  "dj" => $dj_config,
  "package" => $package_config
);
?>