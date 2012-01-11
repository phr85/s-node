<?php

if($GLOBALS['plugin']->getSessionValue('node_id') == '' || $GLOBALS['plugin']->getValue('node_id') != ''){
    $GLOBALS['plugin']->setSessionValue('node_id', $GLOBALS['plugin']->getValue('node_id'));
}

// if id was changed
if($GLOBALS['plugin']->getValue('new_id') != ''){
    $GLOBALS['plugin']->setSessionValue('node_id', $GLOBALS['plugin']->getValue('new_id'));
}

if(XT::getSessionValue('ctrl') == 1){
    XT::assign("CTRL", true);
}

if($GLOBALS['plugin']->getSessionValue('node_id') != ''){

    // execute query and check for errors
    $result = XT::query("SELECT
            node_id,
            title,
            pagetitle,
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
            copyright,
            halflife,
            article_id,
            article_layout,
            visible,
            image,
            image_version,
            show_in_overview,
            nav_image,
            nav_image_generated_enabled,
            nav_image_generated_params,
            nav_image_version,
            nav_image_active,
            nav_image_active_generated_enabled,
            nav_image_active_generated_params,
            nav_image_active_version,
            nav_image_rollover,
            nav_image_rollover_generated_enabled,
            nav_image_rollover_generated_params,
            nav_image_rollover_version,
            nav_image_active_rollover,
            nav_image_active_rollover_generated_enabled,
            nav_image_active_rollover_generated_params,
            nav_image_active_rollover_version,
            rewrite_name,
            header,
            footer,
            css,
            based_on_tpl
        FROM
            " . $GLOBALS['plugin']->getTable("navigation_details") . "
        WHERE
            node_id = " . $GLOBALS['plugin']->getSessionValue('node_id') . "
            AND lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
    ",__FILE__,__LINE__);

    // Initialize field arrays
    $fields_info = array();
    $node_id = 0;
	$resultcount = 0;
    while($row = $result->FetchRow()){

		$resultcount++;
        // Template file
        if($row['tpl_file'] == ''){
            $row['tpl_file'] = '_pages/' . $row['node_id'] . '.tpl';
        }

        // Half decay period
        if($row['halflife'] >= 3600){
            $row['halflife_mode'] = 3600;
        }
        if($row['halflife'] >= 86400){
            $row['halflife_mode'] = 86400;
        }
        if($row['halflife'] >= 2592000){
            $row['halflife_mode'] = 2592000;
        }
        if($row['halflife'] >= 31536000){
            $row['halflife_mode'] = 31536000;
        }
        $row['halflife'] = @floor($row['halflife'] / $row['halflife_mode']);

        $row['mod_user'] = XT::getUserName($row['mod_user']);
        $row['c_user'] = $row['creation_user'];
        $row['creation_user'] = XT::getUserName($row['creation_user']);

        $node_id = $row['node_id'];
        $nav_active = $row['active'];

        /*
        $GLOBALS['usr']->getUserString(
        */
        XT::assign("DATA", $row);
    }

    if($resultcount < 1){
        $row = array();

        $row['node_id'] = $GLOBALS['plugin']->getSessionValue('node_id');
        $row['tpl_file'] = '_pages/' . $row['node_id'] . '.tpl';

        if (is_array(XT::getValue("originalRow"))){
        	 $row = XT::getValue("originalRow");
        }

        XT::assign("DATA", $row);

        // Display the button to transfer the data from the original
        XT::addImageButton('Transfer default values', 'languageTransfer','default','copy.png','0',"slave1","");
        XT::assign("LANGUAGE_TRANSFER", 1);
    }

    $node_id = $GLOBALS['plugin']->getSessionValue('node_id');
    if (!$node_id) {
    	$node_id = 0;
    }

    /**
     * Get contents
     */

    $sql = "SELECT
                c.id,
                c.params,
                c.active,
                c.position,
                c.main_value,
                p.package,
                m.module,
                m.main_content_type,
                m.title,
                pd.title as package_title,
                pd.description
            FROM
                " . XT::getTable('navigation_contents') . " AS c,
                " . XT::getTable('plugins_packages') . " AS p
                LEFT JOIN
                (" . XT::getTable('plugins_packages_details') . " AS pd CROSS JOIN " . XT::getTable('plugins_modules') . " as m) ON (pd.id = p.id AND pd.lang = m.lang)
            WHERE
                p.id = c.package AND
                m.module = c.module AND
                m.package = c.package AND
                c.node_id = " . $node_id . " AND
                m.lang = '" . XT::getLang() . "' AND
                c.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
            ORDER BY
                c.position ASC
            ";

    $result = XT::query($sql, __FILE__, __LINE__);

    $ids = array();
    while ($row = $result->fetchRow()) {
        $row['package'] = substr($row['package'], strrpos($row['package'],'.') + 1);

        if($row['main_value'] != ''){

        	// Get titles
            $result_titles = XT::query("
                SELECT
                    title
                FROM
                    " . XT::getDatabasePrefix() . "search_infos_global_" . $GLOBALS['plugin']->getActiveLang() . "
                WHERE
                    content_type = '" . $row['main_content_type'] . "' AND
                    content_id IN (" . $row['main_value'] . ")
                ORDER BY
                    title ASC
            ",__FILE__,__LINE__);

            while ($row_title = $result_titles->FetchRow()) {
            	$row['titles'][] = $row_title['title'];
            }

        }
        $packages[] = $row;
    }

    XT::assign('PACKAGES', $packages);
    XT::assign("NAV_ACTIVE", $nav_active);
    XT::assign("NODE_ID", $node_id);
    XT::assign("META", $fields_meta);
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    //Images
    XT::assign("IMAGE_PICKER_TPL", $GLOBALS['plugin']->getConfig("image_picker_tpl"));
    XT::assign("IMAGE_PICKER_BASE_ID", $GLOBALS['plugin']->getConfig("image_picker_base_id"));

    // Get page templates
    $result = XT::query("
        SELECT
            b.node_id as id,
            b.title,
            b.image
        FROM
            " . XT::getTable('navigation_templates') . " as a LEFT JOIN
            " . XT::getTable('navigation_details') . " as b ON (b.node_id = a.tpl_id AND b.lang = '" . $GLOBALS['plugin']->getActiveLang() . "')
        ORDER BY
            b.title ASC
    ",__FILE__,__LINE__);

    $data = array();
    while($row = $result->FetchRow()){
        $data[] = $row;
    }

    if(XT::getSessionValue('ctrl') == 1){
        $GLOBALS['plugin']->contribute("contents_buttons", "Cancel", "cancelContent","delete.png","0","");
    } else {
        if(sizeof($packages) > 0){
            $GLOBALS['plugin']->contribute("contents_buttons", "Add", "addContentSimple","document_add.png","0","","n");
        } else {
            $GLOBALS['plugin']->contribute("contents_buttons", "Add", "insertContentSimple","document_add.png","0","","n");
        }
            // TODO $GLOBALS['plugin']->contribute("contents_buttons", "Add article", "addNewArticle","document_add.png","0","","a");
    }

    // Assign templates
    XT::assign("TEMPLATES", $data);

    // Buttons
    XT::addImageButton('Apply template','applyTemplate','layouts','disk_blue.png','0',"","a");
    XT::addImageButton('Save page as template','saveAsTemplate','layouts','document_new.png','0',"","l");
    XT::assign("LAYOUTS_BUTTONS",$GLOBALS['plugin']->getButtons('layouts'));

    $content = XT::build('editSimple.tpl');
} else {
    XT::log("No User ID set.",__FILE__,__LINE__,XT_ERROR);
}

?>
