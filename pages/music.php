<section class="introduction content-section">
  <h1>Hi-life Music</h1>
  <p class="lead">Our unique music planner allows you make sure you hear the music that you want at your event</p>
  <img src="/assets/images/music/intro.jpg" width="100%" alt="Hilife music" />
</section>

<section class="content-section">
  <p>As an illustration of the sorts of DJ sets we can play there are a number of playlists below. At weddings and parties we usually need to combine a few themes to cover different age groups. We are currently recording brief mixes of the various playlists, these are directly below, as featured on our Mixcloud page.</p>
  <p>We can cover a wide variety of music. Lots of example playlists are available on the music page of our website. We also have a number of brief example mixes on our Mixcloud page. The Jukebox Mix is below, a "mash up" of lots of different styles.</p>
  <p>You are welcome to try out the Music Planner prior to making a booking.</p>
  <div class="mixcloud bg-dark">
    <div>
      <iframe
        width="100%"
        height="60"
        src="https://www.mixcloud.com/widget/iframe/?hide_cover=1&mini=1&feed=%2FHILIFEDJ%2Fhi-life-jukebox-mix_01%2F"
        frameborder="2"
      ></iframe>
    </div>
  </div>

  <div class="content-border__container content-section-link">
    <p>There are many more available on our <a href="https://www.mixcloud.com/HILIFEDJ/" target="_blank">Mixcloud page</a></p>
  </div>
</section>

<section class="content-section">
<?php
  include ($_SERVER['DOCUMENT_ROOT'].'/config/music.php');
  foreach ($music as $key => $genre) {
    include ($_SERVER['DOCUMENT_ROOT'].'/pages/music/category.php');
  }
?>
</section>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/list/regions.php'); ?>
