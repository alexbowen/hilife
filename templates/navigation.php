<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <div style="display:flex;flex-direction: column;">
    <a class="navbar-brand palette-light-shade" href="/"><img src="/assets/images/logo-light-bg-sm.png" height="38" width="41" alt="Hi-Life Entertainment" />Hi-Life Entertainment</a>
    <span class="authenticated-status">
      <?php echo navigationAuthenticated(); ?>
    </span>
      </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item<?php if ($_SERVER['REQUEST_URI'] === '/') { ?> active<?php } ?>">
        <a class="nav-link" href="<?php echo $region_url_prefix; ?>/">Home</a>
      </li>
      <li class="nav-item<?php if (str_contains($_SERVER['REQUEST_URI'], 'djs')) { ?> active<?php } ?>">
        <a class="nav-link" rel="canonical" href="<?php echo $region_url_prefix; ?>/djs">DJs</a>
      </li>
      <li class="nav-item<?php if (str_contains($_SERVER['REQUEST_URI'], 'music')) { ?> active<?php } ?>">
        <a class="nav-link" rel="canonical" href="<?php echo $region_url_prefix; ?>/music">Music</a>
      </li>
      <li class="nav-item<?php if (str_contains($_SERVER['REQUEST_URI'], 'weddings')) { ?> active<?php } ?>">
        <a class="nav-link" rel="canonical" href="<?php echo $region_url_prefix; ?>/weddings">Weddings</a>
      </li>
      <li class="nav-item<?php if (str_contains($_SERVER['REQUEST_URI'], 'bar-and-corporate')) { ?> active<?php } ?>">
        <a class="nav-link" rel="canonical" href="<?php echo $region_url_prefix; ?>/bar-and-corporate">Bar &amp; Corporate</a>
      </li>
      <li class="nav-item<?php if (str_contains($_SERVER['REQUEST_URI'], 'contact')) { ?> active<?php } ?>">
        <a class="nav-link" href="/contact">Contact</a>
      </li>
      <?php if($user->isAdmin()) { ?>
      <li class="nav-item<?php if (str_contains($_SERVER['REQUEST_URI'], 'admin/events')) { ?> active<?php } ?>">
        <a class="nav-link" href="/admin/events">Admin</a>
      </li>
      <?php } ?>
      <?php if($user->isInternal()) { ?>
      <li class="nav-item<?php if (str_contains($_SERVER['REQUEST_URI'], 'planner/view/bookings')) { ?> active<?php } ?>">
        <a class="nav-link" href="/planner/view/bookings">My Bookings</a>
      </li>
      <?php } ?>
      <?php if ($user->isCustomer()) { ?>
      <li class="nav-item<?php if (str_contains($_SERVER['REQUEST_URI'], 'planner')) { ?> active<?php } ?>">
        <a class="nav-link" href="/planner">Music Planner</a>
      </li>
      <?php } ?>
      <?php if ($user->signedIn()) { ?>
      <li class="nav-item<?php if (str_contains($_SERVER['REQUEST_URI'], 'account')) { ?> active<?php } ?>">
        <a class="nav-link" href="/account">Account</a>
      </li>
      <?php } ?>
      <?php if ($user->signedIn()) { ?>
      <li class="nav-item">
        <a class="nav-link" href="/auth/revoke">Sign Out</a>
      </li>
      <?php } else { ?>
      <li class="nav-item<?php if (str_contains($_SERVER['REQUEST_URI'], 'account/sign-in')) { ?> active<?php } ?>">
        <a class="nav-link" href="/account/sign-in">Sign In</a>
      </li>
      <?php } ?>
      </ul>
    </div>
  </div>
</nav>
