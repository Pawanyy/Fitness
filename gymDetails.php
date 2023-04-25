<?php require_once __DIR__ . "/include/layout-start.php"; ?>
<?php
$user_id = 0;
if($helper->isUserLogin()){
    $user_id = $_SESSION['uid'];
}

if(isset($_GET['gym_id']) && !empty($_GET['gym_id'])){
    $gym_id = $_GET['gym_id'];
    
    $sqlEventChk = "SELECT a.* FROM tbl_gyms a WHERE a.id = $gym_id";
    $resultEventChk = $conn -> query($sqlEventChk);
    $rowEvent = $resultEventChk -> fetch_assoc();
    
    if($rowEvent === false || empty($rowEvent)){
        $helper->SendErrorToast("Event Doesn't Exist!!");
        $helper->Redirect(BASE_URL . "gyms.php");
    }
    
} else {
    $helper->Redirect(BASE_URL . "gyms.php");
}

$sql = "SELECT a.*, null as r_date FROM tbl_gyms a WHERE a.id = $gym_id";

if($helper->isUserLogin()){
    // $sql = "SELECT a.*, (SELECT b.date FROM tbl_event_register b WHERE a.id=b.gym_id AND b.user_id = $user_id) AS reg_date FROM tbl_gyms a WHERE a.id = $gym_id; ";
}

$result = $conn -> query($sql);
$row = $result -> fetch_assoc();

$sqlPlans = "SELECT a.* FROM tbl_gym_plans a WHERE a.gym_id = $gym_id";
$resultPlans = $conn -> query($sqlPlans);
$gymPlans = $resultPlans -> fetch_all(MYSQLI_ASSOC);

$activities = [];
$activities = explode(",", $row['activities']);
?>
<main role="main">
    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">Gym Details</h1>
        </div>
    </section>
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title h2 mb-4">
                                <?=$row['name']?>
                            </h5>
                            <div class="d-flex justify-content-between">
                                <span>
                                    <i class="bi bi-person-fill-x"></i>
                                    <strong>for Phy Disabled: </strong>
                                    <?= $row['phy_disabled'] ? 'Yes' : 'No' ?>
                                </span>
                                <span>
                                    <i class="bi bi-geo-alt-fill"></i>
                                    <strong>Location: </strong>
                                    <?= $row['location'] ?>
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <?=$row['description']?>
                            </p>
                            <hr>
                            <div class="list-group">
                                <h2></h2>
                                <div class="list-group-item list-group-item-action active rounded h3">Activities</div>
                                <?php foreach($activities as $key => $value) { ?>
                                <div class="list-group-item"><?=$value?></div>
                                <?php } ?>
                            </div>
                            <!-- <?php if(empty($row['reg_date'])){ ?>
                            <a href="<?=BASE_URL?>gyms.php?gym_id=<?=$row['id']?>"
                                onclick="return confirm('Are you Sure to book for <?=$row['name']?> event!')"
                                class="btn btn-warning">Book</a>
                            <?php } else { ?>
                                <button class="btn btn-secondary">Already Booked</button>
                                <span class="d-block font-sm mt-2"> Registered on: <?= $row['reg_date'] ?></span>
                            <?php } ?> -->
                        </div>
                        <!-- <div class="card-footer">
                            <span><?= $row['date'] ?></span>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <h1 class="text-center">Plans</h1>
                </div>
                <?php 
                foreach($gymPlans as $key => $value) {
                    $facilities = [];
                    $facilities = explode(",", $value['facilities']);
                    ?>
                <div class="col-4">
                    <div class="card mb-4 rounded-3 shadow-sm text-center">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal"><?=$value['name']?></h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">
                                ₹<?=$value['price']?>
                                <small class="text-muted fw-light">/ <?=$value['duration']?> months</small>
                            </h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <?php foreach($facilities as $key => $facility) { ?>
                                <li><?=$facility?></li>
                                <?php } ?>
                            </ul>
                            <?php if($helper->isUserLogin()){ ?>
                                <form action="gyms.php" method="post">
                                    <input type="hidden" value="<?=$value['id']?>">
                                    <button type="submit" name="submit" class="w-100 btn btn-lg btn-outline-primary">Sign up for free</button>
                                </form>
                            <?php } else { ?>
                            <a href="login.php" class="w-100 btn btn-lg btn-outline-primary">Sign up for free</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</main>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>