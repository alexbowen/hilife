<section class="introduction content-section content-center">
  <h1>Music Planner Sign In</h1>
</section>

<div class="row authentication-form">
  <form name="emailform" action="/auth/sign-in" method="post" class="needs-validation auth-form form-signin" novalidate>
    <input type="email" id="email" name="email" class="form-control mb-2" placeholder="Email address" required />
    <div class="invalid-feedback">
      You must enter an email address.
    </div>

    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required />
    <div class="invalid-feedback">
      You must enter your password.
    </div>

    <div class="d-grid gap-2 mb-3">
      <button class="btn btn-success" type="submit" name="action" value="sign-in"><i class="fas fa-sign-in-alt"></i> Sign in</button>
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
      <a href="/account/register" class="btn btn-primary"><i class="fas fa-user-plus"></i> Create new account</a>
      
      <?php if (isset($_COOKIE['cookie-consent']) && $_COOKIE['cookie-consent'] == 'accepted') { ?>
      <p style="text-align:center">OR</p>
      <div class="social-login">
        <a href="<?php echo $fbLoginUrl; ?>" class="btn facebook-btn social-btn mb-2"><span><i class="fab fa-facebook-f"></i> Sign in with Facebook</span> </a>
        <a href="<?php echo $googleLoginUrl; ?>" class="btn google-btn social-btn"><span><i class="fab fa-google"></i> Sign in with Google</span> </a>
      </div>
      <?php } ?>
    </div>
  </form>
</div>
