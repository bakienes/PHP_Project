<?php include "config/db.php" ?>
<?php include "library/header.php" ?>
<?php include "library/menu.php" ?>

<form style="text-align:center;" action="helpformcontrol.php" method="POST"><br><br>
<input type="text" name="help_ad" placeholder="Name"><br><br>
<input type="text" name="help_soyad" placeholder="Surname"><br><br>
<input type="text" name="help_bagis" placeholder="Price"><br><br>
<input type="submit" name="help" value="Donation"><br><br>
</form>

<?php include "library/footer.php" ?>