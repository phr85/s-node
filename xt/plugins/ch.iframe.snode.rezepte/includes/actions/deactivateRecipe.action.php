<?php
$GLOBALS['plugin']->setAdminModule('la');
XT::query("UPDATE
               " . XT::getTable('rezepte') . "
           SET
               active= 0
           WHERE
               id=" . XT::getValue('id')
          ,__FILE__,__LINE__);


// Searchindex AND lang
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex(XT::getValue('id'),$GLOBALS['plugin']->getContentType('Recipe'),1,'global');

foreach ($GLOBALS['cfg']->getLangs() as $key => $lang){
    $search->setLang($key);
    $search->disable();
    XT::query("UPDATE
                   " . XT::getTable('r_details') . "
               SET
                   active= 0
               WHERE
                   id=" . XT::getValue('id') . "
               AND
                   lang='" . $key . "'"
              ,__FILE__,__LINE__);
}

XT::log("Recipe " . XT::getValue('id') . " has been <b>deactivated</b> in all languages.",__FILE__,__LINE__,XT_INFO);


?>