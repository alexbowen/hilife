<section class="introduction content-section content-center">
  <h1>Forgot password</h1>
</section>

<div class="row authentication-form">
  <form name="emailform" action="/auth/reset" method="post" class="needs-validation form-signin" novalidate>
    <input type="email" id="email" name="email" class="form-control" placeholder="Your email address" required />
    <div class="invalid-feedback">
      You must enter a valid email address.
    </div>
    <div class="g-recaptcha" data-sitekey="<?php echo constant("GOOGLE_RECAPTCHA_SITEKEY"); ?>"></div>
    <div class="d-grid gap-2 my-4">
      <button type="submit" name="action" value="forgot" class="btn btn-success">Reset password</button>
    </div>
  </form>
</div>
