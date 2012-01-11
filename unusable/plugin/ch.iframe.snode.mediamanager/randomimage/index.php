<?php

/**
 * Relative picture dir
 */
$rel_pic_dir = '/pictures/';

if(is_numeric($GLOBALS['plugin']->getParam('folder'))){

    $result = XT::query("
        SELECT
            a.id,
            a.pid,
            b.title
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
        LIMIT 1
        ");
    XT::errorCheck(__FILE__,__LINE__);

    /**
     * fetch picture data
     */
    $row = $result->FetchRow();

    /**
     * display image if exists
     */
    if(is_numeric($row['id']) && is_file(PIC_DIR . $row['id'])){
        $GLOBALS['tpl']->assign("PIC_DIR", $rel_pic_dir);
        $GLOBALS['tpl']->assign("PIC_ALT", $row['title']);
        $GLOBALS['tpl']->assign("FOLDER", $GLOBALS['plugin']->getParam('folder'));
        $GLOBALS['tpl']->assign("VERSION", $GLOBALS['plugin']->getParam('version'));
        $GLOBALS['tpl']->assign("PIC", $row['id']);
        $content = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . "default.tpl");
    }
}

?>