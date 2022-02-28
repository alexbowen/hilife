<?php

include_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/utils.php');

class Event {

  public $id;
  public $created;
  public $last_updated;
  public $email;
  public $location;
  public $type;
  public $venue_name;
  public $venue_address;
  public $date;
  public $start_time;
  public $finish_time;
  public $setup_time;
  public $primary_contact;
  public $secondary_contact;
  public $client_address;
  public $client_telephone;
  public $numbers;
  public $event_id;
  public $booking_type;
  public $package_client_id;
  public $status;
  public $contract_status;
  public $notes;
  public $dj_user_id;
  public $dj;
  public $additional;
  public $first_dance;
  public $last_dance;
  public $noplay;
  public $requests;
  public $mic;
  public $cheese;
  public $day;
  public $month;
  public $year;

  public $startMinute;
  public $startHour;
  public $finishMinute;
  public $finishHour;
  public $setupMinute;
  public $setupHour;


  public $top_25;
  public $categories;
  public $decades;
  public $spotify_playlists;

  public $planner_updated;

  function __construct($expanded = false) {
    global $database;

    if ($expanded) {
      $query = "SELECT * FROM events_music_top_25 WHERE event_id = \"" . $this->id . "\"";
      $this->top_25 = $database->query($query)->fetch();

      $query = "SELECT music_categories.*, event_music_categories.favourite FROM event_music_categories INNER JOIN music_categories ON music_categories.id = event_music_categories.category_id WHERE event_id = \"" . $this->id . "\"";
      $this->categories = $database->query($query)->fetchAll(PDO::FETCH_NAMED);

      $query = "SELECT music_decades.*, event_music_decades.favourite FROM event_music_decades INNER JOIN music_decades ON music_decades.id = event_music_decades.decade_id WHERE event_id = \"" . $this->id . "\"";
      $this->decades = $database->query($query)->fetchAll(PDO::FETCH_NAMED);

      $query = "SELECT playlist_id FROM events_playlists WHERE event_id=\"" . $this->id . "\"";
      $this->spotify_playlists = $database->query($query)->fetchAll(PDO::FETCH_COLUMN);
    }
  }

  public function prettyField($property) {
    global $utils;
    return $utils->field($this->$property);
  }

  function prettyDate() {
    global $utils;
    return $utils->prettyDateFormat($this->date);
  }

  function prettyTime($when) {
    global $utils;
    return $utils->prettyTimeFormat($this->{$when . '_time'});
  }
}

?>