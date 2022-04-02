<?php
session_start();
include($_SERVER['DOCUMENT_ROOT'] . '/lib/common.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/lib/auth.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $regions[$_GET['region']]["page_title"]; ?></title>
    <?php include ('templates/head/meta.php'); ?>
    <?php include ('templates/head/scripts.php'); ?>
    <?php include ('templates/head/links.php'); ?>
  </head>

  <body>
    <?php include ('templates/head/gtm.php'); ?>

    <header>
      <div class="navigation-container">
        <?php include ('templates/navigation.php'); ?>
        <div class="header-fade"></div>
      </div>
    </header>

    <main role="main">
    <?php include ('templates/notification.php'); ?>
      <div class="container">
        <?php include ('pages/'.$_GET['page_name'].'.php'); ?>
      </div>
    </main>

    <?php include ('templates/cookies.php'); ?>

    <footer>
      <div class="footer-fade"></div>
      <?php include ('templates/footer.php'); ?>
    </footer>
  </body>
</html>
