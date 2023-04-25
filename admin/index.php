<?php
require_once (dirname(__DIR__)) . "/config/conn.php";

if($helper->IsAdminLogin()){
    $helper->Redirect(ADMIN_URL . "dashboard.php");
}

$helper->Redirect(ADMIN_URL . "login.php");