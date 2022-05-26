<?php
$admin_config = array(
  "enquiry" => array(
    "email" => array(
      "title" => "Booking enquiry received from %primary_contact% for %date%",
      "body" => array(
        "default" => array(
          "Enquiry submitted for event on %date%",
          "start time: %start_time%",
          "finish time: %finish_time%",
          "venue: %venue_name%",
          "event type: %type%",
          "primary contact name: %primary_contact%",
          "email: %email%",
          "telephone: %client_telephone%",
          constant('BASE_URL') . "/admin/edit?id=%id%"
        )
      )
    ),
    "notification" => array(
      "type" => "message",
      "text" => "Event enquiry for %email%"
    )
  ),
  "pending" => array(
    "email" => array(
      "title" => "Event now pending for %primary_contact% on %date%",
      "body" => array(
        "default" => array(
          "Event pending on %date%",
          "start time: %start_time%",
          "finish time: %finish_time%",
          "venue: %venue_name%",
          "event type: %type%",
          "primary contact name: %primary_contact%",
          "email: %email%",
          "telephone: %client_telephone%",
          constant('BASE_URL') . "/admin/edit?id=%id%"
        ),
        "direct" => array(
          ""
        ),
        "package" => array(
          ""
        )
      )
    ),
    "notification" => array(
      "type" => "message",
      "text" => "Event pending for %email%"
    )
  ),
  "confirmed" => array(
    "email" => array(
      "title" => "Event now confirmed for %primary_contact% on %date%",
      "body" => array(
        "default" => array(
          "Event confirmed on %date%",
          "start time: %start_time%",
          "finish time: %finish_time%",
          "venue: %venue_name%",
          "event type: %type%",
          "primary contact name: %primary_contact%",
          "email: %email%",
          "telephone: %client_telephone%",
          constant('BASE_URL') . "/admin/edit?id=%id%"
        )
      )
    ),
    "notification" => array(
      "type" => "message",
      "text" => "Event confirmed for %email%"
    )
  ),
  "cancelled" => array(
    "email" => array(
      "title" => "Admin - event is cancelled for %date%",
      "body" => array(
        "default" => array(
          "Event cancelled on %date%",
          "primary contact name: %primary_contact%",
          "email: %email%",
          "telephone: %client_telephone%",
          constant('BASE_URL') . "/admin/edit?id=%id%"
        )
      )
    ),
    "notification" => array(
      "type" => "message",
      "text" => "Event cancelled for %email%"
    )
  )
);
?>