<?php include "config/db.php" ?>
<?php include "library/header.php" ?>
<?php include "library/menu.php" ?>
<?php
    $query = $db->query("SELECT * FROM indeks", PDO::FETCH_ASSOC);
    $islem = $query->fetch(PDO::FETCH_ASSOC);
?>
    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <?php 
    					$slider = $db->prepare("SELECT * FROM slider");
    					$slider->execute();
    					if($slider->rowCount()){
        				foreach($slider as $row){
            		?>
            		<img class="w-100" src="admin/<?php echo $row["slider_resim"];?>" alt="" />
            		<?php 
                		}
                		}else{
                    	echo "Resim bulunamadı";
                     	}
            		?>
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h3 class="text-white mb-3 d-none d-sm-block">Best Pet Services</h3>
                            <h1 class="display-3 text-white mb-3"><?php echo $row["slider_aciklama"];?></h1>
                            <h5 class="text-white mb-3 d-none d-sm-block">Duo nonumy et dolor tempor no et. Diam sit diam sit diam erat</h5>
                            <a href="" class="btn btn-lg btn-primary mt-3 mt-md-4 px-4">Book Now</a>
                            <a href="" class="btn btn-lg btn-secondary mt-3 mt-md-4 px-4">Learn More</a>
                        </div>
                    </div>
                </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-primary rounded" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-primary rounded" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->
    <!-- Services Start -->
    <div class="container-fluid bg-light pt-5">
        <div class="container py-5">
            <div class="d-flex flex-column text-center mb-5">
                <h1 class="display-4 m-0"><span class="text-primary"><?php echo $islem["indeks_baslik"]; ?></span></h1>
            </div>
            <div class="row pb-3">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="d-flex flex-column text-center bg-white mb-2 p-3 p-sm-5">
                        <h3 class="flaticon-house display-3 font-weight-normal text-secondary mb-3"></h3>
                        <h3 class="mb-3"><?php echo $islem["indeks_bicerik"]; ?></h3>
                        <p><?php echo $islem["indeks_icerik"]; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Services End -->   
<?php include "library/footer.php" ?>