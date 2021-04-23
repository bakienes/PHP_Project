<?php
    require_once "config/db.php";
    if(isset($_REQUEST['btn_insert']))
    {
        try
    {
    $baslik = $_REQUEST['txt_name']; //label name "txt_name"
    $image_file = $_FILES["txt_file"]["name"];
    $type  = $_FILES["txt_file"]["type"]; //label name "txt_file" 
    $size  = $_FILES["txt_file"]["size"];
    $temp  = $_FILES["txt_file"]["tmp_name"];
    $path="upload/".$image_file; //Yükleme Klasör Yolunu Ayarla 
    if(empty($baslik)){
        $errorMsg="Lütfen İsim Giriniz";
    }
    else if(empty($image_file)){
        $errorMsg="Lütfen Resim Seçiniz";
    }
    else if($type=="image/jpg" || $type=='image/jpeg' || $type=='image/png' || $type=='image/gif') //Dosya Uzantısını Kontrol Et
    { 
    if(!file_exists($path)) //Kontrol Dosyası, Yükleme Klasörü Yolunuzda Mevcut Değil 
    {
    if($size < 5000000) //Dosya Boyutu Maksimum 5 MB
    {
        move_uploaded_file($temp, "upload/" .$image_file); //Yükleme Dosyası Geçici Dizinini Yükleme Klasörünüze Taşıyın 
    }
    else
    {
        $errorMsg="Dosya Boyutu Maksimum 5 MB'tır!"; //Hata Mesajı Dosya Boyutu 5MB'den Büyük! 
    }
    }
   else
   { 
        $errorMsg="Upload Klasörü Bulunmuyort"; //Hata Mesajı Yükleme Klasörü Yok
   }
   }
  else
  {
        $errorMsg="Sadece Uzantısı JPG, GIF, PNG ve JPEG Olan Dosyalar Yüklenebilir!"; //Hatalı Dosya Uzantısı
  }
  if(!isset($errorMsg))
  {
        $insert_stmt=$db->prepare('INSERT INTO dersler(ders_baslik,ders_resim) VALUES(:fname,:fimage)'); //Veritabına Ekleme Sorgusu
        $insert_stmt->bindParam(':fname',$baslik); 
        $insert_stmt->bindParam(':fimage',$image_file);   //Tüm Parametreleri Bağla
  if($insert_stmt->execute())
  {
        echo $insertMsg="Dosya Yükleme Başarılı..."; //Sorgu Başarılıysa Yazdır
        header("refresh:3;lesson.php"); //3 Saniye Bekletip index.php Adresine Yönlendir
  }
  }
  else{
      	echo $errorMsg;
  }
  }
        catch(PDOException $e)
  {
        echo $e->getMessage();
  }
  }
?>
<?php include "library/header.php" ?>
<?php include "library/menu.php" ?>

<form method="post" class="form-horizontal" enctype="multipart/form-data">     
 <div class="form-group">
 <label class="col-sm-3 control-label">Ders Adı</label>
 <div class="col-sm-6">
 <input type="text" name="txt_name" class="form-control" placeholder="Lütfen Bir İsim Giriniz" />
 </div>
 </div>
 <div class="form-group">
 <label class="col-sm-3 control-label">Ders Görsel</label>
 <div class="col-sm-6">
 <input type="file" name="txt_file" class="form-control" />
 </div>
 </div> 
 <div class="form-group">
 <div class="col-sm-offset-3 col-sm-9 m-t-15">
 <input type="submit"  name="btn_insert" class="btn btn-success " value="Oluştur">
 <a href="index.php" class="btn btn-danger">İptal</a>
 </div>
 </div>
</form>

<?php include "library/footer.php" ?>