<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

if(isset($_GET['did']) && !empty($_GET['did'])){
    $contact_id = $_GET['did'];
    
    $sqlContactChk = "SELECT a.* FROM tbl_contact a WHERE a.id = $contact_id";
    $resultContactChk = $conn -> query($sqlContactChk);
    $rowContact = $resultContactChk -> fetch_assoc();
    
    if($rowContact === false || empty($rowContact)){
        $helper->SendErrorToast("Contact Doesn't Exist!!");
        $helper->Redirect(ADMIN_URL . "contact.php");
    }

    $sql = "DELETE FROM tbl_contact WHERE id = $contact_id";
    $result = $conn -> query($sql);

    if($result){
        $helper->SendSuccessToast("Contact Deleted Sucessfully");
        $helper->Redirect(ADMIN_URL . 'contact.php');
    } else {
        $helper->SendSuccessToast("Contact Delete Failed!!");
        $helper->Redirect(ADMIN_URL . 'contact.php');
    }

}

$sql = "SELECT * FROM tbl_contact";
$result = $conn -> query($sql);
$rows = $result -> fetch_all(MYSQLI_ASSOC);
?>
<?php 
$title = "Contact";
require_once __DIR__ . "/include/layout-start.php"; 
?>
<div class="py-3">
<div class="table-responsive">
    <h1 class="py-2 px-3 border border-1">Contacts</h1>
    <table class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Subject</th>
                <th scope="col">Message</th>
                <th scope="col">DateTime</th>
                <th scope="col">Action</th>
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
                    <td><?=$value['name']?></td>
                    <td><?=$value['email']?></td>
                    <td><?=$value['phone']?></td>
                    <td><?=$value['subject']?></td>
                    <td><?=$value['message']?></td>
                    <td><?=$value['date']?></td>
                    <td>
                        <a class="ms-1"
                            href="<?=ADMIN_URL?>contact.php?did=<?=$value['id']?>"
                            onclick="return confirm('Are you sure?')">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php } ?>
            <?php if($sl == 0) { ?>
                <tr>
                    <td colspan="10">
                        <div class="text-center py-2">
                            No Contacts
                        </div>
                    </td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
</div>
</div>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>