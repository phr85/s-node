<?php
// reorder positions
$result = XT::query("SELECT
               ingridient_id,position
           FROM
               " . XT::getTable('r2i') . "
           WHERE
               recipe_id=" . XT::getValue("id") . "
           ORDER BY
               position ASC"
,__FILE__,__LINE__);
$i = 1;
while($row = $result->FetchRow()){
    XT::query("UPDATE " . XT::getTable('r2i') . "
              SET
                  position= " . $i . "
              WHERE
                  recipe_id=" . XT::getValue("id") . "
              AND
                  position=" . $row['position']  . "
              AND
                  ingridient_id=" . $row['ingridient_id']
    ,__FILE__,__LINE__);
    $i++;
}
?>