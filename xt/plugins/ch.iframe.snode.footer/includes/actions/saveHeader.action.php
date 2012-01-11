<?php

$file = fopen($GLOBALS['plugin']->getSessionValue("open"),"w");
fwrite($file, stripslashes($GLOBALS['plugin']->getValue("code",true)));
fclose($file);

$GLOBALS['plugin']->setAdminModule("e");

?>
