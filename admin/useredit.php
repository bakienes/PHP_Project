<?php
// Üye Girişi Yapılmamışsa Giriş Sayfasına Yönlendir.
    include "config/db.php";
    if(!$_SESSION["login"]){
    header("Location:login.php");
}
?>
<?php
    include "config/db.php";
        $id = $_GET["id"];
        $uye_getir = $db->prepare("SELECT * FROM uyeler WHERE uye_id = ?");
        $uye_getir->execute(array($id));
    if ($uye_getir) {
        $uye = $uye_getir->fetch(PDO::FETCH_OBJ);
    }
?>
<?php include "library/header.php" ?>
<?php include "library/menu.php" ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kullanıcı Düzenleme Paneli</title>
    <!-- Bootstrap 4.3.1 Framework Projemize Dahil Ediyoruz -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <h4 class="mt-5">Kullanıcı Düzenleme Paneli</h4>

            <?php
            if (isset($_POST["uye_kadi"])) {
                $uye_kadi = trim($_POST["uye_kadi"]);
                $uye_sifre = trim($_POST["uye_sifre"]);
                $uye_eposta = trim($_POST["uye_eposta"]);
                if (empty($uye_kadi) || empty($uye_sifre) || empty($uye_eposta)) {
                    echo '
                       <div class="alert alert-danger" role="alert">
                      Yıldızlı Alanlar Boş Bırakılamaz. 
                      </div>';
                } else {
                    $ayni_uye_varmi = $db->prepare("SELECT * FROM uyeler WHERE uye_kadi = ? AND uye_id != ?");
                    $ayni_uye_varmi->execute(array($uye_kadi, $id));
                    if ($ayni_uye_varmi->rowCount()) {
                        echo '
                           <div class="alert alert-danger" role="alert">
                           Bu Kullanıcı Adı Zaten Kayıtlı! Farklı Bir Kullanıcı Adı Deneyin. 
                          </div>';
                    } else {
                        $uye_guncelle = $db->prepare("UPDATE uyeler SET uye_kadi = ?, uye_sifre = ?, uye_eposta = ? WHERE uye_id = ?");
                        $uye_guncelle->execute(array($uye_kadi, $uye_sifre, $uye_eposta, $id));
                        if ($uye_guncelle){
                            echo '
                           <div class="alert alert-success" role="alert">
                           Değişiklikler Kaydedildi!! Listeye İletilecek. 
                           </div>';
                            header("Location:memberlist.php");
                        }else{
                            echo '
                           <div class="alert alert-danger" role="alert">
                           Üye Güncellemesi Başarısız Oldu. Bir Sorun Var. 
                           </div>';
                        }
                    }
                }
            }
            ?>

            <form method="post" action="">
                <div class="form-group">
                    <label>Kullanıcı Adı: (*)</label>
                    <input type="text" class="form-control" placeholder="Yeni Kullanıcı Adı Giriniz" name="uye_kadi"
                           value="<?php echo $uye->uye_kadi; ?>">
                </div>
                <div class="form-group">
                    <label>Şifre: (*)</label>
                    <input type="text" class="form-control" placeholder="Yeni Şifre Giriniz" name="uye_sifre"
                           value="<?php echo $uye->uye_sifre; ?>">
                </div>
                <div class="form-group">
                    <label>E-Posta: (*)</label>
                    <input type="email" class="form-control" placeholder="Yeni E-Posta Giriniz" name="uye_eposta"
                           value="<?php echo $uye->uye_eposta; ?>">
                </div>
                <button type="submit" class="btn btn-primary">Güncelle</button>
                <a href="memberlist.php" class="btn btn-primary">Üye Listesi</a>
            </form>
        </div>
    </div>
</div>

<?php include "library/footer.php" ?>