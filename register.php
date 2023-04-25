<?php require_once __DIR__ . "/include/layout-start.php"; ?>
<?php
    if(isset($_POST['Register'])){
        $name     = $conn->real_escape_string($_POST['FULLNAME']);
        $email    = $conn->real_escape_string($_POST['EMAIL']);
        $password = $conn->real_escape_string($_POST['PASSWORD']);
        $phone    = $conn->real_escape_string($_POST['MOBILE']);
        $aboutme  = $conn->real_escape_string($_POST['ABOUT_ME']);
        $role = ROLE::USER;
        $created_at = date('Y-m-d h:i:s A');
        
        $sql = "INSERT INTO `tbl_users`(`name`, `email`, `password`, `phone`, `aboutme`, `role`, `created_at`) 
                VALUES ('$name','$email','$password','$phone','$aboutme','$role','$created_at')";
        $result = $conn -> query($sql);

        if($result){
            $helper->SendSuccessToast("Registered Sucessfully");
            $helper->Redirect(BASE_URL . 'register.php');
        } else {
            $helper->SendErrorToast("Error Occoured!!");
            $helper->Redirect(BASE_URL . 'register.php');
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

    .form-control {
        max-width: 100% !important;
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
            <h4 class="text-center">User Register</h4>
        </div>
        <div class="card-body">
            <form method="post">
                <div class="form-horizontal row">
                    <div class="form-group col-12 col-md-6">
                        <label class="control-label" for="EMAIL">Email</label>
                        <div class="">
                            <input class="form-control text-box single-line" data-val="true" data-val-length="The field Email must be a string with a minimum length of 2 and a maximum length of 255." data-val-length-max="255" data-val-length-min="2" data-val-remote="Email already in use" data-val-remote-additionalfields="*.EMAIL" data-val-remote-url="/Remote/IsEmailExists" data-val-required="The Email field is required." id="EMAIL" name="EMAIL" type="email" value="" required>
                            <span class="field-validation-valid text-danger" data-valmsg-for="EMAIL" data-valmsg-replace="true"></span>
                        </div>
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label class="control-label" for="PASSWORD">Password</label>
                        <div class="">
                            <input class="form-control text-box single-line password" data-val="true" data-val-length="The field Password must be a string with a minimum length of 2 and a maximum length of 255." data-val-length-max="255" data-val-length-min="2" data-val-required="The Password field is required." id="PASSWORD" name="PASSWORD" type="password" required>
                            <span class="field-validation-valid text-danger" data-valmsg-for="PASSWORD" data-valmsg-replace="true"></span>
                        </div>
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label class="control-label" for="FULLNAME">Full Name</label>
                        <div class="">
                            <input class="form-control text-box single-line" data-val="true" data-val-length="The field Full Name must be a string with a minimum length of 2 and a maximum length of 255." data-val-length-max="255" data-val-length-min="2" id="FULLNAME" name="FULLNAME" type="text" value="" required>
                            <span class="field-validation-valid text-danger" data-valmsg-for="FULLNAME" data-valmsg-replace="true"></span>
                        </div>
                    </div>

                    <div class="form-group col-12 col-md-6">
                        <label class="control-label" for="MOBILE">Mobile</label>
                        <div class="">
                            <input class="form-control text-box single-line" data-val="true" data-val-length="The field Mobile must be a string with a minimum length of 10 and a maximum length of 10." data-val-length-max="10" data-val-length-min="10" id="MOBILE" name="MOBILE" type="tel" value="" required>
                            <span class="field-validation-valid text-danger" data-valmsg-for="MOBILE" data-valmsg-replace="true"></span>
                        </div>
                    </div>

                    <div class="form-group col-12 col-md-12">
                        <label class="control-label" for="ABOUT_ME">About Me</label>
                        <div class="">
                            <textarea class="form-control text-box multi-line" data-val="true" data-val-length="The field About Me must be a string with a minimum length of 2 and a maximum length of 1000." data-val-length-max="1000" data-val-length-min="2" id="ABOUT_ME" name="ABOUT_ME" required></textarea>
                            <span class="field-validation-valid text-danger" data-valmsg-for="ABOUT_ME" data-valmsg-replace="true"></span>
                        </div>
                    </div>

                    <div class="form-group mt-3 col-12">
                        <button name="Register" class="btn btn-primary w-100 mw-100">Register</button>
                    </div>
                </div>
            </form>        
        </div>
        <div class="card-footer">
            <div class="text-center">
                <a class="btn btn-link" href="<?=BASE_URL?>login.php">Back Login</a>
            </div>
        </div>
    </div>
</main>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>