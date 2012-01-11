<?php

// Zutat löschen
XT::query("DELETE FROM " . XT::getTable('r2i') . "
           WHERE
               recipe_id=" . XT::getValue("id") . "
           AND
               ingridient_id=" . XT::getValue("ingridient_id") . "
           AND
               position=" . XT::getValue("position")
,__FILE__,__LINE__);
XT::call("saveRecipe");
?>