<?php
$currentPage = "about";
?>
<?php require_once __DIR__ . "/include/layout-start.php"; ?>
<?php
$sqlFaq = "SELECT a.*  FROM tbl_faq a; ";
$resultFaq = $conn -> query($sqlFaq);
$faqRows = $resultFaq -> fetch_all(MYSQLI_ASSOC);
?>
<main aria-labelledby="title">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About</li>
        </ol>
    </nav>

    <div class="container">

        <section class="py-5 text-center container">
            <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light"><?=$settings['name']?></h1>
                    <p class="lead text-muted"><?=$settings['about_desc']?></p>
                    <p>
                        <a href="/" class="btn btn-primary my-2">Home</a>
                        <a href="<?=BASE_URL?>contact.php" class="btn btn-secondary my-2">Contact Us</a>
                    </p>
                </div>
            </div>
        </section>

        <section id="About">
            <h1 class="text-center">FAQ</h1>
            <div class="accordion" id="accordionExample">
                <?php 
                $sl = 0;
                foreach($faqRows as $key => $value) { 
                    $sl++;
                    ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading_<?=$sl?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_<?=$sl?>" aria-expanded="true" aria-controls="collapse_<?=$sl?>">
                            <strong>Question <?=$sl?>:</strong>&nbsp; <?=$value['question']?>
                        </button>
                    </h2>
                    <div id="collapse_<?=$sl?>" class="accordion-collapse collapse" aria-labelledby="heading_<?=$sl?>" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>Answer:</strong> <?=$value['answer']?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </section>
    </div>
</main>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>