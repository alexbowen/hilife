<label for="filter-type" class="col-form-label col-sm-4<?php if(!empty($_GET['booking_type'])) { ?> text-bold<?php } ?>">Filter type</label>
<div class="col">
  <div class="input-group mb-1">
    <select name="booking_type" id="filter-type" class="form-select form-select-sm col-sm-8<?php if(!empty($_GET['booking_type'])) { ?> filter-control--active<?php } else { ?> filter-control--inactive<?php } ?>" data-auto-submit="true">
    <optgroup>
      <option value="" <?php if(!isset($_GET['booking_type'])) { ?>selected<?php } ?>>show all</option>
      <option value="direct" <?php if(isset($_GET['booking_type']) && $_GET['booking_type'] == 'direct') { ?>selected<?php } ?>>direct</option>
      <option value="package" <?php if(isset($_GET['booking_type']) && $_GET['booking_type'] == 'package') { ?>selected<?php } ?>>package</option>
    </select>
</optgroup>
  </div>
  <noscript>
    <div class="col">
      <button type="submit" class="btn btn-secondary btn-sm">filter</button>
    </div>
  </noscript>
</div>