<?php
// save changes
$GLOBALS['plugin']->call('saveArticle');
// add image
$position = XT::getQueryData(XT::query("SELECT max(position) as position FROM " . $GLOBALS['plugin']->getTable('images') . " where article_id=" . $GLOBALS['plugin']->getValue('id'),__FILE__,__LINE__,0));
XT::query("INSERT INTO
               " . $GLOBALS['plugin']->getTable('images') . "
               (article_id, image_id, image_version, is_main_image, position)
           VALUES
               (
                " . $GLOBALS['plugin']->getValue('id') . ",
                0,
                0,
                0,
                " . ($position[0]['position']+1) . "
                )"
          ,__FILE__,__LINE__);


$focus['segment'] = 'articleImages_' . ($position[0]['position'] + 1) ;
XT::assign("FOCUS", $focus);

$picker = ($position[0]['position'] + 1) ;
XT::assign("PICKER", $picker);

?>
