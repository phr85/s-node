<?php
XT::query("UPDATE
               " . $GLOBALS['plugin']->getTable('price') . "
           SET
               gift= 1
           WHERE article_id=" . $GLOBALS['plugin']->getValue('article_id')
          ,__FILE__,__LINE__);
?>
