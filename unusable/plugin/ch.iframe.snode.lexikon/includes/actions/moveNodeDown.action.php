<?php
// alle zahlen grössergleich als startwert um 1 erhöhen
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('tree2articles') . "
          SET
              position= position + 10000
          WHERE
              node_id=" . $GLOBALS['plugin']->getSessionValue('open') . "
          AND
              position>=" . $GLOBALS['plugin']->getValue('position')
          ,__FILE__,__LINE__);

// bildposition tauschen
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('tree2articles') . "
          SET
              position= " . $GLOBALS['plugin']->getValue('position') . "
          WHERE
              node_id=" . $GLOBALS['plugin']->getSessionValue('open') . "
          AND
              position=" . ($GLOBALS['plugin']->getValue('position') + 10001)
          ,__FILE__,__LINE__,0);

// reorder positions
$result = XT::query("SELECT
               position
           FROM
               " . $GLOBALS['plugin']->getTable('tree2articles') . "
           WHERE
               node_id=" . $GLOBALS['plugin']->getSessionValue('open') . "
           ORDER BY
               position ASC"
          ,__FILE__,__LINE__);
$i = 1;
while($row = $result->FetchRow()){
    XT::query("UPDATE " . $GLOBALS['plugin']->getTable('tree2articles') . "
              SET
                  position= " . $i . "
              WHERE
                  node_id=" . $GLOBALS['plugin']->getSessionValue('open') . "
              AND
                  position=" . $row['position']
              ,__FILE__,__LINE__);
    $i++;
}
if ($GLOBALS['plugin']->getValue('position') == ($i - 1)){
    $focus['segment'] = 'articleImages_' . $GLOBALS['plugin']->getValue('position') ;
}else{
    $focus['segment'] = 'articleImages_' . ($GLOBALS['plugin']->getValue('position') + 1) ;
}
XT::assign("FOCUS", $focus);
$GLOBALS['plugin']->setAdminModule('bn');
?>
