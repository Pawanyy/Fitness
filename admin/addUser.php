<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

if(isset($_POST['create'])){
    $name     = $conn->real_escape_string(trim($_POST['name']));
    $email    = $conn->real_escape_string(trim($_POST['email']));
    $password = $conn->real_escape_string(trim($_POST['password']));
    $phone    = $conn->real_escape_string(trim($_POST['phone']));
    $aboutme  = $conn->real_escape_string(trim($_POST['aboutme']));
    $role = ROLE::USER;
    $created_at = date('Y-m-d h:i:s A');
    
    $sql = "INSERT INTO `tbl_users`(`name`, `email`, `password`, `phone`, `aboutme`, `role`, `created_at`) 
            VALUES ('$name','$email','$password','$phone','$aboutme','$role','$created_at')";
    $result = $conn -> query($sql);

    if($result){
        $helper->SendSuccessToast("User Created Sucessfully");
        $helper->Redirect(ADMIN_URL . 'users.php');
    } else {
        $helper->SendErrorToast("User Create Failed!!");
        $helper->Redirect(ADMIN_URL . 'users.php');
    }   
}

?>
<?php 
$title = "Add User";
require_once __DIR__ . "/include/layout-start.php"; 
?>
<section class="section">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add User</h5>
            <!-- General Form Elements -->
            <form method="post">
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" value="" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" value="" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Phone</label>
                    <div class="col-sm-10">
                    <input type="text" name="phone" class="form-control" value="" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" value="" required>
                    </div>
                </div>
                <!-- <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile">
                    </div>
                </div> -->
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">About Me</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="aboutme" style="height: 100px" required></textarea>
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