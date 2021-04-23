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
    <title>Yeni Kullanıcı Ekleme Paneli</title>
    <!-- Bootstrap 4.3.1 Framework Projemize Dahil Ediyoruz -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <h4 class="mt-5">Yeni Kullanıcı Ekleme Paneli</h4>
              
<?php
  if (isset($_POST["uye_kadi"])) {
  include "config/db.php";
   $uye_kadi = trim($_POST["uye_kadi"]);
   $uye_sifre = trim($_POST["uye_sifre"]);
   $uye_eposta = trim($_POST["uye_eposta"]);
   $onay = trim($_POST["onay"] ? 1 : 0);
    if (empty($uye_kadi) || empty($uye_sifre) || empty($uye_eposta)) {
      echo '
       <div class="alert alert-danger" role="alert">
      Lütfen Yıldızlı Alanları Boş Bırakmayın. 
      </div>';
    } else {
       if ($onay != 0) {
        echo '
        <div class="alert alert-danger" role="alert">
       Kuralları Kabul Ediniz!!! 
        </div>';
       } else {
         $ayni_uye_varmi = $db -> prepare("SELECT * FROM uyeler WHERE uye_kadi = ?");
         $ayni_uye_varmi -> execute(array($uye_kadi));
          if($ayni_uye_varmi -> rowCount()){
            echo '
            <div class="alert alert-danger" role="alert">
           Bu Kullanıcı Adı Zaten Kullanılıyor. Farklı Bir Kullanıcı Adı Deneyin. 
            </div>';
          }else{
             $uye_ekle = $db->prepare("INSERT INTO uyeler (uye_kadi, uye_sifre, uye_eposta) VALUES (?,?,?)");
             $uye_ekle -> execute(array($uye_kadi, $uye_sifre, $uye_eposta));
             if ($uye_ekle){
               echo '
               <div class="alert alert-success" role="alert">
              Kayıt Başarıyla Tamamlandı
               </div>';
             }else{
               echo '
               <div class="alert alert-danger" role="alert">
               Üye Kaydı Başarısız Oldu. Bir Sorun Var. 
               </div>';
              }
          }
       }
    }
}
?>
            <form method="post" action="">
                <div class="form-group">
                    <label>Kullanıcı Adı: (*)</label>
                    <input type="text" class="form-control" placeholder="Kullanıcı Adı Giriniz" name="uye_kadi">
                </div>
                <div class="form-group">
                    <label>Şifre: (*)</label>
                    <input type="password" class="form-control" placeholder="Şifre Giriniz" name="uye_sifre">
                </div>
                <div class="form-group">
                    <label>E-Posta: (*)</label>
                    <input type="email" class="form-control" placeholder="E-Posta Giriniz" name="uye_eposta">
                </div>
                
                <button type="submit" class="btn btn-primary">Yeni Kullanıcıyı Oluştur</button>
                <a href="memberlist.php" class="btn btn-primary">üye Listesi</a>
            </form>
        </div>
    </div>
</div>

<?php include "library/footer.php" ?>