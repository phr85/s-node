<?php
XT::loadClass("searchindex.class.php","ch.iframe.snode.search");  
// Get the information about the page
$result = XT::query("SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("navigation_details") . "
    WHERE
        node_id = " . XT::getValue('node_id') . "
        AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
",__FILE__,__LINE__);


while($row = $result->FetchRow()){
	// Create template file for this node
	if(!file_exists(PAGES_DIR . $row["tpl_file"])){
	    file_put_contents(PAGES_DIR . $row["tpl_file"], file_get_contents($GLOBALS['tpl']->template_dir . 'includes/skeleton.tpl'));
	}
	
	// Index keywords and description
	$search = new XT_SearchIndex($row['node_id'],$GLOBALS['plugin']->getContentType("Page"),1);
	$ext_link = $row['ext_link'];
	if($row["refertoextlink"] != 1){
	    $ext_link = '';
	}
	if(!empty($ext_link)){
	    $search->link($ext_link);
	}
	$search->setLang($GLOBALS['plugin']->getActiveLang());
	$search->build($row["title"], $row["description"]);
	$search->setImage($row['image']);
	if ($row["active"] != 1) {
		$search->disable();
	}	else {
		$search->enable();
	}
}
?>