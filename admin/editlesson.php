<?php
    require_once "config/db.php";
    if(isset($_REQUEST['update_id']))
    {
        try
    {
        $id = $_REQUEST['update_id']; //get "update_id" from index.php page through anchor tag operation and store in "$id" variable
        $select_stmt = $db->prepare('SELECT * FROM dersler WHERE ders_id =:id'); //sql select query
        $select_stmt->bindParam(':id',$id);
        $select_stmt->execute(); 
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
    }
        catch(PDOException $e)
    {
        $e->getMessage();
    }
    }
    if(isset($_REQUEST['btn_update']))
    {
    try
    {
        $ders_baslik =$_REQUEST['txt_name']; //textbox name "txt_name" 
        $ders_resim = $_FILES["txt_file"]["name"];
        $type  = $_FILES["txt_file"]["type"]; //file name "txt_file"
        $size  = $_FILES["txt_file"]["size"];
        $temp  = $_FILES["txt_file"]["tmp_name"];
        $path="upload/".$ders_resim; //set upload folder path
        $directory="upload/"; //set upload folder path for update time previous file remove and new file upload for next use
    if($ders_resim)
    {
    if($type=="image/jpg" || $type=='image/jpeg' || $type=='image/png' || $type=='image/gif') //check file extension
    { 
    if(!file_exists($path)) //check file not exist in your upload folder path
    {
    if($size < 5000000) //check file size 5MB
    {
        unlink($directory.$row['image']); //unlink function remove previous file
        move_uploaded_file($temp, "upload/" .$ders_resim); //move upload file temperory directory to your upload folder 
    }
    else
    {
        $errorMsg="Resim Dosyası Maksimum 5 MB Olmalıdır."; //error message file size not large than 5MB
    }
    }
    else
    { 
        $errorMsg="File Already Exists...Check Upload Folder"; //error message file not exists your upload folder path
    }
    }
    else
    {
        $errorMsg="Sadece Uzantısı JPG, GIF, PNG ve JPEG Olan Dosyalar Yüklenebili!"; //error message file extension
    }
    }
    else
    {
        $ders_resim=$row['image']; //if you not select new image than previous image sam it is it.
    }
    if(!isset($errorMsg))
    {
        $update_stmt=$db->prepare('UPDATE dersler SET ders_baslik=:ders_baslik, ders_resim=:ders_resim WHERE ders_id=:id'); //sql update query
        $update_stmt->bindParam(':ders_baslik',$ders_baslik);
        $update_stmt->bindParam(':ders_resim',$ders_resim); //bind all parameter
        $update_stmt->bindParam(':id',$id);
   if($update_stmt->execute())
   {
        $updateMsg="Dosya Yükleme Başarılı.."; //file update success message
        header("refresh:3;lesson.php"); //refresh 3 second and redirect to index.php page
   }
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
 <input type="text" name="txt_name" class="form-control" value="<?php echo $ders_baslik; ?>" required/>
 </div>
 </div>
 <div class="form-group">
 <label class="col-sm-3 control-label">Ders Resim</label>
 <div class="col-sm-6">
 <input type="file" name="txt_file" class="form-control" value="<?php echo $ders_resim; ?>"/><br>
 </div>
 <div class="col-sm-6">
 <label class="col-sm-3 control-label">Mevcut Resim</label> 
 <p><img src="upload/<?php echo $ders_resim; ?>" height="100" width="100" /></p>
 </div>
 </div>
 <div class="form-group">
 <div class="col-sm-offset-3 col-sm-9 m-t-15">
 <input type="submit"  name="btn_update" class="btn btn-primary" value="Güncelle">
 <a href="index.php" class="btn btn-danger">Cancel</a>
 </div>
 </div>
</form>

<?php include "library/footer.php" ?>