<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

if(XT::getPermission('view')){
    
    if($GLOBALS['plugin']->getSessionValue('open') == ''){
        $GLOBALS['plugin']->setSessionValue('open',10000);
    }
    
    require_once(CLASS_DIR . "widgets/tree.widget.class.php");
    $treewidget = new XT_WidgetTree;
    $treewidget->addDetails('title','active','public');
    $count = $treewidget->buildTree('navigation','navigation_details','%s','',$in);
    
    // Add Buttons
    if(XT::getPermission('addPages')){
        if($GLOBALS['plugin']->getSessionValue('ctrl_add') || $GLOBALS['plugin']->getSessionValue('ctrl_cut') || $GLOBALS['plugin']->getSessionValue('ctrl_copy')){
            $GLOBALS['plugin']->contribute('overview_buttons','Cancel', 'ctrlCancel','cancel.png','1','master','c');
        } else {
            (sizeof($count) > 0) ? $GLOBALS['plugin']->contribute('overview_buttons','Add page', 'addPage','document_new.png','1','master') : $GLOBALS['plugin']->contribute('overview_buttons','Add page', 'addFirstPage','document_new.png','1','master');;
        }
    }
    XT::getPermission('addProfiles') ? XT::addButton('Add profile', 'addProfile') : null;
    XT::addButton('Add profile', 'addProfile');
    
    XT::assign("CTRL", $GLOBALS['plugin']->getSessionValue('ctrl_add') | $GLOBALS['plugin']->getSessionValue('ctrl_cut') | $GLOBALS['plugin']->getSessionValue('ctrl_copy'));
    
    if($GLOBALS['plugin']->getSessionValue('ctrl_add')){
        XT::assign("CTRL_TARGET","slave1");
        XT::assign("CTRL_FORM","0");
        // default tpls aus dem folder 
        XT::assign('PAGETEMPLATES',array("dd","dddd","dddddd"));
        
    } else {
        XT::assign("CTRL_TARGET","master");
        XT::assign("CTRL_FORM","1");
    }
    
    // Define ctrl mode
    XT::assign("OPEN", $GLOBALS['plugin']->getSessionValue('open'));
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());
    
    $content = XT::build('overview.tpl');

}
?>
