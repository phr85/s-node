<?php

/**
 * Relative picture dir
 */
$rel_pic_dir = '/pictures/';

if(is_numeric($GLOBALS['plugin']->getParam("picture")) && is_file(PIC_DIR . $GLOBALS['plugin']->getParam("picture"))){

    $result = XT::query("
        SELECT
            a.id,
            a.pid,
            b.width,
            b.height,
            b.filesize,
            b.title,
            b.description
        FROM
            " . $GLOBALS['plugin']->getTable("media") . " as a,
            " . $GLOBALS['plugin']->getTable("media") . " as b
        WHERE
            a.id = " . $GLOBALS['plugin']->getParam("picture") . "
            AND b.id = a.pid
        LIMIT 1
        ");
    XT::errorCheck(__FILE__,__LINE__);

    /**
     * fetch picture data
     */
    $row = $result->FetchRow();

    $GLOBALS['tpl']->assign("PIC_DIR", $rel_pic_dir);
    $GLOBALS['tpl']->assign("PIC_ALT", $row['title']);
    $GLOBALS['tpl']->assign("PIC", $row['id']);

    if($GLOBALS['plugin']->getParam("show_desc") == 1){
        $GLOBALS['tpl']->assign("PIC_DESC", $row['description']);
        $GLOBALS['tpl']->assign("SHOW_DESC", 1);
    } else {
        $GLOBALS['tpl']->assign("SHOW_DESC", 0);
    }

    if($GLOBALS['plugin']->getParam("show_details") == 1){
        $GLOBALS['tpl']->assign("PIC_WIDTH", $row['width']);
        $GLOBALS['tpl']->assign("PIC_HEIGHT", $row['height']);
        $GLOBALS['tpl']->assign("PIC_FILESIZE", $row['filesize']);
        $GLOBALS['tpl']->assign("SHOW_DETAILS", 1);
    } else {
        $GLOBALS['tpl']->assign("SHOW_DETAILS", 0);
    }

    $content = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . "default.tpl");
}

?>