<?php

/**
 * this plugin only does something if the user is logged in
 */
if($GLOBALS['auth']->isAuth() && is_numeric($plugin->getValue("tpl_id"))){

    if($plugin->getPostValue("source") != ''){

        /**
         * Save file
         */
        if(is_writeable(PAGES_DIR . $plugin->getPostValue("file"))){
            file_put_contents(PAGES_DIR . $plugin->getPostValue("file"), $plugin->getPostValue("source", false));
            XT::log("Source updated successfully",__FILE__,__LINE__,XT_INFO);
        } else {
            XT::log("Write failed. Not enough permissions",__FILE__,__LINE__,XT_ERROR);
        }
    }

    /**
     * Get file
     */
    $result = XT::query("
        SELECT
            a.title, a.tpl_file, a.live, a.active
        FROM
            xt_navigation_details as a
        WHERE
            a.node_id = " . $plugin->getValue("tpl_id") . "
            AND a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        LIMIT
            1",__FILE__,__LINE__);
    $file = '';
    while($row = $result->FetchRow()){
        $file = $row['tpl_file'];
    }

    /**
     * Get template source
     */
    $source = '';
    if(is_file(PAGES_DIR . $file)){
        $source = file_get_contents(PAGES_DIR . $file);
    }
    
    XT::assign("SOURCE", $source);
    XT::assign("TPL_FILE", $file);
    XT::assign("TPL_ID", $plugin->getValue("tpl_id"));

    /**
     * fetch content
     */
    $content = XT::build('default.tpl');
}

?>