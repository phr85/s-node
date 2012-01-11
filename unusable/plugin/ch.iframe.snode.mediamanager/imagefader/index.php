<?php

/**
 * Example: {plugin package=mediamanager module=imagefader folder=4 show_desc=1 show_details=1 count=10 version="Default"}
 */

/**
 * Relative picture dir
 */
$rel_pic_dir = '/pictures/';

if(is_numeric($GLOBALS['plugin']->getParam("folder"))){

    $result = XT::query("
        SELECT
            a.id,
            a.pid,
            b.title,
            b.description,
            b.filesize,
            b.width,
            b.height
        FROM
            " . $GLOBALS['plugin']->getTable("media") . " as a,
            " . $GLOBALS['plugin']->getTable("media") . " as b
        WHERE
            b.pid = " . $GLOBALS['plugin']->getParam('folder') . "
            AND a.pid = b.id
            AND a.isFolder = 0
            AND a.isVersion = 1
            AND a.version = '" . $GLOBALS['plugin']->getParam('version') . "'
        ORDER BY
            RAND()
        LIMIT " . $GLOBALS['plugin']->getParam('count') . "
        ");
    XT::errorCheck(__FILE__,__LINE__);

    /**
     * fetch picture data
     */
    $data = array();
    while($row = $result->FetchRow()){
        $data[] = $row;
    }

    $GLOBALS['tpl']->assign("FOLDER", $GLOBALS['plugin']->getParam('folder'));
    $GLOBALS['tpl']->assign("PIC_DIR", $rel_pic_dir);
    $GLOBALS['tpl']->assign("PICTURES", $data);

    if($GLOBALS['plugin']->getParam("show_desc") == 1){
        $GLOBALS['tpl']->assign("SHOW_DESC", 1);
    } else {
        $GLOBALS['tpl']->assign("SHOW_DESC", 0);
    }

    if($GLOBALS['plugin']->getParam("show_details") == 1){
        $GLOBALS['tpl']->assign("SHOW_DETAILS", 1);
    } else {
        $GLOBALS['tpl']->assign("SHOW_DETAILS", 0);
    }

    $content = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . "default.tpl");
}

?>