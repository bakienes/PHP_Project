<?php
   require_once "config/db.php";
   if(isset($_REQUEST['delete_id']))
   {
 // Silmek İçin Veritabanından Resim Seç 
      $id=$_REQUEST['delete_id']; //delete_id verisini al $id Değişkeninde Sakla 
      $select_stmt= $db->prepare('SELECT * FROM dersler WHERE ders_id =:id'); //Veritabanından İşlevi Sorgula
      $select_stmt->bindParam(':id',$id);
      $select_stmt->execute();
      $row=$select_stmt->fetch(PDO::FETCH_ASSOC);
      unlink("upload/".$row['ders_resim']); //Bağlantı Kesme İşlevi Dosyanızı Kalıcı Olarak Kaldırın 
 //Veritabanından Kaydı Sil
      $delete_stmt = $db->prepare('DELETE FROM dersler WHERE ders_id =:id');
      $delete_stmt->bindParam(':id',$id);
      $delete_stmt->execute();
      header("Location:index.php");
   }
?>
<?php include "library/header.php" ?>
<?php include "library/menu.php" ?>

<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
           <th>Ders Adı</th>
           <th>Ders Resim</th>
           <th>Düzenle</th>
           <th>Kaldır</th>
        </tr>
   </thead>
   <tbody>
	   
   <?php
      $select_stmt=$db->prepare("SELECT * FROM dersler"); //sql select query
      $select_stmt->execute();
      while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
      {
   ?>
	   
      <tr>
         <td><?php echo $row['ders_baslik']; ?></td>
         <td><img src="upload/<?php echo $row['ders_resim']; ?>" style="width:150px; height:150px;"></td>
         <td><a href="editlesson.php?update_id=<?php echo $row['ders_id']; ?>" class="btn btn-warning">Düzenle</a></td>
         <td><a href="?delete_id=<?php echo $row['ders_id']; ?>" class="btn btn-danger">Kaldır</a></td>
     </tr>
  
   <?php
      }
   ?>
	   
   </tbody>
</table>

<?php include "library/footer.php" ?>