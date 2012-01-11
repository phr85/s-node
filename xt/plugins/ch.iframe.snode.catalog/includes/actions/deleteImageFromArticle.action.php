<?php
$GLOBALS['plugin']->call('saveArticle');
// delete image
XT::query("DELETE FROM
               " . $GLOBALS['plugin']->getTable('images') . "
           WHERE
               article_id=" . $GLOBALS['plugin']->getValue('id') . "
           AND
               position=" . $GLOBALS['plugin']->getValue('delete_image_id')
          ,__FILE__,__LINE__);
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

$focus['segment'] = 'articleImages';
XT::assign("FOCUS", $focus);
?>
