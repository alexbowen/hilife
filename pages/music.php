<?php include ($_SERVER['DOCUMENT_ROOT'].'/config/music.php'); ?>
<section class="introduction content-section">
  <h1>Music for your Hi-Life Entertainment event</h1>
  <img src="/assets/images/music/intro.jpg" alt="Hilife music" class="me-4 img-fluid rounded float-start" />
  <p class="lead">Our unique music planner allows you make sure you hear the music that you want at your event.</p>
  <p class="clearfix">bit of extra text maybe explaining what music planner is and/or content below would be good here</p>
</section>

<section class="content-section">
<?php
  foreach ($music as $key => $genre) {
    include ($_SERVER['DOCUMENT_ROOT'].'/pages/music/category.php');
  }
?>
</section>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/mixcloud.php'); ?>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/list/regions.php'); ?>
