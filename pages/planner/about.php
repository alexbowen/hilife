<?php $plannerPage = "about"; ?>

<h1>About Hi-Life music planner</h1>
<p class="lead">Our unique music planner allows you to view details of your event and tell us about music requirements. You can update it at any point prior to your event and gather your ideas on what you do and don't want. It is designed to work on a mobile phone, computer or tablet so you can use it when and where you want.</p>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/pages/planner/navigation.php'); ?>

<section class="content-tabs__container">
  <div class="row align-items-start gx-5">
    <div class="col-sm">
      <h2 class="card-title">Your top 25 tunes</h2>
      <figure class="figure">
        <figcaption class="figure-caption lead">These are the main tunes for the DJ to include on the night</figcaption>
        <img src="/assets/images/planner/top25.png" class="figure-img img-fluid rounded shadow border mt-3" height="178" alt="">
      </figure>
    </div>

    <div class="col-sm">
      <h2 class="card-title">Use Spotify playlists</h2>
      <figure class="figure">
        <figcaption class="figure-caption lead">You can link playlists from Spotify with your event</figcaption>
        <img src="/assets/images/planner/spotify.png" class="figure-img img-fluid rounded shadow border mt-3" height="178" alt="">
      </figure>
    </div>
  </div>

  <div class="row align-items-start gx-5 mt-5">
    <div class="col-sm">
      <h2 class="card-title">Preferred music categories</h2>
      <figure class="figure">
        <figcaption class="figure-caption lead">Categories of music you would like to be played on the night</figcaption>
        <img src="/assets/images/planner/categories.png" class="figure-img img-fluid rounded shadow border mt-3" height="178" alt="">
      </figure>
    </div>

    <div class="col-sm">
      <h2 class="card-title">Preferred music decades</h2>
      <figure class="figure">
        <figcaption class="figure-caption lead">How contemporary/retro or focused on one or two decades to make the music</figcaption>
        <img src="/assets/images/planner/decades.png" class="figure-img img-fluid rounded shadow border mt-3" height="178" alt="">
      </figure>
    </div>
  </div>

  <div class="row align-items-start gx-5 mt-5">
    <div class="col-sm">
      <h2 class="card-title">Music policy</h2>
      <figure class="figure">
        <figcaption class="figure-caption lead">What you DON'T want to hear is as important as what you DO</figcaption>
        <img src="/assets/images/planner/policy.png" class="figure-img img-fluid rounded shadow border mt-3" height="178" alt="">
      </figure>
    </div>

    <div class="col-sm">
      <h2 class="card-title">Personalise your music</h2>
      <figure class="figure">
        <figcaption class="figure-caption lead">Details of first dance & last song of the night & an area to include any additional information</figcaption>
        <img src="/assets/images/planner/policy2.png" class="figure-img img-fluid rounded shadow border mt-3" height="178" alt="">
      </figure>
    </div>
    <p>Remember your guests will make requests on the night, so the DJ needs a guide to what you think is acceptable. There is an area to put banned songs, set your requests policy, microphone use by the DJ and your policy on cheese/guilty pleasures.</p>
  </div>
</section>

<div class="content-border__container content-section-link">
  <p class="lead">To book an event - submit an enquiry on our <a href="/contact">contact page</a></p>
</div>

<?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/list/regions.php'); ?>
