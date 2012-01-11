<?php

if(!isset($_SESSION['shop']['direct']) || $_SESSION['shop']['direct'] == array()){
    $_SESSION['shop']['direct'] = array(
        0 => array(),
        1 => array(),
        2 => array(),
        3 => array(),
        4 => array(),
        5 => array(),
    );
}

if($GLOBALS['plugin']->getValue('action') !=""){
    include($GLOBALS['plugin']->getValue('action') . ".action.php");
}

XT::assign("DIRECT", $_SESSION['shop']['direct']);

$content = XT::build("default.tpl");

?>