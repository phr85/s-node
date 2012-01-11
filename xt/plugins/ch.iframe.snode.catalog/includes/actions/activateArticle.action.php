<?php
    $GLOBALS['plugin']->setAdminModule('la');
    XT::query("UPDATE
                   " . $GLOBALS['plugin']->getTable('articles') . "
               SET
                   active= 1
               WHERE
                   id=" . $GLOBALS['plugin']->getValue('id')
              ,__FILE__,__LINE__);
//XT::log("Article " . $GLOBALS['plugin']->getValue('id') . " has been <b>activated</b>.",__FILE__,__LINE__,XT_INFO);

 // set And get session values
if(!$GLOBALS['plugin']->getValue('id')){
    $GLOBALS['plugin']->setValue('id', $GLOBALS['plugin']->getSessionValue('articleID'));
}else{
    $GLOBALS['plugin']->setSessionValue('articleID',$GLOBALS['plugin']->getValue('id'));
}

// Searchindex
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
$search = new XT_SearchIndex($GLOBALS['plugin']->getValue('id'),$GLOBALS['plugin']->getContentType('Product'),1, 'global');
$search->setLang($GLOBALS['plugin']->getActiveLang());
$search->enable();

XT::query("UPDATE
               " . $GLOBALS['plugin']->getTable('articles_details') . "
           SET
               active= 1
           WHERE
               id=" . $GLOBALS['plugin']->getValue('id') . "
           AND
               lang='" . $GLOBALS['plugin']->getActiveLang() . "'"
          ,__FILE__,__LINE__);
XT::log("Article " . $GLOBALS['plugin']->getValue('id') . " in language '" . $GLOBALS['plugin']->getActiveLang() . "' has been <b>activated</b>.",__FILE__,__LINE__,XT_INFO);
?>