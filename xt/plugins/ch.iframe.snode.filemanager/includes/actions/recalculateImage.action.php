<?php
// set execution time to endless
set_time_limit(0);
// get all images; width and height


// build version array
foreach ($GLOBALS['image']->versions as $versionname => $value) {
    $versions[$versionname] = $value['id'];
}

//set sourcefile
$sourcefile = $GLOBALS['plugin']->getConfig('file_upload_dir') . XT::getValue('file_id');

if(XT::getConfig("epsconverter")!=""){
    // EPS handling
    if(is_file($GLOBALS['plugin']->getConfig('file_upload_dir') . XT::getValue('file_id') . "_eps")){

        // convert $targetDirectory . $newFileId to tiff using image magick
        exec(XT::getConfig("epsconverter") . " -density 300x300  eps:" . $GLOBALS['plugin']->getConfig('file_upload_dir') . XT::getValue('file_id') . "_eps  png:" . $GLOBALS['plugin']->getConfig('file_upload_dir') . XT::getValue('file_id'));
    }
    // get source image infos
    $sourceinfo = getimagesize($sourcefile);
    // update fileinfo
    XT::query("UPDATE " . XT::getTable("files") . " SET width=" . $sourceinfo[0] . ", height=" . $sourceinfo[1] . " WHERE id = " . XT::getValue('file_id'),__FILE__,__LINE__);
}

// create versions if sourcefile is available
if(is_file($sourcefile)){
    if(is_array($versions)){
        foreach($versions as $key => $value){
            if(is_numeric($value)){
                $targetfile = $GLOBALS['plugin']->getConfig('file_upload_dir') . XT::getValue('file_id') . "_" . $value;
                unset($info);

                $info = $GLOBALS['image']->createVersion($sourcefile, $key, $targetfile,$GLOBALS['plugin']->getConfig('image_quality'));
                if($info['width'] > 0){

                    // Delete existing entries
                    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("files_versions") . "
                    WHERE
                        file_id=" . XT::getValue('file_id') . "
                    AND
                        version=" . $value
                    ,__FILE__,__LINE__);


                    // Insert new entries DB
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
                        " . XT::getValue('file_id') . ",
                        '" . $value . "',
                        " . $info['width'] . ",
                        " . $info['height'] . ",
                        " . $info['filesize'] . ",
                        " . $info['type'] . "
                    )
                    ",__FILE__,__LINE__,0);
                }
            }
        }
    }
}

// create the cube if version small is available
if(is_file($sourcefile . "_2")){
    $GLOBALS['image']->createCube($sourcefile);
}
?>