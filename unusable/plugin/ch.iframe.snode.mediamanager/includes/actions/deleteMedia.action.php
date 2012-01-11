<?php
if(is_numeric($GLOBALS['plugin']->getValue("media_id"))){

    /**
     * Unlink original
     */
    if(is_file(PIC_DIR . $GLOBALS['plugin']->getValue("media_id")) && is_writeable(PIC_DIR . $GLOBALS['plugin']->getValue("media_id"))){
        unlink(PIC_DIR . $GLOBALS['plugin']->getValue("media_id"));
    }
    $result = XT::query("SELECT version FROM " . $GLOBALS['plugin']->getTable("versions") . " WHERE media_id = " . $GLOBALS['plugin']->getValue("media_id"),__FILE__,__LINE__);
    while($row = $result->FetchRow()){

        /**
         * Delete image version
         */
        if(is_file(PIC_DIR . $GLOBALS['plugin']->getValue("media_id") . "_" . $row['version']) && is_writeable(PIC_DIR . $GLOBALS['plugin']->getValue("media_id") . "_" . $row['version'])){
            unlink(PIC_DIR . $GLOBALS['plugin']->getValue("media_id") . "_" . $row['version']);
        }
    }

    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("media") . " WHERE id = " . $GLOBALS['plugin']->getValue("media_id"),__FILE__,__LINE__);
    XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("versions") . " WHERE media_id = " . $GLOBALS['plugin']->getValue("media_id"),__FILE__,__LINE__);

    XT::log("Media deleted successfully",__FILE__,__LINE__,XT_INFO);

}
?>