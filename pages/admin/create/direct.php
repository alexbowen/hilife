<section class="content-section">
  <h1>Create event from direct contact</h1>
  <div class="content-border__container admin">
    <form action="/actions/event" method="post" class="needs-validation admin-form" novalidate>
      <input type="hidden" name="admin[booking_type]" value="direct" />
      <input type="hidden" name="admin[status]" value="pending" />
      <?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/event/form.php'); ?>
      <?php include ($_SERVER['DOCUMENT_ROOT'].'/templates/event/admin/form.php'); ?>
      <div class="row text-end">
        <div class="d-grid gap-2 d-md-block mt-1">
          <a class="btn btn-danger btn-sm" href="/admin/events">cancel</a>
          <button type="submit" name="action" value="create" class="btn btn-primary btn-sm">create new event</button>
        </div>
      </div>
    </form>
  </div>
</section>