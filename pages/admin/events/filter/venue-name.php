<?php
$query = "SELECT venue_name FROM package_clients";
$venues = $database->query($query)->fetchAll(PDO::FETCH_COLUMN);
?>

<label for="filter-venue" class="col-form-label<?php if(!empty($_GET['venue'])) { ?> text-bold<?php } ?>">Filter venue</label>
<div class="col">
  <div class="input-group mb-1">
    <select name="venue" id="filter-venue" class="form-select form-select-sm col-sm-8<?php if(!empty($_GET['venue'])) { ?> filter-control--active<?php } else { ?> filter-control--inactive<?php } ?>" data-auto-submit="true">
    <option value="" <?php if(!isset($_GET['venue'])) { ?>selected<?php } ?>>show all</option>
    <?php foreach ($venues as $key => $venue) { ?>
      <option value="<?php echo $venue; ?>" <?php if(isset($_GET['venue']) && $_GET['venue'] == $venue) { ?>selected<?php } ?>><?php echo $venue; ?></option>
      <?php } ?>
    </select>
  </div>
  <noscript>
    <div class="col">
      <button type="submit" class="btn btn-secondary btn-sm">filter</button>
    </div>
  </noscript>
</div>
