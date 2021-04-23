<?php
	if (isset($_POST["help"])) {
		include "config/db.php";
   		$help_ad = trim($_POST["help_ad"]);
   		$help_soyad = trim($_POST["help_soyad"]);
   		$help_bagis = trim($_POST["help_bagis"]);
$stmt=$db->prepare("INSERT INTO form (help_ad, help_soyad, help_bagis) VALUES (?,?,?)");
$stmt -> execute(array($help_ad, $help_soyad, $help_bagis));
if($stmt) {
echo "Veritabanı Kaydedildi";
header("refresh:3;index.php");
}else {
echo "Veritabanı Kaydedilemedi";
header("refresh:3;helpform.php");
}
?>

