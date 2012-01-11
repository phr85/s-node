<?php

require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title','active');
$count = $treewidget->buildTree('faq_tree','faq_tree_details','%s');

// Add Buttons
if(XT::getPermission('browserStructure')){
    if($GLOBALS['plugin']->getSessionValue('ctrl_add') || $GLOBALS['plugin']->getSessionValue('ctrl_cut') || $GLOBALS['plugin']->getSessionValue('ctrl_copy')){
        $GLOBALS['plugin']->contribute('overview_buttons','Cancel', 'ctrlCancel','delete.png','1','master');
    } else {
        (sizeof($count) > 0) ? $GLOBALS['plugin']->contribute('overview_buttons','Add folder', 'addNode','','1','master') : $GLOBALS['plugin']->contribute('overview_buttons','Add folder', 'addFirstNode','','1','master');;
    }
}
XT::assign("CTRL", $GLOBALS['plugin']->getSessionValue('ctrl_add') | $GLOBALS['plugin']->getSessionValue('ctrl_cut') | $GLOBALS['plugin']->getSessionValue('ctrl_copy'));

// Define ctrl mode
XT::assign("OPEN", $GLOBALS['plugin']->getSessionValue('open'));
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build('overview.tpl');

?>