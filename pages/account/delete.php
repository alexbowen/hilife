<div class="content__container">
  <section class="introduction content-section">
      <h1>Delete your account</h1>
      <p class="lead text-danger">Warning: this will delete your account and any upcoming events will be cancelled</p>
      <form name="deleteform" action="/auth/delete" method="post" class="">
        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" name="events" value="delete" />
          <label class="form-check-label" for="flexRadioDefault2">
            permanently delete events
          </label>
        </div>
        <p class="lead">Do you want to delete your account <?php echo $_SESSION['auth_email']; ?>?</p>
        
        <input type="hidden" name="email" value="<?php echo $_SESSION['auth_email']; ?>" />
        <button type="submit" class="btn btn-danger confirm-action">delete account</button>
      </form>

  </section>
</div>