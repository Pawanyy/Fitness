<?php
$currentPage = "gallery";
?>
<?php require_once __DIR__ . "/include/layout-start.php"; ?>

<main aria-labelledby="title">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Gallery</li>
        </ol>
    </nav>

    <div class="container">
        <section class="pb-2 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light">Gallery</h1>
                    <p class="lead text-muted">Some Images of Event works.</p>
                </div>
            </div>
        </section>

        <section id="About">
            <div class="row">
                <?php 
                $sl = 0;
                foreach($gallery as $key => $value) { 
                    $sl++;
                    ?>
                <div class="col-4 mb-3">
                    <img class="w-100 rounded shadow" src="<?=BASE_URL . $value?>" alt="Image <?=$sl?>"/>
                </div>
            <?php } ?>
            </div>
        </section>
    </div>
</main>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>