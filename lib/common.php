<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/lib/utils.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/config/environment.php');
include ($_SERVER['DOCUMENT_ROOT'] . '/lib/database.php');

include ($_SERVER['DOCUMENT_ROOT'].'/config/regions.php');
$region_url_prefix = isset($_GET['region']) && $_GET['region'] != "leeds" ? "/" . $_GET['region'] : "";
?>