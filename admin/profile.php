<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

$user_id = $_SESSION['uid'];
$sql = "SELECT * FROM tbl_users WHERE id = $user_id";
$result = $conn -> query($sql);
$user_row = $result -> fetch_assoc();

if(isset($_POST['passwordUpdate'])){
    $old_password = $conn->real_escape_string($_POST['oldPassword']);
    $password     = $conn->real_escape_string($_POST['newPassword']);
    $role = ROLE::ADMIN;
    
    $sql = "SELECT * FROM `tbl_users` WHERE id = $user_id AND password = '$old_password' AND role = $role";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();

    if($row !== false && !empty($row)){

        $sql = "UPDATE tbl_users SET password='$password' WHERE id = $user_id";
        $resultUpdate = $conn -> query($sql);

        if($resultUpdate){
            $helper->SendSuccessToast("Password Changed Sucessfully");
            $helper->Redirect(ADMIN_URL . 'profile.php');
        } else {
            $helper->SendErrorToast("Password Update Failed!!");
            $helper->Redirect(ADMIN_URL . 'profile.php');
        }
    } else {
        $helper->SendErrorToast("Old Password Incorrect!!");
        $helper->Redirect(ADMIN_URL . 'profile.php');
    }
}
?>
<?php 
$title = "Profile";
require_once __DIR__ . "/include/layout-start.php"; 
?>
<div class="p-0">
<div class="container">
    <div class="row">
        <div class="col-6">
            <div class="card border border-1">
                <div class="card-header">
                    <h4 class="card-title m-0">Profile</h4>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?=$user_row['name']?>" required disabled>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?=$user_row['email']?>" required disabled>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="<?=$user_row['phone']?>" required disabled>
                        </div>
                        <div class="mb-3">
                            <label for="aboutme" class="form-label">Amout Me</label>
                            <textarea class="form-control" id="aboutme" name="aboutme" required disabled><?=$user_row['aboutme']?></textarea>
                        </div>
                        <!-- <div class="mb-3">
                            <label for="reg" class="form-label">Registration Date</label>
                            <input type="text" class="form-control" id="reg" name="reg" value="<?=$user_row['created_at']?>" disabled>
                        </div>
                        <button type="submit" name="profileUpdate" class="btn btn-primary">Update</button> -->
                    </form>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card border border-1">
                <div class="card-header">
                    <h4 class="card-title m-0">Change Password</h4>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label for="oldPassword" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <button type="submit" name="passwordUpdate" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>