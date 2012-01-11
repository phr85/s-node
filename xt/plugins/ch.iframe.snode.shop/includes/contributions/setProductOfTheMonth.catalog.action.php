<?php
XT::query("UPDATE
               " . $GLOBALS['plugin']->getTable('price') . "
           SET
               product_of_month=0"
          ,__FILE__,__LINE__);

XT::query("UPDATE
               " . $GLOBALS['plugin']->getTable('price') . "
           SET
               product_of_month= 1
           WHERE article_id=" . $GLOBALS['plugin']->getValue('article_id')
          ,__FILE__,__LINE__);
?>