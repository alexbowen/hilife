<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/config/event/customer.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/config/event/admin.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/config/event/package.php');

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
  "customer" => $customer_config,
  "admin" => $admin_config,
  "package" => $package_config
);
?>