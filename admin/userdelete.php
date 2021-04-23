<?php
// Üye Girişi Yapılmamışsa Giriş Sayfasına Yönlendir.
    include "config/db.php";
    if(!$_SESSION["login"]){
    header("Location:login.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Delete Page</title>
     <!-- Bootstrap 4.3.1 Framework Projemize Dahil Ediyoruz -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <h4 class="mt-5">User Delete Panel</h4>
            
            <?php
            include "config/db.php";
            $id = $_GET["id"];
            $uye_getir = $db->prepare("SELECT * FROM uyeler WHERE uye_id = ?");
            $uye_getir->execute(array($id));
            if ($uye_getir->rowCount()) {
                $uye_sil = $db->prepare("DELETE FROM uyeler WHERE uye_id = ?");
                $uye_sil->execute(array($id));
                if ($uye_sil->rowCount()) {
                    echo '
                    <div class="alert alert-success" role="alert">
                    The member was deleted. 
                    </div>';
                    header("Location:memberlist.php");
                } else {
                    echo '    
                    <div class="alert alert-danger" role="alert">
                    Deleting members failed. There is a problem. 
                    </div>';
                }
            } else {
                header("Location:memberlist.php");
            }
            ?>
        
        </div>
    </div>
</div>
</body>
</html>