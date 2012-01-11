<?php
// save changes
$GLOBALS['plugin']->call('saveArticle');
XT::query("UPDATE
               " . $GLOBALS['plugin']->getTable('images') . "
           SET
               is_main_image = 0
           WHERE
               article_id = " . $GLOBALS['plugin']->getValue('id')
          ,__FILE__,__LINE__);
XT::query("UPDATE
               " . $GLOBALS['plugin']->getTable('images') . "
           SET
               is_main_image = 1
           WHERE
               article_id = " . $GLOBALS['plugin']->getValue('id') . "
           AND
               position = " . $GLOBALS['plugin']->getValue('main_image_id')
          ,__FILE__,__LINE__);


$focus['segment'] = 'articleImages_' . $GLOBALS['plugin']->getValue('main_image_id') ;
XT::assign("FOCUS", $focus);


$result = XT::query("
    SELECT
        image_id
    FROM
        " . $GLOBALS['plugin']->getTable("images") . "
    WHERE
        article_id = " . $GLOBALS['plugin']->getValue('id') . "
    AND
        position = " . $GLOBALS['plugin']->getValue('main_image_id')
    ,__FILE__,__LINE__);

$image_id = XT::getQueryData($result);

// Searchindex
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
foreach ($GLOBALS['cfg']->getLangs() as $lang => $name){
    $search = new XT_SearchIndex($GLOBALS['plugin']->getValue('id'),$GLOBALS['plugin']->getContentType('Product'),1);
    $search->setLang($lang);
    $search->setImage($image_id[0]['image_id']);
}

?>
