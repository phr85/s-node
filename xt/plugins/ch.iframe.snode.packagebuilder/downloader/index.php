<?php
@ignore_user_abort();
@set_time_limit(0);

$file_name = $GLOBALS['plugin']->getValue('package');
$file_version = $GLOBALS['plugin']->getValue('package_version');
if($file_version=='open'){
    $filename = PACKAGES . '/' . $file_name . '.xtp.open.xtp';
    $downloadfilename = $file_name . '.xtp.open.xtp';
}else{
    if($file_version=='sampledata'){
        $filename = PACKAGES . '/' . $file_name . '.xtsd';
        $downloadfilename = $file_name . '.xtsd';
    } else {
        $filename = PACKAGES . '/' . $file_name .'.xtp';
        $downloadfilename = $file_name . '.xtp';
    }
}
if(!is_file($filename)){
 die('No file');   
}

$filesize = filesize($filename);

$mime = 'application/force-download';

// Get file information
header('Content-Length: ' . $filesize);
header('Content-Type: ' . $mime);
header('Content-Disposition: attachment; filename="' . $downloadfilename . '"');
header('Cache-Control: max-age=100, must-revalidate');

if($filesize < 204800){
    $file = fopen($filename, 'rb');
    $fstat = fstat($file);
    header("Last-Modified: " . gmdate("D, d M Y H:i:s",$fstat['mtime']) . " GMT");
    //header("Expires: " . gmdate("D, d M Y H:i:s",$fstat['mtime'] + 15555000) . " GMT");
    fpassthru($file);
} else {
    $file = fopen($filename, 'rb');
    $fstat = fstat($file);
    header("Last-Modified: " . gmdate("D, d M Y H:i:s",$fstat['mtime']) . " GMT");
   //header("Expires: " . gmdate("D, d M Y H:i:s",$fstat['mtime'] + 15555000) . " GMT");
    while(!feof($file)) {
        print(fread($file, 65500));
    }
}

header("connection: close"); 
?>