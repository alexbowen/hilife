<?php
include $_SERVER['DOCUMENT_ROOT'].'/lib/event.php';
include ($_SERVER['DOCUMENT_ROOT'].'/config/event.php');

$event = EventFactory::create(array(
  'events.id' => $_GET['id']
), true);

require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
  '6d92d325771e403da886e73f609a9846',
  'b1d42b4a222e4e34a63ce7c70b12f43e'
);

if (isset($_SESSION['accessToken'])) {
  $session->setAccessToken($_SESSION['accessToken']);
  $session->setRefreshToken($_SESSION['refreshToken']);
} elseif (isset($_SESSION['refreshToken'])) {
  $session->refreshAccessToken($_SESSION['refreshToken']);
}

$options = [
  'auto_refresh' => true,
];

$api = new SpotifyWebAPI\SpotifyWebAPI($options, $session);
?>

<section class="introduction content-section admin">
  <?php echo $utils->backlink($_SERVER['HTTP_REFERER'], 'back to dashboard'); ?>
  <div class="row">
    <div class="col">
      <h1 style="display:inline-block;">Music planner summary</h1>
      <button class="btn btn-link palette-light-accent no-print print-action">download PDF</button>
    </div>
  </div>
  <p><?php if ($event && !empty($event->venue_name)) { ?> at <b><?php echo $event->venue_name; ?></b><?php } ?><?php if ($event && !empty($event->date)) { ?> on <b><?php echo $event->prettyDate(); ?></b><?php } ?></p>
</section>

<section class="content-section admin page-break">
  <h2>Details</h2>
  <ul class="list-group admin mb-3">
    <li class="list-group-item"><dl><dt><span>DJ playing</span></dt><dd><?php echo $utils->field($event->dj['dj_name']); ?></dd></dl></li>
  </ul>

  <?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/event/show.php'); ?>
</section>

<section class="content-section admin page-break">
  <h2>Music</h2>
  <?php if (is_array($event->top_25) && count($event->top_25) > 0) { ?>
  <div class="content-border__container admin">
    <div class="row">
    <?php for ($x = 1; $x <= count($event->top_25); $x++) { ?>
      <?php if (!empty($event->top_25['t' . $x])) { ?>
      <dl class="col-md-6 mb-1">
        <dt><?php echo $x; ?></dt>
        <dd><?php echo $event->top_25['t' . $x]; ?></dd>
      </dl>
      <?php } ?>
    <?php } ?>
    </div>
  </div>
  <?php } else { ?>
    <div class="content-border__container admin">
      <span class="field-empty">no top 25 tracks added yet</span>
    </div>
  <?php } ?>
</section>

<section class="content-section admin">
  <ul class="list-group admin">
    <li class="list-group-item"><dl><dt><span>First dance</span></dt><dd><?php echo $utils->field($event->first_dance); ?></dd></dl></li>
    <li class="list-group-item"><dl><dt><span>Last dance</span></dt><dd><?php echo $utils->field($event->last_dance); ?></dd></dl></li>
  </ul>

  <?php if (!empty($event->additional)) { ?>
  <div class="content-border__container admin">
    <dl><dt>Notes: </dt><dd><?php echo $utils->field($event->additional); ?></dd></dl>
  </div>
  <?php } ?>
</section>

<?php if (count($event->spotify_playlists) > 0) { ?>
<section class="content-section admin mt-3">
  <h5>Spotify playlists (<?php echo count($event->spotify_playlists); ?>)</h5>

  <ul class="list-group admin">
  <?php foreach ($event->spotify_playlists as $playlist) { ?>
    <li class="list-group-item"><span><?php echo $playlist['playlist_name']; ?></span><a href="<?php echo $playlist['playlist_url']; ?>">view playlist in Spotify</a></li>
  <?php } ?>
  </ul>

</section>
<?php } ?>

<section class="content-section admin">
  <h5>Categories</h5>
  <div class="content-border__container">
  <?php if (count($event->categories) > 0) { ?>
  <?php foreach ($event->categories as $category) { ?>
    <span class="badge rounded-pill bg-pill mb-2"><?php echo $category['title']; ?><?php if ($category['favourite'] === '1') { ?><span class="ms-1"><img src="/assets/images/icons/heart.svg" height="14" width="14" /></span><?php } ?></span>
  <?php } ?>
  <?php } else { ?>
    <span class="field-empty">no categories added yet</span>
    <?php } ?>
  </div>
</section>

<section class="content-section admin">
  <h5>Decades</h5>
  <div class="content-border__container">
  <?php if (count($event->decades) > 0) { ?>
  <?php foreach ($event->decades as $decade) { ?>
    <span class="badge rounded-pill bg-pill mb-2"><?php echo $decade['title']; ?><?php if ($decade['favourite'] === '1') { ?><span class="ms-1"><img src="/assets/images/icons/heart.svg" height="14" width="14" /></span><?php } ?></span>
  <?php } ?>
  <?php } else { ?>
    <span class="field-empty">no decades added yet</span>
    <?php } ?>
  </div>
</section>

<section class="content-section admin">
  <h5>Policy</h5>
  <ul class="list-group admin">
    <li class="list-group-item"><dl><dt><span>No play</span></dt><dd><?php echo $utils->field($event->noplay); ?></dd></dl></li>
    <li class="list-group-item"><dl><dt><span>Requests</span></dt><dd><?php echo $utils->field($event_config['policy']['requests'][$event->requests]); ?></dd></dl></li>
    <li class="list-group-item"><dl><dt><span>DJ microphone</span></dt><dd><?php echo $utils->field($event_config['policy']['mic'][$event->mic]); ?></dd></dl></li>
    <li class="list-group-item"><dl><dt><span>Cheese/guilty pleasures</span></dt><dd><?php echo $utils->field($event->cheese); ?></dd></dl></li>
  </ul>
</section>
