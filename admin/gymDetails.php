<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

if(isset($_GET['gym_id']) && !empty($_GET['gym_id'])){
    $gym_id = $_GET['gym_id'];
    
    $sqlGymChk = "SELECT a.* FROM tbl_gyms a WHERE a.id = $gym_id";
    $resultGymChk = $conn -> query($sqlGymChk);
    $rowGym = $resultGymChk -> fetch_assoc();
    
    if($rowGym === false || empty($rowGym)){
        $helper->SendErrorToast("Gym Doesn't Exist!!");
        $helper->Redirect(ADMIN_URL . "gyms.php");
    }

} else {
    $helper->Redirect(ADMIN_URL . "gyms.php");
}

if(isset($_POST['update'])){
    $name         = $conn->real_escape_string( $_POST['name']);
    $location     = $conn->real_escape_string( $_POST['location']);
    $activities   = $conn->real_escape_string( $_POST['activities']);
    $description  = $conn->real_escape_string( $_POST['description']);
    $phy_disabled = isset($_POST['phy_disabled']) ? 1 : 0;
    // $date = $_POST['date'];
    
    $sql = "UPDATE tbl_gyms SET name='$name', location='$location', activities='$activities', phy_disabled='$phy_disabled', description='$description' WHERE id = $gym_id";
    $result = $conn -> query($sql);

    if($result){
        $helper->SendSuccessToast("Gym Updated Sucessfully");
        $helper->Redirect(ADMIN_URL . 'gyms.php');
    } else {
        $helper->SendSuccessToast("Gym Update Failed!!");
        $helper->Redirect(ADMIN_URL . 'gyms.php');
    }
}

$sqlGymUsers = "SELECT c.*, d.name AS plan_name, b.plan_id, d.price AS plan_price, b.date AS reg_date  FROM tbl_gyms a JOIN tbl_gym_register b ON a.id = b.gym_id JOIN tbl_users c ON b.user_id=c.id JOIN tbl_gym_plans d ON d.id = b.plan_id WHERE a.id = $gym_id";
$resultGymUsers = $conn -> query($sqlGymUsers);
$rowGymUsers = $resultGymUsers -> fetch_all(MYSQLI_ASSOC);
?>
<?php 
$title = "Gyms Details";
require_once __DIR__ . "/include/layout-start.php"; 
?>
<section class="section">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Gym Details</h5>
            <!-- General Form Elements -->
            <form method="post">
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Gym Name</label>
                    <div class="col-sm-10">
                    <input type="text" name="name" required class="form-control" value="<?=$rowGym["name"]?>">
                    </div>
                </div>
                <!-- <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                    </div>
                </div> -->
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="location" style="height: 100px" required><?=$rowGym["location"]?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="description" style="height: 100px" required><?=$rowGym["description"]?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Activities</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="activities" style="height: 100px" required><?=$rowGym["activities"]?></textarea>
                    <span class="text-muted"><strong>Note:</strong> seperated by comma</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">For Physically Disabled</label>
                    <div class="col-sm-10">
                    <input type="checkbox" class="form-check-input" name="phy_disabled" <?=$rowGym["phy_disabled"] ? 'checked' : ''?>>
                    </div>
                </div>
                <!-- <div class="row mb-3">
                    <label for="inputDate" class="col-sm-2 col-form-label">Gym Date</label>
                    <div class="col-sm-10">
                    <input type="date" name="date" required class="form-control" value="<?=$rowGym["date"]?>">
                    </div>
                </div> -->
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
<div class="table-responsive">
    <h1 class="py-2 px-3 border border-1">Gym Users</h1>
    <table class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User Name</th>
                <th scope="col">User Email</th>
                <th scope="col">User Phone</th>
                <th scope="col">Plan Name</th>
                <th scope="col">Plan Price</th>
                <th scope="col">Registerd Date</th>
                <th scope="col">Details</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sl = 0;
            foreach ($rowGymUsers as $key => $value) { 
                $sl++;
            ?>
                <tr>
                    <th scope="row"><?=$sl?></th>
                    <td><?=$value['name']?></td>
                    <td><?=$value['email']?></td>
                    <td><?=$value['phone']?></td>
                    <td><?=$value['plan_name']?></td>
                    <td><?=$value['plan_price']?></td>
                    <td><?=$value['reg_date']?></td>
                    <td>
                        <a href="<?=ADMIN_URL?>user.php?user_id=<?=$value['id']?>">
                            View
                        </a>
                    </td>    
                </tr>
            <?php } ?>
            <?php if($sl == 0) { ?>
                <tr>
                    <td colspan="9">
                        <div class="text-center py-2">
                            No Registered Users
                        </div>
                    </td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
</div>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>