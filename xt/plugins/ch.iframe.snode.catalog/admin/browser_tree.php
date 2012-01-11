<?php
if(XT::getPermission('list')){
    require_once(CLASS_DIR . "widgets/tree.widget.class.php");
    $treewidget = new XT_WidgetTree;
    $treewidget->addDetails('title','active');
    $count = $treewidget->buildTree('tree','nodes','%s','',$in);

    // Add Buttons
    if(XT::getPermission('browserStructure')){
        if($GLOBALS['plugin']->getSessionValue('ctrl_add') || $GLOBALS['plugin']->getSessionValue('ctrl_cut') || $GLOBALS['plugin']->getSessionValue('ctrl_copy')){
            $GLOBALS['plugin']->contribute('browser_buttons','Cancel', 'cancel','delete.png','1','master');
        } else {
            (sizeof($count) > 0) ? $GLOBALS['plugin']->contribute('browser_buttons','Add node', 'addNode','folder_new.png','1','master') : $GLOBALS['plugin']->contribute('browser_buttons','Add node', 'addFirstNode','folder_new.png','1','master');;
        }
    }
    XT::getPermission('addProfiles') ? XT::addButton('Add profile', 'addProfile') : null;
    XT::addButton('Add profile', 'addProfile');

    XT::assign("CTRL", $GLOBALS['plugin']->getSessionValue('ctrl_add') | $GLOBALS['plugin']->getSessionValue('ctrl_cut') | $GLOBALS['plugin']->getSessionValue('ctrl_copy'));

   

    // Define ctrl mode
    XT::assign("OPEN", $GLOBALS['plugin']->getSessionValue('open'));
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    $content = XT::build('browser_tree.tpl');

}

?>
