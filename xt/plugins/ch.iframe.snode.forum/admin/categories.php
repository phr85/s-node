<?php
if(XT::getPermission('list')){
    require_once(CLASS_DIR . "widgets/tree.widget.class.php");
    $treewidget = new XT_WidgetTree;
    $treewidget->addDetails('title','active');
    $count = $treewidget->buildTree('forum_categories','forum_categories_details','%s','',$in);

    // Add Buttons
        if($GLOBALS['plugin']->getSessionValue('ctrl_add') || $GLOBALS['plugin']->getSessionValue('ctrl_cut') || $GLOBALS['plugin']->getSessionValue('ctrl_copy')| $GLOBALS['plugin']->getSessionValue('ctrl_cutforum') | $GLOBALS['plugin']->getSessionValue('ctrl_addforum')){
            $GLOBALS['plugin']->contribute('category_buttons','Cancel', 'cancel','delete.png','1','master');
        } else {
            (sizeof($count) > 0) ? $GLOBALS['plugin']->contribute('category_buttons','Add node', 'addNode','folder_new.png','1','master') : $GLOBALS['plugin']->contribute('category_buttons','Add node', 'addFirstNode','folder_new.png','1','master');;
            $GLOBALS['plugin']->contribute('category_buttons','Add forum', 'addForum','document_new.png','1','master');
        }
     

    XT::assign("CTRL", $GLOBALS['plugin']->getSessionValue('ctrl_add') | $GLOBALS['plugin']->getSessionValue('ctrl_cut') | $GLOBALS['plugin']->getSessionValue('ctrl_copy') | $GLOBALS['plugin']->getSessionValue('ctrl_cutforum') | $GLOBALS['plugin']->getSessionValue('ctrl_addforum'));

   

// forums for display    
$result = XT::query("
    SELECT
 *
    FROM
        " . $GLOBALS['plugin']->getTable("forum_forums") . "
    WHERE
        category_id = " . $GLOBALS['plugin']->getSessionValue('open') . "
        
    ",__FILE__,__LINE__,0);

    
    
    XT::assign("FORUMS", XT::getQueryData($result));
    XT::assign("OPEN", $GLOBALS['plugin']->getSessionValue('open'));
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    $content = XT::build('categories.tpl');

}

?>
