<section class="introduction content-section content-center">
  <h1>Music planner sign in</h1>
</section>

<div class="row authentication-form">
  <form name="emailform" action="/auth/sign-in" method="post" class="needs-validation auth-form form-signin" novalidate>
    <?php if (isset($_GET['redirect'])) { ?>
    <input type="hidden" name="redirect" value="<?php echo $_GET['redirect']; ?>" />
    <?php } ?>
    <input type="email" id="email" name="email" class="form-control mb-2" placeholder="Email address" required />
    <div class="invalid-feedback">
      You must enter an email address.
    </div>

    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required />
    <div class="invalid-feedback">
      You must enter your password.
    </div>

    <div class="d-grid gap-2 mb-3">
      <button class="btn btn-success" type="submit" name="action" value="sign-in"><i class="fas fa-sign-in-alt me-1"></i> Sign in</button>
      <div class="row">
        <div class="col-6">
            <a href="/account/forgot-password" id="forgot_pswd">Forgot password?</a>
        </div>
        <div class="col-6 text-end">
          <?php if (isset($_COOKIE['cookie-consent']) && $_COOKIE['cookie-consent'] == 'accepted') { ?>
          <label class="form-check-label" for="remember">Remember me</label>
          <input type="checkbox" id="remember" name="remember" class="form-check-input" <?php if (isset($_COOKIE['hilife-remember-user'])) { ?>checked<?php } ?>>
          <?php } ?>
        </div>
      </div>
      <hr>
      <a href="/account/register" class="btn btn-primary"><i class="fas fa-user-plus me-1"></i> Create new account</a>
      
      <?php if (isset($_COOKIE['cookie-consent']) && $_COOKIE['cookie-consent'] == 'accepted') { ?>
      <p style="text-align:center">OR</p>
      <div class="social-login">
        <a href="<?php echo $fbLoginUrl; ?>" class="btn facebook-btn social-btn mb-2"><span><i class="fa-brands fa-facebook me-1"></i> Sign in with Facebook</span> </a>
        <a href="<?php echo $googleLoginUrl; ?>" class="btn google-btn social-btn"><span><i class="fa-brands fa-google me-1"></i> Sign in with Google</span> </a>
      </div>
      <?php } ?>
    </div>
  </form>
</div>
