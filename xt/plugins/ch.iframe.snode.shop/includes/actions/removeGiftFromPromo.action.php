<?php
$GLOBALS['plugin']->call('savepromo');
$data = XT::getQueryData(XT::query("SELECT
                                       position
                                    FROM " . $GLOBALS['plugin']->getTable('promo_gifts') . "
                                    WHERE discount_id=" . $GLOBALS['plugin']->getValue('id') . "
                                    AND article_id = " . $GLOBALS['plugin']->getValue('article_id')
                                    ,__FILE__,__LINE__));

XT::query("DELETE
           FROM " . $GLOBALS['plugin']->getTable('promo_gifts') . "
           WHERE discount_id=" . $GLOBALS['plugin']->getValue('id') . "
           AND article_id = " . $GLOBALS['plugin']->getValue('article_id')
           ,__FILE__,__LINE__,0);

XT::query("UPDATE " . $GLOBALS['plugin']->getTable('promo_gifts') . "
           SET position = position-1
           WHERE discount_id=" . $GLOBALS['plugin']->getValue('id') . "
           AND position > " . ($data[0]['position'])
           ,__FILE__,__LINE__,0);
$GLOBALS['plugin']->setAdminModule('promoedit');
?>
