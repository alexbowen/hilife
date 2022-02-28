<?php if (count($_SESSION['notifications']) > 0) { ?>
  <?php foreach ($_SESSION['notifications'] as $notification) { ?>
    <div class="notification <?php echo $notification['type']; ?>">
      <p><?php echo $notification['message']; ?></p>
    </div>
  <?php } ?>
<?php } ?>

<?php $_SESSION['notifications'] = array(); ?>