<?php
/**
 * get title
 */
$title = $GLOBALS['plugin']->getValue("folder_name");

if($title != ''){

    $result = XT::query("
        SELECT
            a.id
        FROM
            " . $GLOBALS['plugin']->getTable("tree") . " as a,
            " . $GLOBALS['plugin']->getTable("tree") . " as b,
            " . $GLOBALS['plugin']->getTable("folders") . " as f
        WHERE
            b.id = " . $GLOBALS['plugin']->getValue("folder") . "
            AND a.level = b.level + 1
            AND f.title = '" . $title . "'
            AND f.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        ",__FILE__,__LINE__,0);

    if($result->RecordCount() < 1){

        include_once(CLASS_DIR . 'tree.class.php');
        $tree = new XT_Tree("tree");
        $newid = $tree->addChildNode($GLOBALS['plugin']->getValue("folder"));

        XT::query("
            INSERT INTO
                " . $GLOBALS['plugin']->getTable("folders") . "
            (
                node_id,
                title,
                description,
                lang
            ) VALUES (
                " . $newid . ",
                '" . $title . "',
                '" . $GLOBALS['plugin']->getValue('description') . "',
                '" . $GLOBALS['plugin']->getActiveLang() . "'
            )
            ",__FILE__,__LINE__);

        $GLOBALS['plugin']->setAdminModule('o');

    } else {
        XT::log("Folder \"" . $title . "\" already exists",__FILE__,__LINE__,XT_ERROR);
        $GLOBALS['plugin']->setAdminModule('af');
    }

} else {
    XT::log("Folder name cannot be empty",__FILE__,__LINE__,XT_ERROR);
    $GLOBALS['plugin']->setAdminModule('af');
}
?>