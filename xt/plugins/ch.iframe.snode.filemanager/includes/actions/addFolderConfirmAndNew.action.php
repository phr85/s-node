<?php
/**
 * get title
 */
$title = $GLOBALS['plugin']->getValue("folder_name");

if($title != ''){

    /**
     * check for the same title in the same folder
     */
    $result = XT::query("
        SELECT
            a.id
        FROM
            " . $GLOBALS['plugin']->getTable("files") . " as a,
            " . $GLOBALS['plugin']->getTable("files") . " as b
        WHERE
            b.id = " . $GLOBALS['plugin']->getValue("folder") . "
            AND a.level = b.level + 1
            AND a.title = '" . $title . "'
        ");
    XT::errorCheck(__FILE__,__LINE__);
    if($result->RecordCount() < 1){

        include_once(CLASS_DIR . 'nestedset.class.php');
        $nestedset = new nestedset($plugin);
        $nestedset->setTable('files');
        $newid = $nestedset->insertNodeAtEnd($GLOBALS['plugin']->getValue("folder"), $title);

        $data = array(
            "description" => $GLOBALS['plugin']->getValue('description'),
            "isFolder" => 1,
        );
        $nestedset->updateNode($newid, $data);

        $GLOBALS['error']->add("Folder \"" . $title . "\" created successfully",__FILE__,__LINE__,XT_INFO);

    } else {
        $GLOBALS['error']->add("Folder \"" . $title . "\" already exists",__FILE__,__LINE__,XT_ERROR);
    }

    $GLOBALS['plugin']->setAdminModule('af');

} else {

    $GLOBALS['error']->add("Folder name cannot be empty",__FILE__,__LINE__,XT_ERROR);
    $GLOBALS['plugin']->setAdminModule('af');

}
?>