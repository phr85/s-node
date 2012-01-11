<?php
// alle zahlen gr�ssergleich als startwert um 1 erh�hen
XT::query("UPDATE " . XT::getTable('r2i') . "
          SET
              position= position + 10000
          WHERE
              recipe_id=" . XT::getValue('id') . "
          AND
              position>=" . (XT::getValue('position') - 1)
          ,__FILE__,__LINE__);

// bildposition tauschen
XT::query("UPDATE " . XT::getTable('r2i') . "
          SET
              position= " . XT::getValue('position') . "
          WHERE
              recipe_id=" . XT::getValue('id') . "
          AND
              position=" . (XT::getValue('position') + 10000)
          ,__FILE__,__LINE__,0);

          
// neu sortieren
XT::call("reorderIngridientsInRecipe");
?>