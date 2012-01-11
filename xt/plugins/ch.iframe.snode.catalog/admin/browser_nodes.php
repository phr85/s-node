<?php

XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

if(XT::getPermission('list')){


// Get active folder
$active = 1;
if($GLOBALS['plugin']->getSessionValue("node_id") != ''){
    $active = $GLOBALS['plugin']->getSessionValue("node_id");
}
if($GLOBALS['plugin']->getValue('node_id') != ''){
    $active = $GLOBALS['plugin']->getValue('node_id');
}
$GLOBALS['plugin']->setSessionValue("node_id", $active);

XT::assign("NODE_MANAGER_TPL", $GLOBALS['plugin']->getConfig('node_manager_tpl'));
XT::assign("NODE_MANAGER_BASE_ID", $GLOBALS['plugin']->getConfig('node_manager_base_id'));
XT::assign("CTRL_ADD", $GLOBALS['plugin']->getSessionValue("ctrl_add"));
XT::assign("NODE_ID",$GLOBALS['plugin']->getSessionValue("node_id"));
$result = XT::query("SELECT
                        ad.id,
                        ad.title,
                        ad.lead,
                        a.art_nr,
                        ad.active as lang_active,
                        ad.lang,
                        a2t.node_id,
                        a2t.position,
                        i.image_id

                    FROM
                        " . $GLOBALS['plugin']->getTable('articles_details') . " as ad
                    LEFT JOIN
                        " . $GLOBALS['plugin']->getTable('tree2articles') . " as a2t on (a2t.article_id = ad.id)
                    LEFT JOIN
                        " . $GLOBALS['plugin']->getTable('images') . "  as i on (i.article_id = ad.id AND i.is_main_image = 1)
                    LEFT JOIN
                        " . $GLOBALS['plugin']->getTable('articles') . " as a on (a.id = ad.id)
                    WHERE
                        a2t.node_id=" .$GLOBALS['plugin']->getSessionValue("node_id") . "
                     AND
                        ad.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
                    ORDER BY
                        a2t.position ASC",__FILE__, __LINE__,0);

XT::assign("ARTICLES", XT::getQueryData($result));


/**
 * fetch content
 */
$content = XT::build('browser_nodes.tpl');

}

?>
