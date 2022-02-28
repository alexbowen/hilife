<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/utils.php');

require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';

$session = new SpotifyWebAPI\Session(
  '6d92d325771e403da886e73f609a9846',
  'b1d42b4a222e4e34a63ce7c70b12f43e'
);

if ($_SESSION['accessToken']) {
  $session->setAccessToken($_SESSION['accessToken']);
  $session->setRefreshToken($_SESSION['refreshToken']);
} elseif ($_SESSION['refreshToken']) {
  $session->refreshAccessToken($_SESSION['refreshToken']);
}

$options = [
  'auto_refresh' => true,
];

$api = new SpotifyWebAPI\SpotifyWebAPI($options, $session);

if ($_POST['action'] == 'link') {
  $playlist = $api->getPlaylist($_POST['playlist_id']);
  $query="INSERT INTO events_playlists (event_id, playlist_id, playlist_name, playlist_url) VALUES (\"" . $_GET['id'] . "\", \"" . $_POST['playlist_id'] . "\", \"" . $playlist->name . "\", \"" . $playlist->uri . "\")";
  $database->query($query);

  $utils->setPlannerUpdated($_GET['id'], $_SESSION['auth_roles']);
}

if ($_POST['action'] == 'unlink') {
  $query="DELETE FROM events_playlists WHERE event_id=\"" . $_GET['id'] . "\" AND playlist_id=\"" . $_POST['delete_playlist_id'] . "\"";
  $database->query($query);

  $utils->setPlannerUpdated($_GET['id'], $_SESSION['auth_roles']);
}

if ($session->getAccessToken()) {
  $playlists = $api->getMyPlaylists();
}

if ($_POST['action'] == 'update') {
  $insertFields = '';
  $parameters = '';
  $updateValues = '';

  for ($x = 1; $x <= 25; $x++) {
    $insertFields .= "t" . $x . ", ";
    $parameters .= ":t" . $x . ", ";
    $updateValues .= "t" . $x . "=VALUES(t" . $x . "), ";
  }
  
  $sql = "INSERT INTO events_music_top_25 (event_id, " . rtrim($insertFields, ", ") . ")
  VALUES (:event_id, " . rtrim($parameters, ", ") . ")
  ON DUPLICATE KEY UPDATE " . rtrim($updateValues, ", ");

  $query = $database->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

  $trackArray = array();

  foreach ($_POST['tracks'] as $key => $track) {
    $trackNumber = $key + 1;
    $trackArray[':t' . $trackNumber] = $track;
  }

  $query->execute(array_merge(array(':event_id' => $_GET['id']), $trackArray));

  $utils->setPlannerUpdated($_GET['id'], $_SESSION['auth_roles']);
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
    <form name="eventmusic" action="/planner/music/playlists?id=<?php echo $event->id; ?>" method="post">

      <div class="row">
        <?php for ($x = 1; $x <= 25; $x++) { ?>
        <div class="col-md-4 mb-2">
          <input type="text" class="form-control" name="tracks[]" value="<?php echo $event->top_25['t' . $x]; ?>" placeholder="<?php echo $x; ?>." />
        </div>
        <?php } ?>
      </div>

      <div class="row text-end mb-2">
        <div class="d-grid gap-2 d-md-block">
          <button type="submit" name="action" value="update" class="btn btn-sm btn-secondary">save top 25</button>
        </div>
      </div>
    </form>
  </div>

  <div class="content-border__container admin">
    <h5>Spotify playlists</h5>
    <?php if (count($playlists->items) > count($event->spotify_playlists)) { ?>
    <form name="eventactions" action="/planner/music/playlists?id=<?php echo $event->id; ?>" method="post">

      <div class="input-group" style="margin-bottom:10px">
        <select class="form-select" name="playlist_id">
        <?php
          foreach ($playlists->items as $playlist) {
            if (in_array($playlist->id, $event->spotify_playlists)) {
              echo "<option disabled value=\"" . $playlist->id . "\">" . $playlist->name . "</option>";
            } else {
              ?>
              <option value="<?php echo $playlist->id; ?>"><?php echo $playlist->name; ?></option>
              <?php
            }
          }
          ?>
        </select>
        <button type="submit" value="link" name="action" class="btn btn-sm btn-secondary">link with event</button>
      </div>
    </form>
    <?php } ?>

    <?php
    foreach ($playlists->items as $key => $playlist) {
      if (in_array($playlist->id, $event->spotify_playlists)) {
        echo "<form name=\"playlistactions\" action=\"/planner/music/playlists?id=$event->id\" method=\"post\">";
        echo "<input type=\"hidden\" name=\"delete_playlist_id\" value=\"" . $playlist->id . "\" />";
        echo "<input type=\"hidden\" name=\"event_id\" value=\"" . $event->id . "\" />";
        include ($_SERVER['DOCUMENT_ROOT'].'/pages/planner/music/spotify-playlist.php');
        echo "</form>";
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