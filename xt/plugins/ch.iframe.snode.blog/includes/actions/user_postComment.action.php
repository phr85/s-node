<?php
if(XT::getValue("comment") !=""){
    XT::loadClass('tree.class.php',"ch.iframe.snode.core");
    $tree = new XT_Tree("comments");
    // wenn kommentare existieren, addchild verwenden, ansonsten neuen baum erstellen
    $count = XT::getQueryData(XT::query("SELECT count(*) as cnt, tree_id FROM " . XT::getTable("comments") . " WHERE content_type=" . XT::getValue("content_type") . " AND content_id=" . XT::getValue("content_id") . " GROUP by tree_id" ,__FILE__,__LINE__));
    if($count[0]['cnt'] > 0){
        // wenn eine ID von einem commentar angegeben wurde, dieser id als child schreiben

        if(XT::getValue("comment_id")>0){
            $newid = $tree->addChildNode(XT::getValue("comment_id"));
        }else {
            $newid = $tree->addChildNode($count[0]['tree_id']);
        }
    }else {
        $newid = $tree->addTree();
    }

    // Titel aufbauen oder den vom content holen
    if(XT::getValue("title")!=""){
        $title = XT::getValue("title");
    }else {
        $title = XT::getTitleByContentType(XT::getValue("content_type"),XT::getValue("content_id"));
    }
    if (is_array($title)){
    	$title = implode(",",$title);
    }

    // Schauen ob Webseitenangabe vorhanden ist bzw. korrekt
    if(XT::getValue("website")!= ""){
	   	$website = XT::getValue("website");
		// Http wird autom. hinzugefügt.
	   	$website = str_replace("http://","",$website);
    }else {
    	$website = "";
    }

    // daten eintragen
    XT::query("UPDATE " . XT::getTable("comments") . " SET
            title='" . $title . "',
            name='" . XT::getValue("name") . "',
            active='" . XT::getConfig('postCommentActive') . "',
            email='" . XT::getValue("email") . "',
            comment='" . strip_tags(XT::getValue("comment"),XT::getConfig("allowable_tags")) . "',
            content_type=" . XT::getValue("content_type") . ",
            content_id=" . XT::getValue("content_id") . ",
            ip_long=" . ip2long($_SERVER['REMOTE_ADDR']) . ",
            user_id=" . XT::getUserID() . ",
            website='" . $website . "',
            c_date=" . TIME . "
           WHERE id=". $newid,__FILE__,__LINE__);

    // werte für einen weiteren kommentar behalten
    $data['user']['name']           = XT::getValue('name');
	$data['user']['email']          = XT::getValue('email');
    XT::setSessionValue('user',$data['user']);
    $data['comment']['title'] = $title;
	$data['comment']['comment'] = strip_tags(XT::getValue("comment"),XT::getConfig("allowable_tags")) ;
	$data['comment']['id'] = $newid;
	$data['comment']['ip'] = $_SERVER['REMOTE_ADDR'];
	$data['comment']['date'] = time();
	// Send moderation email
	if (XT::getConfig("moderate") != "") {
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

	    $mail->AddAddress(XT::getConfig("moderate"),'');
	    $mail->Subject  =  $_SERVER['SERVER_NAME'] . " Comment: " . $data['comment']['title'];
		XT::assign("MAIL_DATA",$data);
		if(is_file(TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.comment/moderate_mail.tpl')){
	        $mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.blog/mail/moderate_comment.tpl');
	    }else {
	        $mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . 'default//ch.iframe.snode.blog/mail/moderate_comment.tpl');
	    }

	    if(!$mail->Send()){
        	XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
	    }
	}

} else {
	$noinsert = true;
}
?>