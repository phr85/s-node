<?php

// Get all field inputs

$inputs = $GLOBALS['plugin']->getValue("formfields");

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

$toattachfiles = array();

while($row = $result->FetchRow()){
    $fields[$row['scripting_identifier']] = $inputs[$row['element_id']];

    // fileupload
    if($row['element_type']==13 && $row['scripting_identifier']!=''){

        if(XT::getSessionValue($row['scripting_identifier'])){
            $uploadedfile[$row['scripting_identifier']]=true;
        }


        if(isset($_FILES['x220_file_' . $row['element_id']]) && $_FILES['x220_file_' . $row['element_id']]['name'] != ''){
            if(!XT::getSessionValue($row['scripting_identifier'])){
                if(move_uploaded_file($_FILES['x220_file_' . $row['element_id']]['tmp_name'], ROOT_DIR . 'tmp/' . basename($_FILES['x220_file_' . $row['element_id']]['tmp_name']))){
                    $_FILES['x220_file_' . $row['element_id']]['tmp_name'] = ROOT_DIR . 'tmp/' . basename($_FILES['x220_file_' . $row['element_id']]['tmp_name']);
                    XT::setSessionValue($row['scripting_identifier'],$_FILES['x220_file_' . $row['element_id']]);
                    $uploadedfile[$row['scripting_identifier']]=true;

                }
            }
        }

        // Array with all fileuploads
        $toattachfiles[] = $row['scripting_identifier'];
    }
}

XT::assign(UPLOADEDFILE,$uploadedfile);

// Get rules
$script_rules_result = XT::query("
    SELECT
        rules.*
    FROM
        " . $GLOBALS['plugin']->getTable("forms_elements_rules") . " as rules
    INNER JOIN
        " . $GLOBALS['plugin']->getTable("forms_elements") . " as elements on (elements.element_id = rules.element_id )
    WHERE
        rules.form_id = " . $GLOBALS['plugin']->getValue("form_id") . "
    ORDER BY
        elements.pos ASC
",__FILE__,__LINE__);

$rule_errors = array();
$data = array();

while($row = $script_rules_result->FetchRow()){

    $error = '';

    // Check this rule
    switch($row['compare_type']){

        // Simple compare
        case 1:

            switch($row['compare_query']){

                case "==":
                    if(!($inputs[$row['element_id']] == $row['value'])){
                        $error = true;
                    }
                    break;

                case "<=":
                    if(!($inputs[$row['element_id']] <= $row['value'])){
                        $error = true;
                    }
                    break;

                case ">=":
                    if(!($inputs[$row['element_id']] >= $row['value'])){
                        $error = true;
                    }
                    break;

                case "!=":
                    if(!($inputs[$row['element_id']] != $row['value'])){
                        $error = true;
                    }
                    break;

                case "&&":
                    if(!($inputs[$row['element_id']] && $row['value'])){
                        $error = true;
                    }
                    break;

                case "||":
                    if(!($inputs[$row['element_id']] || $row['value'])){
                        $error = true;
                    }
                    break;

                case ">":
                    if(!($inputs[$row['element_id']] > $row['value'])){
                        $error = true;
                    }
                    break;

                case "<":
                    if(!($inputs[$row['element_id']] < $row['value'])){
                        $error = true;
                    }
                    break;
            }
            break;

            // Regular expression (Perl Regexp)
        case 2:
            if(!preg_match($row['compare_query'],$inputs[$row['element_id']])){
                $error = true;
            }
            break;

            // Regular expression (POSIX Regexp)
        case 3:
            if(!ereg($row['compare_query'], $inputs[$row['element_id']])){
                $error = true;
            }
            break;
            // Call Rule script
        case 4:
            if($row['value'] != ""){
                include(DATA_DIR . 'scripts/ch.iframe.snode.formmanager/' . $row['value'] . '.php');
                if($error != ''){
                    $row['error_msg'] = $error;
                }
            }
            break;
    }

    if($error != ''){
        $rule_errors[$row['element_id']][] = $row['error_msg'];
    }

    $data[] = $row;
}



// empty old  entries
XT::query("DELETE FROM " . $GLOBALS['plugin']->getTable("forms_data") . " WHERE
    fillout_id = " . $fillout_id . "",__FILE__,__LINE__);

// Fill form data
if(is_array($inputs)){
    foreach($inputs as $key => $value){

        if(is_array($value)){

            foreach($value as $value_value){

                XT::query("
                    INSERT INTO " . $GLOBALS['plugin']->getTable("forms_data") . "
                    (
                        fillout_id,
                        element_id,
                        element_value
                    ) VALUES (
                        " . $fillout_id . ",
                        " . $key . ",
                        '"  . $value_value . "'
                    )",__FILE__,__LINE__);

            }

        } else {

            XT::query("
                    INSERT INTO " . $GLOBALS['plugin']->getTable("forms_data") . "
                    (
                        fillout_id,
                        element_id,
                        element_value
                    ) VALUES (
                        " . $fillout_id . ",
                        " . $key . ",
                        '"  . $value . "'
                    )",__FILE__,__LINE__);

        }
    }
}





if($rule_errors == array()){
    XT::query("
        UPDATE
            " . $GLOBALS['plugin']->getTable("forms_fillouts") . "
        SET
            submission_date = " . TIME . "
        WHERE
            id = " . $fillout_id,__FILE__,__LINE__);


    // formular für weiteres ausfüllen reseten
    $_SESSION['forms'][$form_id] = 'completed';

    // Perform after actions
    $perform_script_result = XT::query("
        SELECT
            *
        FROM
            " . $GLOBALS['plugin']->getTable("forms_actions") . "
        WHERE
            form_id = " . $GLOBALS['plugin']->getValue("form_id") . "
        ORDER BY
            pos ASC
        ",__FILE__,__LINE__);

    $data = array();

    while($row = $perform_script_result->FetchRow()){
        switch($row['type']){

            // Redirect (External)
            case 1:
                header("Location: " . $row['value']);
                die();
                break;

                // Redirect (Internal)
            case 7:
                header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $row['value'] . "");
                die();
                break;

                // Mail
            case 2:

                // Get form details
                $data_form = array();
                $result_form = XT::query("SELECT * FROM " . $GLOBALS['plugin']->getTable("forms") . " WHERE id = '" . $GLOBALS['plugin']->getValue("form_id") . "'",__FILE__,__LINE__);
                while($row_form = $result_form->FetchRow()){
                    $data_form[] = $row_form;
                }

                $form = $data_form[0];

                // Get field details
                $data_field = array();



                $result_field = XT::query("SELECT element_id, element_type, label FROM " . $GLOBALS['plugin']->getTable("forms_elements") . " WHERE form_id = '" . $GLOBALS['plugin']->getValue("form_id") . "' ORDER BY pos ASC",__FILE__,__LINE__);
                while($row_field = $result_field->FetchRow()){
                    $data_field[$row_field['element_id']] = $row_field;
                    $data_field[$row_field['element_id']]['label'] = str_pad($row_field['label'],25);
                }

                // Inputs
                $field_inputs = array();
                foreach($inputs as $key => $value){
                    $field_inputs[$key] = array('title' => str_pad($data_field[$key]['label'],25));
                    $fields[$row['scripting_identifier']] = $inputs[$row['element_id']];
                }

                XT::assign("FORMTITLE", $form['title']);
                XT::assign("IDENTIFIER", $fields);
                XT::assign("INPUT_FIELDS", $field_inputs);
                XT::assign("INPUT_VALUES", $inputs);
                XT::assign("ALL_FIELDS", $data_field);

                // Set receiver
                $receiver = $GLOBALS['cfg']->get("system","email");

                if(XT::checkEmail(trim($row['value']))) {
                    $receiver = trim($row['value']);
                }
                elseif($row['value'] != "") {
                    $res = explode(':', $row['value']);
                    if($res[1]) {
                        switch (strtolower($res[0])) {
                            case 'session':
                                if(XT::checkEmail(trim($_SESSION[$res[1]]))) {
                                    $receiver = trim($_SESSION[$res[1]]);
                                }
                                break;
                            case 'request':
                                if(XT::checkEmail(trim($_REQUEST[$res[1]]))) {
                                    $receiver = trim($_REQUEST[$res[1]]);
                                }
                                break;
                            case 'get':
                                if(XT::checkEmail(trim($_GET[$res[1]]))) {
                                    $receiver = trim($_GET[$res[1]]);
                                }
                                break;
                            case 'post':
                                if(XT::checkEmail(trim($_POST[$res[1]]))) {
                                    $receiver = trim($_POST[$res[1]]);
                                }
                                break;
                            case 'field':
                                if(XT::checkEmail(trim($fields[$res[1]]))) {
                                    $receiver = trim($fields[$res[1]]);
                                }
                                break;
                            default:
                                break;
                        }
                    }
                }

                require_once(CLASS_DIR . "/phpmailer/class.phpmailer.php");
                // Create and send mail
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->IsHTML(true);
                $mail->Encoding = '7bit';
                $mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
                if(XT::checkEmail(trim($fields['email_from']))){
                    $mail->FromName = trim($fields['email_from']);
                    $mail->From = trim($fields['email_from']);
                }else{
                    $mail->FromName = $GLOBALS['cfg']->get("system","email");
                    $mail->From = $GLOBALS['cfg']->get("system","email");
                }

                if(XT::checkEmail(trim($fields['email']))) {
                    $mail->AddReplyTo($fields['email']);
                }

                $mail->Host = $GLOBALS['cfg']->get('smtp','Host');

                $mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
                if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
                    $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
                    $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
                }

                //Attached Files
                foreach($toattachfiles as $toattachfile) {
                    $filedetail = XT::getSessionValue($toattachfile);
                    if($filedetail['error']==0 && $filedetail['size']>0 && is_file($filedetail['tmp_name'])){
                        $mail->AddAttachment($filedetail['tmp_name'],$filedetail['name']);

                    }
                }

                $mail->AddAddress($receiver);

                if(XT::checkEmail(trim($fields['email'])) && $fields['email_copy'][1]==1){
                    $mail->AddCC(trim($fields['email']));
                }

                if(XT::checkEmail(trim($fields['email'])) && $fields['email_copy']==true){
                    $mail->AddCC(trim($fields['email']));
                }

                if(XT::checkEmail(trim($fields['email'])) && $fields['email_bcc'][1]==1){
                    $mail->AddBCC(trim($fields['email']));
                }

                if(XT::checkEmail(trim($fields['email'])) && $fields['email_bcc']==true){
                    $mail->AddBCC(trim($fields['email']));
                }

                if(XT::checkEmail(trim($fields['email'])) && $fields['email_cc']!=""){
                    $mail->AddCC(trim($fields['email_cc']));
                }

                if(XT::checkEmail(trim($fields['email'])) && $fields['subject']!=""){
                    $mail->Subject  =  trim($fields['subject']);

                }else {
                    $mail->Subject  = $GLOBALS['cfg']->get("system","name") . ' - ' . $form['title'] . ' (#' . $fillout_id . ')';
                }

                XT::assign("SUBJECT",$mail->Subject);

                // in metadata werden bei action typ 2 das template gespeichert
                if($row['metadata'] != ''){
                    $mail->Body  = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'mail/' . $row['metadata']);
                } else {
                    $mail->Body  = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'mail/default.tpl');
                }
                $mail->AltBody = $GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'mail/plaintext.tpl');

                if(!$mail->Send()){
                    XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
                }

                // Delete Files
                foreach($toattachfiles as $toattachfile) {
                    $filedetail = XT::getSessionValue($toattachfile);
                    unlink($filedetail['tmp_name']);
                    XT::unsetSessionValue($toattachfile);
                }

                break;

                // Call Script
            case 3:
                include(DATA_DIR . 'scripts/ch.iframe.snode.formmanager/' . $row['value'] . '.php');
                break;

                // Call another form
            case 4:
                header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['plugin']->getConfig("viewer_tpl") . "&x" . $GLOBALS['plugin']->getBaseID() . "_form_id=" . $row['value']);
                die();
                break;

                // Send internal message
            case 5:
                require_once(CLASS_DIR . "message.class.php");
                $message = new XT_Message();
                $message->addReceiver($row['value']);
                $message->send($GLOBALS['lang']->msg("New form fillout #" . $fillout_id . " received"),"Testmessage");
                break;

                // Start workflow
            case 6:
                require_once(CLASS_DIR . "workflow.class.php");
                $workflow = new XT_Workflow();
                $instance_id = $workflow->create($GLOBALS['lang']->msg("Form fillout") . " #" . $fillout_id,$row['value']);
                $workflow->start($instance_id);
                break;
        }

    }
}

?>