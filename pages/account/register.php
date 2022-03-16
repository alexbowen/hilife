<section class="introduction content-section content-center">
  <h1>Music Planner Registration</h1>
</section>

<div class="row authentication-form">
  <form name="emailform" action="/auth/register" method="post" class="needs-validation form-signin" novalidate>
    <input type="email" id="email" name="email" maxlength="50" class="form-control mt-4" placeholder="Enter your email address" required />
    <div class="invalid-feedback">
      Invalid email address.
    </div>

    <input type="text" id="username" name="username" minlength="6" maxlength="20" class="form-control mt-4" placeholder="Choose a username" aria-describedby="usernameHelp" required />
    <div id="usernameHelp" class="form-text">Your username must be 6-20 characters.</div>
    <div class="invalid-feedback">
      Invalid username
    </div>

    <input type="password" id="password" class="form-control mt-4" minlength="8" maxlength="14" placeholder="Choose a password" aria-describedby="passwordHelp" required />
    <div id="passwordHelp" class="form-text">Your password must be 8-14 characters.</div>
    <div class="invalid-feedback">
      Password entered is not 8-14 characters.
    </div>

    <input type="password" id="password-match" name="password" class="form-control mt-4" placeholder="Re-enter password" required />
    <div class="invalid-feedback">
      Passwords do not match.
    </div>

    <div class="d-grid gap-2 my-4">
      <button type="submit" name="action" value="register" class="btn btn-success"><i class="fas fa-sign-in-alt"></i> Register</button>
    </div>
  </form>
</div>       
