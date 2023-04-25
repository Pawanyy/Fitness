<?php require_once dirname(dirname(__DIR__)) . "/config/conn.php"; ?>
<!doctype html>
<html lang="en">

<head>
    <title>NSS</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once (dirname(__DIR__)) . "/include/header.php"; ?>
</head>

<body>
<style>
    main {
        min-height: 70vh;
    }
    
    .form-group {
        margin-bottom: 5px !important;
    }
    input[type=submit] {
        background-color: #448dfa;
        color: white;
    }
</style>
<?php require_once (dirname(__DIR__)) . "/include/navbar.php"; ?>
<?php require_once (dirname(__DIR__)) . "/include/sidebar.php"; ?>
<main id="main" class="main">

        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=ADMIN_URL?>">Home</a></li>
                    <li class="breadcrumb-item active"><?=$title?></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body pt-3">
        <?php require_once dirname(__DIR__) . "/include/toast.php"; ?>
