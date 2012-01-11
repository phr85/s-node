<?php
if(XT::getPermission('list')){
    // Enable Char filter and navigator
    XT::enableAdminCharFilter('title');
    XT::enableAdminNavigator('groups');
    
    // Get users list
    $result = XT::query("
        SELECT 
            ro.id, 
            ro.title,
            ro.description, 
            ro.active, 
            spr.principal_type
        FROM 
            " . XT::getTable('groups') . " as ro 
            LEFT JOIN
            " . XT::getTable('pools_rel') . " as spr  ON
            (spr.principal_id = ro.id AND spr.principal_type=2 AND spr.node_id=" . $GLOBALS['plugin']->getSessionValue('open') . ")"
             
    . XT::getAdminCharFilter() . " 
        ORDER BY 
            ro.title ASC 
        LIMIT 
            " . XT::getAdminNavigatorLimit() . "
        ",__FILE__,__LINE__,0);
    
    XT::assign("DATA", XT::getQueryData($result));
    
    // Build plugin
    $content = XT::build('groups.tpl');
    
}

?>
