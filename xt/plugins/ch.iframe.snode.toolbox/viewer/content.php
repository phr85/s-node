<?php

$result = XT::query("
        SELECT
            c.id,
            c.params,
            c.active,
            c.position,
            c.main_value,
            c.node_id,
            ct.icon,
            ct.title as content_type_title,
            ct.content_table,
            ct.title_field,
            ct.id_field,
            p.package,
            p.id as package_id,
            m.module,
            m.main_content_type,
            m.title,
            pd.title as package_title,
            pd.description
        FROM
            " . XT::getTable('navigation_contents') . " AS c,
            " . XT::getTable('plugins_packages') . " AS p
        LEFT JOIN
            (" . XT::getTable('plugins_packages_details') . " AS pd CROSS JOIN " . XT::getTable('plugins_modules') . " as m) ON (pd.id = p.id AND pd.lang = m.lang)
        LEFT JOIN
            " . XT::getTable('content_types') . " AS ct ON  (pd.id = ct.id)
        WHERE
            p.id = c.package AND
            m.module = c.module AND
            m.package = c.package AND
            c.node_id = " . $GLOBALS['tpl_id'] . " AND
            m.lang = '" . XT::getActiveLang() . "' AND
            c.lang = '" . XT::getActiveLang() . "'
        ORDER BY
            c.position ASC
", __FILE__, __LINE__);

$ids = array();
while ($row = $result->fetchRow()) {
    $row['package'] = substr($row['package'], strrpos($row['package'],'.') + 1);

    if($row['main_value'] != ''){

        // Get titles
        $result_titles = XT::query("
            SELECT
                title
            FROM
                " . XT::getDatabasePrefix() . "search_infos_global_" . XT::getActiveLang() . "
            WHERE
                content_type = '" . $row['main_content_type'] . "' AND
                content_id IN (" . $row['main_value'] . ")
            ORDER BY
                title ASC
            LIMIT 1
        ",__FILE__,__LINE__);
        
        $row_title = $result_titles->FetchRow();
        $row['content_title'] = "{$row_title['title']} ({$row['title']})";

    }
    $packages[] = $row;
}

// Get Pid
$result = XT::query("
    SELECT
        pid
    FROM
        " . XT::getTable('navigation') . "
    WHERE
        id = " . $GLOBALS['tpl_id'] . "
",__FILE__, __LINE__);

$row = $result->fetchRow();

XT::assign("PID", $row['pid']);
XT::assign("PACKAGES", $packages);
XT::assign("SOURCEEDIT_TPL", 108);
XT::assign("PAGEDESIGNER_TPL", 814);
XT::assign("NAVIGATION_BASEID", 60);
XT::assign("SOURCEEDIT_BASEID", 1);
XT::assign("FORMMANAGER_BASEID", 220);

XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

// Add buttons
if (XT::getSessionValue('ctrl') == 1) {
    XT::addImageButton('Cancel','addContentCancel','default','delete.png','content');
    XT::assign("CTRL","1");
}
else {
    if (count($packages) > 0) {
        XT::addImageButton('Add content','addContent','default','document_add.png','content');
    }
    else {
        // Add a first content if no content is in the page
        XT::addImageButton('Add content','addContentCancel','default','document_add.png','content','','','',"popup('/index.php?TPL=102&amp;module=slave1&amp;x60_action=insertContentSimple&amp;x60_livetpl=1&amp;x60_entry_pos=0&amp;x60_insert_pos=1&amp;x60_entry_mode=after&amp;x60_node_id=" . $GLOBALS['tpl_id']  . "&amp;x60_node_pid=" . $row['pid'] . "',800,600,'edit_addfirst');");
    }
    XT::addImageButton('Add article','addNewArticle','default','document_new.png','content','','','',"popup('/index.php?TPL=237&amp;x270_insertPage=1&amp;x270_target_node_id=" . $GLOBALS['tpl_id']  . "','','','NewDoc');");
}

?>