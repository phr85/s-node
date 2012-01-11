<?php

if($GLOBALS['plugin']->getValue("action_id") != ''){
    $GLOBALS['plugin']->setSessionValue("action_id", $GLOBALS['plugin']->getValue("action_id"));
}

$result = XT::query("
    SELECT
        *
    FROM
        " . $GLOBALS['plugin']->getTable("forms_actions") .  "
    WHERE
        id = " . $GLOBALS['plugin']->getSessionValue("action_id") . "
    ",__FILE__,__LINE__);

$data = XT::getQueryData($result);

switch($data[0]['type']){

    case 7:

        // Get pages
        $result = XT::query("
        SELECT
            node_id,
            title
        FROM
            " . $GLOBALS['plugin']->getTable("navigation_details") .  "
        WHERE
            lang = 'de'
        ORDER BY
            title ASC
        ",__FILE__,__LINE__);

        $pages = XT::getQueryData($result);

        XT::assign("PAGES",$pages);
        break;

    case 3:

        // Get script info
        $result = XT::query("
        SELECT
            id,
            title
        FROM
            " . $GLOBALS['plugin']->getTable("forms_scripts") .  "
        ORDER BY
            title ASC
        ",__FILE__,__LINE__);

        $scripts = XT::getQueryData($result);
        $script_id = $data[0]['value'];
        if ($script_id == 0 OR $script_id  == ""){
        	$script_id = $scripts[0]['id'];
        }
        if (XT::getValue("value") != "") {
        	$script_id = XT::getValue("value");
        }

        if (is_numeric($script_id)) {

        	XT::assign("SCRIPT_CONTENT", highlight_file(DATA_DIR . 'scripts/ch.iframe.snode.formmanager/' . $script_id . '.php',true));
        }

        XT::assign("SCRIPTS", $scripts);
        break;

    case 4:

        // Get forms
        $result = XT::query("
        SELECT
            id,
            title
        FROM
            " . $GLOBALS['plugin']->getTable("forms") .  "
        ORDER BY
            title ASC
        ",__FILE__,__LINE__);

        $forms = XT::getQueryData($result);
        XT::assign("FORMS", $forms);
        break;

    case 5:

        // Get users
        $result = XT::query("
        SELECT
            id,
            username
        FROM
            " . $GLOBALS['plugin']->getTable("user") .  "
        ORDER BY
            username ASC
        ",__FILE__,__LINE__);

        $users = XT::getQueryData($result);
        XT::assign("USERS", $users);
        break;

    case 6:

        // Get workflows
        $result = XT::query("
        SELECT
            id,
            title
        FROM
            " . $GLOBALS['plugin']->getTable("workflows") .  "
        WHERE
            id = workflow_id
        ORDER BY
            title ASC
        ",__FILE__,__LINE__);

        $workflows = XT::getQueryData($result);
        XT::assign("WORKFLOWS", $workflows);
        break;
}
XT::assign("DATA", $data[0]);

$content = XT::build("editAction.tpl");

?>
