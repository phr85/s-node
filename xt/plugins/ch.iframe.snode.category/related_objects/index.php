<?php

$source_type = XT::autoval("source_type","P",false);
$source_id =   XT::autoval("source_id",  "P",false);
$category_in = XT::autoval("categories", "P",false);
$target_type = XT::autoval("target_type","P",false);


// Kategorien ermitteln wenn nicht angegeben, ansonsten darauf Vertrauen das echte kategorien angegeben wurden.
if(!$category_in){
    // weitermachen wenn cid und ctype angegeben wurden
    if(is_numeric($source_id) && is_numeric($source_type)){
        $result = XT::query("SELECT content_id from " . XT::getTable("relations") . " WHERE content_type=5500 AND
        target_content_type=" . $source_type . "
        AND target_content_id=" . $source_id,__FILE__,__LINE__,0 );
         while($row = $result->FetchRow()){
             $cat[] = $row['content_id'];
         }

        if(is_array($cat)){
            $category_in = implode(", ",$cat);
        }
    }else {
    	 $stop = true;
    }
}

// limitierun auf bestimmte target_typen
if(is_numeric($target_type)){
     $target_type_sql = " AND target_content_type IN(" . $target_type . ")";
}



if(!$stop){
    $result = XT::query("SELECT rel.* FROM " . XT::getTable('relations') . " as rel
    WHERE content_type=5500
    AND
    content_id IN (" . $category_in . ")"
    . $target_type_sql
    . "  ORDER by position "
    ,__FILE__,__LINE__);

    $data['DATA'] = XT::getQueryData($result);

    foreach ($data['DATA'] as $key => $value) {
        $assign[$value['content_id']][$value['target_content_type']][] = $value;
    }
    unset($data);
    XT::assign("xt" . XT::getBaseID() . "_related_objects", $assign);

    // Fetch content
    $style = XT::autoval("style","P","default.tpl");

    $content = XT::build($style);
}
?>
