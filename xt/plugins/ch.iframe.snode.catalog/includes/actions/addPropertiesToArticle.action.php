<?php
$GLOBALS['plugin']->call('saveArticle');
if($GLOBALS['plugin']->getValue('property_id') != 0){
    XT::query("INSERT INTO
                   " . $GLOBALS['plugin']->getTable('fields_rel') . "
               (article_id, lang, field_id, display)
               VALUES
                   (
                   " . $GLOBALS['plugin']->getValue('id') . ",
                   '" . $GLOBALS['plugin']->getActiveLang() . "',
                   " . $GLOBALS['plugin']->getValue('property_id') . ",
                   NULL
                   )"
          ,__FILE__,__LINE__);
          
    XT::query("INSERT INTO
                   " . $GLOBALS['plugin']->getTable('fields_values') . "
               (article_id, lang, field_id, position, value)
               VALUES
                   (
                   " . $GLOBALS['plugin']->getValue('id') . ",
                   '" . $GLOBALS['plugin']->getActiveLang() . "',
                   " . $GLOBALS['plugin']->getValue('property_id') . ",
                   1,
                   NULL
                   )"
          ,__FILE__,__LINE__);
          
    $focus['field'] = 'field_' . $GLOBALS['plugin']->getValue('property_id');
    $focus['segment'] = 'additionalProperties';
    XT::assign("FOCUS", $focus);
}
?>
