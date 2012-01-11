<?php
//scripting identifier für das File (array), für mehrere files einfach den array erweitern
$fileident[0]="dat1";
$fileident[1]="dat2";

// empfÃ¤nger der datei (entweder als hidden field mit scripting identifier fileemail oder direkt eine emailadresse eingeben)
$receiver = $fields['fileemail'];
// $receiver = "filereceiver@email.com";


// mailclasse initialisieren
require_once(CLASS_DIR . "/phpmailer/class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->IsHTML(true);
$mail->Encoding = '7bit';
$mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
$mail->FromName = $fields['email'];
$mail->From = $fields['email'];
$mail->Host = $GLOBALS['cfg']->get('smtp','Host');
$mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
    $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
    $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
}

$mail->AddAddress($receiver);

$mail->Subject  = "DATA " . $fields['subject'] . " " . $GLOBALS['cfg']->get("system","name") . ' - ' . $form['title'] . ' (#' . $fillout_id . ')';
$mail->Body = "Files: 
";



// vorhandene dateien anhaengen (falls keine fehler oder grÃ¶sse über 0bytes ist)
foreach ($fileident as $file) {
    $filedetail = XT::getSessionValue($file);
    if($filedetail['error']==0 && $filedetail['size']>0 && is_file(ROOT_DIR . $filedetail['tmp_name'])){
        $mail->AddAttachment(ROOT_DIR . $filedetail['tmp_name'],$filedetail['name']);
        $mail->Body .= XT::printArray($filedetail,true);
    }
}


// mail verschicken

if(!$mail->Send()){
    XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
}


// Reset File
foreach ($fileident as $file) {
    XT::unsetSessionValue($file);
    unlink(ROOT_DIR . $filedetail['tmp_name']);
}

?>