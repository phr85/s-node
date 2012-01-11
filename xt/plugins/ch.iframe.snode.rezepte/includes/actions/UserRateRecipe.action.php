<?php
// insert into ratings
XT::query("insert into `xt_rezepte_rating`(`recipe_id`,`user_id`,`rating`,`date`) values 
( '" . XT::getValue("recipe_id") . "','" . XT::getUserID() . "','" . XT::getValue("rating") . "','" . TIME ."')",__FILE__,__LINE__);

// update recipe
$result = XT::query("select avg(rating) as rating_avg, count(*) as rating_votes from xt_rezepte_rating where recipe_id= '" . XT::getValue("recipe_id") . "'",__FILE__,__LINE__);
$values = XT::GetQueryData($result);

XT::query("UPDATE " . XT::getTable('rezepte') . "
          SET
              rating_avg=" . $values[0]['rating_avg'] . ",
              rating_votes=" . $values[0]['rating_votes'] . "
          WHERE
              id=" . XT::getValue('recipe_id') . "
          ",__FILE__,__LINE__,0);

?>