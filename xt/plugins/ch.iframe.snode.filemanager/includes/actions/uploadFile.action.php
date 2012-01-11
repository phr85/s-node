<?php
// set max execution time to endless
set_time_limit(0);

// Variable :: File Data
$file_data = $_FILES['file'];

// Variable :: Target Folder ID
$folder_id = XT::getSessionValue("open");

// Check for given file
if($file_data['name'] == ''){
	XT::log("Please select a file you want to upload",__FILE__,__LINE__,XT_ERROR);
}
// File Upload
require_once(CLASS_DIR . 'file.class.php');
$file = new XT_File();
$file->setDescription(XT::getValue('description'));
$file->setKeywords(XT::getValue('keywords'));
$file->setTitle(XT::getValue('title'));
$file->setPublic(XT::getValue('public'));
$file->destroy_original = XT::getConfig("destroy_original");
$file->max_image_size = XT::getConfig("max_image_size");
$file->_epsconverter = XT::getConfig("epsconverter");
$file->original_image_width = XT::getConfig("original_image_width");

$file->upload($file_data,$folder_id);


if(XT::getValue("validity") == 'enabled'){
	if(XT::getValue('valid_date_str')!=""){
		$valid_date_pre = explode(".",XT::getValue('valid_date_str'));
		$valid_date = mktime(0,0,0,$valid_date_pre[1],$valid_date_pre[0],$valid_date_pre[2]);
	}else{
		$valid_date = 'NULL';
	}
	if ($valid_date > 0){
		XT::setValue('valid_date',mktime(XT::getValue('hend') ,XT::getValue('mend'),0,date('m',$valid_date),date('d',$valid_date),date('y',$valid_date)));
	}
}else {
	$valid_date = 0;
}

if(XT::getValue("validity_from") == 'enabled'){
	if(XT::getValue('valid_from_str')!=""){
		$valid_from_pre = explode(".",XT::getValue('valid_from_str'));
		$valid_from = mktime(0,0,0,$valid_from_pre[1],$valid_from_pre[0],$valid_from_pre[2]);
	}else{
		$valid_from = 'NULL';
	}
	$valid_from = $valid_from + (XT::getValue("validity_from_hrs") * 3600);
	$valid_from = $valid_from + (XT::getValue("validity_from_min") * 60);


}else {
	$valid_from = 0;
}

if($valid_date || $valid_from){
	XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable('files') . "
    SET
        valid_date = '" . $valid_date . "',
        valid_from = '" . $valid_from . "'
    WHERE
        id = " .  $file->id . "
    ",__FILE__,__LINE__,0);
}


// Stay on file upload tab
XT::setAdminModule('afi');

?>