<?php

if(XT::getPermission('roles')){

    // Enable Char filter and navigator
    XT::enableAdminCharFilter('title');
    XT::enableAdminNavigator('roles');
    

    
XT::addImageButton("create <u>r</u>ole", "createRole" ,"default","role.png","0","slave1","u");
    // Get users list
    $result = XT::query("
        SELECT 
            id,
            title,
            description,
            active
        FROM 
            " . XT::getTable('roles') . XT::getAdminCharFilter() . " 
        ORDER BY 
            title ASC 
        LIMIT 
            " . XT::getAdminNavigatorLimit() . "
        ",__FILE__,__LINE__);
    
    XT::assign("DATA", XT::getQueryData($result));
    
    // Build plugin
    $content = XT::build('Rolemanagement.tpl');
}else{
    XT::log("No Permission (BaseID:" . $GLOBALS['plugin']->getBaseID() . ")" ,__FILE__,__LINE__,XT_ERROR);
    $content = "";
}
?>
