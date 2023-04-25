<?php
$currentPage = "home";
?>
<?php require_once __DIR__ . "/include/layout-start.php"; ?>
<?php
    $gallery = array_splice($gallery, 0, 3);

    $sqlEvents = "SELECT a.* FROM tbl_events a ORDER BY a.id DESC LIMIT 3";
    $resultEvents = $conn -> query($sqlEvents);
    $rowEvents = $resultEvents -> fetch_all(MYSQLI_ASSOC);
?>
<style>
    .cover-bg {
        background-image: url('<?=BASE_URL?>assets/img/bg/nssWLogo.jpg');
        background-size: cover;
    }

    .cover-bg .text-container {
        box-shadow: inset #0000004a 0px 0px 200px 200px;
        color: white;
    }

    h1.site-title {
        font-weight:600;
    }
    
    h1.site-title+p.lead {
        font-weight:400;
    }
</style>

<section>
    <div class="p-4 p-md-5 mb-4 rounded cover-bg">
        <div class="col-md-6 p-4 text-container rounded">
            <h1 class="site-title display-4 fst-italic"><?=$settings['name']?></h1>
            <p class="lead my-3">
                <?=$settings['main_desc']?>
            </p>
        </div>
    </div>
</section>

<!-- <section>
    <div class="container px-4 py-5" id="icon-grid">
        <h2 class="pb-2 border-bottom">Features</h2>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
            <div class="col d-flex align-items-start">
                <i class="bi-r-circle text-muted flex-shrink-0 me-3 fs-2"></i>
                <div>
                    <h3 class="fw-bold mb-0 fs-4">Simple</h3>
                    <p>Offers a user-friendly and straightforward experience for buying, selling, or renting properties.</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <i class="bi-currency-dollar text-muted flex-shrink-0 me-3 fs-2"></i>
                <div>
                    <h3 class="fw-bold mb-0 fs-4">Affordable</h3>
                    <p>Provides cost-effective solutions for clients looking to save money on real estate transactions.</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <i class="bi-safe text-muted flex-shrink-0 me-3 fs-2"></i>
                <div>
                    <h3 class="fw-bold mb-0 fs-4">Trusted</h3>
                    <p>Reliable and reputable platform that clients can trust to meet their real estate needs.</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <i class="bi-fast-forward text-muted flex-shrink-0 me-3 fs-2"></i>
                <div>
                    <h3 class="fw-bold mb-0 fs-4">Faster</h3>
                    <p>Offers quicker transactions and turnaround times compared to traditional real estate processes.</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <i class="bi-buildings text-muted flex-shrink-0 me-3 fs-2"></i>
                <div>
                    <h3 class="fw-bold mb-0 fs-4">Quantity</h3>
                    <p>Boasts a vast selection of properties for clients to choose from, catering to a diverse range of needs and preferences.</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <i class="bi-globe-asia-australia text-muted flex-shrink-0 me-3 fs-2"></i>
                <div>
                    <h3 class="fw-bold mb-0 fs-4">Global</h3>
                    <p>Have a global presence, providing access to properties across various locations worldwide.</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <i class="bi-cash-coin text-muted flex-shrink-0 me-3 fs-2"></i>
                <div>
                    <h3 class="fw-bold mb-0 fs-4">Refund</h3>
                    <p>Offers a refund option in case clients are dissatisfied with the services provided.</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <i class="bi-wifi text-muted flex-shrink-0 me-3 fs-2"></i>
                <div>
                    <h3 class="fw-bold mb-0 fs-4">Remote</h3>
                    <p>Allows clients to access and manage their real estate transactions remotely, providing convenience and flexibility.</p>
                </div>
            </div>
        </div>
    </div>
</section> -->
<section class="my-2">
    <h2 class="pb-2 border-bottom">Images</h2>
    <div class="row pt-3">
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
    <a class="btn btn-link w-100 h4 text-decoration-none mouse-pointer pb-2 text-center border border-1 py-2 mt-2 px-4"
        href="<?=BASE_URL?>gallery.php">View More</a>
</section>
<section class="my-2">
    <h2 class="pb-2 border-bottom">Events</h2>
    <div class="row pt-3">
        <?php 
        $sl = 0;
        foreach($rowEvents as $key => $value) { 
            $sl++;
            ?>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <?=$value['name']?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <?=substr($value['description'], 0, 255)."..."?>
                            <a href="<?=BASE_URL?>eventDetails.php?event_id=<?=$value['id']?>"
                            class="btn btn-link text-decoration-none p-0">Read more</a>
                        </p>
                        <!-- <?php if(empty($value['reg_date'])){ ?>
                        <a href="<?=BASE_URL?>events.php?event_id=<?=$value['id']?>"
                            onclick="return confirm('Are you Sure to book for <?=$value['name']?> event!')"
                            class="btn btn-warning">Book</a>
                            <?php } else { ?>
                                <button class="btn btn-secondary">Already Booked</button>
                                <span class="d-block font-sm mt-2"> Registered on: <?= $value['reg_date'] ?></span>
                            <?php } ?> -->
                    </div>
                    <div class="card-footer">
                        <span><?= $value['date'] ?></span>
                    </div>
                </div>
            </div>
    <?php } ?>
    </div>
    <a class="btn btn-link w-100 h4 text-decoration-none mouse-pointer pb-2 text-center border border-1 py-2 mt-2 px-4"
        href="<?=BASE_URL?>events.php">View More</a>
</section>
<section>
    <div class="container px-4 py-5" id="custom-cards">
        <h2 class="pb-2 border-bottom">Testimonials</h2>

        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 py-5">
            <div class="col">
                <div class="card card-cover h-100 overflow-hidden rounded-4 shadow-lg" style="background-image: url(@Url.Content("~/assets/img/RealEstate-bg1.jpg"));">
                    <div class="d-flex flex-column h-100 p-5 py-3 text-shadow-1">
                        <h3 class="my-4 display-6 lh-1 fw-bold"><q>I was impressed by the quantity and quality of NSS Work.</q></h3>
                        <ul class="d-flex list-unstyled mt-auto">
                            <li class="me-auto">
                                <i class="bi-person-circle fs-3"></i>
                            </li>
                            <li class="d-flex align-items-center me-3">
                                <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"></use></svg>
                                <small>Jayesh Mishra</small>
                            </li>
                            <li class="d-flex align-items-center">
                                <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"></use></svg>
                                <small>3d</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card card-cover h-100 overflow-hidden rounded-4 shadow-lg" style="background-image: url('unsplash-photo-2.jpg');">
                    <div class="d-flex flex-column h-100 p-5 py-3 text-shadow-1">
                        <h3 class="my-4 display-6 lh-1 fw-bold"><q>NNS's global reach helped me find the opportunity to Broden my View.</q></h3>
                        <ul class="d-flex list-unstyled mt-auto">
                            <li class="me-auto">
                                <i class="bi-person-circle fs-3"></i>
                            </li>
                            <li class="d-flex align-items-center me-3">
                                <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"></use></svg>
                                <small>Reshma Singh</small>
                            </li>
                            <li class="d-flex align-items-center">
                                <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"></use></svg>
                                <small>4d</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card card-cover h-100 overflow-hidden rounded-4 shadow-lg" style="background-image: url('unsplash-photo-3.jpg');">
                    <div class="d-flex flex-column h-100 p-5 py-3 text-shadow-1">
                        <h3 class="my-4 display-6 lh-1 fw-bold"><q>NSS made me Learn may New Things By Practice.</q></h3>
                        <ul class="d-flex list-unstyled mt-auto">
                            <li class="me-auto">
                                <i class="bi-person-circle fs-3"></i>
                            </li>
                            <li class="d-flex align-items-center me-3">
                                <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#geo-fill"></use></svg>
                                <small>Jiwan Chaudhary</small>
                            </li>
                            <li class="d-flex align-items-center">
                                <svg class="bi me-2" width="1em" height="1em"><use xlink:href="#calendar3"></use></svg>
                                <small>5d</small>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . "/include/layout-end.php"; ?>