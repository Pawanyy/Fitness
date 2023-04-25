<?php require_once __DIR__ . "/include/layout-start.php"; ?>
<?php
if( ! $helper->isUserLogin()){
    $helper->Redirect(BASE_URL . 'login.php');
}

$user_id = $_SESSION['uid'];
$sql = "SELECT a.*, b.date AS r_date FROM tbl_events a LEFT JOIN tbl_event_register b ON a.id = b.event_id  WHERE b.user_id = $user_id";
$result = $conn -> query($sql);
$rows = $result -> fetch_all(MYSQLI_ASSOC);
?>
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">My Events</h1>
        <p class="lead text-muted mx-5 px-5">You can browse your Registered Events.</p>
    </div>
</section>

<div class="table-responsive">
    <table class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Event Name</th>
                <th scope="col">Event Date</th>
                <th scope="col">Register At</th>
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
                    <td><?=$value['date']?></td>
                    <td><?=$value['r_date']?></td>
                    <td>
                        <a href="<?=BASE_URL?>eventDetails.php?event_id=<?=$value['id']?>">
                            View
                        </a>
                    </td>
                </tr>
            <?php } ?>
            <?php if($sl == 0) { ?>
                <tr>
                    <td colspan="5">
                        <div class="text-center py-2">
                            No Events
                        </div>
                    </td>
                </tr>
            <?php } ?> 
        </tbody>
    </table>
</div>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>