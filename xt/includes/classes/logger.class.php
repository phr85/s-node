<?php
class XT_Logger {
    var $_errors = array();
    
    var $_tmpErrorFile;
    
    function add($desc, $file, $line, $severity, $content_type = 0, $content_id = 0, $content_action = ''){

        // Log message
        XT::query("
            INSERT INTO
                " . XT::getDatabasePrefix() . "log
            (
                user_id,
                description,
                creation_date,
                log_type,
                call_file,
                call_line,
                baseid,
                content_type,
                content_id,
                content_action
            ) VALUES (
                '" . $_SESSION['user']['id'] . "',
                '" . addslashes($desc) . "',
                " . time() . ",
                " . $severity . ",
                '" . $file . "',
                '" . $line . "',
                '" . XT::getBaseID() . "',
                '" . $content_type . "',
                '" . $content_id . "',
                '" . $content_action . "'
            )
        ",__FILE__,__LINE__);

        if($severity <= $GLOBALS['cfg']->get("system","log_level"))
        /**
         * build error
         */
        $error = array(
            "desc" => $desc,
            "file" => $file,
            "line" => $line,
            "severity" => $severity
            );

        /**
         * add to error stack
         */
        if(!in_array($error,$this->_errors)){
            array_push($this->_errors, $error);
        }

    }

    function getErrors(){
        return array_reverse($this->_errors);
    }
    
    function tmpErrorFileExists() {
    	// Set the path to the temp file
    	$this->_tmpErrorFile = ROOT_DIR . "tmp/send_errors.php";
    	// create the file if not exist
    	if (!is_file($this->_tmpErrorFile)) {
    		touch($this->_tmpErrorFile);
    	}
    	// return if the file exists
    	return is_file($this->_tmpErrorFile);
    }
    
    
    
    function reportError($title,$message) {
    	if ($GLOBALS['cfg']->get('system','send_error') != "") {
	    	// Just do something if the temporary array exists
	    	if ($this->tmpErrorFileExists()) {
		    	$errors = array();
		    	// set the time now
		    	$time = time();
		    	// create an unique id for the error message
		    	$msgid = md5($message);
		    	// Include the temporary error file
		    	include ROOT_DIR . "tmp/send_errors.php";
		    	// Resend errors just after 2 hours
		    	if (($time - $errors[$msgid]) > (60 * 60 * 2) || count($errors) == 0) {
		    	
			    	
			    	require_once(CLASS_DIR . "/phpmailer/class.phpmailer.php");
			    	$body = "<b>System:</b>" . $_SERVER["SERVER_NAME"];
			    	$body .= $message;
			    	$message .= "<hr/>";
			    
			
			    	$message .= "<b>REQUEST Informations</b>";
			    	$message .= '<table width="100%" border="1">';
			    	foreach($_REQUEST as $key => $val){
			    		$message .= '<tr>';
			    		$message .= '<td>' . $key . '</td>';
			    		if (is_array($val)) {
			    			$message .= '<td><pre>' . print_r($val,1) . '</pre></td>';
			    		} else {
			    			$message .= '<td>' . $val . '</td>';
			    		}
			    		$message .= '</tr>';
			    	}
			    	$message .= '</table>';
			    	
			    	$message .= "<hr/>";
			    	$message .= "<b>SESSION Informations</b>";
			    	$message .= '<table width="100%" border="1">';
			    	foreach($_SESSION as $key => $val){
			    		$message .= '<tr>';
			    		$message .= '<td>' . $key . '</td>';
			    		if (is_array($val)) {
			    			$message .= '<td><pre>' . print_r($val,1) . '</pre></td>';
			    		} else {
			    			$message .= '<td>' . $val . '</td>';
			    		}
			    		$message .= '</tr>';
			    	}
			    	$message .= '</table>';
			    	
			    	$message .= "<hr/>";
			    	$message .= "<b>SERVER Informations</b>";
			    	$message .= '<table width="100%" border="1">';
			    	foreach($_SERVER as $key => $val){
			    		$message .= '<tr>';
			    		$message .= '<td>' . $key . '</td>';
			    		if (is_array($val)) {
			    			$message .= '<td><pre>' . print_r($val,1) . '</pre></td>';
			    		} else {
			    			$message .= '<td>' . $val . '</td>';
			    		}
			    		$message .= '</tr>';
			    	}
			    	$message .= '</table>';
			    	
			    	$mail = new PHPMailer();
					$mail->IsSMTP();
					$mail->IsHTML(true);
					$mail->Encoding = '7bit';
					$mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
					$mail->FromName = $GLOBALS['cfg']->get('system','name');
					$mail->From = $GLOBALS['cfg']->get('system','email');
					if ( $GLOBALS['cfg']->get('smtp','Host') == "%SMTP_HOST%") {
						$mail->Host = 'localhost';
					} else {
						$mail->Host = $GLOBALS['cfg']->get('smtp','Host');
					}
					$mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
					if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
					    $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
					    $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
					}
					
					$mail->Subject  =  'XT ERROR: '. $title . " " . $_SERVER["SERVER_NAME"];
					$mail->Body = $message;
					$mail->AddAddress($GLOBALS['cfg']->get('system','send_error'));
					$mail->Send();
					$mail->ClearAddresses();
					
			    	unset($mail);
			    	
			    	$errors[$msgid] = $time;
			    	
			    	$fcontent = "<?php\n";
			    	
			    	foreach ($errors as $key=>$value) {
			    		// Keep only records during 24 hours
			 			if (($time - $value) > (60 * 60 * 24)) {
			    			$fcontent .= "\$errors['$key'] = '$value';\n";
			 			}
			    		
			    	}
			    	
			    	$fcontent .= "?>";
			    	file_put_contents($this->_tmpErrorFile,$fcontent);
		    	} else {
		    		// Do nothing
		    	}
	    	}
    	}
    }

}

?>