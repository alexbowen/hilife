<?php
$customer_config = array(
  "enquiry" => array(
    "email" => array(
      "title" => "Hi-life Entertainment booking enquiry received",
      "body" => array(
        "default" => array(
          "Hi %primary_contact%",
          "Thank you for your enquiry about booking a DJ for your %type% on %date% at %venue_name%",
          "line of body text with email %email%",
          "line of body text with telephone %client_telephone%",
          "line of body text with location %location%",
          "You can now start planning your event using our planner.",
          "Create your account at " . constant('BASE_URL') . "/account/register",
          "Or you can sign in immediatley with Facebook at " . constant('BASE_URL') . "/account/sign-in"
        )
      )
    ),
    "notification" => array(
      "type" => "message",
      "text" => "Event enquiry updated for %email%"
    )
  ),
  "pending" => array(
    "email" => array(
      "title" => "Hi-life Entertainment event is pending confirmation",
      "body" => array(
        "default" => array(
          "Hi %primary_contact%",
          "Event is pending confirmation on %date%",
          "You can now start planning your event using our planner.",
          "Create your account at " . constant('BASE_URL') . "/account/register",
          "Or you can sign in immediatley with Facebook at " . constant('BASE_URL') . "/account/sign-in"
        ),
        "direct" => array(
          "Your contract will be sent to you shortly."
        ),
        "package" => array(
          "optional package booking body text - can be removed or changed in config"
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
      "title" => "Hi-life Entertainment event is confirmed for %date%",
      "body" => array(
        "default" => array(
          "Hi %primary_contact%",
          "Event is confirmed on %date%",
          "You can now start planning your event using our planner.",
          "Create your account at " . constant('BASE_URL') . "/account/register",
          "Or you can sign in immediatley with Facebook at " . constant('BASE_URL') . "/account/sign-in"
        ),
        "direct" => array(
          "optional direct booking body text - can be removed or changed in config"
        ),
        "package" => array(
          "optional package booking body text - can be removed or changed in config"
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
      "title" => "Hi-life Entertainment event is cancelled for %date%",
      "body" => array(
        "default" => array(
          "Hi %primary_contact%",
          "Event is cancelled on %date%"
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