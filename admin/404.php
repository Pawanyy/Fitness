<!doctype html>
<html lang="en">
<head>
    <title>Admin Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php require_once __DIR__ . "/include/header.php"; ?>
</head>

<body>

<style>
    html,
    body {
        height: 100%;
    }
    
    body {
        display: flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
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
<main class="form-signin w-100 m-auto">
    <div class="card">
        <div class="card-header">
            <h4 class="text-center">ADMIN</h4>
        </div>
        <div class="card-body">
            
            
            <form action="/Admin" method="post"><input name="__RequestVerificationToken" type="hidden" value="Hx8rdgIgwBfVBIGPEGq2jwn4pRKJy5ekZdoVqtJfp1Imt6OMPevmPpz9mqIp9W2G09B2PTczk53-aQdRQEBUhHdXdcNOFW0dfke7l-QvApU1">                    <h1 class="text-center h3 mb-3 fw-normal">Please sign in</h1>
            <div class="form-group mt-2 mb-2">
                <label for="USERNANE">Username</label>
                <div class="col-md-12">
                    <input class="form-control text-box single-line" data-val="true" data-val-length="The field Username must be a string with a minimum length of 2 and a maximum length of 255." data-val-length-max="255" data-val-length-min="2" data-val-required="The Username field is required." id="USERNAME" name="USERNAME" type="text" value="">
                    <span class="field-validation-valid text-danger" data-valmsg-for="USERNAME" data-valmsg-replace="true"></span>
                </div>
            </div>
            <div class="form-group mt-2 mb-2">
                <label for="PASSWORD">Password</label>
                <div class="col-md-12">
                    <input class="form-control text-box single-line password" data-val="true" data-val-length="The field Password must be a string with a minimum length of 2 and a maximum length of 255." data-val-length-max="255" data-val-length-min="2" data-val-required="The Password field is required." id="PASSWORD" name="PASSWORD" type="password">
                    <span class="field-validation-valid text-danger" data-valmsg-for="PASSWORD" data-valmsg-replace="true"></span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12">
                    <input type="submit" value="Login" class="w-100 btn btn-lg btn-primary">
                    <p class="mt-5 mb-3 text-muted">© 2023</p>
                </div>
            </div>
        </form>            </div>
    </div>
</main>

<!-- <script src="/Scripts/jquery-3.4.1.js"></script>

<script src="/Scripts/bootstrap.js"></script> -->
</body>
</html>