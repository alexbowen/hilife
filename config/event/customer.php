<?php
$customer_config = array(
  "enquiry" => array(
    "email" => array(
      "title" => "Hi-Life Entertainment booking enquiry received",
      "body" => array(
        "default" => array(
          "Hi %primary_contact%",
          "Thank you for your enquiry about booking a DJ for your event on %date%",
          "venue: %venue_name%",
          "event type: %type%",
          "I will send you a quote shortly to your email address at %email%."
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
      "title" => "Your booking is now in our diary, pending you paying your deposit",
      "body" => array(
        "default" => array(
          "Hi %primary_contact%",
          "You will receive a seperate email from me with your booking form and instructions how to pay your deposit for your event on %date%",
          "You can now start planning your event using our music planner.",
          "Create your account at " . constant('BASE_URL') . "/account/register"
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
      "title" => "Hi-Life Entertainment event is confirmed for %date%",
      "body" => array(
        "default" => array(
          "Hi %primary_contact%",
          "Event is confirmed on %date%",
          "You can now start planning your event using our planner.",
          "Create your account at " . constant('BASE_URL') . "/account/register"
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
      "text" => "Event confirmed for %email%"
    )
  ),
  "cancelled" => array(
    "email" => array(
      "title" => "Hi-Life Entertainment event is cancelled for %date%",
      "body" => array(
        "default" => array(
          "Hi %primary_contact%",
          "I can confirm that your booking is cancelled on %date% . If you change your mind please drop me an email back at any point."
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
