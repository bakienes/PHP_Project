<?php
  date_default_timezone_set('Europe/Istanbul');
  echo "Bugünün Tarihi: " . date("Y/m/d") . "<br>";
  echo "Saat: " . date("h:i:sa");
?>
<?php
// Üye Girişi Yapılmamışsa Giriş Sayfasına Yönlendir.
  include "config/db.php";
  if ($_SESSION["login"]) {
//header("Location:login.php");
}
?>

<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Giriş Sayfası</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
</head>
<body>
<div class="container">
    <div class="col">
        <?php
        if ($_POST) {
            $kullanici_adi = trim($_POST["kullanici_adi"]);
            $sifre = trim($_POST["sifre"]);
            if (!$kullanici_adi || !$sifre) {
                echo '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Hatta!</strong> Kullanıcı Adı Veya Şifre Alanları Boş Bırakılamaz!  
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
            } else {
                $uye_varmi = $db->prepare("SELECT * FROM uyeler WHERE uye_kadi = ? AND uye_sifre = ?");
                $uye_varmi->execute(array($kullanici_adi, $sifre));
                if ($uye_varmi->rowCount() > 0) {
                    $uye = $uye_varmi->fetch(PDO::FETCH_OBJ);
                    $_SESSION["login"] = true;
                    $_SESSION["uye"] = $uye->uye_kadi;
                    $_SESSION["id"] = $uye->uye_id;
                    header("Refresh: 1; url=index.php");
                    echo '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Giriş Başarılı. </strong> Ana Sayfaya Yönlendirileceksiniz ... 
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>';
                } else {
                    echo '
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Hata!</strong> Kullanıcı İsmi Veya Parola Yanlış! Lütfen Tekrar Deneyin.  
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                    ';
                }
            }
        }
        ?>
        <h4 class="mt-5">Giriş</h4>
        <form method="post" action="">
            <div class="form-group">
                <label>UserName: (*)</label>
                <input type="text" class="form-control" placeholder="Kullanıcı Adınızı Giriniz" name="kullanici_adi">
            </div>
            <div class="form-group">
                <label>Şifre: (*)</label>
                <input type="password" class="form-control" placeholder="Şifrenizi Giriniz" name="sifre">
            </div>
            <button type="submit" class="btn btn-primary">Oturum Aç</button>
			<a href="register.php" class="btn btn-primary">Kayıt Ol</a>
        </form>
    </div>
</div>
</body>
</html>