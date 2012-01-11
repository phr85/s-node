<?php

if(XT::getValue('email')){

    // Get id for this user
    $result = XT::query("
        SELECT
            usr.id,
            usr.username,
            usr.id as user_id
        FROM
            " . XT::getTable('user') . " as usr
        WHERE
            usr.email = '" . XT::getValue('email') . "'
    ",__FILE__,__LINE__,0);

    $data = array();
    while($row = $result->FetchRow()){
        $data[] = $row;
    }

    $pass = random_password(5);

    if(sizeof($data) > 0){
        foreach ($data as $user) {
            if($user['username'] != 'admin'){
                $newpass = md5($pass . $GLOBALS['cfg']->get("system", "magic"));
                XT::query("
                    UPDATE
                        " . XT::getTable('user') . "
                    SET
                        password = '" . $newpass . "'
                    WHERE
                        id = '" . $user['user_id'] . "'
                    ",__FILE__,__LINE__);
                $updatedusers[] = $user['username'];
            }
        }
        XT::assign("EMAIL", XT::getValue('email'));
        XT::assign("PASSWORD", $pass);
        XT::assign("USERNAME", $data[0]['username']);
        XT::assign("updatedusers",$updatedusers);
        
        require_once(CLASS_DIR . "/phpmailer/class.phpmailer.php");
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->IsHTML(true);
        $mail->Encoding = '7bit';
        $mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
        $mail->From = $GLOBALS['cfg']->get("smtp",'DefaultFrom');
        $mail->FromName = $GLOBALS['cfg']->get("smtp",'DefaultFromName');
        $mail->Host = $GLOBALS['cfg']->get('smtp','Host');
        $mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
        if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
            $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
            $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
        }
        $mail->AddAddress(XT::getValue('email'));
        $mail->Subject = $GLOBALS['cfg']->get("system",'name') . " " . $GLOBALS['lang']->msg("Your password");
        $mail->Body = XT::build("mail.tpl");
        $mail->Send();
        $content = XT::build("ok.tpl");

    } else {

        XT::assign("EMAIL", XT::getValue('email'));
        $content = XT::build("failed.tpl");
    }
} else {

    $content = XT::build("default.tpl");
}

function random_password( $len = 10 )
{
    $salt = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvXxYyZz0123456789';
    $salt_max = strlen( $salt ) - 1 ;
    $pass = '' ;
    for( $i=0; $i < $len; $i++ ) {
        $pass .= substr( $salt, mt_rand(0, $salt_max), 1 ) ;
    }
    return $pass ;
}

?>