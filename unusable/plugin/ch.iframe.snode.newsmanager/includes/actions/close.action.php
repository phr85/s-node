<?php

XT::unlock($GLOBALS['plugin']->getSessionValue('id'), $GLOBALS['plugin']->getContentType('News'));

if(isset($_SESSION['referer'])){
    $referer = $_SESSION['referer'];
    unset($_SESSION['referer']);
    header("Location: " . $referer . "&lang=" . $GLOBALS['plugin']->getActiveLang() . "");
} else {
    $GLOBALS['plugin']->setAdminModule("slave1");
}

?>