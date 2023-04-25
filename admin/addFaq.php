<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

if(isset($_POST['create'])){
    $question = $conn->real_escape_string($_POST['question']);
    $answer   = $conn->real_escape_string($_POST['answer']);
    
    $sql = "INSERT INTO `tbl_faq`(`question`, `answer`) 
            VALUES ('$question','$answer')";
    $result = $conn -> query($sql);

    if($result){
        $helper->SendSuccessToast("Faq Created Sucessfully");
        $helper->Redirect(ADMIN_URL . 'faqs.php');
    } else {
        $helper->SendErrorToast("Faq Create Failed!!");
        $helper->Redirect(ADMIN_URL . 'faqs.php');
    }   
}

?>
<?php 
$title = "Add Faq";
require_once __DIR__ . "/include/layout-start.php"; 
?>
<section class="section">

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add Faq</h5>
            <!-- General Form Elements -->
            <form method="post">
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Question</label>
                    <div class="col-sm-10">
                    <input type="text" name="question" class="form-control" value="" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Answer</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="answer" style="height: 100px" required></textarea>
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