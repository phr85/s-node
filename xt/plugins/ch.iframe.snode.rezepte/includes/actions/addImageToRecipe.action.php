<?php
// save changes
$GLOBALS['plugin']->call('saveRecipe');
// add image
$position = XT::getQueryData(XT::query("SELECT max(position) as position FROM " . XT::getTable('images') . " where recipe_id=" . XT::getValue('id'),__FILE__,__LINE__,0));
$isMainImage = 0;
if(sizeof($position[0]['position']) < 1){
    $isMainImage = 1;
}
XT::query("INSERT INTO
               " . XT::getTable('images') . "
               (recipe_id, image_id, image_version, is_main_image, position)
           VALUES
               (
                " . XT::getValue('id') . ",
                0,
                0,
                '" . $isMainImage . "',
                " . ($position[0]['position']+1) . "
                )"
          ,__FILE__,__LINE__);

$focus['segment'] = 'recipeImages_' . ($position[0]['position'] + 1) ;
XT::assign("FOCUS", $focus);

$picker = ($position[0]['position'] + 1) ;
XT::assign("PICKER", $picker);

?>
