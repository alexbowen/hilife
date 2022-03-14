<section class="content-section">
  <div class="content-intro">
    <h1>Cookies</h1>
    <p class="lead">How cookies are used on this website</p>
  </div>
</section>

<section class="content-section">
  <h4>Your cookie settings</h4>
  <?php if (isset($_COOKIE['cookie-consent'])) { ?>
    <form action="/actions/cookies" method="post">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="cookies" value="accept" <?php if (isset($_COOKIE['cookie-consent']) && $_COOKIE['cookie-consent'] == 'accepted') { ?>checked<?php } ?> />
        <label class="form-check-label" for="flexRadioDefault2">
          cookies accepted
        </label>
      </div>

      <div class="form-check">
        <input class="form-check-input" type="radio" name="cookies" value="decline" <?php if (isset($_COOKIE['cookie-consent']) && $_COOKIE['cookie-consent'] == 'declined') { ?>checked<?php } ?> />
        <label class="form-check-label" for="flexRadioDefault2">
          cookies declined
        </label>
      </div>

      <button type="submit" class="btn btn-sm btn-secondary my-3">save setting</button>
      <p><i>Please note: we have to use a cookie to honour your setting but this holds an accepted/declined value only.</i></p>
    </form>
    <?php } else { ?>
      <p>You have not stated a preference.</p>
      <?php } ?>
    <h4>Functionality</h4>
    <p>If you consent to cookies the following functionality is enabled:</p>
    <ul>
      <li>Login remember me (1 month)</li>
      <li>Facebook login option</li>
      <li>Google login option</li>
    </ul>
    <p>The following standard Google cookies will be stored for analytics:</p>
    <ul>
      <li>_gat_gtag_UA_</li>
      <li>_ga</li>
      <li>_gid</li>
    </ul>
    <p>If you do not consent to cookies then Google site traffic (analytics) data collection is completely disabled.</p>
  </section>

<section class="content-section">
  <h4>More infomation</h4>
  <p>If you have any further questions about use of cookies:</p>
  <ul>
    <li>speak to Mark on <a href="tel:07828688144" class="contact">07828 688144</a></li>
    <li>send email to <a href="mailto:mark@thehi-life.co.uk" class="contact">mark@thehi-life.co.uk</a></li>
  </ul>
</section>
