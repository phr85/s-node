<?php
// Include the pclzip library
require_once(CLASS_DIR . 'zip/pclzip.lib.php');
// Activate theme
$theme = XT::getValue('theme_title');
XT::assign("DLTHEME",XT::getValue('theme_title'));
// Location of the zip file
$zipfile = ROOT_DIR . "/tmp/" . $theme . ".xtt";
//  create the tmp directory if it don't exist
if(!is_dir(ROOT_DIR . "/tmp/")){
	mkdir(ROOT_DIR . "/tmp/");
}
//  create the fonts directory if it don't exist
if(!is_dir(BASE_DIR . "/fonts/" . $theme)){
	mkdir(BASE_DIR . "/fonts/" . $theme);
}
//  create the scripts directory if it don't exist
if(!is_dir(BASE_DIR . "/scripts/" . $theme)){
	mkdir(BASE_DIR . "/scripts/" . $theme);
}
// Create a list with all folder we want export
$folders = 'images/' . $theme . ',scripts/' . $theme . ',styles/live/' . $theme . ',xt/templates/' . $theme . ',fonts/' . $theme;
// Create the zip object and set the temporary file location
$archive = new PclZip($zipfile);
// Let us collect the data and squeeze it like a roadkilled animal
$v_list = $archive->create($folders);
if ($v_list == 0) {
	XT::log("Error : ".$archive->errorInfo(true),__FILE__,__LINE__,XT_ERROR);
} else {
	  // Put out the file
	  header("Content-type: application/octet-stream");
      header('Content-Disposition: attachment; filename="' . basename($zipfile) . '"');
      header('Cache-Control: no-cache');
      $file = @fopen($zipfile, 'rb');
      $fstat = @fstat($file);
      header("Last-Modified: " . gmdate("D, d M Y H:i:s",$fstat['mtime']) . " GMT");
      fpassthru($file);
      fclose($file);
      unlink($zipfile);
      exit;
      
}



XT::setAdminModule('wizardExportTheme');

?>