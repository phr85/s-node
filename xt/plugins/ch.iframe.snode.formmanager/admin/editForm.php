<?php

if($GLOBALS['plugin']->getValue("form_id") != ''){
    $GLOBALS['plugin']->setSessionValue("form_id", $GLOBALS['plugin']->getValue("form_id"));
}

if(is_numeric($GLOBALS['plugin']->getSessionValue("form_id"))){

    $result = XT::query("
        SELECT
            *
        FROM
            " . $GLOBALS['plugin']->getTable("forms") .  "
        WHERE
            lang = 'de' AND
            id = " . $GLOBALS['plugin']->getSessionValue("form_id") . "
        ORDER BY
            title ASC
        ",__FILE__,__LINE__);

    $data = XT::getQueryData($result);
    XT::assign("DATA", $data[0]);

    $field_types = &$GLOBALS['plugin']->getConfig('field_types');

    $result = XT::query("
        SELECT
            *
        FROM
            " . $GLOBALS['plugin']->getTable("forms_elements") .  "
        WHERE
            lang = 'de' AND
            form_id = " . $GLOBALS['plugin']->getSessionValue("form_id") . "
        ORDER BY
            pos ASC
        ",__FILE__,__LINE__);

    $data = array();
    $groupCounter = 0;
    while($row = $result->FetchRow()){
        $row['element_type_id'] = $row['element_type'];
        $row['element_type'] = $field_types[$row['element_type']];
        $lastPos = $row['pos'];
        if ($row['element_type_id'] == 6){
        	if ($groupCounter <= 0){
        		$groupCounter = $row['size'];
        	}
        }else{
        	$groupCounter--;
        }
    }
    if ($groupCounter > 0){
    	for ($i = 1; $i <= $groupCounter; $i++) {
    		XT::setValue("position","after");
    		XT::setValue("insert_position",$lastPos);
    		$GLOBALS['plugin']->call("insertElement");

    		XT::query("
            UPDATE " . $GLOBALS['plugin']->getTable("forms_elements") . "
            SET element_type = 1, label='" . XT::translate("Auto added field") . " " . ($lastPos + 1 ) ."'
            WHERE form_id = " . $GLOBALS['plugin']->getSessionValue("form_id") . " AND pos = " . ($lastPos + 1 ). "",__FILE__,__LINE__);
    		$lastPos++;
		}
    }
    $result = XT::query("
        SELECT
            *
        FROM
            " . $GLOBALS['plugin']->getTable("forms_elements") .  "
        WHERE
            lang = 'de' AND
            form_id = " . $GLOBALS['plugin']->getSessionValue("form_id") . "
        ORDER BY
            pos ASC
        ",__FILE__,__LINE__);

    while($row = $result->FetchRow()){
        $row['element_type_id'] = $row['element_type'];
        $row['element_type'] = $field_types[$row['element_type']];
        $data[] = $row;
    }
    XT::assign("ELEMENTS", $data);

    if($GLOBALS['plugin']->getSessionValue("ctrl_add") != ''){
        $GLOBALS['plugin']->contribute("edit_form_elements_buttons", "Cancel", "cancel","cancel.png","0","","c");
    } else {
        if(sizeof($data) > 0){
            $GLOBALS['plugin']->contribute("edit_form_elements_buttons", "Add element", "addElement","add.png","0","","e");
        } else {
            $GLOBALS['plugin']->contribute("edit_form_elements_buttons", "Add element", "addFirstElement","add.png","0","","e");
        }
    }

    if($GLOBALS['plugin']->getSessionValue("ctrl_add")){
        XT::assign("CTRL", 1);
    }

    // Get after actions
    $result = XT::query("
        SELECT
            *
        FROM
            " . $GLOBALS['plugin']->getTable("forms_actions") .  "
        WHERE
            lang = 'de' AND
            form_id = " . $GLOBALS['plugin']->getSessionValue("form_id") . "
        ORDER BY
            pos ASC
        ",__FILE__,__LINE__);

    $types = &$GLOBALS['plugin']->getConfig('action_types');

    $data = array();
    while($row = $result->FetchRow()){
        $row['label'] = $types[$row['type']];

        switch($row['type']){

            case 7:
                // Get script title
                $result_a = XT::query("SELECT node_id,title FROM " . $GLOBALS['plugin']->getTable("navigation_details") .  " WHERE node_id ='" . $row['value'] . "'",__FILE__,__LINE__);
                $pages = XT::getQueryData($result_a);
                $row['value'] = $pages[0]['title'] . " (" . $pages[0]['node_id'] . ")";
                break;

            case 3:
                // Get script title
                if ($row['value'] != "") {
                	$result_a = XT::query("SELECT id,title FROM " . $GLOBALS['plugin']->getTable("forms_scripts") .  " WHERE id = '" . $row['value']  . "'",__FILE__,__LINE__);
                    $scripts = XT::getQueryData($result_a);
                    $row['value'] = $scripts[0]['title'] . " (" . $scripts[0]['id'] . ".php)";
                }
                break;

            case 4:
                // Get form title
                $result_a = XT::query("SELECT title FROM " . $GLOBALS['plugin']->getTable("forms") .  " WHERE id = '" . $row['value'] . "'",__FILE__,__LINE__);
                $forms = XT::getQueryData($result_a);
                $row['value'] = $forms[0]['title'];
                break;

            case 5:
                // Get username
                $row['value'] = XT::getUsername($row['value']);
                break;

            case 6:
                // Get workflow title
                $result_a = XT::query("SELECT title FROM " . $GLOBALS['plugin']->getTable("workflows") .  " WHERE id = '" . $row['value'] . "'",__FILE__,__LINE__);
                $workflows = XT::getQueryData($result_a);
                $row['value'] = $workflows[0]['title'];
                break;
        }

        $data[] = $row;
    }

    if($GLOBALS['plugin']->getSessionValue("ctrl_add_action") != ''){
        $GLOBALS['plugin']->contribute("edit_form_actions_buttons", "Cancel", "cancel","delete.png","0","","c");
    } else {
        if(sizeof($data) > 0){
            $GLOBALS['plugin']->contribute("edit_form_actions_buttons", "Add action", "addAction","gear_add.png","0","","a");
        } else {
            $GLOBALS['plugin']->contribute("edit_form_actions_buttons", "Add action", "addFirstAction","gear_add.png","0","","a");
        }
    }

    if($GLOBALS['plugin']->getSessionValue("ctrl_add_action")){
        XT::assign("CTRL_ACTION", 1);
    }

    XT::assign("ACTIONS", $data);


    // Get PreActions
    $result = XT::query("
        SELECT
            *
        FROM
            " . $GLOBALS['plugin']->getTable("forms_preactions") .  "
        WHERE
            lang = 'de' AND
            form_id = " . $GLOBALS['plugin']->getSessionValue("form_id") . "
        ORDER BY
            pos ASC
        ",__FILE__,__LINE__);

    $types = &$GLOBALS['plugin']->getConfig('action_types');

    $data = array();
    while($row = $result->FetchRow()){
        $row['label'] = $types[$row['type']];

        switch($row['type']){

            case 7:
                // Get script title
                $result_a = XT::query("SELECT node_id,title FROM " . $GLOBALS['plugin']->getTable("navigation_details") .  " WHERE node_id ='" . $row['value'] . "'",__FILE__,__LINE__);
                $pages = XT::getQueryData($result_a);
                $row['value'] = $pages[0]['title'] . " (" . $pages[0]['node_id'] . ")";
                break;

            case 3:
                // Get script title
                if ($row['value'] != "") {
                	$result_a = XT::query("SELECT id,title FROM " . $GLOBALS['plugin']->getTable("forms_scripts") .  " WHERE id = " . $row['value'],__FILE__,__LINE__);
                    $scripts = XT::getQueryData($result_a);
                    $row['value'] = $scripts[0]['title'] . " (" . $scripts[0]['id'] . ".php)";
                }
                break;

            case 4:
                // Get form title
                $result_a = XT::query("SELECT title FROM " . $GLOBALS['plugin']->getTable("forms") .  " WHERE id = " . $row['value'],__FILE__,__LINE__);
                $forms = XT::getQueryData($result_a);
                $row['value'] = $forms[0]['title'];
                break;

            case 5:
                // Get username
                $row['value'] = XT::getUsername($row['value']);
                break;

            case 6:
                // Get workflow title
                $result_a = XT::query("SELECT title FROM " . $GLOBALS['plugin']->getTable("workflows") .  " WHERE id = " . $row['value'],__FILE__,__LINE__);
                $workflows = XT::getQueryData($result_a);
                $row['value'] = $workflows[0]['title'];
                break;
        }

        $data[] = $row;
    }

    if($GLOBALS['plugin']->getSessionValue("ctrl_add_preaction") != ''){
        $GLOBALS['plugin']->contribute("edit_form_preactions_buttons", "Cancel", "cancel","delete.png","0","","c");
    } else {
        if(sizeof($data) > 0){
            $GLOBALS['plugin']->contribute("edit_form_preactions_buttons", "Add action", "addPreAction","gear_add.png","0","","r");
        } else {
            $GLOBALS['plugin']->contribute("edit_form_preactions_buttons", "Add action", "addFirstPreAction","gear_add.png","0","","r");
        }
    }

    if($GLOBALS['plugin']->getSessionValue("ctrl_add_preaction")){
        XT::assign("CTRL_PREACTION", 1);
    }

    XT::assign("PREACTIONS", $data);


    $content = XT::build("editForm.tpl");

}

?>
