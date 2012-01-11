<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title','active');

// user holen
$userfolders = XT::getQueryData(XT::query("SELECT id, username, home_node_id as folder from xt_user where home_node_id is not NULL",__FILE__,__LINE__),'id');
$current_user = XT::autoval('current_user',"R",XT::getUserID());
if($userfolders[$current_user]['folder']){
    $treewidget->fix_tree = array($userfolders[$current_user]['folder']);
}else {
    $treewidget->fix_tree = array(2);
}
XT::assign('USERFOLDERS',$userfolders);
XT::assign('CURRENT_USER',$current_user);



$count = $treewidget->buildTree('files_tree','files_tree_details','%s','');

// Add Buttons
if(XT::getPermission('browserStructure')){
    if($GLOBALS['plugin']->getSessionValue('ctrl_add') || $GLOBALS['plugin']->getSessionValue('ctrl_cut') || $GLOBALS['plugin']->getSessionValue('ctrl_cut_file') || $GLOBALS['plugin']->getSessionValue('ctrl_copy')){
        $GLOBALS['plugin']->contribute('overview_buttons','Cancel', 'ctrlCancel','cancel.png','1','master');
    } else {
        (sizeof($count) > 0) ? $GLOBALS['plugin']->contribute('overview_buttons','Add folder', 'addNode','folder_new.png','1','master') : $GLOBALS['plugin']->contribute('overview_buttons','Add folder', 'addFirstNode','folder_new.png','1','master');;
    }
}

if(XT::getConfig("convert_user_button")){
    $GLOBALS['plugin']->contribute('overview_buttons','Convert User Folders', 'convertUserFolders','refresh.png','1','master');   
} 



XT::assign("CTRL", $GLOBALS['plugin']->getSessionValue('ctrl_add') | $GLOBALS['plugin']->getSessionValue('ctrl_cut')| $GLOBALS['plugin']->getSessionValue('ctrl_cut_file') | $GLOBALS['plugin']->getSessionValue('ctrl_cut_file') | $GLOBALS['plugin']->getSessionValue('ctrl_copy'));

// Define ctrl mode
XT::assign("OPEN", $GLOBALS['plugin']->getSessionValue('open'));
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());

XT::assign("ADMINMODUL", $GLOBALS['plugin']->adminModule);

XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());
// Set the id for homedirs. You musn't delete this directory.
XT::assign("HOME_DIRS", XT::getConfig("home_folder_id"));
$content = XT::build('userfolders.tpl');

?>