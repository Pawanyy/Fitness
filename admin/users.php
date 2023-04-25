<?php require_once (dirname(__DIR__)) . "/config/conn.php"; ?>
<?php
$helper->IsAccessibleByAdmin();

if(isset($_GET['did']) && !empty($_GET['did'])){
    $user_id = $_GET['did'];
    $role = ROLE::USER;
    
    $sqlUserChk = "SELECT a.* FROM tbl_users a WHERE a.id = $user_id AND a.role = $role";
    $resultUserChk = $conn -> query($sqlUserChk);
    $rowUser = $resultUserChk -> fetch_assoc();
    
    if($rowUser === false || empty($rowUser)){
        $helper->SendErrorToast("User Doesn't Exist!!");
        $helper->Redirect(ADMIN_URL . "users.php");
    }

    $sql = "DELETE FROM tbl_users WHERE id = $user_id";
    $result = $conn -> query($sql);

    if($result){
        
        $helper->SendSuccessToast("User Deleted Sucessfully");
        $helper->Redirect(ADMIN_URL . 'users.php');
    } else {
        $helper->SendSuccessToast("User Delete Failed!!");
        $helper->Redirect(ADMIN_URL . 'User.php');
    }

}

$title = "Users";
require_once __DIR__ . "/include/layout-start.php"; 
?>
<?php
$role = ROLE::USER;
$sql = "SELECT a.* FROM tbl_users a WHERE a.role = $role GROUP BY a.id;";
$result = $conn -> query($sql);
$rows = $result -> fetch_all(MYSQLI_ASSOC);
?>
<div class="py-3">
<div class="table-responsive">
    <h1 class="py-2 px-3 border border-1 d-flex justify-content-between align-items-center">
        <span>Users</span>
        <a href="<?=ADMIN_URL?>addUser.php" class="btn btn-primary">Add User</a>
    </h1>
    <table class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Registered At</th>
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
                    <td><?=$value['name']?></td>
                    <td><?=$value['email']?></td>
                    <td><?=$value['phone']?></td>
                    <td><?=$value['created_at']?></td>
                    <td>
                        <a class="me-1" href="<?=ADMIN_URL?>user.php?user_id=<?=$value['id']?>">
                            View
                        </a>
                        <a class="ms-1"
                            href="<?=ADMIN_URL?>users.php?did=<?=$value['id']?>"
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
                            No Users
                        </div>
                    </td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
</div>
</div>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>