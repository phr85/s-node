<?php

function_exists("zend_loader_file_licensed") ? XT::checkDomain(zend_loader_file_licensed()) : null;

require_once(CLASS_DIR . "widgets/tree.widget.class.php");
$treewidget = new XT_WidgetTree;
$treewidget->addDetails('title','active','public');
$count = $treewidget->buildTree('faq_tree','faq_tree_details','%s','',$in);
$data = $treewidget->getData();

if(XT::getPermission('add')){

    // Add Buttons
    if(XT::getPermission('add')){
        if(XT::getSessionValue('ctrl_add') ||
        XT::getSessionValue('ctrl_cut') ||
        XT::getSessionValue('ctrl_copy') ||
        XT::getSessionValue('ctrl_copy_entry') ||
        XT::getSessionValue('ctrl_cut_entry')){
            $GLOBALS['plugin']->contribute('overview_buttons','Cancel', 'ctrlCancel','cancel.png','1','master');
        } else {
        (sizeof($count) > 0) ? $GLOBALS['plugin']->contribute('overview_buttons','Add category', 'addNode','folder_new.png','1','master') : $GLOBALS['plugin']->contribute('overview_buttons','Add page', 'addFirstPage','document_new.png','1','master');;
        }
    }

    // Buttons
    $GLOBALS['plugin']->contribute('overview_buttons','Add FAQ', 'addFaqRel','document_new.png','0','slave1');

    XT::assign("CTRL",
    XT::getSessionValue('ctrl_add') |
    XT::getSessionValue('ctrl_cut') |
    XT::getSessionValue('ctrl_copy')|
    XT::getSessionValue('ctrl_copy_entry')|
    XT::getSessionValue('ctrl_cut_entry')
    );
    XT::assign("CTRLENTRY",
    XT::getSessionValue('ctrl_copy_entry')|
    XT::getSessionValue('ctrl_cut_entry')
    );

    if(XT::getSessionValue('ctrl_add')){
        XT::assign("CTRL_TARGET","slave1");
        XT::assign("CTRL_FORM","0");
    } else {
        XT::assign("CTRL_TARGET","master");
        XT::assign("CTRL_FORM","1");
    }
}

$nodes = array();
foreach($data as $key => $node){
    $nodes[] = $node['id'];
    if ($node['selected'] == 1){
    	$node_id = $node['id'];
    	
    	// Get FAQ articles affiliated with this FAQ Category
    	$articlequery = XT::query("
			SELECT
				*
			FROM
				" . XT::getTable('faq2cat') . " as rel
			LEFT JOIN 
				" . XT::getTable('faq') . " as articles ON (articles.id = rel.faq_id AND articles.lang='" . XT::getActiveLang() . "')
			WHERE 
				rel.node_id = " . $node_id . "
			ORDER BY
				rel.position,
				articles.date desc
			"
    	,__FILE__,__LINE__);
    	    	
    	$temp = XT::getQueryData($articlequery);
    	
    	XT::assign("xt" . XT::getBaseID() . "_ITEMS",$temp);
    }
}

XT::assign("xt" . XT::getBaseID() . "_FAQ", $data);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());


$content = XT::build("categories.tpl");

?>