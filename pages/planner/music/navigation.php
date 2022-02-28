<?php echo $utils->backlink('/planner', 'back to main page'); ?>
<h1>Music for your event</h1>
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link<?php if ($section == 'playlists') { ?> active<?php } ?>" href="/planner/music/playlists?id=<?php echo $event->id; ?>">Playlists</a>
  </li>
  <li class="nav-item">
    <a class="nav-link<?php if ($section == 'themes') { ?> active<?php } ?>" href="/planner/music/themes?id=<?php echo $event->id; ?>">Themes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link<?php if ($section == 'policy') { ?> active<?php } ?>" href="/planner/music/policy?id=<?php echo $event->id; ?>">Policy</a>
  </li>
</ul>