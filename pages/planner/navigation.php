<?php if ($user->signedIn()) { ?>
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link<?php if ($plannerPage === "events") { echo " active"; } ?>"<?php if ($plannerPage === "events") { echo " aria-current=\"page\""; } ?> href="/planner">Your events</a>
  </li>
  <li class="nav-item">
    <a class="nav-link<?php if ($plannerPage === "about") { echo " active"; } ?>"<?php if ($plannerPage === "about") { echo " aria-current=\"page\""; } ?> href="/planner/about">About music planner</a>
  </li>
</ul>
<?php } ?>
