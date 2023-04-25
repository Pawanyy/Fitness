<?php
require_once dirname(__DIR__) . '/bootstrap.php';
session_start();

$database = new Database($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USER'], $_ENV['DB_PASS']);

$conn = $database->getConnectionMysqli();

$helper = new Helper();

$sqlSettings = "SELECT * FROM tbl_settings";
$resultSettings = $conn -> query($sqlSettings);
$settings = $resultSettings -> fetch_assoc();

$gallery = [];
$special_gallery = [];

$all_files = glob("assets/img/gallery/special/*.*");
for ($i=0; $i<count($all_files); $i++)
{
    $image_name = $all_files[$i];
    $supported_format = array('gif','jpg','jpeg','png');
    $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    if (in_array($ext, $supported_format))
        {
            $special_gallery[] = $image_name;
            $gallery[] = $image_name;
        } else {
            continue;
        }
}

$all_files = glob("assets/img/gallery/*.*");
for ($i=0; $i<count($all_files); $i++)
{
    $image_name = $all_files[$i];
    $supported_format = array('gif','jpg','jpeg','png');
    $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
    if (in_array($ext, $supported_format))
        {
            $gallery[] = $image_name;
            //echo $image_name . "<br /><br />";
        } else {
            continue;
        }
}