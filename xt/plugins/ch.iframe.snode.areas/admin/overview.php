<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

if(XT::getPermission('list')){

    // Enable Char filter and navigator
    XT::enableAdminCharFilter('title');
    XT::enableAdminNavigator('areas');
    
    // Get users list
    $result = XT::query("
        SELECT
            id,
            title,
            active,
            creation_date,
            creation_user,
            mod_date,
            mod_user,
            pos
        FROM
            " . XT::getTable('areas') . XT::getAdminCharFilter() . "
        ORDER BY
            pos ASC
        LIMIT
            " . XT::getAdminNavigatorLimit() . "
        ",__FILE__,__LINE__);

    $data = XT::getQueryData($result);
    XT::assign("DATA", $data);
    
    if(XT::getPermission('add')){
        // If something should be added
        if($GLOBALS['plugin']->getSessionValue("ctrl_add") != ''){
            $GLOBALS['plugin']->contribute("overview_buttons", "Cancel", "cancel","delete.png","1","master");
        } else {
            if(sizeof($data) > 0){
                $GLOBALS['plugin']->contribute("overview_buttons", "Add area", "addArea","add_small.png","1","master");
            } else {
                $GLOBALS['plugin']->contribute("overview_buttons", "Add area", "addFirstArea","add_small.png","1","master");
            }
        }
        $GLOBALS['plugin']->getSessionValue("ctrl_add") == 1 ? XT::assign("CTRL", 1) : XT::assign("CTRL", 0);
    }

    // Build plugin
    $content = XT::build('overview.tpl');

} else {
    
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
    
}

?>