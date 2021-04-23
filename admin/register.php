<?php include "config/db.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
    <!-- Bootstrap 4.3.1 Framework Projemize Dahil Ediyoruz -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <h4 class="mt-5">Register</h4>

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
       Please do not leave the starred fields blank. 
       </div>';
    } else {
       if ($onay != 1) {
        echo '
        <div class="alert alert-danger" role="alert">
        You have to accept the terms of membership. 
        </div>';
       } else {
         $ayni_uye_varmi = $db -> prepare("SELECT * FROM uyeler WHERE uye_kadi = ?");
         $ayni_uye_varmi -> execute(array($uye_kadi));
          if($ayni_uye_varmi -> rowCount()){
            echo '
            <div class="alert alert-danger" role="alert">
            This username is already taken. Please try a different username. 
            </div>';
          }else{
             $uye_ekle = $db->prepare("INSERT INTO uyeler (uye_kadi, uye_sifre, uye_eposta) VALUES (?,?,?)");
             $uye_ekle -> execute(array($uye_kadi, $uye_sifre, $uye_eposta));
             if ($uye_ekle){
               echo '
               <div class="alert alert-success" role="alert">
               Registration is complete. You are redirected to the home page ... 
               </div>';
				       header("Refresh: 2; url=login.php"); 
             }else{
               echo '
               <div class="alert alert-danger" role="alert">
               Member registration failed. There is a problem. 
               </div>';
              }
          }
       }
    }
}
?>
          <form method="post" action="">
            <div class="form-group">
              <label>UserName: (*)</label>
              <input type="text" class="form-control" placeholder="Pleas UserName" name="uye_kadi">
            </div>
            <div class="form-group">
              <label>Password: (*)</label>
              <input type="password" class="form-control" placeholder="Pleas Password" name="uye_sifre">
            </div>
            <div class="form-group">
              <label>Mail: (*)</label>
              <input type="email" class="form-control" placeholder="Pleas Mail" name="uye_eposta">
            </div>
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" name="onay">
              <label class="form-check-label">I accept the terms of membership (*)</label>
            </div>
              <button type="submit" class="btn btn-primary">Register</button>
          </form>
        </div>
    </div>
</div>
</body>
</html>