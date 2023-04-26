<?php
$currentPage = "events";
?>
<?php require_once __DIR__ . "/include/layout-start.php"; ?>
<?php

    $user_id = 0;
    $sql = "SELECT a.*, null as r_date FROM tbl_gyms a";

    if($helper->isUserLogin()){
        $user_id = $_SESSION['uid'];
        // $sql = "SELECT a.*, (SELECT b.date FROM tbl_event_register b WHERE a.id=b.gym_id AND b.user_id = $user_id) AS reg_date FROM tbl_gyms a;";
    }

    if(isset($_GET['searchGym'])){
        $searchText = $_GET['searchText'];
        $phy_disabled = $_GET['phy_disabled'];

        $sql = "SELECT a.*, null as r_date FROM tbl_gyms a WHERE 1";

        if(!empty(trim($searchText))){
            $sql .= " AND (name LIKE '%$searchText%' OR location LIKE '%$searchText%' OR activities LIKE '%$searchText%')";
        }

        if($phy_disabled == 1){
            $sql .= " AND a.phy_disabled = 1";
        }
    }

    $result = $conn -> query($sql);
    $rows = $result -> fetch_all(MYSQLI_ASSOC);

    if(isset($_POST['register']) && $helper->isUserLogin()){
        $gym_id = $_POST['gym_id'];
        $plan_id = $_POST['plan_id'];
        $date = date('Y-m-d h:i:s A');

        $sqlGymChk = "SELECT a.*, (SELECT b.date FROM tbl_gym_register b WHERE a.id=b.gym_id AND b.user_id = $user_id AND b.plan_id = $plan_id) AS reg_date FROM tbl_gyms a WHERE a.id = $gym_id;";
        $resultGymChk = $conn -> query($sqlGymChk);
        $rowGym = $resultGymChk -> fetch_assoc();

        if($rowGym === false || empty($rowGym)){
            $helper->SendErrorToast("Gym Doesn't Exist!!");
            $helper->Redirect(BASE_URL . "gyms.php");
        }

        if( !empty($rowGym['r_date'])){
            $helper->SendErrorToast("Already Registered for $rowGym[name] Gym!!");
            $helper->Redirect(BASE_URL . "gyms.php");
        }

        $conn -> query("DELETE FROM tbl_gym_register WHERE gym_id = $gym_id AND user_id = $user_id");

        $sqlGymRegister = "INSERT INTO `tbl_gym_register`( `gym_id`, plan_id, `user_id`, `date`) 
                            VALUES ('$gym_id', '$plan_id', '$user_id','$date')";
        $resultGymRegister = $conn -> query($sqlGymRegister);

        echo $sqlGymRegister;

        if($resultGymRegister){
            $helper->SendSuccessToast("Registered for $rowGym[name] Gym!!");
            $helper->Redirect(BASE_URL . "gyms.php");
        } else {
            $helper->SendErrorToast("Cannot Registered for $rowGym[name] Gym!!");
            $helper->Redirect(BASE_URL . "gyms.php");
        }
    } else if(isset($_POST['register'])) {
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
            <h1 class="jumbotron-heading">Browse Gyms</h1>
            <p class="lead text-muted mx-5 px-5">You can Brouse For Gyms.</p>
            <p>
                <a href="/" class="btn btn-primary my-2">Home</a>
                <a href="<?=BASE_URL?>contact.php" class="btn btn-secondary my-2">Contact Us</a>
            </p>
            <form class="row mx-5 text-start" method='get'>
                <div class="col-8">
                    <input type="search" class="form-control" name="searchText" placeholder="Search" value="<?=isset($_GET['searchText']) ? $_GET['searchText'] : ''?>">
                </div>
                <div class="col-2">
                    <select name="phy_disabled" class="form-control" required>
                        <option value="0">All</option>
                        <option value="1" <?=isset($_GET['phy_disabled']) && $_GET['phy_disabled'] == 1 ? 'Selected' : ''?>>Phy Disabled</option>
                    </select>
                </div>
                <div class="col-2">
                    <button type="submit" name="searchGym" class="btn btn-primary w-100">Search</button>
                </div>
            </form>
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
                                    <a href="<?=BASE_URL?>gymDetails.php?gym_id=<?=$value['id']?>"
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