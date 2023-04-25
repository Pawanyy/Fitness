<?php require_once __DIR__ . "/include/layout-start.php"; ?>
<?php
    if(isset($_POST['Login'])){
        $email    = $conn->real_escape_string($_POST['EMAIL']);
        $password = $conn->real_escape_string($_POST['PASSWORD']);
        $role = ROLE::USER;
        
        $sql = "SELECT * FROM `tbl_users` WHERE email = '$email' AND password = '$password' AND role = $role";
        $result = $conn -> query($sql);
        $row = $result -> fetch_assoc();

        if($row !== false && !empty($row)){

            $_SESSION['uid'] = $row['id'];
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];

            $helper->SendSuccessToast("Login Sucessfully");
            $helper->Redirect(BASE_URL . 'profile.php');
        } else {
            $helper->SendErrorToast("Email or Password Incorrect!!");
            $helper->Redirect(BASE_URL . 'login.php');
        }
    }
?>
<style>
    html,
    body {
        height: 100%;
    }

    body {
        align-items: center;
        background-color: #f5f5f5;
    }
    .form-control{
        max-width:100% !important;
    }

    .form-signin {
        max-width: 370px;
        padding: 15px;
    }

    .form-signin .form-floating:focus-within {
        z-index: 2;
    }

    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
</style>

<main class="form-signin mt-5 mb-5 m-auto">
    <div class="card mt-5 mb-5">
        <div class="card-header">
            <h4 class="text-center">User Login</h4>
        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="form-horizontal">
                    <div class="form-group mb-3">
                        <label class="control-label" for="EMAIL">Email</label>
                        <div class="col-md-12">
                            <input class="form-control text-box single-line" data-val="true" data-val-length="The field Email must be a string with a minimum length of 2 and a maximum length of 255." data-val-length-max="255" data-val-length-min="2" data-val-remote="Email already in use" data-val-remote-additionalfields="*.EMAIL" data-val-remote-url="/Remote/IsEmailExists" data-val-required="The Email field is required." id="EMAIL" name="EMAIL" type="email" value="" required>
                            <span class="field-validation-valid text-danger" data-valmsg-for="EMAIL" data-valmsg-replace="true"></span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="control-label" for="PASSWORD">Password</label>
                        <div class="col-md-12">
                            <input class="form-control text-box single-line password" data-val="true" data-val-length="The field Password must be a string with a minimum length of 2 and a maximum length of 255." data-val-length-max="255" data-val-length-min="2" data-val-required="The Password field is required." id="PASSWORD" name="PASSWORD" type="password" required>
                            <span class="field-validation-valid text-danger" data-valmsg-for="PASSWORD" data-valmsg-replace="true"></span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="col-md-12">
                            <button name="Login" class="btn btn-primary w-100 mw-100">Login</button>
                        </div>
                    </div>
                </div>
            </form>        
        </div>
        <div class="card-footer">
            <div class="text-center">
                <a class="btn btn-link" href="<?=BASE_URL?>register.php">Create Account</a>
            </div>
        </div>
    </div>
</main>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>