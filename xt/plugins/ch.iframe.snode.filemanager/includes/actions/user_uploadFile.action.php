<?php

// Variable :: File Data
$file_data = $_FILES['file'];

// Variable :: Target Folder ID
$folder_id = $_SESSION['user']['home_node_id'];

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
$file->upload($file_data,$folder_id);

// Stay on file upload tab
XT::setAdminModule('afi');

?>