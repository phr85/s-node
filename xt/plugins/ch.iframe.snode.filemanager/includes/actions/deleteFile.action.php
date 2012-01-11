<?php
if(is_numeric($GLOBALS['plugin']->getValue("file_id"))){

    unlink(DATA_DIR . "files/" . $GLOBALS['plugin']->getValue("file_id"));
    $files = glob(DATA_DIR . "files/" . $GLOBALS['plugin']->getValue("file_id") . "_*");
    if(is_array($files)) {
        foreach($files as $file){
            if(is_writeable($file)){
                unlink($file);
            }
        }
    }
    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("files") . " WHERE id = " . $GLOBALS['plugin']->getValue("file_id"),__FILE__,__LINE__);
    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("files_details") . " WHERE id = " . $GLOBALS['plugin']->getValue("file_id"),__FILE__,__LINE__);
    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("files_versions") . " WHERE file_id = " . $GLOBALS['plugin']->getValue("file_id"),__FILE__,__LINE__);

    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("files_rel") . " WHERE node_id = " . $GLOBALS['plugin']->getValue("node_id") . " AND file_id = " . $GLOBALS['plugin']->getValue("file_id"),__FILE__,__LINE__);
    
    XT::loadClass('searchindex.class.php','ch.iframe.snode.search');
    $search = new XT_SearchIndex($GLOBALS['plugin']->getValue("file_id"),$GLOBALS['plugin']->getContentType("File"),$GLOBALS['plugin']->getValue('public'));
    $search->delete();
}
?>