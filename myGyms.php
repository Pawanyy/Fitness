<?php require_once __DIR__ . "/include/layout-start.php"; ?>
<?php
if( ! $helper->isUserLogin()){
    $helper->Redirect(BASE_URL . 'login.php');
}

$user_id = $_SESSION['uid'];

if(isset($_GET['gym_id']) && !empty($_GET['gym_id'])){
    $gym_id = $_GET['gym_id'];
    
    $sqlGymChk = "SELECT a.* FROM tbl_gyms a WHERE a.id = $gym_id";
    $resultGymChk = $conn -> query($sqlGymChk);
    $rowGym = $resultGymChk -> fetch_assoc();
    
    if($rowGym === false || empty($rowGym)){
        $helper->SendErrorToast("Gym Doesn't Exist!!");
        $helper->Redirect(BASE_URL . "myGyms.php");
    }

    $conn -> query("DELETE FROM tbl_gym_register WHERE gym_id = $gym_id AND user_id = $user_id");
    $helper->SendSuccessToast("Gym Plan Canceled Successfully!!");
        $helper->Redirect(BASE_URL . "myGyms.php");
    
}

$sql = "SELECT a.*, b.plan_id, c.name AS plan_name, c.price AS plan_price, b.date AS r_date FROM tbl_gyms a LEFT JOIN tbl_gym_register b ON a.id = b.gym_id LEFT JOIN tbl_gym_plans c ON c.id = b.plan_id  WHERE b.user_id = $user_id";
$result = $conn -> query($sql);
$rows = $result -> fetch_all(MYSQLI_ASSOC);
?>
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">My Gyms</h1>
        <p class="lead text-muted mx-5 px-5">You can browse your Registered Gyms.</p>
    </div>
</section>

<div class="table-responsive">
    <table class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Gym Name</th>
                <th scope="col">Gym Date</th>
                <th scope="col">Plan Name</th>
                <th scope="col">Plan Price</th>
                <th scope="col">Register At</th>
                <th scope="col">Details</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sl = 0;
            foreach ($rows as $key => $value) { 
                $sl++;
            ?>
                <tr>
                    <th scope="row"><?=$sl?></th>
                    <td><?=$value['name']?></td>
                    <td><?=$value['date']?></td>
                    <td><?=$value['plan_name']?></td>
                    <td><?=$value['plan_price']?></td>
                    <td><?=$value['r_date']?></td>
                    <td>
                        <a href="<?=BASE_URL?>gymDetails.php?gym_id=<?=$value['id']?>">
                            View
                        </a>
                        <a href="<?=BASE_URL?>myGyms.php?gym_id=<?=$value['id']?>">
                            Cancel
                        </a>
                    </td>
                </tr>
            <?php } ?>
            <?php if($sl == 0) { ?>
                <tr>
                    <td colspan="8">
                        <div class="text-center py-2">
                            No Gyms Registered
                        </div>
                    </td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
</div>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>