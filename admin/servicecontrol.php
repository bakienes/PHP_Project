<?php
  if (isset($_POST["service_baslik"])) {
  include "config/db.php";
   $service_baslik = trim($_POST["service_baslik"]);
   $service_sbaslik = trim($_POST["service_sbaslik"]);
   $service_icerik = trim($_POST["service_icerik"]);
   $onay = trim($_POST["onay"] ? 1 : 0);
    if (empty($service_baslik) || empty($service_sbaslik) || empty($service_icerik)) {
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
         $ayni_form_varmi = $db -> prepare("SELECT * FROM service WHERE service_baslik = ?");
         $ayni_form_varmi -> execute(array($service_baslik));
          if($ayni_form_varmi -> rowCount()){
            echo '
            <div class="alert alert-danger" role="alert">
           Veritabanında Zaten Böyle Bir Veri Mevcut!
            </div>';
          }else{
             $form_ekle = $db->prepare("INSERT INTO service (service_baslik, service_sbaslik, service_icerik) VALUES (?,?,?)");
             $form_ekle -> execute(array($service_baslik, $service_sbaslik, $service_icerik));
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