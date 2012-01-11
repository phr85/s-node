<?php




$result = XT::query("SELECT max(position) as position FROM " . XT::getTable('images') . " WHERE article_id=" . $GLOBALS['plugin']->getValue('id') ,__FILE__,__LINE__);
$row = $result->FetchRow();

$i = $row['position'] + 1 ;

$result = XT::query("SELECT file.id from " . XT::getTable('files') . " as file
LEFT JOIN " . XT::getTable('files_rel') . " as rel ON(rel.file_id = file.id)
WHERE rel.node_id = " . XT::getValue('imagefolder'),__FILE__,__LINE__);


while($row = $result->FetchRow()){
    if($i ==1){
        $isMainImage = 1;
    }else {
    	$isMainImage = 0;
    }
    XT::query("DELETE FROM
               " . $GLOBALS['plugin']->getTable('images') . "
           WHERE
               article_id=" . $GLOBALS['plugin']->getValue('id') . "
           AND
               image_id=" . $row['id']
          ,__FILE__,__LINE__);
    
    XT::query("INSERT INTO
                   " . $GLOBALS['plugin']->getTable('images') . "
                   (article_id, image_id, image_version, is_main_image, position)
               VALUES
                   (
                    " . $GLOBALS['plugin']->getValue('id') . ",
                    " . $row['id'] . ",
                    2,
                    " . $isMainImage . ",
                    " . $i . "
                    )"
    ,__FILE__,__LINE__);
    $i++;
}

// reorder positions
$result = XT::query("SELECT
               position
           FROM
               " . $GLOBALS['plugin']->getTable('images') . "
           WHERE
               article_id=" . $GLOBALS['plugin']->getValue('id') . "
           ORDER BY
               position ASC"
          ,__FILE__,__LINE__);
$i = 1;
while($row = $result->FetchRow()){
    XT::query("UPDATE " . $GLOBALS['plugin']->getTable('images') . "
              SET
                  position= " . $i . "
              WHERE
                  article_id=" . $GLOBALS['plugin']->getValue('id') . "
              AND
                  position=" . $row['position']
              ,__FILE__,__LINE__);
    $i++;
}
$result = XT::query("SELECT count(article_id) as count from  " . XT::getTable('images') . " WHERE is_main_image = 1 AND article_id=" . $GLOBALS['plugin']->getValue('id') ,__FILE__,__LINE__);
$row = $result->FetchRow();
if($row['count'] < 1){
    $result = XT::query("UPDATE  " . XT::getTable('images') . " SET is_main_image= 1 WHERE position = 1 AND article_id=" . $GLOBALS['plugin']->getValue('id') ,__FILE__,__LINE__);
}
?>