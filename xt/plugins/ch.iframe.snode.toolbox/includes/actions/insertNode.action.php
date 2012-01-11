<?php

include_once(CLASS_DIR . 'tree.class.php');
$tree = new XT_Tree("navigation");

$limit_exceeded = false;

if(XT::getValue("node_id") > 10000){
    // Limitation check
    if(function_exists("zend_loader_file_licensed")){
        $lic_info = @zend_loader_file_licensed();
        if($lic_info['Limit'] > 0){
            $result = XT::query("
    	       SELECT count(id) as count_id FROM " . XT::getTable('navigation') . " WHERE id > 10000",__FILE__,__LINE__
    	       );

    	       while($row = $result->FetchRow()){
    	           if($row['count_id']+1 > ($lic_info['Limit']+2)){
    	               XT::log('Sie haben Ihr Seitenlimit erreicht (' . $lic_info['Limit'] . ' Seiten) - Upgrade auf S-Node.com',__FILE__,__LINE__,XT_ERROR);
    	               $limit_exceeded = true;
    	           }
    	       }
        }
    }
}

if(!$limit_exceeded){
    switch(XT::getValue("position")){
        case 'into':
            $newid = $tree->addChildNode(XT::getValue("node_id"));
            $GLOBALS['plugin']->setAdminModule(XT::getValue('target_module'));

            break;
        case 'before':
            $newid = $tree->addNode(XT::getValue("node_id"),"before");
            $GLOBALS['plugin']->setAdminModule(XT::getValue('target_module'));
            
            break;
        case 'after':
            $newid = $tree->addNode(XT::getValue("node_id"),"after");
            $GLOBALS['plugin']->setAdminModule(XT::getValue('target_module'));
            
            break;
    }



   

    $public = 1;
    // Get parent node information
    $result = XT::query("
        SELECT
            public
        FROM
            " . XT::getTable('navigation_details') . "
        WHERE
            node_id = " . XT::getValue('node_id') . "
        LIMIT 1
    ",__FILE__,__LINE__);

    $data = array();
    while($row = $result->FetchRow()){
        $data[] = $row;
        $public = $row['public'];
    }
    //get pid
    $details = $tree->_nodeInfo($newid);
    // Get node details
    $result = XT::query("SELECT
            *
        FROM
            " . $GLOBALS['plugin']->getTable('navigation_details') . "
        WHERE
            node_id = " . $details['pid'] . "
        AND
        lang= '" . $GLOBALS['plugin']->getActiveLang() . "'
        ",__FILE__,__LINE__);

    $row = $result->FetchRow();
 $GLOBALS['plugin']->setValue("node_id", $newid);
    // Create detail row
    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('navigation_details') . "
        (
            node_id,
            lang,
            tpl_file,
            creation_user,
            creation_date,
            header,
            footer,
            css,
            show_in_overview,
            visible,
            live,
            public
        ) VALUES (
            " . XT::getValue('node_id') . ",
            '" . $GLOBALS['plugin']->getActiveLang() . "',
            '_pages/" . XT::getValue('node_id') . ".tpl',
            '" . $GLOBALS['auth']->getUserID() . "',
            '" . time() . "',
            '" . $row['header'] . "',
            '" . $row['footer'] . "',
            '" . $row['css'] . "',
            '" . $row['show_in_overview'] . "',
            '" . $row['visible'] . "',
            '" . $row['live'] . "',
            '" . $public . "'
        )
    ");
    
    
    // Delete Template file first!!
	@unlink(PAGES_DIR  ."_pages/". XT::getValue('node_id') . ".tpl");
	// Create template file for this node
	file_put_contents(PAGES_DIR  ."_pages/". XT::getValue('node_id') . ".tpl", file_get_contents($GLOBALS['tpl']->template_dir . 'includes/skeleton.tpl'));
	// Redirect to the new page
    header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $newid);
    
}
?>
