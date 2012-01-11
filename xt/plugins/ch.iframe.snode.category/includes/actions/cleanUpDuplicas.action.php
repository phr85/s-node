<?php
$result = XT::query("
            SELECT
               count(id) as duplica,id 
            FROM
                " . $GLOBALS['plugin']->getTable('relations') . "
            WHERE
                content_id = " . XT::getValue('node_id') . "
            AND
                content_type = " .XT::getBaseID() . "
                
            group by target_content_type, target_content_id
            ORDER by position ASC
            ",__FILE__,__LINE__);

while($row = $result->FetchRow()){
    if($row['duplica'] >1){
        XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable('relations') . " WHERE id=" . $row['id'],__FILE__,__LINE__);
    }
}

?>