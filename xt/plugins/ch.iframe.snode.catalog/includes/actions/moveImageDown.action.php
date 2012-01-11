<?php
// alle zahlen grössergleich als startwert um 1 erhöhen
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('images') . "
          SET
              position= position + 10000
          WHERE
              article_id=" . $GLOBALS['plugin']->getValue('id') . "
          AND
              position>=" . $GLOBALS['plugin']->getValue('move_image_id')
          ,__FILE__,__LINE__);

// bildposition tauschen
XT::query("UPDATE " . $GLOBALS['plugin']->getTable('images') . "
          SET
              position= " . $GLOBALS['plugin']->getValue('move_image_id') . "
          WHERE
              article_id=" . $GLOBALS['plugin']->getValue('id') . "
          AND
              position=" . ($GLOBALS['plugin']->getValue('move_image_id') + 10001)
          ,__FILE__,__LINE__,0);

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
if ($GLOBALS['plugin']->getValue('move_image_id') == ($i - 1)){
    $focus['segment'] = 'articleImages_' . $GLOBALS['plugin']->getValue('move_image_id') ;
}else{
    $focus['segment'] = 'articleImages_' . ($GLOBALS['plugin']->getValue('move_image_id') + 1) ;
}
XT::assign("FOCUS", $focus);
$GLOBALS['plugin']->setAdminModule('ea');
?>
