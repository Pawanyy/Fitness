<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

if(isset($_POST['create'])){
    $name        = $conn->real_escape_string( $_POST['name']);
    $description = $conn->real_escape_string( $_POST['description']);
    $date = $_POST['date'];
    
    $sql = "INSERT INTO `tbl_events`(`name`, `description`, `date`) 
            VALUES ('$name','$description','$date')";
    $result = $conn -> query($sql);

    if($result){
        $helper->SendSuccessToast("Event Created Sucessfully");
        $helper->Redirect(ADMIN_URL . 'events.php');
    } else {
        $helper->SendErrorToast("Event Create Failed!!");
        $helper->Redirect(ADMIN_URL . 'events.php');
    }   
}

?>
<?php 
$title = "Add Event";
require_once __DIR__ . "/include/layout-start.php"; 
?>
<section class="section">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add Event</h5>
            <!-- General Form Elements -->
            <form method="post">
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" value="" required>
                    </div>
                </div>
                <!-- <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                    </div>
                </div> -->
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="description" style="height: 100px" required></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-10">
                    <input type="date" name="date" class="form-control" value="" required>
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