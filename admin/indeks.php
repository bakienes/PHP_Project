<?php include "config/db.php" ?>
<?php include "library/header.php" ?>
<?php include "library/menu.php" ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Anasayfa Ayar Paneli</title>
    <!-- Bootstrap 4.3.1 Framework Projemize Dahil Ediyoruz -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <h4 class="mt-5">Anasayfa Ayar Paneli</h4>
            <form method="post" action="indekscontrol.php">
                <div class="form-group">
                    <label>Başlık: (*)</label>
                    <input type="text" class="form-control" placeholder="Başlık Giriniz" name="indeks_baslik">
                </div>
                <div class="form-group">
                    <label>İçerik Başlık: (*)</label>
                    <input type="text" class="form-control" placeholder="İçerik Başlık Giriniz" name="indeks_bicerik">
                </div>
                <div class="form-group">
                    <label>İçerik: (*)</label>
                    <input type="text" class="form-control" placeholder="İçerik Giriniz" name="indeks_icerik">
                </div>
                <button type="submit" class="btn btn-primary">Kaydet</button>
            </form>
        </div>
    </div>
</div>
<?php include "library/footer.php" ?>