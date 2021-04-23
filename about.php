<?php include "library/header.php" ?>
<?php include "library/menu.php" ?>
<?php
    $query = $db->query("SELECT * FROM about", PDO::FETCH_ASSOC);
    $islem = $query->fetch(PDO::FETCH_ASSOC);
?>
    <!-- About Start -->
    <div class="container py-5">
        <div class="row py-5">
            <div class="col-lg-7 pb-5 pb-lg-0 px-3 px-lg-5">
                <h1 class="display-4 mb-4"><span class="text-primary"><?php echo $islem["about_baslik"]; ?></span></h1>
                <h5 class="text-muted mb-3"><?php echo $islem["about_icerik"]; ?></h5>
                <ul class="list-inline">
                    <li><h5><i class="fa fa-check-double text-secondary mr-3"></i><?php echo $islem["about_ico"]; ?></h5></li>
                </ul>
            </div>
            <div class="col-lg-5">
                <div class="row px-3">
                    <div class="col-12 p-0">
                        <img class="img-fluid w-100" src="img/about-1.jpg" alt="">
                    </div>
                    <div class="col-6 p-0">
                        <img class="img-fluid w-100" src="img/about-2.jpg" alt="">
                    </div>
                    <div class="col-6 p-0">
                        <img class="img-fluid w-100" src="img/about-3.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
<?php include "library/footer.php" ?>