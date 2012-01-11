<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

require_once('xt/includes/config.inc.php');
require_once('xt/includes/db.inc.php');

@ignore_user_abort();
@set_time_limit(0);

$file_name = addslashes($_GET['file_name']);
$file_version = addslashes($_GET['file_version']);

$file_id = explode(".",addslashes($_GET['file_id']));
$file_id = $file_id[0];

if($file_id > 0){
    $result = $GLOBALS['db']->query("SELECT filename,count_downloads,downloads FROM " . $GLOBALS['cfg']->get("database","prefix") . "files WHERE id = " . $file_id . " LIMIT 1");
    $row = $result->FetchRow();
    if(is_array($row)){

        if($row['count_downloads'] == 1){
            $GLOBALS['db']->query("UPDATE " . $GLOBALS['cfg']->get("database","prefix") . "files SET downloads = downloads + 1 WHERE id = " . $file_id . "");
        }

        if(!function_exists("mime_content_type_xt")){
            function mime_content_type_xt($filename){
                include_once("xt/includes/mimetypes.inc.php");
                if (isset($GLOBALS['mimetypes'][substr(strrchr(strtolower($filename), '.'),1)])){

                    return $GLOBALS['mimetypes'][substr(strrchr(strtolower($filename), '.'),1)];
                }else {
                    return false;
                }

            }
        }

        $version = '';
        if($file_version != '' && $file_version != 'embed'){
            $version = '_' . $file_version;
        }

        if(!is_file(DATA_DIR . 'files/' . $file_id . $version)){
            $filename = DATA_DIR . 'files/' . $file_id;
        } else {
            $filename = DATA_DIR . 'files/' . $file_id . $version;
        }
        $filesize = @filesize($filename);

        $mime =mime_content_type_xt($row['filename']);
        if ($mime){
            header('Content-Type: ' . $mime);
        }

        header('Content-Length: ' . $filesize);

        if (!$mime || $_GET['download']){
            header("Content-type: application/" . substr(strrchr($row['filename'], '.'),1));
            header('Content-Disposition: attachment; filename="' . $row['filename'] . '"');
        }else {
            header('Content-Disposition: inline; filename="' . $row['filename'] . '"');
        }

        header('Cache-Control: max-age=15555000, must-revalidate');

        if($filesize < 204800){
            $file = @fopen($filename, 'rb');
            $fstat = @fstat($file);
            header("Last-Modified: " . gmdate("D, d M Y H:i:s",$fstat['mtime']) . " GMT");
            //header("Expires: " . gmdate("D, d M Y H:i:s",$fstat['mtime'] + 15555000) . " GMT");
            fpassthru($file);
        } else {

            $file = @fopen($filename, 'rb');


            if(function_exists('apache_request_headers')){
                $headers = apache_request_headers();
                if(isset($headers['Range'])){
                    $range = substr($headers['Range'],6);
                    $range = substr($range,0,-1);
                    //more infos bei http://www.html-world.de/program/http_6.php#range
                    $parts=explode(',',$range);
                    fseek($file,$parts[0],SEEK_SET);
                }
            }


            $fstat = @fstat($file);
            header("Last-Modified: " . gmdate("D, d M Y H:i:s",$fstat['mtime']) . " GMT");
            //header("Expires: " . gmdate("D, d M Y H:i:s",$fstat['mtime'] + 15555000) . " GMT");
            while(!feof($file)) {
                print(fread($file, 65500));

            }
        }
    }

}else {
    header("HTTP/1.0 404 Not Found");

}
if($file_id == 0){

    $filename = 'images/spacer.gif';

    // Get file information
    header('Content-Length: 68');
    header('Content-Type: image/gif');
    header('Content-Disposition: inline; filename="spacer.gif"');
    header("Last-Modified: " . gmdate("D, d M Y H:i:s",1122563638) . " GMT");

    // send file
    $file = fopen($filename, 'rb');
    fpassthru($file);
}
$GLOBALS['db']->close();
?>