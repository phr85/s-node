<?php
$assign = array();
$password = "";
if(($GLOBALS['plugin']->getValue('password') != $GLOBALS['plugin']->getValue('password_repeat'))){
    XT::actionStop("Your passwords are not identical","password");
} else {
    if($GLOBALS['plugin']->getValue('password') != '' && $GLOBALS['plugin']->getValue('password_repeat') != ''){
        $password = md5($GLOBALS['plugin']->getValue('password') . $GLOBALS['cfg']->get("system","magic"));
    }
}
if($GLOBALS['plugin']->getValue('password') == ""){
    // XT::log("Password cannot be empty",__FILE__,__LINE__,XT_ERROR);
    XT::actionStop("Password cannot be empty","password");
}

if(XT::getValue('username') == ""){
    //XT::log("Username cannot be empty",__FILE__,__LINE__,XT_ERROR);
    XT::actionStop("Username cannot be empty","username");
}
if(XT::getValue('email') == ""){
    // XT::log("E-Mail address cannot be empty",__FILE__,__LINE__,XT_ERROR);
    XT::actionStop("E-Mail address cannot be empty","email");
}else{
    if(!XT::checkEmail(XT::getValue('email'))){
        XT::actionStop("E-Mail address is not valid","email");
    }
}

// Check for already existing username
$result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable('users') . " WHERE username = '" . $GLOBALS['plugin']->getValue('username') . "'",__FILE__,__LINE__);
while($row = $result->FetchRow()){
    //XT::log("This username is already in use",__FILE__,__LINE__,XT_ERROR);
    XT::actionStop("This username is already in use","username");
}


// If there were no errors, go ahead an insert user into db
if(!XT::actionIsStopped()){

    XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('users') . " (
        username,
        password,
        email,
        creation_date,
        mod_date,
		active
        ) VALUES (
        '" . XT::getValue('username') . "',
        '" . $password . "',
        '" . XT::getValue('email') . "',
        " . time() . ",
        " . time() . ",
		1
        )",__FILE__,__LINE__);

    // get user id
    $result = XT::query("SELECT id FROM " . $GLOBALS['plugin']->getTable('users') . " WHERE username = '" . $GLOBALS['plugin']->getValue('username') . "'",__FILE__,__LINE__);
    while($row = $result->FetchRow()){
        $userid = $row['id'];
    }



    // Create Address
    XT::loadClass('address.class.php','ch.iframe.snode.addressmanager');

    // Instantiate address entry
    $address = new XT_Address();
    // Update values
    $address->setTitle(XT::getValue('username'));
    $address->setImage($row['image']);
    $address->setEMail(XT::getValue('email'));
    $address->setDescription(XT::getValue('description'));
    $address->setuserid($userid);
    $address->setPrimaryUserAddress(1);
    $address->setType(3);
    // Commit changes
    $address->save();



    // Add role users
    XT::query("INSERT
	   INTO ". XT::getTable("user_roles") . "
	       (user_id, role_id)
	    VALUES
        (" . $userid . ",  2)
     ",__FILE__,__LINE__);

    // Add user to a role
    $role = XT::getParam('role');
    if ($role != "") {
        $role = explode(",",$role);
        if (!is_array($role)){
            $roles[] = $role;
        } else {
            $roles = $role;
        }
        unset($role);
        foreach ($roles as $role) {
            if (is_numeric(trim($role))) {
                XT::query("INSERT
			    INTO ". XT::getTable("user_roles") . "
			       (user_id, role_id)
			    VALUES
		        (" . $userid . ",  " . trim($role). ")
		     ",__FILE__,__LINE__);
            }
        }
    }

    // Add user to a role
    $group = XT::getParam('group');
    if ($group != "") {
        $group = explode(",",$group);
        if (!is_array($group)){
            $groups[] = $group;
        } else {
            $groups = $group;
        }
        unset($group);
        foreach ($groups as $group) {
            if (is_numeric(trim($group))) {
                XT::query("INSERT
			    INTO ". XT::getTable("user_groups") . "
			       (user_id, group_id)
			    VALUES
		        (" . $userid . ",  " . trim($group). ")
		     ",__FILE__,__LINE__);
            }
        }
    }

    if(XT::getConfig("infomailOnRegistration")){
        // Send email to admin
        require_once(CLASS_DIR . "/phpmailer/class.phpmailer.php");
        // Create and send mail
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->IsHTML(true);
        $mail->Encoding = '7bit';
        $mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
        $mail->FromName = $GLOBALS['cfg']->get('smtp','DefaultFromName');
        $mail->From = $GLOBALS['cfg']->get('smtp','DefaultFrom');
        $mail->Host = $GLOBALS['cfg']->get('smtp','Host');

        $mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
        if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
            $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
            $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
        }
        $mail->AddAddress($GLOBALS['cfg']->get('system','email'));
        $mail->Subject  =  $GLOBALS['cfg']->get('system','base_meta_title') . " neue Anmeldung";
        $mail->Body  = "Bitte Prüfen und aktivieren";
        if(!$mail->Send()){
            XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
        }

    }
    // Commit changes
    if (XT::getParam('autologin') == "true") {
        $GLOBALS['auth']->setCredentials($GLOBALS['plugin']->getValue('username'), $GLOBALS['plugin']->getValue('password'));
        $GLOBALS['auth']->login();

        // Init arrays
        if(!is_array($_SESSION['user'])){
            $_SESSION['user'] = array();
        }
        if(!array_key_exists('roles',$_SESSION['user'])){
            $_SESSION['user']['roles'] = array();
        }

        // Add each user to "Everyone" Role
        if(!in_array(3,$_SESSION['user']['roles'])){
            $_SESSION['user']['roles'][] = 3;
        }

        // Add each logged in user to "User" Role
        if($GLOBALS['auth']->isAuth()){
            if(!in_array(2,$_SESSION['user']['roles'])){
                $_SESSION['user']['roles'][] = 2;
            }
        }
    }

    if (XT::getParam('redirect_tpl') != "") {
        header("Location: index.php?TPL=" . XT::getParam('redirect_tpl'));
    }
    XT::assign('REGISTRED',1);
}
?>