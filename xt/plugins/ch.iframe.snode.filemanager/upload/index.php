<?php

$uploaded = false;

if(isset($_FILES['file']) && $_FILES['file']['name'] != ''){

    $GLOBALS['plugin']->setValue("description","");
    $GLOBALS['plugin']->setValue("keywords","");

    /**
     * Check for errors
     */
    if($_FILES['file']['error'] == 0){

        /**
         * Create node for original image
         */
        XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable("files") . "
            (
                filename,
                upload_date,
                upload_user
            ) VALUES (
                '" . $_FILES['file']['name'] . "',
                " . time() . ",
                " . XT::getUserID() . "
            )",__FILE__,__LINE__);

        // get new id
        $result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable("files") . "
                   ORDER BY id DESC LIMIT 1
                ",__FILE__,__LINE__);

        $data = XT::getQueryData($result);

         XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable("files_details") . "
            (
                id,
                lang,
                title,
                description,
                keywords
            ) VALUES (
                '" . $data[0]['id'] . "',
                '" . XT::getPluginLang() . "',
                '" . $_FILES['file']['name'] . "',
                '" . $GLOBALS['plugin']->getValue("description") . "',
                '" . $GLOBALS['plugin']->getValue("keywords") . "'
            )",__FILE__,__LINE__);


        XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable("files_rel") . " (node_id,file_id) VALUES (" . $GLOBALS['plugin']->getSessionValue("open") . "," . $data[0]['id'] . ")",__FILE__,__LINE__);

        /**
         * Move the uploaded file
         */
        if(move_uploaded_file($_FILES['file']['tmp_name'], $GLOBALS['plugin']->getConfig('file_upload_dir') . $data[0]['id'])){

            $orig_filesize = filesize($GLOBALS['plugin']->getConfig('file_upload_dir') . $data[0]['id']);

            // Is this file an image
            $info = getimagesize($GLOBALS['plugin']->getConfig('file_upload_dir') . $data[0]['id']);
            $width = '';
            $height = '';
            if(!$info){
                $type = 0;

                // Font
                if(substr($_FILES['file']['name'],strrchr('.',$_FILES['file']['name'])) == '.ttf'){
                    $type = 3;
                }

            } else {
                if($info[2] == 4){
                    $type = 2;
                } else {

                    // This file is an image
                    $type = 1;
                    $width = $info[0];
                    $height = $info[1];

                    // Create image versions
                    $versions = XT::getConfig('imageversions');

                    if(is_array($versions)){
                        foreach($versions as $value => $key){
                            if(is_numeric($value)){

                                $info = $GLOBALS['image']->createVersion($GLOBALS['plugin']->getConfig('file_upload_dir') . $data[0]['id'], $key, $GLOBALS['plugin']->getConfig('file_upload_dir') . $data[0]['id'] . "_" . $value);

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
                                        " . $data[0]['id'] . ",
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

                    $GLOBALS['image']->createCube($GLOBALS['plugin']->getConfig('file_upload_dir') . $data[0]['id']);
                }
            }

            XT::query("UPDATE " . $GLOBALS['plugin']->getTable("files") . "
                SET
                    filesize = " . $orig_filesize . ",
                    type = " . $type . ",
                    width = '" . $width . "',
                    height = '" . $height . "'
                WHERE id = " . $data[0]['id'] . "
                ",__FILE__,__LINE__);

            $uploaded_file = $data[0]['id'];

            XT::loadClass('searchindex.class.php','ch.iframe.snode.search');
            $search = new XT_SearchIndex($uploaded_file,$GLOBALS['plugin']->getContentType("File"));
            $search->add($GLOBALS['plugin']->getValue("keywords"), 1);
            $search->build($_FILES['file']['name'], $GLOBALS['plugin']->getValue("description"));

            if($type == 1){
                $search->setImage($data[0]['id']);
            }
            header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['tpl_id']);
        } else {
            XT::log("File upload error (Moving of temporary file \"" . $_FILES['file']['tmp_name'] . "\" failed)",__FILE__,__LINE__,XT_ERROR);
        }
    } else {
        XT::log("File upload error (Unknown)",__FILE__,__LINE__,XT_ERROR);
    }
} else {
    XT::log("Please select a file you want to upload",__FILE__,__LINE__,XT_ERROR);
}
$content = XT::build("default.tpl");

?>
