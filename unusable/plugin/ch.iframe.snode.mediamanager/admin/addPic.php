<?php

XT::addImageButton('Upload picture', 'uploadPicture','default','add.png','1','master','s');


// Assign buttons
$GLOBALS['tpl']->assign("BUTTONS", $GLOBALS['plugin']->getButtons());

if(isset($uploaded_pic)){
    $GLOBALS['tpl']->assign("PIC", $uploaded_pic);
} else {
    $GLOBALS['tpl']->assign("PIC", "");
}
$GLOBALS['tpl']->assign("VERSIONS", $image->getVersions());

/**
 * active folder information
 */
$GLOBALS['tpl']->assign("FOLDER", $GLOBALS['plugin']->getSessionValue("opentitle"));
$GLOBALS['tpl']->assign("FOLDER_ID", $GLOBALS['plugin']->getSessionValue("open"));

$content = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'addPic.tpl');

?>