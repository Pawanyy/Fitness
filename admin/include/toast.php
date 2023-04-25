<?php if(isset($_SESSION['sucmsg'])) { ?>
<div class="mt-3 alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success:</strong>&nbsp;<?php echo $_SESSION['sucmsg']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php unset($_SESSION['sucmsg']); } ?>

<?php if(isset($_SESSION['errmsg'])) { ?>
<div class="mt-3 alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Error:</strong>&nbsp;<?php echo $_SESSION['errmsg']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php unset($_SESSION['errmsg']); } ?>
<script>
$( document ).ready(function() {
    $('.alert').alert()
});
</script>