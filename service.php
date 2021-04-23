<?php include "library/header.php" ?>
<?php include "library/menu.php" ?>
<?php
    $query = $db->query("SELECT * FROM service", PDO::FETCH_ASSOC);
    $islem = $query->fetch(PDO::FETCH_ASSOC);
?>
    <!-- Services Start -->
    <div class="container-fluid bg-light pt-5">
        <div class="container py-5">
            <div class="d-flex flex-column text-center mb-5">
                <h1 class="display-4 m-0"><span class="text-primary"><?php echo $islem["service_baslik"]; ?></span></h1>
            </div>
            <div class="row pb-3">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5">
                        <h3 class="flaticon-house display-3 font-weight-normal text-secondary mb-3"></h3>
                        <h3 class="mb-3"><?php echo $islem["service_sbaslik"]; ?></h3>
                        <p><?php echo $islem["service_icerik"]; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->
<?php include "library/footer.php" ?>