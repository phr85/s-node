<?php
$GLOBALS['plugin']->setAdminModule('e');


if(XT::getValue('manual_date_str')!=""){
	$manual_date_pre = explode(".",XT::getValue('manual_date_str'));
	$manual_date = mktime(0,0,0,$manual_date_pre[1],$manual_date_pre[0],$manual_date_pre[2]);
}else{
	$manual_date = 'NULL';
}
if ($manual_date > 0){
	XT::setValue('manual_date',mktime(XT::getValue('hend') ,XT::getValue('mend'),0,date('m',$manual_date),date('d',$manual_date),date('y',$manual_date)));
}

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

XT::query("
    UPDATE
        " . $GLOBALS['plugin']->getTable('files') . "
    SET
        filename = '" . XT::getValue("filename") . "',
        image = '" . XT::getValue("image") . "',
        image_version = '" . XT::getValue("image_version") . "',
        count_downloads = '" . XT::getValue("count_downloads") . "',
        downloads = '" . XT::getValue("downloads") . "',
        public = '" . XT::getValue("public") . "',
        manual_date = '" . $manual_date . "',
        valid_date = '" . $valid_date . "',
        valid_from = '" . $valid_from . "'
    WHERE
        id = " . XT::getValue("file_id") . "
    ",__FILE__,__LINE__,0);

XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('files_details') . "
    WHERE
        id = " . XT::getValue("file_id") . "
    AND
        lang = '" . XT::getPluginLang() . "'",__FILE__,__LINE__);

XT::query("
    INSERT INTO
        " . $GLOBALS['plugin']->getTable('files_details') . "
    SET
        title = '" . XT::getValue("title") . "',
        description = '" . XT::getValue("description") . "',
        keywords = '" . XT::getValue("keywords") . "',
        id = " . XT::getValue("file_id") . ",
        lang = '" . XT::getPluginLang() . "'
    ",__FILE__,__LINE__,0);

/**
 * Is a replace file posted
 */
if(isset($_FILES['file']) && $_FILES['file']['name'] != ''){

	/**
     * Check for errors
     */
	if($_FILES['file']['error'] == 0){


		/**
         * Move the uploaded file
         */
		if(move_uploaded_file($_FILES['file']['tmp_name'], $GLOBALS['plugin']->getConfig('file_upload_dir') . XT::getValue("file_id"))){

			clearstatcache();
			$orig_filesize = filesize($GLOBALS['plugin']->getConfig('file_upload_dir') . XT::getValue("file_id"));

			// Is this file an image
			$info = getimagesize($GLOBALS['plugin']->getConfig('file_upload_dir') . XT::getValue("file_id"));
			$width = '';
			$height = '';
			if(!$info){
				$type = 0;

				// Font
				if(substr($_FILES['file']['name'],strrchr('.',$_FILES['file']['name'])) == '.ttf'){
					$type = 3;
				}
			} else {
				if($info[2] == 4 || $info[2] == 13){
					$type = 2;
				} elseif($info[2] < 4 || $info[2] == 6 || $info[2] == 7 || $info[2] == 8){

					// This file is an image
					$type = 1;
					$width = $info[0];
					$height = $info[1];

					// Create image versions
					$versions = XT::getConfig('imageversions');
					if(is_array($versions)){


						// Delete old versions
						XT::query("
                                    DELETE FROM
                                        " . $GLOBALS['plugin']->getTable("files_versions") . "
                                    WHERE
                                        file_id = " . XT::getValue("file_id") . "
                                ",__FILE__,__LINE__);

						foreach($versions as $value => $key){
							if(is_numeric($value)){

								$info = $GLOBALS['image']->createVersion($GLOBALS['plugin']->getConfig('file_upload_dir') . XT::getValue("file_id"), $key, $GLOBALS['plugin']->getConfig('file_upload_dir') . XT::getValue("file_id") . "_" . $value);

								/**
                                 * Create entry for each image version
                                 */
								XT::query("
                                    INSERT INTO
                                        " . $GLOBALS['plugin']->getTable("files_versions") . "
                                    (
                                        file_id,
                                        version,
                                        width,
                                        height,
                                        filesize,
                                        type
                                    ) VALUES (
                                        " . XT::getValue("file_id") . ",
                                        '" . $value . "',
                                        " . $info['width'] . ",
                                        " . $info['height'] . ",
                                        " . $info['filesize'] . ",
                                        " . $info['type'] . "
                                    )
                                ",__FILE__,__LINE__);
							}
						}
					}
					$GLOBALS['image']->createCube($GLOBALS['plugin']->getConfig('file_upload_dir') . XT::getValue("file_id"));

					//Delete images if requires
					if(XT::getConfig("destroy_original")){

						$GLOBALS['image']->createPseudoOriginal(DATA_DIR . "files/" . XT::getValue("file_id"),XT::getConfig("max_image_size"),XT::getConfig("original_image_width"));
					}



				}else{
					$type = 0;
				}
			}

			XT::query("UPDATE " . $GLOBALS['plugin']->getTable("files") . "
                SET
                    filesize = " . $orig_filesize . ",
                    type = " . $type . ",
                    width = '" . $width . "',
                    height = '" . $height . "',
                    filename = '"  . $_FILES['file']['name'] . "',
                    upload_date = '" . time() . "',
					md5sum='" . md5(file_get_contents($GLOBALS['plugin']->getConfig('file_upload_dir') . XT::getValue("file_id"))) . "'
                WHERE id = " . XT::getValue("file_id") . "
                ",__FILE__,__LINE__);
		}
	}
}



require_once(CLASS_DIR . "fileindexer.class.php");
$fileindexer = new XT_FileIndexer();
$filecontent = $fileindexer->index($GLOBALS['plugin']->getConfig('file_upload_dir') . XT::getValue("file_id"), XT::getValue("filename"));

XT::loadClass('searchindex.class.php','ch.iframe.snode.search');
$search = new XT_SearchIndex(XT::getValue("file_id"),$GLOBALS['plugin']->getContentType("File"),XT::getValue('public'));
$search->setLang(XT::getPluginLang());
$search->add(XT::getValue("keywords"), 1);
$search->add($filecontent, 1);
$search->setManualDate($manual_date);
$search->add(XT::getValue('filename'), 1);
$search->build(XT::getValue("title"), XT::getValue("description"));

if(XT::getValue('image') > 0){
	$search->setImage(XT::getValue("image"));
} else {
	if(XT::getValue("type") == 1){
		$search->setImage(XT::getValue("file_id"));
	}
}


?>