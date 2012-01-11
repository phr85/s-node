<?php
$GLOBALS['plugin']->setAdminModule('e');

XT::query("
    INSERT INTO  
        " . $GLOBALS['plugin']->getTable("virtual_url") . " 
    (
        pattern_mode
    ) VALUES (
        0
    )
", __FILE__, __LINE__);

$result = XT::query("
    SELECT 
        id 
    FROM 
        " . $GLOBALS['plugin']->getTable("virtual_url") . " 
    ORDER BY 
        id DESC 
    LIMIT 
        1", __FILE__, __LINE__);

$data = $result->fetchRow();

$GLOBALS['plugin']->setValue('virtual_id', $data['id']);
    
?>