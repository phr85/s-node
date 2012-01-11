<?php

@ignore_user_abort();
@set_time_limit(0);

$filename = $GLOBALS['plugin']->getConfig("file_upload_dir") . $GLOBALS['plugin']->getValue("file_id");

header('Content-Length: ' . filesize($filename));
header('Cache-Control: public');
header('Content-Type: application/force-download');
header('Content-Disposition: attachment; filename="' . $GLOBALS['plugin']->getValue("file_name") . '"');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');
header('Connection: close');

$file = fopen($filename, 'rb');
while(!feof($file)) {
    print(fread($file, 65500));
    ob_flush();
    flush();
} 

?>
