<?php

if(XT::getValue('pagetemplate') > 0){
    $result = XT::query("
        SELECT * FROM
            " . XT::getTable('navigation_details') . "
        WHERE
            node_id = '" . XT::getValue('pagetemplate') . "'
    ",__FILE__,__LINE__);
    $row = $result->FetchRow();
    
    // Set based_on_tpl in navigation details
    XT::query("
        UPDATE
            " . XT::getTable('navigation_details') . "
        SET
            based_on_tpl = '" . XT::getValue('pagetemplate') . "',
            css = '" . $row['css'] . "',
            header = '" . $row['header'] . "',
            footer = '" . $row['footer'] . "',
            public = '" . $row['public'] . "',
            visible = '" . $row['visible'] . "',
            image = '" . $row['image'] . "'
        WHERE
            node_id = " . XT::getValue('id') . "
    ",__FILE__,__LINE__);
    
    // Get navigation contents from template
    $result = XT::query("
        SELECT
            node_id,
            package,
            module,
            position,
            params,
            active,
            main_value,
            lang
        FROM
            " . XT::getTable('navigation_contents') . "
        WHERE
            node_id = '" . XT::getValue('pagetemplate') . "'
    ",__FILE__,__LINE__);
    
    // Delete all existing entries for this page
    XT::query("
        DELETE FROM
            " . XT::getTable('navigation_contents') . "
        WHERE
            node_id = " . XT::getValue('id') . "
    ",__FILE__,__LINE__);
    
    // Insert these entries into new page
    while($row = $result->FetchRow()){
        
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
                " . XT::getValue('id') . ",
                '" . $row['package'] . "',
                '" . $row['module'] . "',
                '" . $row['position'] . "',
                '" . $row['params'] . "',
                '" . $row['active'] . "',
                '" . $row['main_value'] . "',
                '" . $row['lang'] . "'
            )
        ",__FILE__,__LINE__);
        
    }
    
    // Get tpl_file
    $result = XT::query("
        SELECT
            tpl_file
        FROM
            " . XT::getTable('navigation_details') . "
        WHERE
            node_id = '" . XT::getValue('pagetemplate') . "'
    ",__FILE__,__LINE__);
    
    $tpl_file = '';
    while($row = $result->FetchRow()){
        $tpl_file = $row['tpl_file'];
    }
    
    // Copy template file
    if(is_file(PAGES_DIR . $tpl_file)){
        $file = file_get_contents(PAGES_DIR . $tpl_file);
        file_put_contents(PAGES_DIR . XT::getValue('tpl_file'), $file);
    }

}

?>