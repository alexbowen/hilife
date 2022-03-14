<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link<?php if ($adminPage === "events") { echo " active"; } ?>"<?php if ($adminPage === "events") { echo " aria-current=\"page\""; } ?> href="/admin/events">Events</a>
  </li>
  <li class="nav-item">
    <a class="nav-link<?php if ($adminPage === "search") { echo " active"; } ?>"<?php if ($adminPage === "search") { echo " aria-current=\"page\""; } ?> href="/admin/search">Search</a>
  </li>
  <li class="nav-item">
    <a class="nav-link<?php if ($adminPage === "create") { echo " active"; } ?>"<?php if ($adminPage === "create") { echo " aria-current=\"page\""; } ?> href="/admin/create">Create</a>
  </li>
  <li class="nav-item">
    <a class="nav-link<?php if ($adminPage === "archive") { echo " active"; } ?>"<?php if ($adminPage === "archive") { echo " aria-current=\"page\""; } ?> href="/admin/archive">Archive</a>
  </li>
</ul>
