<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;


$directory = str_replace("\\","/", $GLOBALS['tpl']->theme_template_dir . "includes/header");

/*
$data = array();
if($dir = opendir($directory)) {
    while($file = readdir($dir)) {
        if($file != "." && $file != ".." && $file[0] != '.') {
            $filedata = array();
            if(is_dir($directory . $file)){
                $filedata['isFolder'] = 1;
            }
            $filedata['title'] = $file;
            $filedata['path'] = $directory . $file;
            array_push($data, $filedata);
        }
    }
    closedir($dir);
}
*/
$count = count(explode("/",$directory));
XT::assign("DATA", getFiles($directory,$count));

//XT::assign("FILES", getFiles($GLOBALS['tpl']->template_dir . "includes/header/"));

$content = XT::build("overview.tpl");

function getFiles($directory, $initialcount) {
    
    // Initial folder count
    $count = count(explode("/",$directory));
    
   // Try to open the directory
   if($dir = opendir($directory)) {
       // Create an array for all files found
       $tmp = Array();
       $filedata = array();

       // Add the files
       while($file = readdir($dir)) {
           // Make sure the file exists
           if($file != "." && $file != ".." && $file[0] != '.') {
               
               $isDir = false;
               if(is_dir($directory . "/" . $file)) {
                   $filedata['isFolder'] = 1;
                   $isDir = true;
               }
               
               $filedata['level'] = $count - $initialcount + 1;
               $filedata['title'] = $file;
               $filedata['path'] = $directory . "/" . $file;
               array_push($tmp, $filedata);
               
               // If it's a directiry, list all files within it
               if($isDir) {
                   $tmp2 = getFiles($directory . "/" . $file,$initialcount);
                   if(is_array($tmp2)) {
                       $tmp = array_merge($tmp, $tmp2);
                   }
               }
           }
       }

       // Finish off the function
       closedir($dir);
       return $tmp;
   }
}

?>
