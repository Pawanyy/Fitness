<?php
$currentPage = "events";
?>
<?php require_once __DIR__ . "/include/layout-start.php"; ?>
<?php

    $user_id = 0;
    $sql = "SELECT a.*, null as r_date FROM tbl_gyms a";

    // if($helper->isUserLogin()){
    //     $user_id = $_SESSION['uid'];
    //     $sql = "SELECT a.*, (SELECT b.date FROM tbl_event_register b WHERE a.id=b.event_id AND b.user_id = $user_id) AS reg_date FROM tbl_gyms a;";
    // }

    $result = $conn -> query($sql);
    $rows = $result -> fetch_all(MYSQLI_ASSOC);

    // if(isset($_GET['event_id']) && $helper->isUserLogin()){
    //     $event_id = $_GET['event_id'];
    //     $date = date('Y-m-d h:i:s A');

    //     $sqlEventChk = "SELECT a.*, (SELECT b.date FROM tbl_event_register b WHERE a.id=b.event_id AND b.user_id = $user_id) AS reg_date FROM tbl_gyms a WHERE a.id = $event_id;";
    //     $resultEventChk = $conn -> query($sqlEventChk);
    //     $rowEvent = $resultEventChk -> fetch_assoc();

    //     if($rowEvent === false || empty($rowEvent)){
    //         $helper->SendErrorToast("Event Doesn't Exist!!");
    //         $helper->Redirect(BASE_URL . "gyms.php");
    //     }

    //     if( !empty($rowEvent['r_date'])){
    //         $helper->SendErrorToast("Already Registered for $rowEvent[name] Event!!");
    //         $helper->Redirect(BASE_URL . "gyms.php");
    //     }

    //     $sqlEventRegister = "INSERT INTO `tbl_event_register`( `event_id`, `user_id`, `date`) 
    //                         VALUES ('$event_id','$user_id','$date')";
    //     $resultEventRegister = $conn -> query($sqlEventRegister);

    //     if($resultEventRegister){
    //         $helper->SendSuccessToast("Registered for $rowEvent[name] Event!!");
    //         $helper->Redirect(BASE_URL . "gyms.php");
    //     } else {
    //         $helper->SendErrorToast("Cannot Registered for $rowEvent[name] Event!!");
    //         $helper->Redirect(BASE_URL . "gyms.php");
    //     }
    // } else if(isset($_GET['event_id'])) {
    //     $helper->Redirect(BASE_URL . "login.php");
    // }
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
            <h1 class="jumbotron-heading">Browse Gyms</h1>
            <p class="lead text-muted mx-5 px-5">You can Brouse For Gyms.</p>
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
                    <div class="col-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">
                                    <?=$value['name']?>
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text">
                                    <?=substr($value['description'], 0, 255)."..."?>
                                    <a href="<?=BASE_URL?>gymDetails.php?event_id=<?=$value['id']?>"
                                    class="btn btn-link text-decoration-none p-0">Read more</a>
                                </p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <span>
                                    <i class="bi bi-person-fill-x"></i>
                                    <strong>for Phy Disabled: </strong>
                                    <?= $value['phy_disabled'] ? 'Yes' : 'No' ?>
                                </span>
                                <span>
                                    <i class="bi bi-geo-alt-fill"></i> 
                                    <strong>Location: </strong>
                                    <?= $value['location'] ?>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</main>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>