<?php

$GLOBALS['plugin']->call("saveArticle");
XT::unlock($GLOBALS['plugin']->getSessionValue('id'), $GLOBALS['plugin']->getContentType('Article'));

if(isset($_SESSION['referer'])){
    $referer = $_SESSION['referer'];
    unset($_SESSION['referer']);
    header("Location: " . $referer . "&lang=" . $GLOBALS['plugin']->getActiveLang() . "");
} else {
    $GLOBALS['plugin']->setAdminModule("slave1");
}

?>