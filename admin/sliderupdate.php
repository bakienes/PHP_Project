<?php include "config/db.php" ?>
<?php
if($_POST){
    if ($_FILES["sld_resim"]["size"]<1024*1024){  //Dosya Boyutu Maksimum 1MB!
        if ($_FILES["sld_resim"]["type"]=="image/jpeg"){  //Dosya Tipi JPEG
            $slider_aciklama = $_POST["sld_aciklama"];
            $dosya_adi = $_FILES["sld_resim"]["name"];
            //Slider Kayıt Ederken Yeni Bir İsim Oluşturalım
            $uret=array("as","rt","ty","yu","fg");
            $uzanti=substr($dosya_adi,-4,4);
            $sayi_tut=rand(1,10000);
            $yeni_ad="upload/".$uret[rand(0,4)].$sayi_tut.$uzanti;
            //Dosya Yeni Adıyla Upload'a Kaydedilecek
            if (move_uploaded_file($_FILES["sld_resim"]["tmp_name"],$yeni_ad)){
                echo 'Dosya başarıyla yüklendi.';
                //Bilgileri Veritabanına Kayıt Ediyoruz..
            $sorgu = $db->prepare("INSERT INTO slider SET slider_resim=:slider_resim,slider_aciklama=:slider_aciklama");
            $sorgu->execute(array(':slider_resim'=> $yeni_ad,':slider_aciklama'=>$slider_aciklama));
            if ($sorgu){
                echo 'Veritabanına kaydedildi.';
                header("refresh:3;slider.php");
            }else{
                echo 'Kayıt sırasında hata oluştu!';
                header("refresh:3;slider.php");
            }
        }else{
            echo 'Dosya Yüklenemedi!';
            header("refresh:3;slider.php");
        }
    }else{
        echo 'Dosya yalnızca jpeg formatında olabilir!';
        header("refresh:3;slider.php");
    }
    }else{          
        echo 'Dosya boyutu 1 Mb ı geçemez!';
        header("refresh:3;slider.php");
    }
}
?>