<?php
if(is_numeric($GLOBALS['plugin']->getValue("file_id"))){
    $checkfileowner = XT::getQueryData(XT::query("Select  upload_user from " . XT::getTable("files") . " where id=" . XT::getValue("file_id") ,__FILE__,__LINE__));
    if($checkfileowner[0]['upload_user'] ==  $_SESSION['user']['id']){

        $files = glob(DATA_DIR . "files/" . $GLOBALS['plugin']->getValue("file_id") . "*");
        foreach($files as $file){
            if(is_writeable($file)){
                unlink($file);
            }
        }
        XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("files") . " WHERE id = " . $GLOBALS['plugin']->getValue("file_id"),__FILE__,__LINE__);
        XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("files_details") . " WHERE id = " . $GLOBALS['plugin']->getValue("file_id"),__FILE__,__LINE__);
        XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("files_versions") . " WHERE file_id = " . $GLOBALS['plugin']->getValue("file_id"),__FILE__,__LINE__);

        XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("files_rel") . " WHERE file_id = " . $GLOBALS['plugin']->getValue("file_id"),__FILE__,__LINE__);

        XT::loadClass('searchindex.class.php','ch.iframe.snode.search');
        $search = new XT_SearchIndex($GLOBALS['plugin']->getValue("file_id"),$GLOBALS['plugin']->getContentType("File"),$GLOBALS['plugin']->getValue('public'));
        $search->delete();
    }
}
?>