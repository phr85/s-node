<?php
XT::query("DELETE FROM
               " . $GLOBALS['plugin']->getTable('price') . "
           WHERE
               article_id=" . $GLOBALS['plugin']->getValue('id')
          ,__FILE__,__LINE__,0);
?>
