<?php
if(XT::getValue('mode') == 'ac'){
    $GLOBALS['plugin']->setAdminModule('ec');
} else {
    $GLOBALS['plugin']->setAdminModule('ecs');
}
if ($GLOBALS['plugin']->getValue('module_id') == '-|-') {
    XT::log("No module selected", __FILE__, __LINE__, XT_ERROR);
    $GLOBALS['plugin']->setAdminModule('ac');
}
else {
    $node_id = $GLOBALS['plugin']->getValue('node_id');

    $modidentifier = explode('-|-',$GLOBALS['plugin']->getValue('module_id'));
    
    $package = $modidentifier[0];
    $module =  $modidentifier[1];
    
    if($package != '' && $module != ''){
        
        if(XT::getValue('insert_pos') > 0){
            $position = XT::getValue('insert_pos');
        } else {
            $result = XT::query("SELECT
                    MAX(position) + 1 AS position 
                FROM 
                    " . $GLOBALS['plugin']->getTable('navigation_contents') . " 
                WHERE 
                    node_id=" . $node_id . "
                AND 
                    lang='" . $GLOBALS['plugin']->getActiveLang() . "'", __FILE__, __LINE__);
            $row = $result->fetchRow();
            $position = $row['position'];
            
            if (!$position) {
                $position = 1;
            }
        }
        XT::setValue('entry_position',$position);
        $sql = "INSERT INTO
                      " . $GLOBALS['plugin']->getTable('navigation_contents') . "
                      (node_id, package, module, position, active, lang)
            VALUES
                ($node_id, $package, '$module', $position, 1, '" . $GLOBALS['plugin']->getActiveLang() . "')";
    
        $result = XT::query($sql, __FILE__, __LINE__);
    
        $sql = "SELECT
                 id 
            FROM 
                 " . $GLOBALS['plugin']->getTable('navigation_contents') . " 
            WHERE
                lang='" . $GLOBALS['plugin']->getActiveLang() . "'
            ORDER BY 
                 id 
            DESC LIMIT
                 1";
    
        $result = XT::query($sql, __FILE__, __LINE__);
        $row = $result->fetchRow();
    
        $GLOBALS['plugin']->setValue('entry_id', $row['id']);
        
        $GLOBALS['plugin']->call('saveTemplateContent');
    } else {
        XT::log("No module selected", __FILE__, __LINE__, XT_ERROR);
        $GLOBALS['plugin']->setAdminModule('ac');
    }
}
?>