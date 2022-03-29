<?php

function eventInvalid($event) {
  $error = false;

  switch ($event['status']) {
    case "pending":  
    case "enquiry":      
      if (empty($event["primary_contact"])) {
        $error = 'No primary contact name set';
      }

      if (empty($event["email"])) {
        $error = 'No client email set';
      }

      break;

    case "confirmed":
      if ($event["booking_type"] == 'direct' && $event["contract_status"] !== 'received') {
        $error = 'No contract yet received';
      }
  }

  $date_now = date("Y-m-d");
  $date_event = new DateTime($event['date']);
  
  if ($date_now > $date_event->format('Y-m-d')) {
    $error = 'Date is in the past';
  }

  return $error;
}

?>
