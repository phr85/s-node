<?php
// set product of month
XT::query("UPDATE " . XT::getTable('r_details') . " SET recipe_of_month=1
    WHERE id=" . XT::getValue('id') . " AND lang='" . XT::getPluginLang() . "'",__FILE__,__LINE__);

// Unset the older entries
if(XT::getConfig('recipe_of_month') > 0){
    $result = XT::query("SELECT id FROM " . XT::getTable('r_details') . "
    WHERE
        recipe_of_month=1
    AND
        active=1
    AND
        id != ". XT::getValue('id') . "
    AND
        lang='" . XT::getPluginLang() . "'
    ORDER by ID desc
    ",__FILE__,__LINE__);

    $i = 1;
    while($row = $result->FetchRow()){
        if($i > (XT::getConfig('recipe_of_month') -1)){
            XT::query("UPDATE " . XT::getTable('r_details') . " SET recipe_of_month=0
            WHERE id=" .$row['id'] . " AND lang='" . XT::getPluginLang() . "'",__FILE__,__LINE__);
        }
        $i ++;
    }
//unset inactive entries
    XT::query("UPDATE " . XT::getTable('r_details') . "
    SET
        recipe_of_month=0
    WHERE
        lang='" . XT::getPluginLang() . "'
    AND
        active=0
    AND
        id != " . XT::getValue('id')
    ,__FILE__,__LINE__);

}

?>