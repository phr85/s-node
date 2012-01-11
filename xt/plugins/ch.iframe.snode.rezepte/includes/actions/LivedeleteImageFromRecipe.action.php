<?php
$GLOBALS['plugin']->call('saveRecipe');
// delete image
XT::query("DELETE FROM
               " . XT::getTable('images') . "
           WHERE
               recipe_id=" . XT::getValue('id') . "
           AND
               position=1"
          ,__FILE__,__LINE__);
?>
