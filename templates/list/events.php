<?php
  $region = $regions[$_GET['region']]["db_key"];
  $query = "SELECT * FROM gigs WHERE region='$region' ORDER BY ID DESC";
?>
<section class="content-section">
  <h3>Recent Events</h3>
  <p>Some recent events that Hi-Life mobile DJs have played in the <?php echo $regions[$_GET['region']]["db_key"]; ?> and <?php echo $regions[$_GET['region']]["county"]; ?> Region for weddings, parties and corporate events:</p>
  <div class="content-list__container content-border__container">
    <ul class="content-list">
    <?php foreach ($database->query($query) as $row) { ?>
      <li>
        <span><?php echo $row['Description']; ?></span>
        <span>at</span>
        <span><?php echo $row['Venue']; ?></span>
        <span>,</span>
        <span><?php echo $row['Place']; ?></span>
      </li>
    <?php
    }
    echo "</ul>";
    ?>
    <p>Up to date as of <?php echo date("jS F Y"); ?></p>
  </div>
</section>
