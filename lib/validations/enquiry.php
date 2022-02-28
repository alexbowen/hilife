<?php

function enquiryInvalid($enquiry) {
  $error = false;

  $date_now = date("Y-m-d");
  $date_event = new DateTime($enquiry['date']);
  
  if ($date_now > $date_event->format('Y-m-d')) {
    $error = 'Date is invalid';
  }

  return $error;
}

?>