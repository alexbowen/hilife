<div class="row">
  <div class="col-sm">
    <div class="card mb-3">
      <div class="card-body p-3">
        <img src="<?php echo $playlist->images[0]->url; ?>" height="80" width="80" class="rounded float-start me-2" />
        <h5 class="card-title"><?php echo $playlist->name; ?></h5>
        <div><?php echo $playlist->description; ?></div>
        <div><?php echo $playlist->tracks->total; ?> tracks</div>
        <div><a href="<?php echo $playlist->uri; ?>">view playlist in Spotify</a></div>
      </div>
      <div class="card-body p-3">
        <button type="submit" value="unlink" name="action" class="btn btn-secondary btn-sm card-link">unlink playlist</button>
        <button type="button" class="toggle-control btn btn-primary btn-sm card-link" data-content-id="toggle-content-<?php echo $key; ?>">show playlist tracks</button>
      </div>
    </div>
  </div>
</div>

<?php $items = $api->getPlaylistTracks($playlist->id); ?>
<div class="content-border__container admin toggle-content toggle-content--hidden mt-0" id="toggle-content-<?php echo $key; ?>">
  <?php foreach ($items->items as $item) { ?>
  <dl class="col-md-6">
    <dt><?php echo $item->track->name; ?></dt>
    <dd><?php echo $item->track->artists[0]->name; ?></dd>
  </dl>
  <?php } ?>
</div>
   