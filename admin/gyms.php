<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

if(isset($_GET['did']) && !empty($_GET['did'])){
    $gym_id = $_GET['did'];
    
    $sqlGymChk = "SELECT a.* FROM tbl_gyms a WHERE a.id = $gym_id";
    $resultGymChk = $conn -> query($sqlGymChk);
    $rowGym = $resultGymChk -> fetch_assoc();
    
    if($rowGym === false || empty($rowGym)){
        $helper->SendErrorToast("Gym Doesn't Exist!!");
        $helper->Redirect(ADMIN_URL . "gyms.php");
    }

    $sql = "DELETE FROM tbl_gyms WHERE id = $gym_id";
    $result = $conn -> query($sql);

    if($result){
        
        //$conn -> query("DELETE FROM tbl_event_register WHERE event_id = $gym_id");

        $helper->SendSuccessToast("Gym Deleted Sucessfully");
        $helper->Redirect(ADMIN_URL . 'gyms.php');
    } else {
        $helper->SendSuccessToast("Gym Delete Failed!!");
        $helper->Redirect(ADMIN_URL . 'gyms.php');
    }
}

$title = "Gyms";
require_once __DIR__ . "/include/layout-start.php"; 
?>
<?php
//$sql = "SELECT a.*, (SELECT COUNT(b.event_id) FROM tbl_event_register b WHERE b.event_id = a.id) AS reg_users  FROM tbl_gyms a; ";
$sql = "SELECT a.*  FROM tbl_gyms a; ";
$result = $conn -> query($sql);
$rows = $result -> fetch_all(MYSQLI_ASSOC);
?>
<div class="py-3">
<div class="table-responsive">
    <h1 class="py-2 px-3 border border-1 d-flex justify-content-between align-items-center">
        <span>Gyms</span>
        <a href="<?=ADMIN_URL?>addGym.php" class="btn btn-primary">Add Gym</a>
    </h1>
    <table class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Gym Name</th>
                <th scope="col">Gym Location</th>
                <th scope="col">Gym Activities</th>
                <th scope="col">Gym Description</th>
                <th scope="col">for Physically Disabled</th>
                <th scope="col">Created Date</th>
                <!-- <th scope="col">Registered Users</th> -->
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
                    <td><?=$value['location']?></td>
                    <td><?=$value['activities']?></td>
                    <td><?=$value['description']?></td>
                    <td><?=$value['phy_disabled'] ? 'Yes' : 'No'?></td>
                    <td><?=$value['date']?></td>
                    <!-- <td><?=$value['reg_users']?></td> -->
                    <td>
                        <a href="<?=ADMIN_URL?>gymDetails.php?gym_id=<?=$value['id']?>">
                            View
                        </a>
                        <a class="ms-1"
                            href="<?=ADMIN_URL?>gyms.php?did=<?=$value['id']?>"
                            onclick="return confirm('Are you sure?')">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
            <?php if($sl == 0) { ?>
                <tr>
                    <td colspan="5">
                        <div class="text-center py-2">
                            No Gyms
                        </div>
                    </td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
</div>
</div>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>