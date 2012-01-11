<?php
// for direct publish, do savetempfile
if(isset($_FILES['file']) && $_FILES['file']['name'] != ''){
    if(move_uploaded_file($_FILES['file']['tmp_name'], $GLOBALS['plugin']->getConfig('temp_file_upload_dir') . $_FILES['file']['name'])){
        XT::setSessionValue("file",$_FILES['file']);
    }
}
$uploaded_file = XT::getSessionValue("file");
//unset temp session variable
XT::unsetSessionValue("file");
if (is_array($uploaded_file)){

    include_once(PLUGIN_DIR . "ch.iframe.snode.filemanager/includes/config.ext.inc.php");

XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable("files") . "
            (
                filename,
                upload_date,
                upload_user
            ) VALUES (
                '" . $uploaded_file['name'] . "',
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
                '" . $uploaded_file['name'] . "',
                '" . XT::getValue('title') . "',
                'forum posting id " . XT::getValue("newid") . "'
            )",__FILE__,__LINE__);


        XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable("files_rel") . " (node_id,file_id) VALUES (" . $GLOBALS['plugin']->getConfig("FileNode") . "," . $data[0]['id'] . ")",__FILE__,__LINE__);

 

        /**
     * Check for errors
     */
        if($uploaded_file['error'] == 0){


            /**
         * Move the uploaded file
         */
            if(rename(XT::getConfig(temp_file_upload_dir) . $uploaded_file['name'], $GLOBALS['plugin']->getConfig('file_upload_dir') . $data[0]['id'])){
                clearstatcache();
                $orig_filesize = filesize($GLOBALS['plugin']->getConfig('file_upload_dir') .$data[0]['id']);

                // Is this file an image
                $info = getimagesize($GLOBALS['plugin']->getConfig('file_upload_dir') .$data[0]['id']);
                $width = '';
                $height = '';
                if(!$info){
                    $type = 0;

                    // Font
                    if(substr($uploaded_file['name'],strrchr('.',$uploaded_file['name'])) == '.ttf'){
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
                                        file_id = " .$data[0]['id'] . "
                                ",__FILE__,__LINE__);

                            foreach($versions as $value => $key){
                                if(is_numeric($value)){

                                    $info = $GLOBALS['image']->createVersion($GLOBALS['plugin']->getConfig('file_upload_dir') .$data[0]['id'], $key, $GLOBALS['plugin']->getConfig('file_upload_dir') .$data[0]['id'] . "_" . $value);
                                    
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
                                        " .$data[0]['id'] . ",
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
                        $GLOBALS['image']->createCube($GLOBALS['plugin']->getConfig('file_upload_dir') .$data[0]['id']);

                        //Delete images if requires
                        if(XT::getConfig("destroy_original")){
                            $GLOBALS['image']->createPseudoOriginal(DATA_DIR . "files/" .$data[0]['id']);
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
                    filename = '"  . $uploaded_file['name'] . "',
                    upload_date = '" . time() . "'
                WHERE id = " .$data[0]['id'] . "
                ",__FILE__,__LINE__);


            }
        }




    //update topic
    XT::query("UPDATE
                " . XT::getTable('forum_postings') . "
                SET
                    upload_file_id = '" . $data[0]['id'] . "'
                WHERE
                    id = '" . XT::getValue("newid") . "'
            ",__FILE__,__LINE__);
}
?>