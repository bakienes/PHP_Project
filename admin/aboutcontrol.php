<?php
  if (isset($_POST["about_baslik"])) {
  include "config/db.php";
   $about_baslik = trim($_POST["about_baslik"]);
   $about_icerik = trim($_POST["about_icerik"]);
   $about_ico = trim($_POST["about_ico"]);
   $onay = trim($_POST["onay"] ? 1 : 0);
    if (empty($about_baslik) || empty($about_icerik) || empty($about_ico)) {
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
         $ayni_form_varmi = $db -> prepare("SELECT * FROM about WHERE about_baslik = ?");
         $ayni_form_varmi -> execute(array($about_baslik));
          if($ayni_form_varmi -> rowCount()){
            echo '
            <div class="alert alert-danger" role="alert">
           Veritabanında Zaten Böyle Bir Veri Mevcut!
            </div>';
          }else{
             $form_ekle = $db->prepare("INSERT INTO about (about_baslik, about_icerik, about_ico) VALUES (?,?,?)");
             $form_ekle -> execute(array($about_baslik, $about_icerik, $about_ico));
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