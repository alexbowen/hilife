<section class="introduction content-section">
  <div class="content-intro">
    <h1>Reset password</h1>
  </div>
</section>

<div class="row authentication-form">
  <form name="passwordresetform" action="/auth/reset" method="post" class="needs-validation form-signin" novalidate>

    <input type="password" id="password" class="form-control" minlength="8" maxlength="14" placeholder="Choose a password" aria-describedby="passwordHelp" required />
    <div id="passwordHelp" class="form-text">Your password must be 8-14 characters.</div>
    <div class="invalid-feedback">
      Password entered is not 8-14 characters.
    </div>

    <input type="password" id="password-match" name="password" placeholder="Re-enter password" class="form-control" required />
    <div class="invalid-feedback">
      Passwords do not match.
    </div>

    <div class="d-grid gap-2 my-4">
      <input type="hidden" name="selector" value="<?php echo $_GET['selector']; ?>" />
      <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>" />
      <button type="submit" name="action" value="new" class="btn btn-success"><i class="fas fa-sign-in-alt"></i> Reset password</button>
    </div>
  </form>
</div>
