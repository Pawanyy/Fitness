<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

if(isset($_GET['event_id']) && !empty($_GET['event_id'])){
    $event_id = $_GET['event_id'];
    
    $sqlEventChk = "SELECT a.* FROM tbl_events a WHERE a.id = $event_id";
    $resultEventChk = $conn -> query($sqlEventChk);
    $rowEvent = $resultEventChk -> fetch_assoc();
    
    if($rowEvent === false || empty($rowEvent)){
        $helper->SendErrorToast("Event Doesn't Exist!!");
        $helper->Redirect(ADMIN_URL . "events.php");
    }

} else {
    $helper->Redirect(ADMIN_URL . "events.php");
}

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $date = $_POST['date'];
    $description = $_POST['description'];
    
    $sql = "UPDATE tbl_events SET name='$name', description='$description', date='$date' WHERE id = $event_id";
    $result = $conn -> query($sql);

    if($result){
        $helper->SendSuccessToast("Event Updated Sucessfully");
        $helper->Redirect(ADMIN_URL . 'events.php');
    } else {
        $helper->SendSuccessToast("Event Update Failed!!");
        $helper->Redirect(ADMIN_URL . 'events.php');
    }
}

$sqlEventUsers = "SELECT c.*, b.date AS reg_date  FROM tbl_events a JOIN tbl_event_register b ON a.id = b.event_id JOIN tbl_users C ON b.user_id=c.id WHERE a.id = $event_id";
$resultEventUsers = $conn -> query($sqlEventUsers);
$rowEventUsers = $resultEventUsers -> fetch_all(MYSQLI_ASSOC);
?>
<?php 
$title = "Events Details";
require_once __DIR__ . "/include/layout-start.php"; 
?>
<section class="section">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Event Details</h5>
            <!-- General Form Elements -->
            <form method="post">
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Event Name</label>
                    <div class="col-sm-10">
                    <input type="text" name="name" required class="form-control" value="<?=$rowEvent["name"]?>">
                    </div>
                </div>
                <!-- <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                    </div>
                </div> -->
                <div class="row mb-3">
                    <label for="inputDate" class="col-sm-2 col-form-label">Event Date</label>
                    <div class="col-sm-10">
                    <input type="date" name="date" required class="form-control" value="<?=$rowEvent["date"]?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Event Description</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="description" style="height: 100px"><?=$rowEvent["description"]?></textarea>
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
<div class="table-responsive">
    <h1 class="py-2 px-3 border border-1">Event Users</h1>
    <table class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User Name</th>
                <th scope="col">User Email</th>
                <th scope="col">User Date</th>
                <th scope="col">Registerd Date</th>
                <th scope="col">Details</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sl = 0;
            foreach ($rowEventUsers as $key => $value) { 
                $sl++;
            ?>
                <tr>
                    <th scope="row"><?=$sl?></th>
                    <td><?=$value['name']?></td>
                    <td><?=$value['email']?></td>
                    <td><?=$value['phone']?></td>
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
                    <td colspan="7">
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