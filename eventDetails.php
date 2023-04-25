<?php require_once __DIR__ . "/include/layout-start.php"; ?>
<?php
$user_id = 0;
if($helper->isUserLogin()){
    $user_id = $_SESSION['uid'];
}

if(isset($_GET['event_id']) && !empty($_GET['event_id'])){
    $event_id = $_GET['event_id'];
    
    $sqlEventChk = "SELECT a.* FROM tbl_events a WHERE a.id = $event_id";
    $resultEventChk = $conn -> query($sqlEventChk);
    $rowEvent = $resultEventChk -> fetch_assoc();
    
    if($rowEvent === false || empty($rowEvent)){
        $helper->SendErrorToast("Event Doesn't Exist!!");
        $helper->Redirect(BASE_URL . "events.php");
    }
    
} else {
    $helper->Redirect(BASE_URL . "events.php");
}

$sql = "SELECT a.*, null as r_date FROM tbl_events a WHERE a.id = $event_id";

if($helper->isUserLogin()){
    $sql = "SELECT a.*, (SELECT b.date FROM tbl_event_register b WHERE a.id=b.event_id AND b.user_id = $user_id) AS reg_date FROM tbl_events a WHERE a.id = $event_id; ";
}

$result = $conn -> query($sql);
$row = $result -> fetch_assoc();
?>
<main role="main">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Event Details</h1>
        </div>
    </section>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <?=$row['name']?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?=$row['description']?>
                            </p>
                            <?php if(empty($row['reg_date'])){ ?>
                            <a href="<?=BASE_URL?>events.php?event_id=<?=$row['id']?>"
                                onclick="return confirm('Are you Sure to book for <?=$row['name']?> event!')"
                                class="btn btn-warning">Book</a>
                                <?php } else { ?>
                                    <button class="btn btn-secondary">Already Booked</button>
                                    <span class="d-block font-sm mt-2"> Registered on: <?= $row['reg_date'] ?></span>
                                <?php } ?>
                        </div>
                        <div class="card-footer">
                            <span><?= $row['date'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>