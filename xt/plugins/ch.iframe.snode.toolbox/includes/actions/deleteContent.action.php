<?php
$result = XT::query("SELECT 
                        position 
                    FROM 
                        " . $GLOBALS['plugin']->getTable('navigation_contents') . "
                    WHERE 
                        id=" . $GLOBALS['plugin']->getValue('entry_id'), __FILE__, __LINE__);

$row = $result->fetchRow();
$position = $row['position'];
XT::setValue('deleteposition', $position -1);


XT::query("DELETE FROM 
            " . $GLOBALS['plugin']->getTable('navigation_contents') . "
           WHERE 
                node_id=" . $GLOBALS['plugin']->getValue('node_id') . "
           AND 
                id=" . $GLOBALS['plugin']->getValue('entry_id'), __FILE__, __LINE__);

XT::query("UPDATE 
                " . $GLOBALS['plugin']->getTable('navigation_contents') . "
           SET 
                position = position - 1
           WHERE 
                position > " . $position, __FILE__, __LINE__);
                
XT::call('saveTemplateContent');
?>