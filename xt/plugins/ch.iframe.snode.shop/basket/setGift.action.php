<?php
// get available presents
        $result = XT::query("
            SELECT
                ad.id,
                ad.title,
                p.gift as points
            FROM
                " . $GLOBALS['plugin']->getTable("catalog_articles_details") . " as ad
            LEFT JOIN
                " . $GLOBALS['plugin']->getTable("price") . " as p ON (p.article_id = ad.id)
            WHERE
                ad.lang='" . $GLOBALS['lang']->getLang() . "'
            AND
                ad.id=" . $GLOBALS['plugin']->getValue('article_id'),__FILE__,__LINE__);

        $data = XT::getQueryData($result);
        $_SESSION['GIFT']['selected'][]=$data[0];
?>
