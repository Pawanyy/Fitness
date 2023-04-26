<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

if(isset($_GET['did']) && !empty($_GET['did'])){
    $gym_plan_id = $_GET['did'];
    
    $sqlGymPlanChk = "SELECT a.* FROM tbl_gym_plans a WHERE a.id = $gym_plan_id";
    $resultGymPlanChk = $conn -> query($sqlGymPlanChk);
    $rowGymPlan = $resultGymPlanChk -> fetch_assoc();
    
    if($rowGymPlan === false || empty($rowGymPlan)){
        $helper->SendErrorToast("Plan Doesn't Exist!!");
        $helper->Redirect(ADMIN_URL . "gymPlans.php");
    }

    $sql = "DELETE FROM tbl_gym_plans WHERE id = $gym_plan_id";
    $result = $conn -> query($sql);

    if($result){
        
        $helper->SendSuccessToast("Plan Deleted Sucessfully");
        $helper->Redirect(ADMIN_URL . 'gymPlans.php');
    } else {
        $helper->SendSuccessToast("Plan Delete Failed!!");
        $helper->Redirect(ADMIN_URL . 'donation.php');
    }

}
$title = "Gym Plans";
require_once __DIR__ . "/include/layout-start.php"; 
?>
<?php
$sql = "SELECT a.*, b.name AS gym_name FROM tbl_gym_plans a LEFT JOIN tbl_gyms b ON a.gym_id=b.id;";
$result = $conn -> query($sql);
$rows = $result -> fetch_all(MYSQLI_ASSOC);
?>
<div class="py-3">
<div class="table-responsive">
    <h1 class="py-2 px-3 border border-1 d-flex justify-content-between align-items-center">
        <span>Gym Plans</span>
        <a href="<?=ADMIN_URL?>addGymPlan.php" class="btn btn-primary">Add Gym Plan</a>
    </h1>
    <table class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Plan Name</th>
                <th scope="col">Gym Name</th>
                <th scope="col">Plan Amount</th>
                <th scope="col">Plan Duration(Months)</th>
                <th scope="col">Plan Facilities</th>
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
                    <td><?=$value['gym_name']?></td>
                    <td><?=$value['price']?></td>
                    <td><?=$value['duration']?></td>
                    <td><?=$value['facilities']?></td>
                    <td>
                        <a href="<?=ADMIN_URL?>gymPlanDetails.php?plan_id=<?=$value['id']?>">
                            View
                        </a>
                        <a class="ms-1"
                            href="<?=ADMIN_URL?>gymPlans.php?did=<?=$value['id']?>"
                            onclick="return confirm('Are you sure?')">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
            <?php if($sl == 0) { ?>
                <tr>
                    <td colspan="10">
                        <div class="text-center py-2">
                            No Plans
                        </div>
                    </td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
</div>
</div>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>