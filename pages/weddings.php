<section class="introduction content-section">
  <h1>Wedding DJ Hire from Hi-Life Entertainment</h1>
  <p class="lead">Since I founded the company, back in 2006 from my record shop (Soul Alley) in Leeds our mobile DJs have played several thousand weddings up and down the country. Our Music Planner service means that every wedding set is unique and tailored to the clients' wishes. We have played over 100 LGBT weddings and civil partnerships in recent years and hopefully there will be many more in the future.</p>
</section>

<section class="content-section">
  <h2>Read feedback from weddings we have played at!</h2>
  <p>Below you can read some testimonials from just a small selection of the weddings we have DJ'd at in the last couple of years, both in Yorkshire and further afield. You can also find reviews on our <a href="https://www.facebook.com/hilifeentertainmentleeds/" target="_blank">Facebook page</a> and other social media from links below.</p>
<?php
  include ($_SERVER['DOCUMENT_ROOT'].'/config/weddings.php');
  foreach ($weddings as $key => $wedding) {
?>
  <div class="row">
    <div class="col-sm">
      <div class="card card-full-width clearfix">
      <?php
        echo "<img src=\"/assets/images/wedding/" . $wedding['image']['file'] . "\" alt=\"" . $wedding['image']['alt'] . "\" class=\"rounded img-fluid float-md-end ms-md-3\" />";
        echo "<p class=\"caption\">" . $wedding['caption'] . "</p>";
        echo "<p><span class=\"label\">Venue</span> " . $wedding['venue'] . "</p>";
        if (isset($wedding['dj'])) {
          echo "<p><span class=\"label\">DJ</span> " . $wedding['dj'] . "</p>";
        }
        echo "<p><span class=\"label\">Music genres</span> " . $wedding['genres'] . "</p>";
        echo "<p><span class=\"label\">Favourite track(s)</span> " . $wedding['tracks'] . "</p>";
      ?>
      </div>
    </div>
  </div>
  <?php
}
?>
</section>

<?php include('weddings/gallery.php'); ?>
                            
<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/list/events.php'); ?>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/list/regions.php'); ?>