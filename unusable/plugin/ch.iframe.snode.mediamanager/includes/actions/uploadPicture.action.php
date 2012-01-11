<?php
/**
 * Is a picture posted
 */
if(isset($_FILES['picture']) && $_FILES['picture']['name'] != ''){

    /**
     * Check for errors
     */
    if($_FILES['picture']['error'] == 0){

        $orig_info = @getimagesize($_FILES['picture']['tmp_name']);

        if($orig_info[2] < 1 || $orig_info[2] > 3){
            XT::log("File isn't an image or image format is not supported",__FILE__,__LINE__,XT_ERROR);
        } else {

            $orig_filesize = filesize($_FILES['picture']['tmp_name']);
            
            /**
             * Create entry for original image
             */
            XT::query("
                INSERT INTO
                    " . $GLOBALS['plugin']->getTable("media") . "
                (
                    node_id,
                    lang,
                    title,
                    type,
                    width,
                    height,
                    filesize,
                    description,
                    keywords,
                    alt
                ) VALUES (
                    " . $GLOBALS['plugin']->getValue("folder") . ",
                    '" . $GLOBALS['plugin']->getActiveLang() . "',
                    '" . $_FILES['picture']['name'] . "',
                    " . $orig_info[2] . ",
                    " . $orig_info[0] . ",
                    " . $orig_info[1] . ",
                    " . $orig_filesize . ",
                    '" . $GLOBALS['plugin']->getValue("description") . "',
                    '" . $GLOBALS['plugin']->getValue("keywords") . "',
                    '" . $GLOBALS['plugin']->getValue("alt") . "'
                )",__FILE__,__LINE__);
            
            /**
             * Get media id
             */
            $result = XT::query("
                SELECT id FROM " . $GLOBALS['plugin']->getTable("media") . " ORDER BY id DESC LIMIT 1",__FILE__,__LINE__);
            
            while($row = $result->FetchRow()){
                $newid = $row['id'];
            }
            
            /**
             * Move the uploaded file
             */
            if(is_numeric($newid) && move_uploaded_file($_FILES['picture']['tmp_name'], $GLOBALS['plugin']->getConfig('picture_upload_dir') . $newid)){
                
                /**
                 * Create image versions
                 */
                $versions = $GLOBALS['plugin']->getValue('version');
                if(is_array($versions)){
                    foreach($versions as $key => $value){
                        if(is_numeric($value)){
                            
                            $info = $GLOBALS['image']->createVersion($GLOBALS['plugin']->getConfig('picture_upload_dir') . $newid, $key, $GLOBALS['plugin']->getConfig('picture_upload_dir') . $newid . "_" . $value);
                            
                            /**
                             * Create entry for each image version
                             */
                            XT::query("
                                INSERT INTO
                                    " . $GLOBALS['plugin']->getTable("versions") . "
                                (
                                    media_id,
                                    version,
                                    width,
                                    height,
                                    filesize,
                                    type
                                ) VALUES (
                                    " . $newid . ",
                                    '" . $value . "',
                                    " . $info['width'] . ",
                                    " . $info['height'] . ",
                                    " . $info['filesize'] . ",
                                    " . $info['type'] . "
                                )",__FILE__,__LINE__);
                        }
                    }
                }
                $uploaded_pic = $newid;

                /**
                 * Index keywords and description
                 */
                XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
                $search = new XT_SearchIndex($newid,$GLOBALS['plugin']->getContentType("Image"));
                $search->add($GLOBALS['plugin']->getValue("keywords"), 1);
                $search->add($GLOBALS['plugin']->getValue("alt"), 2);
                $search->build($_FILES['picture']['name'], $GLOBALS['plugin']->getValue("description"));

                XT::log("Picture uploaded successfully",__FILE__,__LINE__,XT_INFO);
            } else {
                XT::log("Picture upload error (Moving of temporary file failed)",__FILE__,__LINE__,XT_ERROR);
            }
        }
    } else {
        XT::log("Picture upload failed (Unknown error)",__FILE__,__LINE__,XT_ERROR);
    }
} else {
    XT::log("Please select a picture you want to upload",__FILE__,__LINE__,XT_ERROR);
}

$GLOBALS['plugin']->setAdminModule('ap');
?>