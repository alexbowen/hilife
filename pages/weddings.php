<?php include ($_SERVER['DOCUMENT_ROOT'].'/config/weddings.php'); ?>

<section class="introduction content-section">
  <h1>Wedding DJ Hire from Hi-Life Entertainment</h1>
  <p class="lead">Since I founded the company, back in 2006 from my record shop (Soul Alley) in Leeds our mobile DJs have played several thousand weddings up and down the country. Our Music Planner service means that every wedding set is unique and tailored to the clients' wishes. We have played over 100 LGBT weddings and civil partnerships in recent years and hopefully there will be many more in the future.</p>
</section>

<section class="content-section">
  <h2>Read feedback from weddings we have played at!</h2>
  <p>Below you can read some testimonials from just a small selection of the weddings we have DJ'd at in the last couple of years, both in Yorkshire and further afield. You can also find reviews on our <a href="https://www.facebook.com/hilifeentertainmentleeds/" target="_blank">Facebook page</a> and other social media from links below.</p>
  <?php foreach ($weddings as $wedding) { ?>
  <div class="row">
    <div class="col-sm">
      <div class="card card-full-width clearfix">
        <img src="/assets/images/wedding/<?php echo $wedding['image']['file']; ?>" alt="<?php echo $wedding['image']['alt']; ?>" class="rounded img-fluid float-md-end ms-md-3" />
        <p class="caption"><?php echo $wedding['caption']; ?></p>
        <p><span class="label">Venue</span> <?php echo $wedding['venue']; ?></p>
        <?php if (isset($wedding['dj'])) { ?>
          <p><span class="label">DJ</span> <?php echo $wedding['dj']; ?></p>
        <?php } ?>
        <p><span class="label">Music genres</span> <?php echo $wedding['genres']; ?></p>
        <p><span class="label">Favourite track(s)</span> <?php echo $wedding['tracks']; ?></p>
      </div>
    </div>
  </div>
  <?php } ?>
</section>

<?php include('weddings/gallery.php'); ?>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/youtube.php'); ?>
                            
<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/list/events.php'); ?>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/list/regions.php'); ?>
