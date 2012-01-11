<?php
// alle zahlen gr�ssergleich als startwert um 1 erh�hen
XT::query("UPDATE " . XT::getTable('r2tree') . "
          SET
              position= position + 10000
          WHERE
              node_id=" . XT::getSessionValue('open') . "
          AND
              position>=" . XT::getValue('position')
          ,__FILE__,__LINE__);

// bildposition tauschen
XT::query("UPDATE " . XT::getTable('r2tree') . "
          SET
              position= " . XT::getValue('position') . "
          WHERE
              node_id=" . XT::getSessionValue('open') . "
          AND
              position=" . (XT::getValue('position') + 10001)
          ,__FILE__,__LINE__,0);

// reorder positions
$result = XT::query("SELECT
               recipe_id
           FROM
               " . XT::getTable('r2tree') . "
           WHERE
               node_id=" . XT::getSessionValue('open') . "
           ORDER BY
               position ASC"
          ,__FILE__,__LINE__);
$i = 1;
while($row = $result->FetchRow()){
    XT::query("UPDATE " . XT::getTable('r2tree') . "
              SET
                  position= " . $i . "
              WHERE
                  node_id=" . XT::getSessionValue('open') . "
              AND
                  recipe_id=" . $row['recipe_id']
              ,__FILE__,__LINE__);
    $i++;
}
if (XT::getValue('position') == ($i - 1)){
    $focus['segment'] = 'recipeImages_' . XT::getValue('position') ;
}else{
    $focus['segment'] = 'recipeImages_' . (XT::getValue('position') + 1) ;
}
XT::assign("FOCUS", $focus);
$GLOBALS['plugin']->setAdminModule('bn');

?>