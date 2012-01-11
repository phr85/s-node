<?php
// Get the category without "0,xy" or whatever
if (XT::getValue('category')) {
	$category = XT::getValue('category');
	$category = explode(",",$category);
	$category = array_pop($category);
	// Ensure that all new posts are active
	XT::setValue('alwaysactive',1);
	// Mark category as open
	XT::setSessionValue('open',$category);
	
	XT::call("addArticleRel");
	if (XT::getValue("insertPage") == 1) {
		XT::setValue('node_id',XT::getValue('target_node_id'));
		XT::setValue('main_value',XT::getSessionValue('newid'));
		XT::setValue('package',XT::getBaseId());
		XT::setValue('module',"viewer");
		XT::setValue('params',"id=\"" . XT::getSessionValue('newid') . "\"");
		XT::call("ch.iframe.snode.navigation.InsertArticle");
		XT::call("ch.iframe.snode.navigation.cleanup");
		XT::call("ch.iframe.snode.navigation.saveTemplateContent");
	}
	// Redirect to the edit mode
	header('Location: /index.php?TPL=119&x' . XT::getBaseId() . '_id=' . XT::getSessionValue('newid') . '&x' . XT::getBaseId() . '_action=editArticle&x' . XT::getBaseId() . '_liveedit=true');	
} else {
	require_once(CLASS_DIR . "widgets/tree.widget.class.php");
	$treewidget = new XT_WidgetTree;
	$treewidget->addDetails('title','active','public');
	$count = $treewidget->buildTree('articles_tree','articles_tree_details','%s','',$in);
	$data = $treewidget->getData();
	
	$nodes = array();
	foreach($data as $key => $node){
	    $nodes[] = $node['id'];
	}
	
	// SQL
	$result = XT::query("
	    SELECT
	        a.id,
	        a.title,
	        a.subtitle,
	        a.creation_date,
	        a.active,
	        a.locked,
	        a.locked_user,
	        a.locked_date,
	        a.published,
	        a.rid,
	        rel.node_id
	    FROM
	        " . XT::getTable('articles_tree_rel') . " as rel LEFT JOIN 
	        " . XT::getTable('articles_v') . " as a ON (a.id = rel.article_id AND a.latest = 1 AND a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
	    WHERE
	        rel.node_id IN (" . implode(',',$nodes) . ") AND
	        a.title !=''
	    ORDER BY
	        a.title ASC
	    ",__FILE__,__LINE__);
	
	$data = array();
	while($row = $result->FetchRow()){
	    $data[$row['node_id']][] = $row;
	}
	XT::assign("INSERTPAGE", XT::getValue("insertPage"));
	XT::assign("TARGETNODEID", XT::getValue("target_node_id"));
	XT::assign("ARTICLES", $data);
	XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
	XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());
	
	$content = XT::build('chooseCategory.tpl');
}

?>
