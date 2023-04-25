<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

if(isset($_POST['create'])){
    $name      = $conn->real_escape_string( $_POST['name']);
    $gym       = $conn->real_escape_string( $_POST['gym']);
    $price     = $conn->real_escape_string( $_POST['price']);
    $duration  = $conn->real_escape_string( $_POST['duration']);
    $facilities = $conn->real_escape_string( $_POST['facilities']);
    $date      = date('Y-m-d');
    
    $sql = "INSERT INTO `tbl_gym_plans`( `name`, `price`, `gym_id`, `duration`, `facilities`) 
            VALUES ( '$name', '$price', '$gym', '$duration', '$facilities')";
    $result = $conn -> query($sql);

    if($result){
        $helper->SendSuccessToast("Gym Plan Created Sucessfully");
        $helper->Redirect(ADMIN_URL . 'gymPlans.php');
    } else {
        $helper->SendErrorToast("Gym Plan Create Failed!!");
        $helper->Redirect(ADMIN_URL . 'gymPlans.php');
    }   
}

$sqlGymChk = "SELECT a.* FROM tbl_gyms a";
$resultGym = $conn -> query($sqlGymChk);
$gyms = $resultGym -> fetch_all(MYSQLI_ASSOC);
?>
<?php 
$title = "Add Gym";
require_once __DIR__ . "/include/layout-start.php"; 
?>
<section class="section">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add Gym Plan</h5>
            <!-- General Form Elements -->
            <form method="post">
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" value="" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Gym</label>
                    <div class="col-sm-10">
                    <select class="form-select" name="gym" aria-label="Default select example" required>
                        <option value="" selected>Open this select menu</option>
                        <?php foreach($gyms as $key => $value) { ?>
                        <option value="<?=$value['id']?>"><?=$value['name']?></option>
                        <?php } ?>
                    </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-10">
                    <input type="number" min="0" class="form-control" name="price">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Duration</label>
                    <div class="col-sm-10">
                    <input type="number" min="1" class="form-control" name="duration">
                    <span class="text-muted"><strong>Note:</strong> In Months</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Facilities</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="facilities" style="height: 100px" required></textarea>
                    <span class="text-muted"><strong>Note:</strong> seperated by comma</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                    <button type="submit" name="create" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </form><!-- End General Form Elements -->
        </div>
    </div>
</section>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>