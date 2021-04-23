<?php
    $sayfa = trim($_GET["sayfa"]);
    switch ($sayfa){
        case "":
    include "index.php";
        break;
    case "cikis-yap":
        include "logout.php";
    break;
    default:
        include "index.php";
    break;
}
?>