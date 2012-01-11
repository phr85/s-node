<?php
$GLOBALS['plugin']->call('saveArticle');
XT::query("DELETE FROM
               " . $GLOBALS['plugin']->getTable('fields') . "
           WHERE
               article_id=" . $GLOBALS['plugin']->getValue('id') . "
           AND
               fieldname_id=" . $GLOBALS['plugin']->getValue('field_id') . "
           AND
               lang='" . $GLOBALS['plugin']->getActiveLang() . "'"
          ,__FILE__,__LINE__);
$focus['segment'] = 'additionalProperties';
XT::assign("FOCUS", $focus);
?>
