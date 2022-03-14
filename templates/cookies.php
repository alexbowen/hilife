<?php if (!isset($_COOKIE['cookie-consent'])) { ?>
<div class="cookies-banner border-top border-light">
  <div class="row">
    <div class="col-6 text-end">
      <p class="fs-5 mb-2">Do you accept the use of cookies?</p>
    </div>
    <div class="col-6 text-start">
      <form action="/actions/cookies" method="post">
        <button type="submit" class="btn btn-sm btn-success me-2 mb-1 mb-md-0" value="accept" name="cookies">accept cookies</button>
        <button type="submit" class="btn btn-sm btn-warning" value="decline" name="cookies">decline cookies</button>
      </form>
    </div>
  </div>
  <div class="row">
    <p class="text-center">Click <a href="/cookies">here</a> to see how cookies are used</p>
  </div>
</div>
<?php } ?>
