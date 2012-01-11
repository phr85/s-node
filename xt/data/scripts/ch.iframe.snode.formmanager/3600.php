<?php
// Set group id
$groupID= 2;

// Get user id
$result = XT::query("SELECT id FROM xt_user WHERE username = '" . $fields['username']. "'");
$data = XT::getQueryData($result);
$user_id = $data[0]['id'];

if($user_id > 0){
    header("Location: " . $_SERVER['PHP_SELF'] . "?TPL=" . $GLOBALS['tpl_id'] . "&user_already_exists=1");
} else {
    $password = random_password();
    $fields['password'] = $password;
    // Create user
    XT::query("
INSERT INTO
xt_user
(
username,
password,
creation_date,
creation_user,
active,
firstName,
lastName,
street,
plz,
city,
email
) VALUES (
'" . $fields['username'] . "',
'" . md5($password . $GLOBALS['cfg']->get("system","magic")) . "',
" . time() . ",
'" . XT::getUserID() . "',
1,
'" . $fields['firstName'] . "',
'" . $fields['lastName'] . "',
'" . $fields['street'][0] . " " . $fields['street'][1] . "',
'" . $fields['plz'][0] . "',
'" . $fields['plz'][1] . "',
'" . $fields['email'] . "'
)",__FILE__,__LINE__);

    // Get user id
    $result = XT::query("SELECT id FROM xt_user ORDER BY id DESC LIMIT 1");
    $data = XT::getQueryData($result);
    $user_id = $data[0]['id'];
    $_SESSION['userid']=$user_id;

    // Add group reseller
    XT::query("INSERT
   INTO xt_user_groups
       (user_id, group_id)
    VALUES
        (" . $user_id . ",  2)
     ",__FILE__,__LINE__);

    $_SESSION['fields'] = $fields;

    //login
    //$GLOBALS['auth']->setCredentials($fields['username'],$fields['password']);
    //$GLOBALS['auth']->login();

    //Mail Password
    XT::assign("FIELDS",$fields);

    // Create and send mail
    require_once(CLASS_DIR . 'mail.class.php');
    $mail = new XT_Mail($fields['email'],$fields['email'],$fields['email']);
    $mail->addReceiver($fields['email']);
    $mail->setSubject("Zugangsdaten Forum");
    $mail->setHTML(true);
    $mail->setBody($GLOBALS['tpl']->fetch($GLOBALS['plugin']->tpl_location . 'forum.tpl'));
    $mail->send();
}

    function random_password( $len = 5 ){
        $salt = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvXxYyZz0123456789';
        $salt_max = strlen( $salt ) - 1 ;
        $pass = '' ;
        for( $i=0; $i < $len; $i++ ) {
            $pass .= substr( $salt, mt_rand(0, $salt_max), 1 ) ;
        }
        return $pass ;
    }
?>