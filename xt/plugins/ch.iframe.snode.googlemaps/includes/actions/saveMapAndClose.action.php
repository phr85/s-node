<?php

// Call Action Save Map 
XT::call("saveMap");

// Set Slave module if there was no referer given.
if(isset($_SESSION['referer'])){
    $referer = $_SESSION['referer'];
    unset($_SESSION['referer']);
    header("Location: " . $referer . "&lang=" . $GLOBALS['plugin']->getActiveLang() . "");
} else {
    XT::setAdminModule("slave1");
}

// Set Admin Module to original "slave1"
XT::setAdminModule("slave1");
    
?>