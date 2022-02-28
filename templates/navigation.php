<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/">
    <img src="/assets/images/logo-light-bg-sm.png" height="40" width="40" alt="Hi-life Entertainment" />
  </a>
  <div class="navbar-title">
    <h2 class="palette-light-shade">Hi-life Entertainment</h2>
    <span class="authenticated-status">
      <?php if ($_SESSION['auth_username']) { ?>Hello <?php echo $_SESSION['auth_username']; } ?>
      <?php if ($_SESSION['auth_provider'] == "facebook") { ?>
        <i class="fab fa-facebook-f facebook-btn authentication-logo"></i><?php } ?>

      <?php if ($_SESSION['auth_provider'] == "google") { ?>
        <i class="fab fa-google google-btn authentication-logo"></i>
      <?php } ?>
    </span>
  </div>
  <button
    class="navbar-toggler"
    type="button"
    data-toggle="collapse"
    data-target="#navbarsExampleDefault"
    aria-controls="navbarsExampleDefault"
    aria-expanded="false"
    aria-label="Toggle navigation"
  >
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-right" id="navbarsExampleDefault">
    <ul class="navbar-nav">
      <li class="nav-item<?php if ($_SERVER['REQUEST_URI'] === '/') { ?> active<?php } ?>">
        <a class="nav-link" href="<?php echo $region_url_prefix; ?>/">Home</a>
      </li>
      <li class="nav-item<?php if ($_SERVER['REQUEST_URI'] === '/djs') { ?> active<?php } ?>">
        <a class="nav-link" rel="canonical" href="<?php echo $region_url_prefix; ?>/djs">DJs</a>
      </li>
      <li class="nav-item<?php if ($_SERVER['REQUEST_URI'] === '/music') { ?> active<?php } ?>">
        <a class="nav-link" rel="canonical" href="<?php echo $region_url_prefix; ?>/music">Music</a>
      </li>
      <li class="nav-item<?php if ($_SERVER['REQUEST_URI'] === '/weddings') { ?> active<?php } ?>">
        <a class="nav-link" rel="canonical" href="<?php echo $region_url_prefix; ?>/weddings">Weddings</a>
      </li>
      <li class="nav-item<?php if ($_SERVER['REQUEST_URI'] === '/bar-and-corporate') { ?> active<?php } ?>">
        <a class="nav-link" rel="canonical" href="<?php echo $region_url_prefix; ?>/bar-and-corporate">Bar &amp; Corporate</a>
      </li>
      <li class="nav-item<?php if ($_SERVER['REQUEST_URI'] === '/blog') { ?> active<?php } ?>">
      <a class="nav-link" href="https://hi-lifemobiledjleeds.blog/blog/" target="_blank">Blog</a>
      </li>
      <li class="nav-item<?php if ($_SERVER['REQUEST_URI'] === '/contact') { ?> active<?php } ?>">
        <a class="nav-link" href="/contact">Contact</a>
      </li>
      <?php if($user->isAdmin()) { ?>
      <li class="nav-item<?php if (str_contains($_SERVER['REQUEST_URI'], '/admin/events')) { ?> active<?php } ?>">
        <a class="nav-link" href="/admin/events">Admin</a>
      </li>
      <?php } ?>
      <?php if($user->isInternal()) { ?>
      <li class="nav-item<?php if ($_SERVER['REQUEST_URI'] === '/planner/view/bookings') { ?> active<?php } ?>">
        <a class="nav-link" href="/planner/view/bookings">My Bookings</a>
      </li>
      <?php } ?>
      <?php if ($user->isCustomer()) { ?>
      <li class="nav-item<?php if ($_SERVER['REQUEST_URI'] === '/planner') { ?> active<?php } ?>">
        <a class="nav-link" href="/planner">Music Planner</a>
      </li>
      <?php } ?>
      <?php if ($user->signedIn()) { ?>
      <li class="nav-item">
        <a class="nav-link" href="/auth/revoke">Sign Out</a>
      </li>
      <?php } else { ?>
      <li class="nav-item<?php if ($_SERVER['REQUEST_URI'] === '/account/sign-in') { ?> active<?php } ?>">
        <a class="nav-link" href="/account/sign-in">Sign In</a>
      </li>
      <?php } ?>
    </ul>
  </div>
</nav>