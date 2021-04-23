<?php
  if (isset($_POST["indeks_baslik"])) {
  include "config/db.php";
   $indeks_baslik = trim($_POST["indeks_baslik"]);
   $indeks_bicerik = trim($_POST["indeks_bicerik"]);
   $indeks_icerik = trim($_POST["indeks_icerik"]);
   $onay = trim($_POST["onay"] ? 1 : 0);
    if (empty($indeks_baslik) || empty($indeks_bicerik) || empty($indeks_icerik)) {
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
         $ayni_form_varmi = $db -> prepare("SELECT * FROM indeks WHERE indeks_baslik = ?");
         $ayni_form_varmi -> execute(array($indeks_baslik));
          if($ayni_form_varmi -> rowCount()){
            echo '
            <div class="alert alert-danger" role="alert">
           Veritabanında Zaten Böyle Bir Veri Mevcut!
            </div>';
          }else{
             $form_ekle = $db->prepare("INSERT INTO indeks (indeks_baslik, indeks_bicerik, indeks_icerik) VALUES (?,?,?)");
             $form_ekle -> execute(array($indeks_baslik, $indeks_bicerik, $indeks_icerik));
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