<?php
$admin_config = array(
  "enquiry" => array(
    "email" => array(
      "title" => "booking enquiry from website for %type% at %venue_name%",
      "body" => array(
        "default" => array(
          "Enquiry submitted for event on %date% starting at %start_time% till %finish_time%",
          "primary contact name: %primary_contact%",
          "email: %email%",
          "telephone: %client_telephone%",
		      "%notes%"
        ),
        "direct" => array(

        ),
        "package" => array(

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
      "title" => "Admin - event now pending",
      "body" => array(
        "default" => array(
          "Event pending on %date%",
          "primary contact name: %primary_contact%",
          "email: %email%",
          "telephone: %client_telephone%"
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
      "title" => "Admin - event now confirmed for %date%",
      "body" => array(
        "default" => array(
          "Event confirmed on %date%",
          "primary contact name: %primary_contact%",
          "email: %email%",
          "telephone: %client_telephone%"
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
      "title" => "Admin - event is cancelled for %date%",
      "body" => array(
        "default" => array(
          "Event cancelled on %date%",
          "primary contact name: %primary_contact%",
          "email: %email%",
          "telephone: %client_telephone%"
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
      "text" => "Event cancelled for %email%"
    )
  )
);
?>