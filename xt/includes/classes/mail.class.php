<?php
require_once(CLASS_DIR . "/phpmailer/class.phpmailer.php");

class XT_Mail {
	var $mail;

    function XT_Mail($sender_mail,$sender_name='',$reply_to=''){
    
        
        $this->mail = new PHPMailer();
        $this->mail->IsSMTP();
        $this->mail->Encoding = '7bit';
        $this->mail->Host = $GLOBALS['cfg']->get('smtp','Host');
        
        if ($sender_name != ""){
			$this->mail->FromName = $sender_name;
		}
		
		if ($sender_mail != ""){
			$this->mail->From = $sender_mail;
		}
		if ($reply_to != ""){
			$this->mail->AddReplyTo($reply_to,$sender_name);
		}
		
		$this->mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
		if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
		    $this->mail->Username = $GLOBALS['cfg']->get('smtp','Username');
		    $this->mail->Password = $GLOBALS['cfg']->get('smtp','Password');
		}
    }

    function setHTML($isHTML = true){
        $this->mail->IsHTML($isHTML);
    }

    function addCC($address, $name = ''){
      	$this->mail->AddCC($address,$name);
    }

    function addBCC($address, $name = ''){
        $this->mail->AddBCC($address,$name);
    }

    function addReceiver($address, $name = ''){
        $this->mail->AddAddress($address,$name);
    }

    function setSubject($subject){
        $this->mail->Subject = $subject;
    }

	function setPlainBody($body){
	    $this->mail->AltBody  = $body;
	}

    function setBody($body){
        $this->mail->Body = $body;
    }
	
    function send(){
    	
     //die ("<pre>" . print_r($this->mail,1) . "</pre>");
      return $this->mail->Send(); 
    }
}
?>