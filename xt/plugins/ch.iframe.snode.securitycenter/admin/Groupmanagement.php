<?php

if(XT::getPermission('groups')){

    // Enable Char filter and navigator
    XT::enableAdminCharFilter('title');
    XT::enableAdminNavigator('groups');
    

    
XT::addImageButton("create <u>g</u>roup", "createGroup" ,"default","group.png","0","slave1","u");
    // Get users list
    $result = XT::query("
        SELECT 
            id,
            title,
            description,
            active
        FROM 
            " . XT::getTable('groups') . XT::getAdminCharFilter() . " 
        ORDER BY 
            title ASC 
        LIMIT 
            " . XT::getAdminNavigatorLimit() . "
        ",__FILE__,__LINE__);
    
    XT::assign("DATA", XT::getQueryData($result));
    
    // Build plugin
    $content = XT::build('Groupmanagement.tpl');
}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}
?>
