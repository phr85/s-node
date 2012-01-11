<?php
//include_once(CLASS_DIR . 'tree.class.php');
XT::loadClass('tree.class.php','ch.iframe.snode.core');
// set endles time limit for big imports
set_time_limit (0);


if(!is_dir(IMPORT_DIR)){
    @mkdir(IMPORT_DIR,0777);
}

$filelist = getFiles(IMPORT_DIR);

asort($filelist);
// build path list
foreach ($filelist as $item) {
    if($item['path'] !=''){
        $folderarray[$item['path']]['dir'] = $item['dir'];
        $folderarray[$item['path']]['parent'] = substr($item['path'],0,(strlen($item['dir']) +1 )*-1);
    }
}

if(count($filelist) !=0){
    //insert import node with date as last element in the root node
    $tree = new XT_Tree("files_tree");
    $import_id = $tree->addNode(1,'last');
    insertDetails($import_id,"import " . date("d.m.y H:i:s",TIME));
}

if(is_array($folderarray)){
    // adding nodes to the file tree
    foreach ($folderarray as $key => $item) {
        if($item['parent'] == ''){
            $folderarray[$key]['id'] = $tree->addNode($import_id,'last');
            insertDetails($folderarray[$key]['id'],$folderarray[$key]['dir']);
        }else{
            $folderarray[$key]['id'] = $tree->addNode($folderarray[$folderarray[$key]['parent']]['id'],'last');
            insertDetails($folderarray[$key]['id'],$folderarray[$key]['dir']);
        }
    }
}

if(is_array($filelist)){
    // move files from IMPORT_DIR for this folder
    foreach ($filelist as $item) {
        if($item['file'] != ''){
            if($item['path'] == ''){
                moveFile($item['path'],$item['file'], $import_id);
            }else{
                moveFile($item['path'],$item['file'], $folderarray[$item['path']]['id']);
            }
        }
    }
}

XT::log(count($filelist) . " " .  XT::translate('Files imported') ,__FILE__,__LINE__,XT_INFO);

if(!rmdirr(IMPORT_DIR)){
    XT::log(XT::translate("Cannot remove import folders, you have to delete them manually"),__FILE__,__LINE__,XT_ERROR);
}
@mkdir(IMPORT_DIR,0777);
@chmod(IMPORT_DIR,0777);

// creating directory details
function insertDetails($node_id, $title){
    // Create detail row
    foreach ($GLOBALS['cfg']->getLangs() as $lang_code=>$lang_name) {
        XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('files_tree_details') . "
	        (
	            node_id,
	            lang,
	            creation_user,
	            creation_date,
	            title,
	            active
	        ) VALUES (
	            " . $node_id . ",
	            '" . $lang_code . "',
	            '" . $GLOBALS['auth']->getUserID() . "',
	            '" . time() . "',
	            '" . utf8_decode($title) . "',
	            1
	        )
	    ");
    }
}

// reading the imports structure and files
function getFiles($directory) {
    // Try to open the directory
    if($dir = opendir($directory)) {
        // Create an array for all files found
        $tmp = Array();
        // Add the files
        while($file = readdir($dir)) {
            // Make sure the file exists
            if($file != "." && $file != ".." && $file[0] != '.' && $file != 'Thumbs.db') {
                // If it's a directory, list all files within it
                if(is_dir($directory . "/" . $file)) {

                    $folder = str_replace(IMPORT_DIR,'',$directory . "/" . $file);
                    array_push($tmp, array('path' => $folder, 'dir' => basename($folder), 'file' => ''));

                    $tmp2 = getFiles($directory . "/" . $file);
                    if(is_array($tmp2)) {
                        $tmp = array_merge($tmp, $tmp2);
                    }
                } else {
                    $folder = str_replace(IMPORT_DIR,'',$directory);
                    array_push($tmp, array('path' => $folder, 'dir' => basename($folder), 'file' => $file));
                }
            }
        }
        // Finish off the function
        closedir($dir);
        return $tmp;
    }
}

function moveFile($sourceFilePath,$sourceFileName, $node_id){

    if(is_file(IMPORT_DIR . "/" . $sourceFilePath . "/" . $sourceFileName)){
        $targetDirectory = $GLOBALS['plugin']->getConfig('file_upload_dir');
		if ((filesize(IMPORT_DIR . "/" . $sourceFilePath . "/" . $sourceFileName) + (ceil(memory_get_usage(true)))) < (str_replace("M","",ini_get("memory_limit")) * 1024 * 1024)) {
			$md5sum = md5(file_get_contents(IMPORT_DIR . "/" . $sourceFilePath . "/" . $sourceFileName));
		} else {
			$md5sum =  md5_file(IMPORT_DIR . "/" . $sourceFilePath . "/" . $sourceFileName);
			if (strlen($md5sum) > 32) {
				$tmp = explode(" ",$md5sum); // Hier war was drinn
				if (is_array($tmp) ){
					$md5sum = $tmp[0];
				}
				unlink($tmp);
			}
		}
        XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable("files") . "
            (
                filename,
                upload_date,
                upload_user,
				md5sum
            ) VALUES (
                '" . $sourceFileName . "',
                " . time() . ",
                " . XT::getUserID() . ",
				'" . $md5sum . "'
            )",__FILE__,__LINE__);

        // get new File id
        $result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable("files") . "
                   ORDER BY id DESC
                ",__FILE__,__LINE__);

        $data = XT::getQueryData($result);
        $newFileId = $data[0]['id'];
        XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable("files_rel") . " (node_id,file_id) VALUES (" . $node_id . "," . $newFileId . ")",__FILE__,__LINE__);
        foreach ($GLOBALS['cfg']->getLangs() as $lang_code=>$lang_name) {
            XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable("files_details") . "
	            (
	                id,
	                title,
	                lang
	            ) VALUES (
	                '" . $newFileId . "',
	                '" . $sourceFileName . "',
	                '" . $lang_code . "'
	            )",__FILE__,__LINE__);
        }
		$md5sum = "";
        /**
         * Move the file
         */

        if(rename(IMPORT_DIR . "/" . $sourceFilePath . "/" . $sourceFileName,$targetDirectory . $newFileId)){

            $orig_filesize = filesize($targetDirectory . $newFileId);


            if(XT::getConfig("epsconverter")!=""){
                // EPS handling
                if(substr($sourceFileName,-4) == '.eps'){
                    // copy file to id_eps
                    copy($targetDirectory . $newFileId,$targetDirectory . $newFileId . "_eps");
                    // convert $targetDirectory . $newFileId to tiff using image magick
                    exec(XT::getConfig("epsconverter") . " -density 300x300  eps:" . $targetDirectory . $newFileId . " png:".$targetDirectory . $newFileId);
                }
            }

            // Is this file an image
            $info = @getimagesize($targetDirectory . $newFileId);

            $width = '';
            $height = '';
            if(!$info){
                $type = 0;

                // Font
                if(substr($sourceFileName,strrchr('.',$sourceFileName)) == '.ttf'){
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
                        foreach($versions as $value => $key){
                            if(is_numeric($value)){

                                $info = $GLOBALS['image']->createVersion($targetDirectory . $newFileId, $key, $targetDirectory . $newFileId . "_" . $value);

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
                                        " . $newFileId . ",
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

                    $GLOBALS['image']->createCube($targetDirectory . $newFileId);


                    //Delete images if requires
                    if(XT::getConfig("destroy_original")){
                        $GLOBALS['image']->createPseudoOriginal(DATA_DIR . "files/" . $newFileId,XT::getConfig("max_image_size"),XT::getConfig("original_image_width"));
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
                    upload_date = '" . time() . "'
                WHERE id = " . $newFileId . "
                ",__FILE__,__LINE__);

        } else {
            XT::log("File upload error (Moving of temporary file \"" . $sourceFileName . "\" failed)",__FILE__,__LINE__,XT_ERROR);
        }
    }
}


function rmdirr($dir) {
    if($objs = glob($dir . "/*")){
        foreach($objs as $obj) {
            is_dir($obj)? rmdirr($obj) : unlink($obj);
        }
    }
    if(!@rmdir($dir)){
        return false;
    }
}
?>