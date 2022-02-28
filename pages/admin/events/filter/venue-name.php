<?php
include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');

$query = "SELECT venue_name FROM package_clients";
$venues = $database->query($query)->fetchAll(PDO::FETCH_COLUMN);
?>

<label for="filter-venue" class="col-form-label">Filter venue</label>
<div class="col">
  <div class="input-group mb-1">
    <select name="venue" id="filter-venue" class="form-select form-select-sm col-sm-8" data-auto-submit="true">
    <option value="" <?php if(!isset($_GET['venue'])) { ?>selected<?php } ?>>show all</option>
    <?php foreach ($venues as $key => $venue) { ?>
      <option value="<?php echo $venue; ?>" <?php if($_GET['venue'] == $venue) { ?>selected<?php } ?>><?php echo $venue; ?></option>
      <?php } ?>
    </select>
  </div>
  <noscript>
    <div class="col">
      <button type="submit" class="btn btn-secondary btn-sm">filter</button>
    </div>
  </noscript>
</div>
