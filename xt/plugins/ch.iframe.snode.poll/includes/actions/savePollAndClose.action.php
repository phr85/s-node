<?php

XT::call("savePoll");

if(isset($_SESSION['referer'])){
    $referer = $_SESSION['referer'];
    unset($_SESSION['referer']);
    header("Location: " . $referer . "&lang=" . $GLOBALS['plugin']->getActiveLang() . "");
} else {
    XT::setAdminModule("slave1");
}

   XT::setAdminModule("slave1");
    
?>