<?php

XT::call("saveFaq");

if(isset($_SESSION['referer'])){
    $referer = $_SESSION['referer'];
    unset($_SESSION['referer']);
    header("Location: " . $referer . "&lang=" . XT::getActiveLang() . "");
} else {
    XT::setAdminModule("slave1");
}

   XT::setAdminModule("slave1");

?>