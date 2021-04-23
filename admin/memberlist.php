<?php
// Üye Girişi Yapılmamışsa Giriş Sayfasına Yönlendir.
    include "config/db.php";
    if(!$_SESSION["login"]){
    header("Location:login.php");
}
?>
<?php include "library/header.php" ?>
<?php include "library/menu.php" ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Üye Listesi Paneli</title>
    <!-- Bootstrap 4.3.1 Framework Projemize Dahil Ediyoruz -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col">
            <h4 class="mt-5">Üye Listesi Paneli</h4>
            <table class="table">
                <thead class="thead-light">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Kullanıcı Adı</th>
                    <th scope="col">Şifre</th>
                    <th scope="col">E-Posta</th>
                    <th scope="col">Düzenle / Sil</th>
                </tr>
                </thead>
                <tbody>
                
                <?php
                    include "config/db.php";
                    $uyeler = $db -> query("SELECT * FROM uyeler ORDER BY uye_id ASC", PDO::FETCH_OBJ);
                    foreach ($uyeler as $uye) { ?>

                    <tr>
                        <th scope="row"><?php echo $uye->uye_id;?></th>
                        <td><?php echo $uye->uye_kadi;?></td>
                        <td><?php echo $uye->uye_sifre;?></td>
                        <td><?php echo $uye->uye_eposta;?></td>
                        <td>
                            <a href="useredit.php?id=<?php echo $uye->uye_id;?>">[ Düzenle ]</a>
                            <a href="userdelete.php?id=<?php echo $uye->uye_id;?>">[ Sil ]</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
            <a href="useradd.php" class="btn btn-primary">Yeni Kullanıcı Ekle</a>
        </div>
    </div>
</div>

<?php include "library/footer.php" ?>