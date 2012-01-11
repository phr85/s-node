<?php

if(XT::getParam("name") != ''){
    $result = XT::query("SELECT id FROM " . XT::getTable('forms') . " WHERE identifier='" . XT::getParam("name") . "'",__FILE__,__LINE__);
    $row = $result->FetchRow();
    XT::setValue('form_id', $row['id']);
    $form_id = $row['id'];
}else {
    // Get form id
    $form_id = is_numeric($GLOBALS['plugin']->getParam("form_id")) ? $GLOBALS['plugin']->getParam("form_id") : XT::getValue("form_id");
}


if(is_numeric($form_id)){


    if(!isset($_SESSION['forms'])){
        $_SESSION['forms'] = array();
    }

    // Get fillout id
    $result = XT::query("
        SELECT max(id) as id FROM " . $GLOBALS['plugin']->getTable("forms_fillouts") . " WHERE session_id = '" . session_id() . "' AND form_id = " . $form_id,__FILE__,__LINE__);

    $data = XT::getQueryData($result);
    $fillout_id = $data[0]['id'];
    $_SESSION['forms'][$form_id];

    // nur ausführen wenn noch nicht ausgeführt wurde oder letztes form complett ausgefüllt wurde
    if(!$fillout_id > 0 || $_SESSION['forms'][$form_id]=='completed'){
        // Init fillout
        XT::query("
            INSERT INTO
                " . $GLOBALS['plugin']->getTable("forms_fillouts") . "
            (
                form_id,
                session_id,
                start_date,
                submission_date,
                referer
            ) VALUES (
                " . $form_id . ",
                '" . session_id() . "',
                " . time() . ",
                0,
                '" . $_SERVER['HTTP_REFERER'] . "'
            )",__FILE__,__LINE__);

        // Get fillout id erneut setzen
        $result = XT::query("
        SELECT max(id) as id FROM " . $GLOBALS['plugin']->getTable("forms_fillouts") . " WHERE session_id = '" . session_id() . "' AND form_id = " . $form_id ,__FILE__,__LINE__);
        $data = XT::getQueryData($result);
        $fillout_id = $data[0]['id'];
        $_SESSION['forms'][$form_id] = 'started';
    }

    include('preactions.php');


    if(XT::getValue("formfields") != ''){
        include('perform.php');
    }


    // Get form details
    $result = XT::query("
        SELECT
            *
        FROM
            " . $GLOBALS['plugin']->getTable("forms") . "
        WHERE
            id = " . $form_id . "
        AND
            active = 1
        LIMIT 1
        ",__FILE__,__LINE__);

    $data = array();
    while($row = $result->FetchRow()){
        $layout = $row['layout'];
        $data[] = $row;
    }

    XT::assign("FORM", $data[0]);

    // Sonderzeichen in Post in html umwandeln wenn der typ text ist
    $temppost = $_POST['x' . $GLOBALS['plugin']->getBaseID() . '_formfields'];


    if($data[0]['id'] > 0){

        // Get fields
        $result = XT::query("
            SELECT
                *
            FROM
                " . $GLOBALS['plugin']->getTable("forms_elements") . "
            WHERE
                form_id = " . $form_id . "
            ORDER BY
                pos ASC
        ",__FILE__,__LINE__);

        $data = array();
        while($row = $result->FetchRow()){
            if(strchr($row['default_value'],':') != ''){
                $res = split(':',$row['default_value']);
                switch (strtolower($res[0])) {
                    case 'session':
                        $parts = explode(".",$res[1]);
                        $val = $_SESSION[$parts[0]];
                        array_shift($parts);
                        foreach ($parts as $value) {
                            $val=$val[$value];
                        }
                        $row['default_value'] = $val;
                        break;
                    case 'request':
                        $row['default_value'] = $_REQUEST[$res[1]];
                        break;
                    case 'get':
                        $row['default_value'] = $_GET[$res[1]];
                        break;
                    case 'post':
                        $row['default_value'] = $_POST[$res[1]];
                        break;

                    default:
                        break;
                }
            }

            if(is_file($GLOBALS['plugin']->location . 'datasource_types/' . $row['datasource_type'] . '.datasource_type.php')){
                include($GLOBALS['plugin']->location . 'datasource_types/' . $row['datasource_type'] . '.datasource_type.php');
            }
            $labels[$row['element_id']] = $row['label'];
            $data[] = $row;


            // Sonderzeichen in Post in html umwandeln wenn der typ text ist
            if($row[element_type]==1){
                $temppost[$row[element_id]] = htmlentities(stripcslashes($temppost[$row[element_id]]),ENT_COMPAT,'UTF-8');
            }




        }

        XT::assign("ADMIN_TPL", $GLOBALS['plugin']->getConfig('admin_tpl'));
        XT::assign("ERRORS", $rule_errors);



        // überarbeitete posts assignen
        XT::assign("POSTS", $temppost);
        //XT::assign("POSTS", $_POST['x' . $GLOBALS['plugin']->getBaseID() . '_formfields']);


        foreach ($data as $key => $value){
            $values[$value['scripting_identifier']] = $value['default_value'] != '' ? $value['default_value'] : $_POST['x' . $GLOBALS['plugin']->getBaseID() . '_formfields'][$value['element_id']];
        }

        XT::assign("LABELS", $labels);
        XT::assign("VALUES", $values);
        XT::assign("ELEMENTS", $data);

        if($layout != ''){
            $content = XT::build($layout);
        } else {
            $content = XT::build('default.tpl');
        }
    }
}

?>