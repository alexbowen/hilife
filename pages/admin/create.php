<?php $adminPage = "create"; ?>

<section class="content-section">
  <?php include ($_SERVER['DOCUMENT_ROOT'].'/pages/admin/navigation.php'); ?>
  <div class="content-tabs__container admin">
    <h4 class="text-center">Choose booking type</h4>

    <div class="container my-4">
      <div class="row justify-content-center my-2">
        <div class="col-4 d-grid gap-2">
          <a href="/admin/create/direct" class="btn btn-secondary btn-sm">direct</a>
        </div>
      </div>

      <div class="row justify-content-center my-2">
        <div class="col-4 d-grid gap-2">
          <a href="/admin/create/package" class="btn btn-secondary btn-sm">package</a>
        </div>
      </div>
    </div>
  </div>
</section>
