<?php
$query = "SELECT * FROM users WHERE roles_mask='2'";
$djs = $database->query($query)->fetchAll();
?>

<label for="filter-dj" class="col-form-label col-sm-4">Filter DJ</label>
<div class="col">
  <div class="input-group mb-1">
    <select name="dj" id="filter-dj" class="form-select form-select-sm col-sm-8" data-auto-submit="true">
      <option value="" <?php if (empty($_GET['dj'])) { ?>selected<?php } ?>>show all</option>
      <?php foreach ($djs as $dj) { ?>
        <option value="<?php echo $dj['username']; ?>" <?php if ($_GET['dj'] == $dj['username']) { ?>selected<?php } ?>><?php echo $dj['username']; ?></option>
      <?php } ?>
    </select>
  </div>
  <noscript>
    <div class="col">
      <button type="submit" class="btn btn-secondary btn-sm">filter</button>
    </div>
  </noscript>
</div>
