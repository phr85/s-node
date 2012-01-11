<?php
// set product of month
XT::query("UPDATE " . XT::getTable('articles_details') . " SET product_of_month=1
    WHERE id=" . XT::getValue('id') . " AND lang='" . XT::getValue('save_lang') . "'",__FILE__,__LINE__);

// Unset the older entries
if(XT::getConfig('product_of_month') > 0){
    $result = XT::query("SELECT id FROM " . XT::getTable('articles_details') . "
    WHERE
        product_of_month=1
    AND
        active=1
    AND
        id != ". XT::getValue('id') . "
    AND
        lang='" . XT::getValue('save_lang') . "'
    ORDER by ID desc
    ",__FILE__,__LINE__);

    $i = 1;
    while($row = $result->FetchRow()){
        if($i > (XT::getConfig('product_of_month') -1)){
            XT::query("UPDATE " . XT::getTable('articles_details') . " SET product_of_month=0
            WHERE id=" .$row['id'] . " AND lang='" . XT::getValue('save_lang') . "'",__FILE__,__LINE__);
        }
        $i ++;
    }
//unset inactive entries
    XT::query("UPDATE " . XT::getTable('articles_details') . "
    SET 
        product_of_month=0
    WHERE 
        lang='" . XT::getValue('save_lang') . "'
    AND 
        active=0
    AND
        id != " . XT::getValue('id')
    ,__FILE__,__LINE__);

}

?>