<?php
if(XT::getValue('title')){
    $GLOBALS['plugin']->call('saveRecipe');
}

if(XT::getValue('tab') != ''){
    $GLOBALS['plugin']->setAdminModule(XT::getValue('tab'));
}
XT::query("UPDATE
               " . XT::getTable('r_details') . "
           SET
               active= 0
           WHERE
               id=" . XT::getValue('id') . "
           AND
               lang='" . XT::getPluginLang() . "'"
          ,__FILE__,__LINE__);

XT::log("Recipe " . XT::getValue('id') . " in language '" . XT::getPluginLang() . "' has been <b>deactivated</b>.",__FILE__,__LINE__,XT_INFO);

// Searchindex
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex(XT::getValue('id'),$GLOBALS['plugin']->getContentType('Recipe'),1,'global');
$search->setLang(XT::getPluginLang());
$search->disable();
?>
