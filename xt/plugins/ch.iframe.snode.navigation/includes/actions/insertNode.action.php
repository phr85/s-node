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
            if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
                $newid = $tree->addChildNode(XT::getValue("node_id"));
                $GLOBALS['plugin']->setAdminModule(XT::getValue('target_module'));
            }
            if($GLOBALS['plugin']->getSessionValue("ctrl_cut")){
                $newid = $tree->moveNode($GLOBALS['plugin']->getSessionValue("source_node_id"),XT::getValue("node_id"),'last');
            }
            if($GLOBALS['plugin']->getSessionValue("ctrl_copy")){
                $newid = $tree->copyNode($GLOBALS['plugin']->getSessionValue("source_node_id"),XT::getValue("node_id"),'last');
            }
            break;
        case 'before':
            if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
                $newid = $tree->addNode(XT::getValue("node_id"),"before");
                $GLOBALS['plugin']->setAdminModule(XT::getValue('target_module'));
            }
            if($GLOBALS['plugin']->getSessionValue("ctrl_cut")){
                $newid = $tree->moveNode($GLOBALS['plugin']->getSessionValue("source_node_id"),XT::getValue("node_id"),'before');
            }
            if($GLOBALS['plugin']->getSessionValue("ctrl_copy")){
                $newid = $tree->copyNode($GLOBALS['plugin']->getSessionValue("source_node_id"),XT::getValue("node_id"),'before');
            }
            break;
        case 'after':
            if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
                $newid = $tree->addNode(XT::getValue("node_id"),"after");
                $GLOBALS['plugin']->setAdminModule(XT::getValue('target_module'));
            }
            if($GLOBALS['plugin']->getSessionValue("ctrl_cut")){
                $newid = $tree->moveNode($GLOBALS['plugin']->getSessionValue("source_node_id"),XT::getValue("node_id"),'after');
            }
            if($GLOBALS['plugin']->getSessionValue("ctrl_copy")){
                $newid = $tree->copyNode($GLOBALS['plugin']->getSessionValue("source_node_id"),XT::getValue("node_id"),'after');
            }
            break;
    }

    if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
        /*
        foreach($GLOBALS['cfg']->getLangs() as $key => $value){
        XT::query("
        INSERT INTO
        " . $GLOBALS['cfg']->get("database","prefix") . "node_perms
        (
        base_id,
        node_id,
        principal_id,
        principal_type,
        perms,
        lang
        ) VALUES (
        " . $GLOBALS['plugin']->getBaseID() . ",
        " . $newid . ",
        " . XT::getUserID() . ",
        1,
        1048575,
        '" . $key . "'
        )",__FILE__,__LINE__);
        }

        */



        $GLOBALS['plugin']->setValue("node_id", $newid);

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
    }

    if($GLOBALS['plugin']->getSessionValue("ctrl_copy")){

        foreach($newid as $value){

            // Get node details
            $result = XT::query("
                SELECT
                    *
                FROM
                    " . $GLOBALS['plugin']->getTable('navigation_details') . "
                WHERE
                    node_id = " . $value['original'] . "
                ",__FILE__,__LINE__);

            while($row = $result->FetchRow()){

                XT::query("
                    INSERT INTO
                        " . $GLOBALS['plugin']->getTable('navigation_details') . "
                    (
                        node_id,
                        lang,
                        title,
                        tpl_file,
                        description,
                        creation_user,
                        creation_date,
                        mod_user,
                        mod_date,
                        ext_link,
                        blank,
                        target,
                        active,
                        public,
                        keywords,
                        cache,
                        author,
						revisit_after,
                        copyright,
                        header,
                        footer,
                        halflife
                    ) VALUES (
                        " . $value['copy'] . ",
                        '" . $row['lang'] . "',
                        '" . addslashes($row['title'] ). "',
                        '_pages/" . $value['copy'] . ".tpl',
                        '" . addslashes($row['description']) . "',
                        " . XT::getUserID() . ",
                        " . time() . ",
                        " . XT::getUserID() . ",
                        " . time() . ",
                        '" . $row['ext_link'] . "',
                        '" . $row['blank'] . "',
                        '" . $row['target'] . "',
                        0,
                        '" . $row['public'] . "',
                        '" . addslashes($row['keywords']) . "',
                        '" . $row['cache'] . "',
                        '" . addslashes($row['author']) . "',
						'" . $row['revisit_after'] . "',
                        '" . addslashes($row['copyright']) . "',
                        '" . $row['header'] . "',
                        '" . $row['footer'] . "',
                        '" . $row['halflife'] . "'
                    )
                ",__FILE__,__LINE__,0);

                // copy TPL FILE  
                copy(PAGES_DIR . $row['tpl_file'], PAGES_DIR . "_pages/" . $value['copy'] . ".tpl");
                
                // duplicate content
                $contentresult = XT::query("SELECT * FROM " . XT::getTable('navigation_contents') . " WHERE node_id=" . $row['node_id'] . " AND lang='" . $row['lang'] . "'",__FILE__,__LINE__);
                while($contentrow = $contentresult->FetchRow()){
                    XT::query("
                    INSERT INTO
                        " . XT::getTable('navigation_contents') . "
                    (
                        node_id,
                        package,
                        module,
                        position,
                        params,
                        active,
                        main_value,
                        lang 
                     ) VALUES (
                      " . $value['copy'] . ",
                      '" . $contentrow['package'] . "',
                      '" . $contentrow['module'] . "',
                      '" . $contentrow['position'] . "',
                      '" . $contentrow['params'] . "',
                      '" . $contentrow['active'] . "',
                      '" . $contentrow['main_value'] . "',
                      '" . $contentrow['lang'] . "'
                     )",__FILE__,__LINE__);
                }
            }
			
			// Copy Properties
	        if (XT::getConfig('display_properties') == true) {
	        	// Set the content type
	        	XT::setValue("XT_PROP_content_type",XT::getContentType('Page'));
	        	// Set the original content_id
	        	XT::setValue('XT_PROP_content_id',$value['original']);
	        	// Set the new content_id
	        	XT::setValue('XT_PROP_target_content_id',$value['copy']);
	        	// call the copy proces
	        	XT::call('ch.iframe.snode.properties.copyPropertyValues');
	        }
        }
        
    }
}


$GLOBALS['plugin']->unsetSessionValue("ctrl_add");
$GLOBALS['plugin']->unsetSessionValue("ctrl_cut");
$GLOBALS['plugin']->unsetSessionValue("ctrl_copy");

?>
