<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

if(isset($_GET['user_id']) && !empty($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    
    $sqlUserChk = "SELECT a.* FROM tbl_users a WHERE a.id = $user_id";
    $resultUserChk = $conn -> query($sqlUserChk);
    $rowUser = $resultUserChk -> fetch_assoc();
    
    if($rowUser === false || empty($rowUser)){
        $helper->SendErrorToast("User Doesn't Exist!!");
        $helper->Redirect(ADMIN_URL . "users.php");
    }

} else {
    $helper->Redirect(ADMIN_URL . "users.php");
}

if(isset($_POST['update'])){
    $name     = $conn->real_escape_string($_POST['name']);
    $phone    = $conn->real_escape_string($_POST['phone']);
    $aboutme  = $conn->real_escape_string($_POST['aboutme']);
    $password = $conn->real_escape_string($_POST['password']);
    $role = ROLE::USER;

    $passwordStr = empty(trim($password)) ? "" : ", password='$password'";
    
    $sql = "UPDATE tbl_users SET name='$name', phone='$phone', aboutme='$aboutme' " . $passwordStr . " WHERE id = $user_id";
    $result = $conn -> query($sql);

    if($result){
        $helper->SendSuccessToast("Profile Updated Sucessfully");
        $helper->Redirect(ADMIN_URL . 'users.php');
    } else {
        $helper->SendSuccessToast("Update Profile Failed!!");
        $helper->Redirect(ADMIN_URL . 'users.php');
    }
}

?>
<?php 
$title = "User Details";
require_once __DIR__ . "/include/layout-start.php"; 
?>
<section class="section">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">User Details</h5>
            <!-- General Form Elements -->
            <form method="post">
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" value="<?=$rowUser["name"]?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" value="<?=$rowUser["email"]?>" required disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                    <input type="text" name="phone" class="form-control" value="<?=$rowUser["phone"]?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" value="">
                    </div>
                </div>
                <!-- <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                    </div>
                </div> -->
                <div class="row mb-3">
                    <label for="inputDate" class="col-sm-2 col-form-label">Created At</label>
                    <div class="col-sm-10">
                    <input type="text" name="date" class="form-control" value="<?=$rowUser["created_at"]?>" required disabled>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">About Me</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="aboutme" style="height: 100px" required><?=$rowUser["aboutme"]?></textarea>
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