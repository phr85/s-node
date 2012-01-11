<?php
if(XT::getValue('status') != "" && is_numeric(XT::getValue('status'))) {
	// Get countries
	$result = XT::query("
	    SELECT
	       *
	    FROM
	        " . XT::getTable('tickets') . "
	    WHERE
			id=" . XT::getValue('id') . "
	",__FILE__,__LINE__);
	$row = $result->fetchRow();
	if ($row['status'] != XT::getValue('status')) {
		$row['status'] = XT::getValue('status');
		$row['status_str'] = "status_" . XT::getValue('status');
		$now = time();
		// Set the new status
		XT::query("
	    UPDATE
	        " . XT::getTable('tickets') . "
	  	SET 
		status=" . XT::getValue('status') . ", 
		mod_date='" . time() . "', 
		mod_user='" . XT::getUserId() . "' 
		WHERE id=" . XT::getValue('id') . "
		", __FILE__, __LINE__);

		// create a nice comment for the history
		$comment = XT::translate("Status changed to") . ": " . XT::translate("status_" . XT::getValue("status"));
		if (XT::getValue("status_comment") != "") {
			$comment .= ": " . XT::getValue("status_comment");
			$row['comment'] = XT::getValue("status_comment");
		}
		
		// Log the new status to the history
		XT::query("
		INSERT INTO
		    " . XT::getTable('tickets_history') . "
		   (ticket_id,type,start_date,end_date,worker,description) VALUES (
			" . XT::getValue("id") . ",
		1,
		" . $now . ",
		" . $now . ",
		" . XT::getUserId() . ",
		'" . $comment . "'
		)
		", __FILE__, __LINE__);

		// Throw a notice
		XT::log(XT::translate('Status Changed'),__FILE__,__LINE__,XT_INFO);
		
		// Get all addresses from the system
		$result = XT::query("
		    SELECT
		        *
		    FROM 
		        " . XT::getTable('addresses') . "
			WHERE active=1 
		    ORDER BY
		       title ASC
		", __FILE__, __LINE__);
		$row['addresses'] = XT::getQueryData($result);
		
		$row['priorities'] = XT::getConfig('priorities');
		
		require_once(CLASS_DIR . "/phpmailer/class.phpmailer.php");
		$mail = new PHPMailer();
	    $mail->IsSMTP();
	    $mail->IsHTML(true);
	    $mail->Encoding = '7bit';
	    $mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
	    $mail->FromName = XT::getUserProperties("firstName") . " " . XT::getUserProperties("lastName");
	    $mail->From = XT::getUserProperties("email");
	    $mail->Host = $GLOBALS['cfg']->get('smtp','Host');
	
	    $mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
	    if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
	        $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
	        $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
	    }
	
	    $mail->Subject  =  XT::translate("Status changed to") . " \"" . XT::translate($row['status_str']) . "\" " . "#" . XT::getValue('id') . " " . $row['title'];
		
		if (XT::getUserId() == $row['worker'] || $row['worker'] == 0) {
			$mail->AddAddress(XT::getUserProperties("email",$row['supervisor']) ,'');
		}
		if (XT::getUserId() == $row['supervisor'] && $row['worker'] != 0) {
			$mail->AddAddress(XT::getUserProperties("email",$row['worker']) ,'');
		}
		if ($row['mail_report'] == 1) {
			foreach($row['addresses'] as $address) {
				if ($address['id'] == $row['client_id'] && $address['email'] != "") {
					$mail->AddAddress($address['email'] ,$address['firstName'] . ' ' . $address['lastName']);
				}
			}
		}
		
		XT::assign("xt" . XT::getBaseID() . "_mail", $row);
		
		if(is_file(TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.tickets/mail/statuschange.tpl')){
	        $mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.tickets/mail/statuschange.tpl');
	    }else {
	        $mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . 'default/ch.iframe.snode.tickets/mail/statuschange.tpl');
	    }
	    
	    if(!$mail->Send()){
        	XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
	    }
	}
}
?>