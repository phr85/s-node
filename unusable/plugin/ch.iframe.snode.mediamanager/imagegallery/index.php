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
            a.title
        FROM
            " . $GLOBALS['plugin']->getTable("media") . " as a,
            " . $GLOBALS['plugin']->getTable("media") . " as b
        WHERE
            b.id = " . $GLOBALS['plugin']->getParam('folder') . "
            AND a.l > b.l AND a.r < b.r
            AND a.level = b.level + 2
            AND a.isFolder = 0
            AND a.version = '" . $GLOBALS['plugin']->getParam('version') . "'
        ORDER BY
            ID ASC
        LIMIT 0, " . $GLOBALS['plugin']->getParam('per_page') . "
        ");
    XT::errorCheck(__FILE__,__LINE__);

    /**
     * fetch picture data
     */
    $data = array();
    while($row = $result->FetchRow()){
        $data[] = $row;
    }

    /**
     * display images
     */
    $GLOBALS['tpl']->assign("PER_LINE", $GLOBALS['plugin']->getParam('per_line'));
    $GLOBALS['tpl']->assign("PER_PAGE", $GLOBALS['plugin']->getParam('per_page'));
    $GLOBALS['tpl']->assign("FOLDER", $GLOBALS['plugin']->getParam('folder'));
    $GLOBALS['tpl']->assign("VERSION", $GLOBALS['plugin']->getParam('version'));
    $GLOBALS['tpl']->assign("PICTURES", $data);

    if($GLOBALS['plugin']->getParam("show_desc") == 1){
        $GLOBALS['tpl']->assign("SHOW_DESC", 1);
    } else {
        $GLOBALS['tpl']->assign("SHOW_DESC", 0);
    }

    $content = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . "default.tpl");
}

?>