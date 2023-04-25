<?php
$currentPage = "events";
?>
<?php require_once __DIR__ . "/include/layout-start.php"; ?>
<?php

    $user_id = 0;
    $sql = "SELECT a.*, null as r_date FROM tbl_events a";

    if($helper->isUserLogin()){
        $user_id = $_SESSION['uid'];
        $sql = "SELECT a.*, (SELECT b.date FROM tbl_event_register b WHERE a.id=b.event_id AND b.user_id = $user_id) AS reg_date FROM tbl_events a;";
    }

    $result = $conn -> query($sql);
    $rows = $result -> fetch_all(MYSQLI_ASSOC);

    if(isset($_GET['event_id']) && $helper->isUserLogin()){
        $event_id = $_GET['event_id'];
        $date = date('Y-m-d h:i:s A');

        $sqlEventChk = "SELECT a.*, (SELECT b.date FROM tbl_event_register b WHERE a.id=b.event_id AND b.user_id = $user_id) AS reg_date FROM tbl_events a WHERE a.id = $event_id;";
        $resultEventChk = $conn -> query($sqlEventChk);
        $rowEvent = $resultEventChk -> fetch_assoc();

        if($rowEvent === false || empty($rowEvent)){
            $helper->SendErrorToast("Event Doesn't Exist!!");
            $helper->Redirect(BASE_URL . "events.php");
        }

        if( !empty($rowEvent['r_date'])){
            $helper->SendErrorToast("Already Registered for $rowEvent[name] Event!!");
            $helper->Redirect(BASE_URL . "events.php");
        }

        $sqlEventRegister = "INSERT INTO `tbl_event_register`( `event_id`, `user_id`, `date`) 
                            VALUES ('$event_id','$user_id','$date')";
        $resultEventRegister = $conn -> query($sqlEventRegister);

        if($resultEventRegister){
            $helper->SendSuccessToast("Registered for $rowEvent[name] Event!!");
            $helper->Redirect(BASE_URL . "events.php");
        } else {
            $helper->SendErrorToast("Cannot Registered for $rowEvent[name] Event!!");
            $helper->Redirect(BASE_URL . "events.php");
        }
    } else if(isset($_GET['event_id'])) {
        $helper->Redirect(BASE_URL . "login.php");
    }
?>
<style>
    .card-body .detail .title {
        font-size: 18px !important;
        font-weight: 500 !important;
        margin-bottom: 10px !important;
    }
    .card-body .detail .title a, .detail .location a {
        text-decoration: none !important;
    }
    .card-body .detail .location a {
        font-size: 13px;
        color: #535353;
        font-weight: 400;
    }

    .card-body .detail .location {
        margin: 0 0 15px;
    }

    .card-body ul li {
        list-style: none;
        width: 50%;
        float: left;
        font-weight: 400;
        line-height: 35px;
        font-size: 13px;
    }
</style>
<main role="main">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Browse Events</h1>
            <p class="lead text-muted mx-5 px-5">You can Brouse For Events.</p>
            <p>
                <a href="/" class="btn btn-primary my-2">Home</a>
                <a href="<?=BASE_URL?>contact.php" class="btn btn-secondary my-2">Contact Us</a>
            </p>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <?php foreach ($rows as $key => $value) { ?>
                    <div class="col-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <?=$value['name']?>
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    <?=substr($value['description'], 0, 255)."..."?>
                                    <a href="<?=BASE_URL?>eventDetails.php?event_id=<?=$value['id']?>"
                                    class="btn btn-link text-decoration-none p-0">Read more</a>
                                </p>
                                <?php if(empty($value['reg_date'])){ ?>
                                <a href="<?=BASE_URL?>events.php?event_id=<?=$value['id']?>"
                                    onclick="return confirm('Are you Sure to book for <?=$value['name']?> event!')"
                                    class="btn btn-warning">Book</a>
                                    <?php } else { ?>
                                        <button class="btn btn-secondary">Already Booked</button>
                                        <span class="d-block font-sm mt-2"> Registered on: <?= $value['reg_date'] ?></span>
                                    <?php } ?>
                            </div>
                            <div class="card-footer">
                                <span><?= $value['date'] ?></span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</main>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>