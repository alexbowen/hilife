<div class="row admin event-date-input">
  <div class="col-4">
    <select id="event-year" name="dateInput[year]" class="form-select form-select-sm" data-date-part="year" required>
      <option value="">Select year</option>
      <?php for ($y = date('Y'); $y <= date('Y') + 5; $y++) { ?>
      <option value="<?php echo $y; ?>" <?php if ($event->year == $y) { ?> selected<?php } ?>><?php echo $y; ?></option>
      <?php } ?>
    </select>
    <div class="invalid-feedback">
      Select date for event
    </div>
  </div>

  <div class="col-4">
    <select id="event-month" name="dateInput[month]" class="form-select form-select-sm" data-date-part="month" required>
      <option value="">Select month</option>
      <?php for ($m = 1; $m <= 12; $m++) { ?>
      <?php $dateObj = DateTime::createFromFormat('!m', $m); ?>
      <option value="<?php echo $m; ?>"<?php if ($event->month == $m) { ?> selected<?php } ?>><?php echo $dateObj->format('F'); ?></option>
      <?php } ?>
    </select>
  </div>

  <div class="col-4">
    <select id="event-day" name="dateInput[day]" class="form-select form-select-sm" data-date-part="day" required>
      <option value="">Select date</option>
      <?php for ($d = 1; $d <= 31; $d++) { ?>
      <option value="<?php echo $d; ?>" <?php if ($event->day == $d) { ?> selected<?php } ?>><?php echo $d; ?></option>
      <?php } ?>
    </select>
  </div>
</div>