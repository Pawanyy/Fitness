<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
session_destroy();
$helper->Redirect(BASE_URL);
?>