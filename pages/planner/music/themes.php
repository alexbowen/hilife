<?php
include $_SERVER['DOCUMENT_ROOT'].'/lib/event.php';

$event = EventFactory::create(array(
  'events.id' => $_GET['id'],
  'email' => $_SESSION['auth_email']
), true);

$query = "SELECT * FROM music_categories";
$categories = $database->query($query);

$query = "SELECT * FROM music_decades";
$decades = $database->query($query);

$section = 'themes';
?>

<section class="content-section">
  
  <?php include ('navigation.php'); ?>
  <form name="eventmusic" action="/actions/planner/themes?id=<?php echo $event->id; ?>" method="post" data-auto-submit="true">
    <div class="content-tabs__container admin mb-3">
      <input type="hidden" name="id" value="<?php echo $event->id; ?>" />
      <input type="hidden" name="action" value="update-auto" />

      <h5>Categories</h5>
      <fieldset>Select categories of music you want playing at you event here.</fieldset>
      <p class="label-info">You can optionally mark selected categories as favourite if you would like the DJ to weight the music towards this category.</p>

      <div class="row my-3 planner-checkbox-list content-section">  
        <?php foreach ($categories as $category) { ?>
        <div class="col col-12 col-lg-4 d-flex">
          <?php $category_selected = array_keys(array_column($event->categories, 'id'), $category['id']); ?>
        
          <div class="form-check form-check-inline w-50">
            <input type="checkbox" name="categories[]" id="category-<?php echo $category['id']; ?>" value="<?php echo $category['id']; ?>" class="form-check-input" <?php if (count($category_selected) > 0) { ?> checked<?php } ?> />
            <label for="category-<?php echo $category['id']; ?>" class="form-check-label"><?php echo $category['title']; ?></label>
          </div>

          <?php if (count($category_selected) > 0) { ?>
          <div class="form-check form-check-inline flex-grow-1 text-start favourite">
            <input type="checkbox" name="category-favourites[]" id="category-favourite-<?php echo $category['id']; ?>" value="<?php echo $category['id']; ?>" class="form-check-input" <?php if (count($category_selected) > 0 && $event->categories[$category_selected[0]]['favourite'] === "1") { ?> checked<?php } ?> />
            <label for="category-favourite-<?php echo $category['id']; ?>" class="form-check-label">favourite</label>
          </div>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
    </div>

    <div class="content-border__container admin">
      <h5>Decades</h5>
      <fieldset>Select decades of music you want playing at you event here.</fieldset>
      <p class="label-info">You can optionally mark selected decades as favourite if you would like the DJ to weight the music towards this decade.</p>

      <div class="row my-3 planner-checkbox-list content-section">
        <?php foreach ($decades as $decade) { ?>
        <div class="col col-12 col-lg-4 d-flex">
          <?php $decade_selected = array_keys(array_column($event->decades, 'id'), $decade['id']); ?>
          <div class="form-check form-check-inline w-50">
            <input type="checkbox" name="decades[]" id="decade-<?php echo $decade['id']; ?>" value="<?php echo $decade['id']; ?>" class="form-check-input" <?php if (count($decade_selected) > 0) { ?> checked<?php } ?> />
            <label for="decade-<?php echo $decade['id']; ?>" class="form-check-label"><?php echo $decade['title']; ?></label>
          </div>

          <?php if (count($decade_selected) > 0) { ?>
          <div class="form-check form-check-inline flex-grow-1 text-start favourite">
            <input type="checkbox" name="decade-favourites[]" id="decade-favourite-<?php echo $decade['id']; ?>" value="<?php echo $decade['id']; ?>" class="form-check-input" <?php if (count($decade_selected) > 0 && $event->decades[$decade_selected[0]]['favourite'] === "1") { ?> checked<?php } ?> />
            <label for="decade-favourite-<?php echo $decade['id']; ?>" class="form-check-label">favourite</label>
          </div>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
    </div>
  </form>

  <form name="eventmusic" action="/actions/planner/themes?id=<?php echo $event->id; ?>" method="post">
    <input type="hidden" name="id" value="<?php echo $event->id; ?>" />
    <div class="content-border__container admin">
      <h5>Additional requirements</h5>
      <div class="row my-3">
          <div class="col">
            <textarea name="additional" class="form-control" rows="6"><?php echo $event->additional; ?></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="row my-2">
              <label for="event-first-dance" class="col-form-label col-4">First dance</label>
              <div class="col-8">
                <input type="text" name="first_dance" id="event-first-dance" value="<?php echo $event->first_dance; ?>" class="form-control" />
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row my-2">
              <label for="event-last-dance" class="col-form-label col-4">Last dance</label>
              <div class="col-8">
                <input type="text" name="last_dance" id="event-last-dance" value="<?php echo $event->last_dance; ?>" class="form-control" />
              </div>
            </div>
          </div>
        </div>

      <div class="row text-end">
        <div class="d-grid gap-2 d-md-block">
          <button type="submit" name="action" value="update" class="btn btn-sm btn-secondary">save themes</button>
        </div>
      </div>
    </div>
  </form>
</section>
