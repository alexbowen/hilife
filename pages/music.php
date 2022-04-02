<section class="introduction content-section">
  <h1>Hi-Life music</h1>
  <p class="lead">Our unique music planner allows you make sure you hear the music that you want at your event</p>
  <img src="/assets/images/music/intro.jpg" width="100%" alt="Hilife music" />
</section>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/mixcloud.php'); ?>

<section class="content-section">
<?php
  include ($_SERVER['DOCUMENT_ROOT'].'/config/music.php');
  foreach ($music as $key => $genre) {
    include ($_SERVER['DOCUMENT_ROOT'].'/pages/music/category.php');
  }
?>
</section>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/youtube.php'); ?>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/list/regions.php'); ?>
