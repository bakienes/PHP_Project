<?php include "library/header.php" ?>
<?php include "library/menu.php" ?>
<h2>Slider Güncelleme Paneli</h2><br><br>
<form action="sliderupdate.php" method="post" name="form1" enctype="multipart/form-data"><br>
<input type="file" name="sld_resim"/><br><br>
<label>Slider Başlık</label><br>
<input type="text" name="sld_aciklama"/> <br><br>
<input type="submit" name="gonder" value="Güncelle"/><br>
</form>
<?php include "library/footer.php" ?>