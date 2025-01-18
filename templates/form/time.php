<?php
$ranges = array(
  "setup" => array(
    "earliest" => 9,
    "latest" => 27
  ),
  "start" => array(
    "earliest" => 10,
    "latest" => 27
  ),
  "finish" => array(
    "earliest" => 12,
    "latest" => 30
  )
);

?>

<div class="row admin event-time-input" data-order="<?php echo $eventTime['order']; ?>">
  <div class="col-6">
    <select name="<?php echo $eventTime['key']; ?>TimeInput[hours]" class="form-select form-select-sm" data-time-part="hours">
      <option value="">hour</option>
      <?php for ($h = $ranges[$eventTime['key']]['earliest']; $h <= $ranges[$eventTime['key']]['latest']; $h++) { ?>
      <?php
        if ($h > 23) {
          $value = $h - 24;
        } else {
          $value = $h;
        }

        switch ($h) {
          case $h > 24:     
            $display = $h - 24;
            $postfix = 'am';
      
            break;

          case $h == 24:
            $display = "";
            $postfix = ' Midnight';

            break;

          case $h == 12:
            $display = "";
            $postfix = ' Noon';

            break;
      
          case $h > 12:
            $display = $h - 12;
            $postfix = 'pm';

            break;

          default:

            $display = $h;
            $postfix = 'am';

        }
      ?>
      <option value="<?php echo $value; ?>" <?php if ($eventTime['hour'] == strval($value)) { ?> selected<?php } ?>><?php echo $display . $postfix; ?></option>
      <?php } ?>
    </select>
    <div class="invalid-feedback">
      timing is invalid
    </div>
  </div>

  <div class="col-6">
    <select name="<?php echo $eventTime['key']; ?>TimeInput[minutes]" class="form-select form-select-sm" data-time-part="minutes">
      <option value="">minutes</option>
      <option value="0" <?php if ($eventTime['minutes'] == "0") { ?> selected<?php } ?>>00</option>
      <option value="15" <?php if ($eventTime['minutes'] == "15") { ?> selected<?php } ?>>15</option>
      <option value="30" <?php if ($eventTime['minutes'] == "30") { ?> selected<?php } ?>>30</option>
      <option value="45" <?php if ($eventTime['minutes'] == "45") { ?> selected<?php } ?>>45</option>
    </select>
  </div>
</div>