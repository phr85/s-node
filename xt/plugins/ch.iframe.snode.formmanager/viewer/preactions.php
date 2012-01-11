<?php


// Perform preactions
$perform_script_result = XT::query("
        SELECT
            *
        FROM
            " . $GLOBALS['plugin']->getTable("forms_preactions") . "
        WHERE
            form_id = " . $form_id . " AND
            lang = 'de'
        ORDER BY
            pos ASC
        ",__FILE__,__LINE__);

$data = array();

while($row = $perform_script_result->FetchRow()){

    switch($row['type']){
        // Mail
        case 2:


            // Set receiver
            $receiver = $row['value'] != '' ? $row['value'] : $GLOBALS['cfg']->get("system","email");

            // Create and send mail
            require_once(CLASS_DIR . 'mail.class.php');
            $mail = new XT_Mail($GLOBALS['cfg']->get("system","email"),$GLOBALS['cfg']->get("system","name"),$GLOBALS['cfg']->get("system","email") );
            $mail->addReceiver($receiver);
            $mail->setSubject($GLOBALS['cfg']->get("system","name") . ' - ' . $form['title'] . ' (#' . $fillout_id . ')');
            $mail->setHTML(true);

                $mail->setBody('SERVER:' . $_SERVER['HTTP_HOST'] . '  URL:' . $_SERVER['REQUEST_URI'] . '
                FROM:' . $_SERVER['REMOTE_ADDR'] . ' @ ' . date("d.m.y H:i:s"));

            $mail->send();

            break;

            // Call Script
        case 3:
            include(DATA_DIR . 'scripts/ch.iframe.snode.formmanager/' . $row['value'] . '.php');
            break;


    }
}
?>