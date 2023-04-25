<?php
require_once dirname(__DIR__) . '/bootstrap.php';
session_start();

$database = new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);

$conn = $database->getConnectionMysqli();

$helper = new Helper();

$sqlSettings = "SELECT * FROM tbl_settings";
$resultSettings = $conn -> query($sqlSettings);
$settings = $resultSettings -> fetch_assoc();

$gallery = [
    "assets/img/gallery/0.jpg",
    "assets/img/gallery/00.jpg",
    // "assets/img/gallery/000.jpg",
    "assets/img/gallery/1.jpg",
    "assets/img/gallery/2.jpg",
    "assets/img/gallery/3.jpg",
    "assets/img/gallery/4.jpg",
    "assets/img/gallery/5.jpg",
    "assets/img/gallery/6.jpg",
    "assets/img/gallery/7.jpg",
    "assets/img/gallery/8.jpg",
    "assets/img/gallery/9.jpg",
    "assets/img/gallery/10.jpg",
    "assets/img/gallery/11.jpg",
    "assets/img/gallery/12.jpg",
    "assets/img/gallery/13.jpg",
];