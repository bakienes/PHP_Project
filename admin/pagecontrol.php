<?php
  session_start(); ob_start();
	require_once("config/db.php");
  if(!isset($_SESSION["eposta"])){
    header("Location:login.php"); 
  }
  if((isset($_POST["ders"])) or (isset($_POST["ders"]))){
    if(isset($_POST["ders"])){
      if($_POST["baslik"]!=""){
      $baslik=Guvenlik($_POST["baslik"]);
      }else{
        $baslik="";
      }
      if($_POST["icerik"]!=""){
        $icerik=Guvenlik($_POST["icerik"]);
      }else{
        $icerik="";
      }
      if($_FILES["image"]["name"]!=""){
        $image=Guvenlik($_FILES["image"]["name"]);
      }else{
        $image="";
      }
    }
    else if(isset($_POST["ders"])){
      if($_POST["baslik1"]!=""){
      $baslik=Guvenlik($_POST["baslik1"]);
      }else{
        $baslik="";
      }
      if($_POST["icerik1"]!=""){
        $icerik=Guvenlik($_POST["icerik1"]);
      }else{
        $icerik="";
      }
      if($_FILES["image1"]["name"]!=""){
        $image=Guvenlik($_FILES["image1"]["name"]);
      }else{
        $image="";
      }
    }
    if($baslik!="" && $icerik!="" && $image!=""){
      $imagepath="assets/img/blog/".$image;
      if(isset($_POST["blog"]))
      {
        $blogsorgusu=mysqli_query($baglanti,"INSERT INTO dersler (ders_id,ders_baslik,ders_resim,ders_aciklama) values ('$baslik','$icerik','$imagepath',$aciklama)");
      }
      else if(isset($_POST["envanter"]))
      {
        $blogsorgusu=mysqli_query($baglanti,"INSERT INTO dersler (ders_id,ders_baslik,ders_resim,ders_aciklama) values ('$baslik','$icerik','$imagepath',$aciklama)");
      }
      $blogsorgusukontrol=mysqli_affected_rows($baglanti);
      if($blogsorgusukontrol>0){
        if(isset($_POST["blog"])){
        move_uploaded_file($_FILES["image"]["tmp_name"],$imagepath);
      }
      else if (isset($_POST["ders"])) {
        move_uploaded_file($_FILES["image1"]["tmp_name"],$imagepath);
      }
        header("Refresh:4;url=index.php");
        ?>
        
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <title>Yönlendirme</title>
          <meta name="viewport" content="width=device-width">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
          <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
          <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
          <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Archivo+Narrow:700,400'>
          <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Alegreya:400italic,400'>
          <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Sacramento'>
          <link rel="stylesheet" href="css/logout.css">
          <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        </head>
        <body>
          <div id="container">
          <div id="message">
            <a id="animate" href="#">Ders Başarıyla Yüklendi. Admin Sayfasına Yönlendiriloysunuz.</a>
          </div>
        </div>
        <script src="js/logout.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        </body>
        </html>
        <?php
      }else{
        header("Refresh:4;url=index.php");
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
          <meta charset="UTF-8">
          <title>Yönlendirme</title>
          <meta name="viewport" content="width=device-width">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
          <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
          <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
          <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Archivo+Narrow:700,400'>
          <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Alegreya:400italic,400'>
          <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Sacramento'>
          <link rel="stylesheet" href="css/logout.css">
          <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
        </head>
        <body>
          <div id="container">
          <div id="message">
            <a id="animate" href="#">Ders Yüklenirken Hata Oluştu! Lütfen Tekrar Deneyiniz. Admin Sayfasına Yönlendiriloysunuz.</a>
          </div>
        </div>
        <script src="js/logout.js"></script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        </body>
        </html>
        <?php
      }
    }else{
      echo "hata 1";
      exit();
       header("Location:index.php");
    }
  }else{
    echo "hata 1";
      exit();
    header("Location:index.php");
  }
  $db = null;
  ob_end_flush();
?>