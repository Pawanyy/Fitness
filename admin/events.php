<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

if(isset($_GET['did']) && !empty($_GET['did'])){
    $event_id = $_GET['did'];
    
    $sqlEventChk = "SELECT a.* FROM tbl_events a WHERE a.id = $event_id";
    $resultEventChk = $conn -> query($sqlEventChk);
    $rowEvent = $resultEventChk -> fetch_assoc();
    
    if($rowEvent === false || empty($rowEvent)){
        $helper->SendErrorToast("Event Doesn't Exist!!");
        $helper->Redirect(ADMIN_URL . "events.php");
    }

    $sql = "DELETE FROM tbl_events WHERE id = $event_id";
    $result = $conn -> query($sql);

    if($result){
        
        $conn -> query("DELETE FROM tbl_event_register WHERE event_id = $event_id");

        $helper->SendSuccessToast("Event Deleted Sucessfully");
        $helper->Redirect(ADMIN_URL . 'events.php');
    } else {
        $helper->SendSuccessToast("Event Delete Failed!!");
        $helper->Redirect(ADMIN_URL . 'events.php');
    }
}

$title = "Events";
require_once __DIR__ . "/include/layout-start.php"; 
?>
<?php
$sql = "SELECT a.*, (SELECT COUNT(b.event_id) FROM tbl_event_register b WHERE b.event_id = a.id) AS reg_users  FROM tbl_events a; ";
$result = $conn -> query($sql);
$rows = $result -> fetch_all(MYSQLI_ASSOC);
?>
<div class="py-3">
<div class="table-responsive">
    <h1 class="py-2 px-3 border border-1 d-flex justify-content-between align-items-center">
        <span>Events</span>
        <a href="<?=ADMIN_URL?>addEvent.php" class="btn btn-primary">Add Event</a>
    </h1>
    <table class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Event Name</th>
                <th scope="col">Event Date</th>
                <th scope="col">Registered Users</th>
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
                    <td><?=$value['reg_users']?></td>
                    <td>
                        <a href="<?=ADMIN_URL?>eventDetails.php?event_id=<?=$value['id']?>">
                            View
                        </a>
                        <a class="ms-1"
                            href="<?=ADMIN_URL?>events.php?did=<?=$value['id']?>"
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
                            No Events
                        </div>
                    </td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
</div>
</div>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>