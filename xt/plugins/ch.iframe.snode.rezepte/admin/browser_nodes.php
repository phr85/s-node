<?php

XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

if(XT::getPermission('list')){


// Get active folder
$active = 1;
if(XT::getSessionValue("node_id") != ''){
    $active = XT::getSessionValue("node_id");
}
if(XT::getValue('node_id') != ''){
    $active = XT::getValue('node_id');
}
$GLOBALS['plugin']->setSessionValue("node_id", $active);

XT::assign("NODE_MANAGER_TPL", $GLOBALS['plugin']->getConfig('node_manager_tpl'));
XT::assign("NODE_MANAGER_BASE_ID", $GLOBALS['plugin']->getConfig('node_manager_base_id'));
XT::assign("CTRL_ADD", XT::getSessionValue("ctrl_add"));
XT::assign("NODE_ID",XT::getSessionValue("node_id"));
$result = XT::query("SELECT
                        ad.id,
                        ad.title,
                        ad.active as lang_active,
                        ad.lang,
                        r2t.node_id,
                        r2t.position,
                        i.image_id

                    FROM
                        " . $GLOBALS['plugin']->getTable('r_details') . " as ad
                    LEFT JOIN
                        " . $GLOBALS['plugin']->getTable('r2tree') . " as r2t on (r2t.recipe_id = ad.id)
                    LEFT JOIN
                        " . $GLOBALS['plugin']->getTable('images') . "  as i on (i.recipe_id = ad.id AND i.is_main_image = 1)
                    LEFT JOIN
                        " . $GLOBALS['plugin']->getTable('rezepte') . " as a on (a.id = ad.id)
                    WHERE
                        r2t.node_id=" .XT::getSessionValue("node_id") . "
                     AND
                        ad.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
                    ORDER BY
                        r2t.position ASC",__FILE__, __LINE__,0);

XT::assign("RECIPE", XT::getQueryData($result));


/**
 * fetch content
 */
$content = XT::build('browser_nodes.tpl');

}

?>
