<?php

if($GLOBALS['plugin']->getValue("open") != ''){
    $GLOBALS['plugin']->setSessionValue("open", $GLOBALS['plugin']->getValue("open"));
}

XT::addImageButton("Save", "saveHeader","default","disk_blue.png",0,"");

if(is_file($GLOBALS['plugin']->getSessionValue("open"))){
    $file = fopen($GLOBALS['plugin']->getSessionValue("open"),"r+");
    $buffer = "";
    while(!feof($file)){
        $buffer .= fgets($file,1024);
    }
    XT::assign("BUFFER", htmlentities($buffer));
}

$content = XT::build("editHeader.tpl");

?>
