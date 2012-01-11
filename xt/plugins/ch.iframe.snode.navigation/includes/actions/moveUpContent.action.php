<?php
XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("navigation_contents") .  " 
            SET 
                position = position - 1 
            WHERE 
                position = " . $GLOBALS['plugin']->getValue("entry_pos") . "
            AND 
                node_id = " . $GLOBALS['plugin']->getValue("node_id")
            ,__FILE__,__LINE__);
            
XT::query("
            UPDATE 
                " . $GLOBALS['plugin']->getTable("navigation_contents") .  " 
            SET 
                position = position + 1 
            WHERE 
                position = (" . $GLOBALS['plugin']->getValue("entry_pos") . " - 1) 
                AND id != " . $GLOBALS['plugin']->getValue("entry_id") . "
            AND 
                node_id = " . $GLOBALS['plugin']->getValue("node_id")
            ,__FILE__,__LINE__);
            
            

// reorder positions
$result = XT::query("SELECT
               id
           FROM
               " . $GLOBALS['plugin']->getTable('navigation_contents') . "
           WHERE
               node_id = " . $GLOBALS['plugin']->getValue("node_id") . "
           ORDER BY
               position ASC"
          ,__FILE__,__LINE__);
$i = 1;
while($row = $result->FetchRow()){
    XT::query("UPDATE " . $GLOBALS['plugin']->getTable('navigation_contents') . "
              SET
                  position= " . $i . "
              WHERE
                  node_id=" . $GLOBALS['plugin']->getSessionValue('open') . "
              AND
                  id=" . $row['id']
              ,__FILE__,__LINE__);
    $i++;
}
            
$GLOBALS['plugin']->call('saveTemplateContent');
?>