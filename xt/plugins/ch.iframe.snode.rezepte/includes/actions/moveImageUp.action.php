<?php
// alle zahlen gr�ssergleich als startwert um 1 erh�hen
XT::query("UPDATE " . XT::getTable('images') . "
          SET
              position= position + 10000
          WHERE
              recipe_id=" . XT::getValue('id') . "
          AND
              position>=" . (XT::getValue('move_image_id') - 1)
          ,__FILE__,__LINE__);

// bildposition tauschen
XT::query("UPDATE " . XT::getTable('images') . "
          SET
              position= " . XT::getValue('move_image_id') . "
          WHERE
              recipe_id=" . XT::getValue('id') . "
          AND
              position=" . (XT::getValue('move_image_id') + 10000)
          ,__FILE__,__LINE__,0);

// reorder positions
$result = XT::query("SELECT
               position
           FROM
               " . XT::getTable('images') . "
           WHERE
               recipe_id=" . XT::getValue('id') . "
           ORDER BY
               position ASC"
          ,__FILE__,__LINE__);
$i = 1;
while($row = $result->FetchRow()){
    XT::query("UPDATE " . XT::getTable('images') . "
              SET
                  position= " . $i . "
              WHERE
                  recipe_id=" . XT::getValue('id') . "
              AND
                  position=" . $row['position']
              ,__FILE__,__LINE__);
    $i++;
}
if (XT::getValue('move_image_id') ==1){
    $focus['segment'] = 'recipeImages_' . XT::getValue('move_image_id') ;
}else{
    $focus['segment'] = 'recipeImages_' . (XT::getValue('move_image_id') - 1) ;
}
XT::assign("FOCUS", $focus);
$GLOBALS['plugin']->setAdminModule('ea');

?>