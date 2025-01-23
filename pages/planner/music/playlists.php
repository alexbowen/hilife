<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
  '6d92d325771e403da886e73f609a9846',
  'b1d42b4a222e4e34a63ce7c70b12f43e'
);

if (isset($_SESSION['accessToken']) && $_SESSION['accessToken']) {
  $session->setAccessToken($_SESSION['accessToken']);
  $session->setRefreshToken($_SESSION['refreshToken']);
} elseif (isset($_SESSION['refreshToken']) && $_SESSION['refreshToken']) {
  $session->refreshAccessToken($_SESSION['refreshToken']);
}

$options = [
  'auto_refresh' => true,
];

$api = new SpotifyWebAPI\SpotifyWebAPI($options, $session);

if (isset($_POST['action']) && $_POST['action'] == 'link') {
  $playlist = $api->getPlaylist($_POST['playlist_id']);
  $query="INSERT INTO events_playlists (event_id, playlist_id, playlist_name, playlist_url) VALUES (\"" . $_POST['id'] . "\", \"" . $_POST['playlist_id'] . "\", \"" . $playlist->name . "\", \"" . $playlist->uri . "\")";
  $database->query($query);

  $utils->setPlannerUpdated($_POST['id'], $_SESSION['auth_roles']);
}

if (isset($_POST['action']) && $_POST['action'] == 'unlink') {
  $query = "DELETE FROM events_playlists WHERE event_id=\"" . $_POST['id'] . "\" AND playlist_id=\"" . $_POST['delete_playlist_id'] . "\"";
  $database->query($query);

  $utils->setPlannerUpdated($_POST['id'], $_SESSION['auth_roles']);
}

if ($session->getAccessToken()) {
  $playlists = $api->getMyPlaylists();
}

include $_SERVER['DOCUMENT_ROOT'].'/lib/event.php';

$event = EventFactory::create(array(
  'events.id' => $_GET['id'],
  'email' => $_SESSION['auth_email']
), true);

$section = 'playlists';
?>

<section class="content-section">
  <?php include ('navigation.php'); ?>
  <div class="content-tabs__container admin">
    <h5>Top 25</h5>
    <form name="eventmusic" action="/actions/planner/playlists?id=<?php echo $event->id; ?>" method="post">

      <div class="row">
        <?php for ($x = 1; $x <= 25; $x++) { ?>
        <div class="col-md-4 mb-2">
          <input type="text" class="form-control" name="tracks[]" value="<?php echo $event->top_25 ? $event->top_25['t' . $x] : ''; ?>" placeholder="<?php echo $x; ?>." />
        </div>
        <?php } ?>
      </div>

      <div class="row text-end mb-2">
        <div class="d-grid gap-2 d-md-block">
          <input type="hidden" name="id" value="<?php echo $event->id; ?>" />
          <button type="submit" name="action" value="update" class="btn btn-sm btn-secondary">save top 25</button>
        </div>
      </div>
    </form>
  </div>

  <div class="content-border__container admin">
    <h5>Spotify playlists</h5>
    <?php if (isset($playlists) && count($playlists->items) > count($event->spotify_playlists)) { ?>
    <form name="eventactions" action="/planner/music/playlists?id=<?php echo $event->id; ?>" method="post">

      <div class="input-group" style="margin-bottom:10px">
        <select class="form-select" name="playlist_id">
        <?php
          foreach ($playlists->items as $playlist) {
            if (in_array($playlist->id, array_column($event->spotify_playlists, 'playlist_id'))) {
              echo "<option disabled value=\"" . $playlist->id . "\">" . $playlist->name . "</option>";
            } else {
              ?>
              <option value="<?php echo $playlist->id; ?>"><?php echo $playlist->name; ?></option>
              <?php
            }
          }
          ?>
        </select>
        <input type="hidden" name="id" value="<?php echo $event->id; ?>" />
        <button type="submit" value="link" name="action" class="btn btn-sm btn-secondary">link with event</button>
      </div>
    </form>
    <?php } else { ?>
      <p>Sign in to link Spotify playlists with your event</p>
    <?php } ?>

    <?php
    if (isset($playlists)) {
      foreach ($playlists->items as $key => $playlist) {
        if (in_array($playlist->id, array_column($event->spotify_playlists, 'playlist_id'))) {
          ?>
          <form name="playlistactions" action="/planner/music/playlists?id=<?php echo $event->id; ?>" method="post">
            <input type="hidden" name="delete_playlist_id" value="<?php echo $playlist->id; ?>" />
            <input type="hidden" name="id" value="<?php echo $event->id; ?>" />
            <?php include ($_SERVER['DOCUMENT_ROOT'].'/pages/planner/music/spotify-playlist.php'); ?>
          </form>
          <?php
        }
      }
    }
    ?>

    <div class="row mb-2">
      <div class="col">
      <div class="d-grid gap-2 d-md-flex my-2 my-md-0">
        <?php if ($session->getAccessToken()) { ?>
        <a href="/spotify/revoke" class="btn btn-sm spotify"><img src="/assets/images/logos/spotify.png" height="24" width="24" />Sign out from Spotify</a>
        <?php } ?>
        <?php if (!$session->getAccessToken()) { ?>
        <a href="/spotify/auth?redirect=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" class="btn btn-sm spotify"><img src="/assets/images/logos/spotify.png" height="24" width="24" />Sign in to Spotify</a>
        <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>
