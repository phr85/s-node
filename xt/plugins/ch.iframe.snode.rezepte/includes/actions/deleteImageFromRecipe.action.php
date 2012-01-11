<?php
$GLOBALS['plugin']->call('saveRecipe');
// delete image
XT::query("DELETE FROM
               " . XT::getTable('images') . "
           WHERE
               recipe_id=" . XT::getValue('id') . "
           AND
               position=" . XT::getValue('delete_image_id')
          ,__FILE__,__LINE__);
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

$focus['segment'] = 'recipeImages';
XT::assign("FOCUS", $focus);
?>
