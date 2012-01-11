<?php

if($GLOBALS['plugin']->getSessionValue('node_id') == '' || $GLOBALS['plugin']->getValue('node_id') != ''){
    $GLOBALS['plugin']->setSessionValue('node_id', $GLOBALS['plugin']->getValue('node_id'));
}

// if id was changed
if($GLOBALS['plugin']->getValue('new_id') != ''){
    $GLOBALS['plugin']->setSessionValue('node_id', $GLOBALS['plugin']->getValue('new_id'));
}

// Add button
//XT::addImageButton('[S]ave', 'savePage','default','disk_blue.png','0',"","s");


if($GLOBALS['plugin']->getSessionValue('node_id') != ''){
    // execute query and check for errors
    $result = XT::query("SELECT
            a.node_id,
            a.title,
            a.pagetitle,
            a.tpl_file,
            a.description,
            a.creation_user,
            a.creation_date,
            a.mod_user,
            a.mod_date,
            a.ext_link,
            a.blank,
            a.target,
            a.active,
            a.public,
            a.keywords,
            a.cache,
            a.author,
			a.revisit_after,
            a.copyright,
            a.halflife,
            a.article_id,
            a.article_layout,
            a.visible,
            a.image,
            a.image_version,
            a.show_in_overview,
            a.nav_image,
            a.nav_image_generated_enabled,
            a.nav_image_generated_params,
            a.nav_image_version,
            a.nav_image_active,
            a.nav_image_active_generated_enabled,
            a.nav_image_active_generated_params,
            a.nav_image_active_version,
            a.nav_image_rollover,
            a.nav_image_rollover_generated_enabled,
            a.nav_image_rollover_generated_params,
            a.nav_image_rollover_version,
            a.nav_image_active_rollover,
            a.nav_image_active_rollover_generated_enabled,
            a.nav_image_active_rollover_generated_params,
            a.nav_image_active_rollover_version,
            a.rewrite_name,
            a.header,
            a.footer,
            a.css,
            a.based_on_tpl,
            b.type as image_type,
            b.width,
            b.height
        FROM
            " . $GLOBALS['plugin']->getTable("navigation_details") . " as a LEFT JOIN
            " . XT::getTable('files') . " as b ON (b.id = a.image)
        WHERE
            a.node_id = " . $GLOBALS['plugin']->getSessionValue('node_id') . "
            AND a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
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
            $row['tpl_join'] = true;
        }
		if($row['tpl_file'] == '_pages/' . $row['node_id'] . '.tpl'){
			$row['tpl_join'] = true;
		}else {
			$row['tpl_join'] = false;
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


        XT::assign("DATA", $row);
    }

    if($resultcount < 1){
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
                p.package,
                m.module,
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
                m.lang = 'de' AND
                c.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
            ORDER BY
                c.position
            ASC";

    $result = XT::query($sql, __FILE__, __LINE__);

    while ($row = $result->fetchRow()) {
        $row['package'] = substr($row['package'], strrpos($row['package'],'.') + 1);
    	$packages[] = $row;
    }



    // get available header / footer templates
    foreach (glob(TEMPLATE_DIR . '/default/includes/header/*.tpl') as $usertpls){
       $USER_TPL['HEADERS'][trim(basename($usertpls))]= 'system';
    }

    foreach (glob(TEMPLATE_DIR . $_SESSION['theme'] . '/includes/header/*') as $usertpls){
        $USER_TPL['HEADERS'][trim(basename($usertpls))]= $_SESSION['theme'];
    }

    foreach (glob(TEMPLATE_DIR . '/default/includes/footer/*.tpl') as $usertpls){
       $USER_TPL['FOOTERS'][trim(basename($usertpls))]= 'system';
    }

    foreach (glob(TEMPLATE_DIR . $_SESSION['theme'] . '/includes/footer/*') as $usertpls){
        $USER_TPL['FOOTERS'][trim(basename($usertpls))]= $_SESSION['theme'];
    }

    XT::assign("USERTPL",$USER_TPL);


    XT::assign('PACKAGES', $packages);
    XT::assign("NAV_ACTIVE", $nav_active);
    XT::assign("NODE_ID", $node_id);
    XT::assign("META", $fields_meta);
    XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
    XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

    //Images
    XT::assign("IMAGE_PICKER_TPL", $GLOBALS['plugin']->getConfig("image_picker_tpl"));
    XT::assign("IMAGE_PICKER_BASE_ID", $GLOBALS['plugin']->getConfig("image_picker_base_id"));

    $content = XT::build('edit.tpl');
} else {
    XT::log("No User ID set.",__FILE__,__LINE__,XT_ERROR);
}

?>
