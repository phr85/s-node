<?php

include_once(INCLUDE_DIR . "mimetypes.inc.php");

$filename = $GLOBALS['plugin']->getConfig("file_upload_dir") . $GLOBALS['plugin']->getValue("file_id");

if(strrpos($GLOBALS['plugin']->getValue("file_name"), ".") !== false){
    $mimetype = substr(strrchr($GLOBALS['plugin']->getValue("file_name"), "."),1);
}else{
    $mimetype = 'exe';
}

if(in_array($mimetype,array_keys($mimetypes))){
    $mimetype = $mimetypes[$mimetype];
} else {
    $mimetype = $mimetypes["exe"];
}

header('Content-Length: ' . filesize($filename));
header('Cache-control: private');
header('Content-Type: ' . $mimetype);
header('Content-Disposition: inline; filename=' . $GLOBALS['plugin']->getValue("file_name"));
header('Connection: close');
$file = fopen($filename, 'rb');
while(!feof($file)) {
    print(fread($file, 65500));
    ob_flush();
    flush();
}

?>
