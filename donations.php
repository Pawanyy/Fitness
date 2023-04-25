<?php require_once __DIR__ . "/include/layout-start.php"; ?>
<?php
if(!$helper->isUserLogin()){
    $helper->Redirect(BASE_URL . 'login.php');
}

$user_id = $_SESSION['uid'];

if(isset($_POST['donate'])){
    $donationAmount = $conn->real_escape_string($_POST['Amount']);
    $created_at = date('Y-m-d h:i:s A');
    
    $sql = "INSERT INTO `tbl_donation`(`donation`, `user_id`, `date`) 
            VALUES ('$donationAmount','$user_id','$created_at')";
    $result = $conn -> query($sql);

    if($result){
        $helper->SendSuccessToast("Money Donated Sucessfully");
        $helper->Redirect(BASE_URL . 'donations.php');
    } else {
        $helper->SendErrorToast("Error Occoured!!");
        $helper->Redirect(BASE_URL . 'donations.php');
    }
}

$sql = "SELECT * FROM tbl_donation WHERE user_id = $user_id";
$result = $conn -> query($sql);
$rows = $result -> fetch_all(MYSQLI_ASSOC);
?>
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Make Donations</h1>
        <p class="lead text-muted mx-5 px-5">Your Can Donate any Amount.</p>
    </div>
</section>
<section class="jumbotron text-center mt-5 mb-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4 border border-1 px-2 py-3 mb-3 shadow rounded">
                <form method="post">
                    <div class="mb-3 text-start">
                        <label for="Amount" class="form-label">Donation Amount</label>
                        <input type="number" min="1" max="999999" required class="form-control" name="Amount" id="Amount">
                        <div id="emailHelp" class="form-text">Your Contribution Matters.</div>
                    </div>
                    <button type="submit" name="donate" class="btn btn-primary">Donate</button>
                </form>
            </div>
        </div>
    </div>
</section>
<div class="table-responsive">
    <h2 class="px-3 py-2 border border-1">My Donations</h2>
    <table class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Donation Amount</th>
                <th scope="col">Date</th>
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
                    <td><?=$value['donation']?></td>
                    <td><?=$value['date']?></td>
                </tr>
            <?php } ?>
            <?php if($sl == 0) { ?>
                <tr>
                    <td colspan="3">
                        <div class="text-center py-2">
                            No Donations
                        </div>
                    </td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
</div>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>