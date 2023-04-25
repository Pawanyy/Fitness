<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

$title = "Dashboard";
require_once __DIR__ . "/include/layout-start.php"; 
?>
    <div class="py-5 text-center">
        <h1 class="my-5">Welcome, Admin</h1>
    </div>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>