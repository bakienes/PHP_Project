<?php
    session_destroy();
    header("Refresh:1; url=login.php");
?>

<div class="alert alert-primary" role="alert">
Başarıyla Çıkış Yaptınız. Giriş Paneline Yönlendiriliyorsunuz ... 
</div>