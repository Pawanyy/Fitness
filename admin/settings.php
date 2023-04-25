<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

if(isset($_POST['update'])){
    $name       = $conn->real_escape_string($_POST['name']);
    $address    = $conn->real_escape_string($_POST['address']);
    $phone      = $conn->real_escape_string($_POST['phone']);
    $email      = $conn->real_escape_string($_POST['email']);
    $website    = $conn->real_escape_string($_POST['website']);
    $main_desc  = $conn->real_escape_string($_POST['main_desc']);
    $about_desc = $conn->real_escape_string($_POST['about_desc']);

    $conn -> query("DELETE FROM tbl_settings");

    $sql = "INSERT INTO `tbl_settings`(`name`, `address`, `phone`, `email`, `website`, `about_desc`, `main_desc`) 
            VALUES ('$name','$address','$phone','$email','$website','$about_desc','$main_desc')";
    $result = $conn -> query($sql);

    if($result){
        $helper->SendSuccessToast("Settings Updated Sucessfully");
        $helper->Redirect(ADMIN_URL . 'settings.php');
    } else {
        $helper->SendErrorToast("Settings Profile Failed!!");
        $helper->Redirect(ADMIN_URL . 'settings.php');
    }
}

$sql = "SELECT * FROM tbl_settings";
$result = $conn -> query($sql);
$settings = $result -> fetch_assoc();
?>
<?php 
$title = "Settings";
require_once __DIR__ . "/include/layout-start.php"; 
?>
<section class="section">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Settings</h5>
            <!-- General Form Elements -->
            <form method="post">
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" value="<?=$settings['name']?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Address</label>
                    <div class="col-sm-10">
                    <input type="text" name="address" class="form-control" value="<?=$settings['address']?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                    <input type="tel" name="phone" class="form-control" value="<?=$settings['phone']?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" value="<?=$settings['email']?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Website</label>
                    <div class="col-sm-10">
                    <input type="text" name="website" class="form-control" value="<?=$settings['website']?>" required>
                    </div>
                </div>
                <!-- <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                    </div>
                </div> -->
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Main Description</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="main_desc" style="height: 100px" required><?=$settings['main_desc']?></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">About Description</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="about_desc" style="height: 100px" required><?=$settings['about_desc']?></textarea>
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