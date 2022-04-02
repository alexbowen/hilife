<?php
$query = "SELECT * FROM users WHERE roles_mask='2'";
$djs = $database->query($query)->fetchAll();
?>

<label for="filter-dj" class="col-form-label col-sm-4<?php if(!empty($_GET['dj'])) { ?> text-bold<?php } ?>">Filter DJ</label>
<div class="col">
  <div class="input-group mb-1">
    <select name="dj" id="filter-dj" class="form-select form-select-sm col-sm-8<?php if(!empty($_GET['dj'])) { ?> filter-control--active<?php } else { ?> filter-control--inactive<?php } ?>" data-auto-submit="true">
      <option value="" <?php if (isset($_GET['dj'])) { ?>selected<?php } ?>>show all</option>
      <?php foreach ($djs as $dj) { ?>
        <option value="<?php echo $dj['id']; ?>" <?php if (isset($_GET['dj']) && $_GET['dj'] == $dj['id']) { ?>selected<?php } ?>><?php echo $dj['username']; ?></option>
      <?php } ?>
    </select>
  </div>
  <noscript>
    <div class="col">
      <button type="submit" class="btn btn-secondary btn-sm">filter</button>
    </div>
  </noscript>
</div>
