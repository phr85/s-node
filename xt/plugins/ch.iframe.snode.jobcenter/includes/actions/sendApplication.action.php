<?php

// Bewerbungs ID
$application_id = XT::getValue("id");

// E-Mail
$data['mail'] = array();

// Die Informationen fuer das E-Mail zusammenstellen
$result = XT::query("
    SELECT
        application.*,
        jobdetail.title as job_title,
        jobdetail.subtitle as job_subtitle,
        jobdetail.introduction as job_introduction,
        jobdetail.maintext as job_maintext,
        job.job_id as job_job_id,
        job.job_percentage_from as job_percentage_from,
        job.job_percentage_to as job_percentage_to,
        job.application_template as application_template,
        contact_address.title as contact_title,
        contact_address.firstName as contact_first_name,
        contact_address.lastName as contact_last_name,
        contact_address.street as contact_street,
        contact_address.postalCode as contact_postal_code,
        contact_address.city as contact_city,
        contact_country.name as contact_country,
        contact_address.tel as contact_tel,
        contact_address.fax as contact_fax,
        contact_address.email as contact_email,
        location_address.title as location_title,
        location_address.firstName as location_first_name,
        location_address.lastName as location_last_name,
        location_address.street as location_street,
        location_address.postalCode as location_postal_code,
        location_address.city as location_city,
        location_country.name as location_country,
        location_address.tel as location_tel,
        location_address.fax as location_fax,
        location_address.email as location_email
    FROM
        " . XT::getTable("jobs_applications") . " as application
    INNER JOIN
        " . XT::getTable("jobs") . " as job on (application.job_id = job.id)
    LEFT JOIN
        " . XT::getTable("jobs_detail") . " as jobdetail on (application.job_id = jobdetail.id AND jobdetail.lang = '" . XT::getLang() ."')
    LEFT JOIN
        " . XT::getTable("addresses") . " as contact_address on (job.contact_id = contact_address.id)
    LEFT JOIN
        " . XT::getTable("countries_detail") . " as contact_country on (contact_address.country = contact_country.country AND contact_country.lang = '" . XT::getLang() ."')
    LEFT JOIN
        " . XT::getTable("addresses") . " as location_address on (job.location_id = location_address.id)
    LEFT JOIN
        " . XT::getTable("countries_detail") . " as location_country on (location_address.country = location_country.country AND location_country.lang = '" . XT::getLang() ."')
    WHERE
        application.id = {$application_id}
    LIMIT 1
",__FILE__,__LINE__);

$data['mail']['info'] = $result->FetchRow();

// Den Node mit den Dateien zuweisen
$application_node = $data['mail']['info']['application_node'];

// Die Werte fuer das E-Mail zusammenstellen
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getTable("jobs_applications_values") . "
    WHERE
        application_id = {$application_id}
    ORDER BY
        id
",__FILE__,__LINE__);

while($row = $result->FetchRow()) {
    $data['mail']['values'][$row['key']] = $row['value'];
}

// Die Anhange fuer das E-Mail zusammenstellen
$result = XT::query("
    SELECT
        file.id,
        file.filename
    FROM
        " . XT::getTable("files_rel") . " as rel
    INNER JOIN
        " . XT::getTable("files") . " as file on (file.id = rel.file_id)
    WHERE
        rel.node_id = {$application_node}
",__FILE__,__LINE__);

while($row = $result->FetchRow()) {
    $data['mail']['attachments'][$row['id']] = $row['filename'];
}

XT::assign("xt" . XT::getBaseID() . "_application_mail", $data['mail']);

// PHP Mailer laden
XT::loadClass('phpmailer/class.phpmailer.php');

// Mail versenden
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->IsHTML(true);
$mail->Encoding = '7bit';
$mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
$mail->FromName = $GLOBALS['cfg']->get("system","email");
$mail->From = $GLOBALS['cfg']->get("system","email");
$mail->Host = $GLOBALS['cfg']->get('smtp','Host');
$mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
    $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
    $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
}

// Kontaktperson, falls vorhanden
if(XT::checkEmail(trim($data['mail']['info']['contact_email']))) {
    $receiver['email'] = trim($data['mail']['info']['contact_email']);
    $receiver['name'] = "{$data['mail']['info']['contact_last_name']} {$data['mail']['info']['contact_first_name']}";
}
else {
    $receiver['email'] = $GLOBALS['cfg']->get("smtp","DefaultFrom");
    $receiver['name'] = $GLOBALS['cfg']->get("smtp","DefaultFromName");
}

// Die E-Mail geht an die Kontaktperson des Jobs
$mail->AddAddress($receiver['email'], $receiver['name']);

// Die Kopie geht an jene Person die Bewerbung ausgefuellt hat
if(XT::checkEmail(trim($data['mail']['values']['email'])) && XT::getValue("copy")) {
    $mail->AddCC(trim($data['mail']['values']['email']),
                 "{$data['mail']['values']['last_name']} {$data['mail']['values']['first_name']}");
}

// Den Betreff des E-Mails zuweisen
$mail->Subject  = $GLOBALS['cfg']->get("system","name") . " - " . XT::translate("online_application");

// Style bestimmen
if($data['mail']['info']['application_template'] != "") {
    $style = substr($data['mail']['info']['application_template'], 0, strrpos($data['mail']['info']['application_template'], "."));
}
else {
    $style = "default";
}

// Template bestimmen
if(file_exists(TEMPLATE_DIR . $GLOBALS['cfg']->get('system','theme') . "/ch.iframe.snode.jobcenter/application/" . $style . "/mail.tpl")) {
    $template = TEMPLATE_DIR . $GLOBALS['cfg']->get('system','theme') . "/ch.iframe.snode.jobcenter/application/" . $style . "/mail.tpl";
}
else {
    $template = TEMPLATE_DIR . "default/ch.iframe.snode.jobcenter/application/" . $style . "/mail.tpl";
}

// Den Inhalt des E-Mails zuweisen
$mail->Body  = $GLOBALS['tpl']->fetch($template);

// Anhaenge
if(count($data['mail']['attachments']) > 0) {
    foreach($data['mail']['attachments'] as $file_id => $filename) {
        $mail->AddAttachment(DATA_DIR . "files/" . $file_id, $filename);
    }
}

// Falls die Bestellung erfolgreich versandt wurde, den Warenkorb leeren, und ein Dankeschoen ausgeben
if($mail->Send()){
    unset($data['form']['fillout']);
    XT::setValue("sent", 1);
    XT::log(XT::translate("email succesfully sent to: ") . $receiver['email'],__FILE__,__LINE__,XT_INFO);
}
// Die Fehlermeldung in die Log schreiben
else {
    XT::setValue("sent", 0);
    XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
}

?>