<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

if(isset($_GET['plan_id']) && !empty($_GET['plan_id'])){
    $plan_id = $_GET['plan_id'];
    
    $sqlGymPlanChk = "SELECT a.* FROM tbl_gym_plans a WHERE a.id = $plan_id";
    $resultGymPlanChk = $conn -> query($sqlGymPlanChk);
    $rowGymPlan = $resultGymPlanChk -> fetch_assoc();
    
    if($rowGymPlan === false || empty($rowGymPlan)){
        $helper->SendErrorToast("GymPlan Doesn't Exist!!");
        $helper->Redirect(ADMIN_URL . "gyms.php");
    }

} else {
    $helper->Redirect(ADMIN_URL . "gyms.php");
}

if(isset($_POST['update'])){
    $name      = $conn->real_escape_string( $_POST['name']);
    $gym       = $conn->real_escape_string( $_POST['gym']);
    $price     = $conn->real_escape_string( $_POST['price']);
    $duration  = $conn->real_escape_string( $_POST['duration']);
    $facilities = $conn->real_escape_string( $_POST['facilities']);
    
    $sql = "UPDATE tbl_gym_plans SET name='$name', gym_id='$gym', price='$price', duration='$duration', facilities='$facilities' WHERE id = $plan_id";
    echo $sql;
    $result = $conn -> query($sql);

    if($result){
        $helper->SendSuccessToast("Gym Plan Updated Sucessfully");
        $helper->Redirect(ADMIN_URL . 'gymPlans.php');
    } else {
        $helper->SendSuccessToast("Gym Plan Update Failed!!");
        $helper->Redirect(ADMIN_URL . 'gymPlans.php');
    }
}

$sqlGymChk = "SELECT a.* FROM tbl_gyms a";
$resultGym = $conn -> query($sqlGymChk);
$gyms = $resultGym -> fetch_all(MYSQLI_ASSOC);
?>
<?php 
$title = "Gym Plan Details";
require_once __DIR__ . "/include/layout-start.php"; 
?>
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Update Gym Plan</h5>
            <!-- General Form Elements -->
            <form method="post">
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" value="<?=$rowGymPlan['name']?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Gym</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="gym" aria-label="Default select example" required>
                            <option value="" selected>Open this select menu</option>
                            <?php foreach($gyms as $key => $value) { ?>
                            <option value="<?=$value['id']?>" <?=$rowGymPlan['gym_id'] == $value['id'] ? 'Selected' : ''?>>
                                <?=$value['name']?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                        <input type="number" min="0" class="form-control" name="price" value="<?=$rowGymPlan['price']?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Duration</label>
                    <div class="col-sm-10">
                        <input type="number" min="1" class="form-control" name="duration" value="<?=$rowGymPlan['duration']?>">
                        <span class="text-muted"><strong>Note:</strong> In Months</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Facilities</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="facilities" style="height: 100px" required><?=$rowGymPlan['facilities']?></textarea>
                        <span class="text-muted"><strong>Note:</strong> seperated by comma</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form><!-- End General Form Elements -->
        </div>
    </div>
</section>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>