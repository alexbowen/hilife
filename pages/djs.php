<section class="introduction content-section">
  <div class="content-intro">
    <h1>Meet the DJs</h1>
    <p class="lead">See below mobile and club DJs available for hire via Hi-Life in <?php echo $regions[$_GET['region']]["db_key"]; ?> and <?php echo $regions[$_GET['region']]["county"]; ?>.</p>
    <p>In most circumstances your mobile DJ will be selected based primarily upon the music that you are looking for, as well as the location of the event and availability. You can of course request a quote to book a specific DJ.</p>
  </div>
</section>

<section class="content-section">
<?php
  include ($_SERVER['DOCUMENT_ROOT'].'/config/djs.php');
  foreach ($djs as $key => $dj) {
?>
  <div class="row">
    <div class="col-sm">
      <div class="card card-full-width clearfix">
      <?php
        echo "<div class=\"profile-photo img-thumbnail\"><img src=\"/assets/images/dj/" . $dj['image']['file'] . "\" alt=\"" . $dj['image']['alt'] . "\" class=\"rounded " . ($key % 2 === 0 ? "float-end ms-3" : "float-start me-3") . "\" /></div>";
        echo "<h3 class=\"card-title\">" . $dj['name'] . "</h3>";
        foreach ($dj['about'] as $about) {
          echo "<p>" .$about . "</p>";
        }
        if ($dj['link']) {
          echo "<a href=\"" . $dj['link']['url'] . "\" target=\"_blank\" class=\"card-link\">" . $dj['link']['text'] . "</a>";
        }
      ?>
      </div>
    </div>
  </div>
  <?php
}
?>
</section>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/list/regions.php'); ?>
