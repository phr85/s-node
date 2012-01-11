<?php
$GLOBALS['plugin']->setAdminModule('la');
XT::query("UPDATE
               " . $GLOBALS['plugin']->getTable('articles') . "
           SET
               active= 0
           WHERE
               id=" . $GLOBALS['plugin']->getValue('id')
          ,__FILE__,__LINE__);


// Searchindex AND lang
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex($GLOBALS['plugin']->getValue('id'),$GLOBALS['plugin']->getContentType('Product'),1,'global');

foreach ($GLOBALS['cfg']->getLangs() as $key => $lang){
    $search->setLang($key);
    $search->disable();
    XT::query("UPDATE
                   " . $GLOBALS['plugin']->getTable('articles_details') . "
               SET
                   active= 0
               WHERE
                   id=" . $GLOBALS['plugin']->getValue('id') . "
               AND
                   lang='" . $key . "'"
              ,__FILE__,__LINE__);
}

XT::log("Article " . $GLOBALS['plugin']->getValue('id') . " has been <b>deactivated</b> in all languages.",__FILE__,__LINE__,XT_INFO);


?>