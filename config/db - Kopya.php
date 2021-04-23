<?php
    error_reporting(0);
    session_start();
    ob_start();
/* Veritabanı Baglantı Bilgileri */
    $hostname = "localhost";
    $username = "buyuk_testing";
    $pass = "rxT285z~";
    $database = "testing";
/* MySQL Bağlantısı */
    try {
        $db = new PDO("mysql:host=" . $hostname . "; dbname=" . $database . "; charset=utf8", "$username", "$pass");
    } catch (PDOException $error) {
        print $error->getMessage();
        exit();
    }
?>    