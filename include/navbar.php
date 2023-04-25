<header>
    <nav class="navbar sticky-top navbar-expand-sm navbar-toggleable-sm navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="<?=BASE_URL?>">
                <img src="<?=BASE_URL?>/assets/img/NSS.png" alt="Logo" height="35" class="d-inline-block align-text-top rounded-4">
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target=".navbar-collapse" title="Toggle navigation" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-sm-inline-flex justify-content-between">
                <ul class="navbar-nav flex-grow-1">
                    <li class="nav-item"><a class="nav-link <?=(isset($currentPage) && $currentPage == "home") ? "active" : ""?>" href="<?=BASE_URL?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link <?=(isset($currentPage) && $currentPage == "gallery") ? "active" : ""?>" href="<?=BASE_URL?>gallery.php">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link <?=(isset($currentPage) && $currentPage == "about") ? "active" : ""?>" href="<?=BASE_URL?>about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link <?=(isset($currentPage) && $currentPage == "events") ? "active" : ""?>" href="<?=BASE_URL?>events.php">Events</a></li>
                    <li class="nav-item"><a class="nav-link <?=(isset($currentPage) && $currentPage == "contact") ? "active" : ""?>" href="<?=BASE_URL?>contact.php">Contact</a></li>

                </ul>
                <form class="d-flex" role="search">
                    <?php if(!$helper->IsLogin()) { ?>
                        <a class="btn btn-success" href="<?=BASE_URL?>login.php">Login</a>
                        <a class="btn btn-info ms-2" href="<?=BASE_URL?>register.php">Sign Up</a>
                        <a class="btn btn-danger ms-2" href="<?=ADMIN_URL?>login.php">Admin</a>
                    <?php } else { ?>
                        <?php if ($helper->IsUserLogin()) { ?>
                        <span class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white ps-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?=$_SESSION['email']?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?=BASE_URL?>profile.php">Profile</a></li>
                                <li><a class="dropdown-item" href="<?=BASE_URL?>donations.php">Donations</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="<?=BASE_URL?>myEvents.php">Registered Event</a></li>
                            </ul>
                        </span>
                        <?php } else { ?>
                        <a href="<?=ADMIN_URL . "dashboard.php"?>">
                            <span class="text-white ps-2">
                                <?=$_SESSION['email']?>
                            </span>
                        </a>
                        <?php } ?>

                        
                    <a class="btn btn-danger ms-2" href="<?=BASE_URL?>logout.php">Logout</a>
                    <?php } ?>
                </form>
            </div>
        </div>
    </nav>
</header>