<?php
if($GLOBALS['plugin']->getValue('title')){
    $GLOBALS['plugin']->call('saveArticle');
}

if($GLOBALS['plugin']->getValue('tab') != ''){
    $GLOBALS['plugin']->setAdminModule($GLOBALS['plugin']->getValue('tab'));
}

XT::query("UPDATE
               " . $GLOBALS['plugin']->getTable('articles_details') . "
           SET
               active= 1
           WHERE
               id=" . $GLOBALS['plugin']->getValue('id') . "
           AND
               lang='" . $GLOBALS['plugin']->getValue('save_lang') . "'"
          ,__FILE__,__LINE__);

XT::log("Article " . $GLOBALS['plugin']->getValue('id') . " in language '" . $GLOBALS['plugin']->getValue('save_lang') . "' has been <b>activated</b>.",__FILE__,__LINE__,XT_INFO);

// Searchindex
include_once(CLASS_DIR . 'searchindex.class.php');
$search = new XT_SearchIndex($GLOBALS['plugin']->getValue('id'),$GLOBALS['plugin']->getContentType('Lexikon'),1,'global');
$search->setLang($GLOBALS['plugin']->getValue('save_lang'));
$search->enable();
?>