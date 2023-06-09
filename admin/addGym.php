<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

if(isset($_POST['create'])){
    $name         = $conn->real_escape_string( $_POST['name']);
    $location     = $conn->real_escape_string( $_POST['location']);
    $activities   = $conn->real_escape_string( $_POST['activities']);
    $description  = $conn->real_escape_string( $_POST['description']);
    $phy_disabled = isset($_POST['phy_disabled']) ? 1 : 0;
    $newimage     = "";
    //$date         = $_POST['date'];
    $date         = date('Y-m-d');

    //File Upload
    if( ! empty($_FILES["image"]["name"])){

        $filepath = $_FILES["image"]["tmp_name"];  
        
        $iUpload = new ImageUpload();
        
        $iUpload->setName('profile_' . time());
        $iUpload->setMime(['png', 'jpg', 'jpeg']);
        $iUpload->setPath( $iUpload->merge_paths(dirname( __DIR__) , "/assets/img/gym/"));
        $iUpload->Upload($filepath);

        if ( $iUpload->isUploaded()) {

            $image = $iUpload->getFullName();
        
            //remove old file
            // $old_image_path = (dirname( __DIR__)) . (empty($old_image) ? "o.txt" : $old_image);
            // if(file_exists($old_image_path)) {
            //     unlink($old_image_path);
            // }
        
            //update new file
            $newimage = "/assets/img/gym/" . $image;
            $message = $iUpload->getMessage();
            $helper->SendSuccessToast($message);

        } else {

            $valid = false;
            $message = $iUpload->getMessage();
            $helper->SendErrorToast($message);

        }
    }
    
    $sql = "INSERT INTO `tbl_gyms`( `name`, image, `location`, `activities`, `phy_disabled`, `description`, `date`) 
            VALUES ('$name', '$newimage', '$location','$activities', $phy_disabled,'$description','$date')";
    $result = $conn -> query($sql);

    if($result){
        $helper->SendSuccessToast("Gym Created Sucessfully");
        $helper->Redirect(ADMIN_URL . 'gyms.php');
    } else {
        $helper->SendErrorToast("Gym Create Failed!!");
        $helper->Redirect(ADMIN_URL . 'gyms.php');
    }   
}

?>
<?php 
$title = "Add Gym";
require_once __DIR__ . "/include/layout-start.php"; 
?>
<section class="section">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add Gym</h5>
            <!-- General Form Elements -->
            <form method="post" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                    <input type="text" name="name" class="form-control" value="" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="formFile" class="col-sm-2 col-form-label">Image Upload</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="image" id="formFile" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Location</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="location" style="height: 100px" required></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="description" style="height: 100px" required></textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Activities</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="activities" style="height: 100px" required></textarea>
                    <span class="text-muted"><strong>Note:</strong> seperated by comma</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">For Physically Disabled</label>
                    <div class="col-sm-10">
                    <input type="checkbox" class="form-check-input" name="phy_disabled">
                    </div>
                </div>
                <!-- <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Date</label>
                    <div class="col-sm-10">
                    <input type="date" name="date" class="form-control" value="" required>
                    </div>
                </div> -->
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