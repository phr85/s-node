<?php
// save changes
$GLOBALS['plugin']->call('saveRecipe');
XT::query("UPDATE
               " . XT::getTable('images') . "
           SET
               is_main_image = 0
           WHERE
               recipe_id = " . XT::getValue('id')
          ,__FILE__,__LINE__);
XT::query("UPDATE
               " . XT::getTable('images') . "
           SET
               is_main_image = 1
           WHERE
               recipe_id = " . XT::getValue('id') . "
           AND
               position = " . XT::getValue('main_image_id')
          ,__FILE__,__LINE__);


$focus['segment'] = 'recipeImages_' . XT::getValue('main_image_id') ;
XT::assign("FOCUS", $focus);


$result = XT::query("
    SELECT
        image_id
    FROM
        " . XT::getTable("images") . "
    WHERE
        recipe_id = " . XT::getValue('id') . "
    AND
        position = " . XT::getValue('main_image_id')
    ,__FILE__,__LINE__);

$image_id = XT::getQueryData($result);

// Searchindex
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
foreach ($GLOBALS['cfg']->getLangs() as $lang => $name){
    $search = new XT_SearchIndex(XT::getValue('id'),$GLOBALS['plugin']->getContentType('Recipe'),1);
    $search->setLang($lang);
    $search->setImage($image_id[0]['image_id']);
}

?>
