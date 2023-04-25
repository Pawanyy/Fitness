<?php require_once __DIR__ . "/include/layout-start.php"; ?>
<?php
session_destroy();
$helper->Redirect(BASE_URL);
?>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>