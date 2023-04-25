<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

if(isset($_GET['did']) && !empty($_GET['did'])){
    $faq_id = $_GET['did'];
    
    $sqlFaqChk = "SELECT a.* FROM tbl_faq a WHERE a.id = $faq_id";
    $resultFaqChk = $conn -> query($sqlFaqChk);
    $rowFaq = $resultFaqChk -> fetch_assoc();
    
    if($rowFaq === false || empty($rowFaq)){
        $helper->SendErrorToast("Faq Doesn't Exist!!");
        $helper->Redirect(ADMIN_URL . "faqs.php");
    }

    $sql = "DELETE FROM tbl_faq WHERE id = $faq_id";
    $result = $conn -> query($sql);

    if($result){
        $helper->SendSuccessToast("Faq Deleted Sucessfully");
        $helper->Redirect(ADMIN_URL . 'faqs.php');
    } else {
        $helper->SendSuccessToast("Faq Delete Failed!!");
        $helper->Redirect(ADMIN_URL . 'faqs.php');
    }
}

$title = "Faqs";
require_once __DIR__ . "/include/layout-start.php"; 
?>
<?php
$sql = "SELECT a.*  FROM tbl_faq a; ";
$result = $conn -> query($sql);
$rows = $result -> fetch_all(MYSQLI_ASSOC);
?>
<div class="py-3">
<div class="table-responsive">
    <h1 class="py-2 px-3 border border-1 d-flex justify-content-between align-items-center">
        <span>Faqs</span>
        <a href="<?=ADMIN_URL?>addFaq.php" class="btn btn-primary">Add Faq</a>
    </h1>
    <table class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Question</th>
                <th scope="col">Answer</th>
                <th scope="col">Details</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sl = 0;
            foreach ($rows as $key => $value) { 
                $sl++;
            ?>
                <tr>
                    <th scope="row"><?=$sl?></th>
                    <td><?=$value['question']?></td>
                    <td><?=$value['answer']?></td>
                    <td>
                        <a class="ms-1"
                            href="<?=ADMIN_URL?>faqs.php?did=<?=$value['id']?>"
                            onclick="return confirm('Are you sure?')">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
            <?php if($sl == 0) { ?>
                <tr>
                    <td colspan="5">
                        <div class="text-center py-2">
                            No Faqs
                        </div>
                    </td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
</div>
</div>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>