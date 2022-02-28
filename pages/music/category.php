<div class="content-section__article">
  <h3><?php echo $genre['title']; ?></h3>
  <div class="clearfix mb-3">
    <img height="150" width="175" src="/assets/images/music/<?php echo $genre['image']['file']; ?>" alt="<?php echo $genre['image']['alt']; ?>" class="img-fluid img-thumbnail rounded float-start mb-1 me-3" />
    <?php foreach ($genre['about'] as $about) { ?>
    <p><?php echo $about; ?></p>
    <?php } ?>
    <button class="toggle-control btn btn-secondary btn-sm" data-content-id="toggle-content-<?php echo $key; ?>">Click to show example playlist</button>
  </div>
  <div class="card card-full-width toggle-content toggle-content--hidden" id="toggle-content-<?php echo $key; ?>">
    <div class="row admin">
    <?php foreach ($genre['playlist'] as $track) { ?>
      <span class="col-md-6"><?php echo $track; ?></span>
    <?php } ?>
    </div>
  </div>
</div>