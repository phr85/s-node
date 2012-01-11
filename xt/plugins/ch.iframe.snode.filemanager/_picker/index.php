<?php

XT::assign('FORM',$GLOBALS['plugin']->getSessionValue("form"));
XT::assign('FIELD',$GLOBALS['plugin']->getSessionValue("field"));
XT::assign('TITLEFIELD',$GLOBALS['plugin']->getSessionValue("titlefield"));
XT::assign('MODE',$GLOBALS['plugin']->getSessionValue("mode"));

require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title','active');
$count = $treewidget->buildTree('files_tree','files_tree_details','%s','',$in);

// Add Buttons
if(XT::getPermission('browserStructure')){
    if($GLOBALS['plugin']->getSessionValue('ctrl_add') || $GLOBALS['plugin']->getSessionValue('ctrl_cut') || $GLOBALS['plugin']->getSessionValue('ctrl_copy')){
        $GLOBALS['plugin']->contribute('overview_buttons','Cancel', 'ctrlCancel','cancel.png','1','master');
    } else {
        (sizeof($count) > 0) ? $GLOBALS['plugin']->contribute('overview_buttons','Add folder', 'addNode','folder_new.png','1','master') : $GLOBALS['plugin']->contribute('overview_buttons','Add folder', 'addFirstNode','folder_new.png','1','master');;
    }
}
if(XT::getPermission('recalculate')){
    $GLOBALS['plugin']->contribute('overview_buttons','Recalculate Images', 'recalculateImages','refresh.png','1','master');   
}

XT::assign("CTRL", $GLOBALS['plugin']->getSessionValue('ctrl_add') | $GLOBALS['plugin']->getSessionValue('ctrl_cut') | $GLOBALS['plugin']->getSessionValue('ctrl_copy'));

// Define ctrl mode
XT::assign("OPEN", $GLOBALS['plugin']->getSessionValue('open'));
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

  $content = XT::build('tree.tpl');

?>
