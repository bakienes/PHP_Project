<?php include "library/header.php" ?>
<?php include "library/menu.php" ?>
<?php
    $query = $db->query("SELECT * FROM price", PDO::FETCH_ASSOC);
    $islem = $query->fetch(PDO::FETCH_ASSOC);
?>
    <!-- Pricing Plan Start -->
    <div class="container-fluid bg-light pt-5 pb-4">
        <div class="container py-5">
            <div class="d-flex flex-column text-center mb-5">
                <h1 class="display-4 m-0"><span class="text-primary"><?php echo $islem["price_baslik"]; ?></span></h1>
            </div>
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="card border-0">
                        <div class="card-header position-relative border-0 p-0 mb-4">
                            <img class="card-img-top" src="img/price-1.jpg" alt="">
                            <div class="position-absolute d-flex flex-column align-items-center justify-content-center w-100 h-100" style="top: 0; left: 0; z-index: 1; background: rgba(0, 0, 0, .5);">
                                <h1 class="display-4 text-white mb-0">
                                    <small class="align-top" style="font-size: 22px; line-height: 45px;"></small><?php echo $islem["price_fiyat"]; ?>$<small class="align-bottom" style="font-size: 16px; line-height: 40px;"></small>
                                </h1>
                            </div>
                        </div>
                        <div class="card-body text-center p-0">
                            <ul class="list-group list-group-flush mb-4">
                                <li class="list-group-item p-2"><i class="fa fa-check text-secondary mr-2"></i><?php echo $islem["price_detay"]; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pricing Plan End -->
<?php include "library/footer.php" ?>

</html>