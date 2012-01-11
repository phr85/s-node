<?php
$sql = "UPDATE 
            " . $GLOBALS['plugin']->getTable('navigation_contents') . " 
        SET 
            active=1 
        WHERE 
            id=" . $GLOBALS['plugin']->getValue('entry_id');

$result = XT::query($sql, __FILE__, __LINE__);

$GLOBALS['plugin']->call('saveTemplateContent');
?>