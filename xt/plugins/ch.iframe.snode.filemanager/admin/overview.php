<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title','active');

$treewidget->fix_tree = array(1);

$count = $treewidget->buildTree('files_tree','files_tree_details','%s','');

// Add Buttons
if(XT::getPermission('browserStructure')){
    if($GLOBALS['plugin']->getSessionValue('ctrl_add') || $GLOBALS['plugin']->getSessionValue('ctrl_cut') || $GLOBALS['plugin']->getSessionValue('ctrl_cut_file') || $GLOBALS['plugin']->getSessionValue('ctrl_copy')){
        $GLOBALS['plugin']->contribute('overview_buttons','Cancel', 'ctrlCancel','cancel.png','1','master');
    } else {
        (sizeof($count) > 0) ? $GLOBALS['plugin']->contribute('overview_buttons','Add folder', 'addNode','folder_new.png','1','master') : $GLOBALS['plugin']->contribute('overview_buttons','Add folder', 'addFirstNode','folder_new.png','1','master');;
    }
}
if(XT::getPermission('recalculate') && !XT::getConfig("destroy_original")){
    $GLOBALS['plugin']->contribute('overview_buttons','Recalculate Images', 'recalculateImages','refresh.png','1','master');   
}
if(XT::getPermission('import')){
    $GLOBALS['plugin']->contribute('overview_buttons','Import Files', 'importFiles','import2.png','1','master');   
}

XT::assign("CTRL", $GLOBALS['plugin']->getSessionValue('ctrl_add') | $GLOBALS['plugin']->getSessionValue('ctrl_cut')| $GLOBALS['plugin']->getSessionValue('ctrl_cut_file') | $GLOBALS['plugin']->getSessionValue('ctrl_cut_file') | $GLOBALS['plugin']->getSessionValue('ctrl_copy'));

// Define ctrl mode
XT::assign("OPEN", $GLOBALS['plugin']->getSessionValue('open'));
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());

XT::assign("ADMINMODUL", $GLOBALS['plugin']->adminModule);

XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());
// Set the id for homedirs. You musn't delete this directory.
XT::assign("HOME_DIRS", XT::getConfig("home_folder_id"));
$content = XT::build('overview.tpl');

?>