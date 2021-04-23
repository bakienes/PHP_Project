<?php
  if (isset($_POST["price_baslik"])) {
  include "config/db.php";
   $price_baslik = trim($_POST["price_baslik"]);
   $price_fiyat = trim($_POST["price_fiyat"]);
   $price_detay = trim($_POST["price_detay"]);
   $onay = trim($_POST["onay"] ? 1 : 0);
    if (empty($price_baslik) || empty($price_fiyat) || empty($price_detay)) {
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
         $ayni_form_varmi = $db -> prepare("SELECT * FROM price WHERE price_baslik = ?");
         $ayni_form_varmi -> execute(array($price_baslik));
          if($ayni_form_varmi -> rowCount()){
            echo '
            <div class="alert alert-danger" role="alert">
           Veritabanında Zaten Böyle Bir Veri Mevcut!
            </div>';
          }else{
             $form_ekle = $db->prepare("INSERT INTO price (price_baslik, price_fiyat, price_detay) VALUES (?,?,?)");
             $form_ekle -> execute(array($price_baslik, $price_fiyat, $price_detay));
             if ($form_ekle){
               echo '
               <div class="alert alert-success" role="alert">
              Kayıt Başarıyla Tamamlandı
               </div>';
              header("Refresh:3; url=index.php");
             }else{
               echo '
               <div class="alert alert-danger" role="alert">
                Kayıt Başarısız Oldu. Bir Sorun Var. 
               </div>';
              }
          }
       }
    }
}
?>