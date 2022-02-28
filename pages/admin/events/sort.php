<label for="admin-sort" class="col-form-label">Sort by</label>
<div class="col">
  <div class="input-group mb-1">
    <select name="sort" id="admin-sort" class="form-select form-select-sm col-sm-8" data-auto-submit="true">
      <option value="created" <?php if($_GET['sort'] == 'created') { ?>selected<?php } ?>>event created - newest first</option>
      <option value="date" <?php if($_GET['sort'] == 'date' || !isset($_GET['sort'])) { ?>selected<?php } ?>>event date - soonest first</option>
      <option value="music" <?php if($_GET['sort'] == 'music') { ?>selected<?php } ?>>music - recently updated</option>
      <option value="details" <?php if($_GET['sort'] == 'details') { ?>selected<?php } ?>>details - recently updated</option>
    </select>
  </div>
  <noscript>
    <div class="col">
      <button type="submit" class="btn btn-secondary btn-sm">sort</button>
    </div>
  </noscript>
</div>
