<?php
    $GLOBALS['plugin']->setAdminModule('la');
    XT::query("UPDATE
                   " . XT::getTable('rezepte') . "
               SET
                   active= 1
               WHERE
                   id=" . XT::getValue('id')
              ,__FILE__,__LINE__,1);
//XT::log("Recipe " . XT::getValue('id') . " has been <b>activated</b>.",__FILE__,__LINE__,XT_INFO);

 // set And get session values
if(!XT::getValue('id')){
    $GLOBALS['plugin']->setValue('id', XT::getSessionValue('recipeID'));
}else{
    $GLOBALS['plugin']->setSessionValue('recipeID',XT::getValue('id'));
}

// Searchindex
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex(XT::getValue('id'),$GLOBALS['plugin']->getContentType('Recipe'),1, 'global');
$search->setLang($GLOBALS['plugin']->getActiveLang());
$search->enable();

XT::query("UPDATE
               " . XT::getTable('r_details') . "
           SET
               active= 1
           WHERE
               id=" . XT::getValue('id') . "
           AND
               lang='" . $GLOBALS['plugin']->getActiveLang() . "'"
          ,__FILE__,__LINE__);
XT::log("Recipe " . XT::getValue('id') . " in language '" . $GLOBALS['plugin']->getActiveLang() . "' has been <b>activated</b>.",__FILE__,__LINE__,XT_INFO);
?>