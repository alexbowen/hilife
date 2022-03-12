<?php
include_once ($_SERVER['DOCUMENT_ROOT'] . '/lib/notify.php');
?>

<?php
foreach (Notify::queue() as $notification) {
?>
  <div class="notification <?php echo $notification['type']; ?>">
    <p><?php echo $notification['message']; ?></p>
  </div>
<?php
}

Notify::flush()
?>
