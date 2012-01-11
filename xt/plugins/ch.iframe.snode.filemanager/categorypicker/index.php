<?php

require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title','active');
$count = $treewidget->buildTree('files_tree','files_tree_details','%s','',$in);

if($GLOBALS['plugin']->getValue("open") != ''){
    $GLOBALS['plugin']->setSessionValue("open", $GLOBALS['plugin']->getValue("open"));
}

// Get files
$result = XT::query("
    SELECT
        b.id,
        det.title,
        b.type
    FROM
        " . $GLOBALS['plugin']->getTable("files_rel") . " as a LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files") . " as b ON (b.id = a.file_id)
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_details") . " as det ON (b.id = det.id AND det.lang = '" . XT::getPluginLang() .  "') 
    WHERE
        a.node_id = '" . $GLOBALS['plugin']->getSessionValue("open") . "'
    ORDER BY
        det.title ASC
",__FILE__,__LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("FILES", $data);

if($GLOBALS['plugin']->getValue("file_id") != ''){
    // Get files
    $result = XT::query("
        SELECT
            a.*,
            det.title,
            det.description
        FROM
            " . $GLOBALS['plugin']->getTable("files") . " as a
        LEFT JOIN
        " . $GLOBALS['plugin']->getTable("files_details") . " as det ON (a.id = det.id AND det.lang = '" . XT::getPluginLang() .  "') 
        WHERE
            a.id = '" . $GLOBALS['plugin']->getValue("file_id") . "'
    ",__FILE__,__LINE__);

    $data = array();
    while($row = $result->FetchRow()){
        $data[] = $row;
    }

    XT::assign("SELECTED", $data[0]);

}

if($GLOBALS['plugin']->getValue("form") != ''){
    $GLOBALS['plugin']->setSessionValue('form',$GLOBALS['plugin']->getValue("form"));
}

if($GLOBALS['plugin']->getValue("field") != ''){
    $GLOBALS['plugin']->setSessionValue('field',$GLOBALS['plugin']->getValue("field"));
}

if($GLOBALS['plugin']->getValue("actionField") != ''){
    $GLOBALS['plugin']->setSessionValue('actionField',$GLOBALS['plugin']->getValue("actionField"));
}

XT::assign("PICKER_FORM", $GLOBALS['plugin']->getSessionValue("form"));
XT::assign("PICKER_FIELD", $GLOBALS['plugin']->getSessionValue("field"));
XT::assign("ACTION_FIELD", $GLOBALS['plugin']->getSessionValue("actionField"));

$content = XT::build("default.tpl");

?>
