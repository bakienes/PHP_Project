<?php include "library/header.php" ?>
<?php include "library/menu.php" ?>
<?php echo "<h2>Toplam Yapılan Bağış:"  ?> 
<?php $query = $db->query("SELECT * FROM form", PDO::FETCH_ASSOC);
     if ( $query->rowCount() ){ 
     foreach( $query as $row ){
          print $row['help_bagis']."<br>";
     }
} ?>
<?php include "library/footer.php" ?>