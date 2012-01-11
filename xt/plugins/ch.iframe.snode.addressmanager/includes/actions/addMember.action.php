<?php
XT::call("save");


function createRandomPassword() {
    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 7) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}

$result = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('addresses') . "
    WHERE
	id = " . XT::getValue('id') . "
    ",__FILE__,__LINE__);
$data = XT::getQueryData($result);
$random = createRandomPassword();
$data[0]['password'] = $random;
XT::assign("DATA", $data[0]);

if ($data[0]['email'] != "") {
	$userid = "";
	$result = XT::query("SELECT id FROM " . XT::getTable('user') . " WHERE username = '" . $data[0]['email']  . "'",__FILE__,__LINE__);
    while($row = $result->FetchRow()){
        $userid = $row['id'];
    }
    if ($userid == "") {
		$password = md5($random . $GLOBALS['cfg']->get("system","magic"));

		XT::query("INSERT INTO " . $GLOBALS['plugin']->getTable('user') . " (
			username,
			password,
			email,
			creation_date,
			creation_user,
			mod_date,
			mod_user,
			active
			) VALUES (
			'" . $data[0]['email'] . "',
			'" . $password . "',
			'" . $data[0]['email'] . "',
			" . time() . ",
			" . $_SESSION['user']['id'] . ",
			" . time() . ",
			" . $_SESSION['user']['id'] . ",
			1
		)",__FILE__,__LINE__);

		$result = XT::query("SELECT id FROM " . XT::getTable('user') . " WHERE username = '" . $data[0]['email']  . "'",__FILE__,__LINE__);
	    while($row = $result->FetchRow()){
	        $userid = $row['id'];
	    }
		// Add role users
		XT::query("UPDATE ". XT::getTable("addresses") . "
		      SET user_id=" .$userid . ",is_primary_user_address = 1 WHERE id=" . XT::getValue('id') . "
		 ",__FILE__,__LINE__);
		 // Add role users
		XT::query("INSERT
		   INTO ". XT::getTable("user_roles") . "
		       (user_id, role_id)
		    VALUES
		    (" . $userid . ",  2)
		 ",__FILE__,__LINE__);

		require_once(CLASS_DIR . "/phpmailer/class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->IsHTML(true);
		$mail->Encoding = '7bit';
		$mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
		$mail->FromName = $data['user']['name'];
		$mail->From = $data['user']['email'];
		$mail->Host = $GLOBALS['cfg']->get('smtp','Host');

		$mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
		if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
		    $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
		    $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
		}

		$mail->AddAddress($data[0]['email'] ,$data[0]['firstName']  . " " . $data[0]['lastName'] );
		$mail->Subject  = $GLOBALS['cfg']->get("system","name") . " - " . XT::translate("New membership");

		if(is_file(TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.addressmanager/mail/addMember.tpl')){
		    $mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.addressmanager/mail/addMember.tpl');
		}else {
		    $mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . 'default/ch.iframe.snode.addressmanager/mail/addMember.tpl');
		}

		if(!$mail->Send()){
		    XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
		}
    } else {
    	   XT::log("User still exist",__FILE__,__LINE__,XT_ERROR);
    }

}
?>
