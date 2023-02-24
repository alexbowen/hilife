<h1>Your account</h1>

<dl class="my-4">
  <dt>Email address</dt>
  <dd><?php echo $_SESSION['auth_email']; ?></dd>
</dl>

<?php if (!isset($_SESSION['fb_access_token']) && $user->signedIn()) { ?>
  <form name="deleteform" action="/auth/reset" method="post" class="">
    <input type="hidden" name="email" value="<?php echo $_SESSION['auth_email']; ?>" />
    <button type="submit" name="action" value="forgot" class="btn btn-sm btn-primary confirm-action" data-confirm-message="Are you sure you want to reset your password?">Reset your password</button>
  </form>

  <div class="my-4">
    <a class="btn btn-sm btn-danger" href="/account/delete">Delete your account</a>
  </div>
<?php } ?>