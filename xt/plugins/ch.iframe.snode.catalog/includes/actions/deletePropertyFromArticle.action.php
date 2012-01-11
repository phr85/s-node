<?php
$GLOBALS['plugin']->call('saveArticle');
XT::query("DELETE FROM
               " . $GLOBALS['plugin']->getTable('fields_rel') . "
           WHERE
               article_id=" . $GLOBALS['plugin']->getValue('id') . "
           AND
               field_id=" . $GLOBALS['plugin']->getValue('field_id') . "
           AND
               lang='" . $GLOBALS['plugin']->getActiveLang() . "'"
          ,__FILE__,__LINE__);
          
          XT::query("DELETE FROM
               " . $GLOBALS['plugin']->getTable('fields_values') . "
           WHERE
               article_id=" . $GLOBALS['plugin']->getValue('id') . "
           AND
               field_id=" . $GLOBALS['plugin']->getValue('field_id') . "
           AND
               lang='" . $GLOBALS['plugin']->getActiveLang() . "'"
          ,__FILE__,__LINE__);

$focus['segment'] = 'additionalProperties';
XT::assign("FOCUS", $focus);
?>