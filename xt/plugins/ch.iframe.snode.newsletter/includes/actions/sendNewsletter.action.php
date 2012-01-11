<?php
XT::call('saveNewsletter');
set_time_limit(0);

$data = array();

require_once(CLASS_DIR . "/phpmailer/class.phpmailer.php");

// Get newsletter details
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getDatabasePrefix() . "newsletter
    WHERE
        id = " . XT::getValue('newsletter_id') . "
",__FILE__,__LINE__);

$res = XT::getQueryData($result);
$data['newsletter'] = $res[0];

// Get Chapter

$i = 0;

$result = XT::query("
    SELECT 
        * 
    FROM 
        " . XT::getTable("newsletter_chapters") . "
    WHERE 
        id = " . XT::getValue('newsletter_id') . " 
    ORDER BY 
        level ASC
    ",__FILE__,__LINE__);
    
while($row = $result->FetchRow()){
    if($row["image"]>0){
        if($row["image_version"] > 0) {
            $fileinfo = getimagesize(DATA_DIR . "files/" . $row["image"] . "_" . $row["image_version"]);
        }else{
            $fileinfo = getimagesize(DATA_DIR . "files/" . $row["image"]);
        }
        $row["image_width"] = $fileinfo[0];
        $row["image_height"] = $fileinfo[1];
    }
    $data['chapters'][$i] = $row;
    $i++;
}

// Get the attachments
$files = array();

// Get the file and folder relations
$rel_result = XT::query("
    SELECT 
        content_id,
        content_type
    FROM 
        " . XT::getTable("relations") . "
    WHERE
        target_content_id = " . XT::getValue('newsletter_id') . " AND
        target_content_type = " . XT::getBaseID() . " AND
        (content_type = 240 OR content_type = 241)
",__FILE__,__LINE__);

// foreach relation get the files
while($rel_row = $rel_result->FetchRow()) {
    
    // folder
    if($rel_row['content_type'] == 241) {
        
        $file_result = XT::query("
            SELECT 
                file.id,
                file.filename
            FROM
                " . XT::getTable("files") . " as file
            INNER JOIN 
                " . XT::getTable("files_rel") . " as rel on (rel.file_id = file.id)
            WHERE
                node_id = " . $rel_row['content_id'] . "
        ",__FILE__,__LINE__);
        
        while($file_row = $file_result->FetchRow()) {
            if(file_exists(DATA_DIR . "files/" . $file_row['id'])) {
                $files[$file_row['id']]['path'] = DATA_DIR . "files/" . $file_row['id'];
                $files[$file_row['id']]['filename'] = $file_row['filename'];
            }
        }
    }
    // file
    else {
        
        $file_result = XT::query("
            SELECT 
                file.id,
                file.filename
            FROM
                " . XT::getTable("files") . " as file
            WHERE
                id = " . $rel_row['content_id'] . "
        ",__FILE__,__LINE__);
        
        $file_row = $file_result->FetchRow();
        if(file_exists(DATA_DIR . "files/" . $file_row['id'])) {
            $files[$file_row['id']]['path'] = DATA_DIR . "files/" . $file_row['id'];
            $files[$file_row['id']]['filename'] = $file_row['filename'];
        }
    }
}

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->IsHTML(true);
$mail->Encoding = '7bit';
$mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
$mail->FromName = $data['newsletter']['sender_name'];
$mail->From = $data['newsletter']['sender_email'];
$mail->Host = $GLOBALS['cfg']->get('smtp','Host');

$mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
    $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
    $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
}

$mail->Subject  =  $data['newsletter']['title'];

// Add newsletter image
if($data['newsletter']['image'] > 0) {
    $size = getimagesize (DATA_DIR . "files/" . $data['newsletter']['image'] . "_" . $data['newsletter']['image_version']);
    $mail->AddEmbeddedImage(DATA_DIR . "files/" . $data['newsletter']['image'] . "_" . $data['newsletter']['image_version'], $data['newsletter']['image'] . "_" . $data['newsletter']['image_version'], $data['newsletter']['image'] . "_" . $data['newsletter']['image_version'], "base64", $size['mime']);
}

// Add chapter images
foreach($data['chapters'] as $chapter) {
    if($chapter['image'] > 0) {
        $size = getimagesize (DATA_DIR . "files/" . $chapter['image'] . "_" . $chapter['image_version']);
        $mail->AddEmbeddedImage(DATA_DIR . "files/" . $chapter['image'] . "_" . $chapter['image_version'], $chapter['image'] . "_" . $chapter['image_version'], $chapter['image'] . "_" . $chapter['image_version'], "base64", $size['mime']);
    }
}

// Add attachments
foreach($files as $file) {
    $mail->AddAttachment($file['path'], $file['filename']);
}

// Get newsletter subscriptions
$result = XT::query("
    SELECT DISTINCT 
        subscr.*
    FROM 
        xt_newsletter_subscriptions as subscr
    INNER JOIN 
        " . XT::getTable('newsletter_subscr2cat') . " as subcat ON (subcat.subscription_id = subscr.id)
    INNER JOIN 
        " . XT::getTable('newsletter_newsl2cat') . " as nlcat ON (nlcat.category_id = subcat.category_id)
    WHERE 
        nlcat.newsletter_id=" . XT::getValue('newsletter_id') . " AND 
        subscr.lang='" . XT::getValue('lang') . "'
",__FILE__,__LINE__);

if(XT::getConfig("individual_mails")){

    while($row = $result->FetchRow()){
        
        $data['userdata'] = $row;
    
        // Get category
        $catres = XT::query("
            SELECT 
                nlcat.category_id as id
            FROM 
                xt_newsletter_subscriptions as subscr
            INNER JOIN 
                " . XT::getTable('newsletter_subscr2cat') . " as subcat ON (subcat.subscription_id = subscr.id)
            INNER JOIN 
                " . XT::getTable('newsletter_newsl2cat') . " as nlcat ON (nlcat.category_id = subcat.category_id)
            WHERE 
                nlcat.newsletter_id = " . XT::getValue('newsletter_id') . " AND 
                subscr.lang = '" . XT::getValue('lang') . "' AND
                subscr.id = " . $row['id'] . "	
        ",__FILE__,__LINE__);
        
        $res = XT::getQueryData($catres);
        $data['category']['id'] = $res[0]['id'];
    
        // Assign $data
        XT::assign("xt" . XT::getBaseId() ."_send" , $data);
        
        if(is_file(TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.newsletter/mail/' . $data['newsletter']['template'])){
            $mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.newsletter/mail/' . $data['newsletter']['template']);
        }else {
            $mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . 'default/ch.iframe.snode.newsletter/mail/' . $data['newsletter']['template']);
        }
        
        $mail->AltBody  = $data['newsletter']['header_plain'] . "\n\n" . $data['newsletter']['content_plain'] . "\n\n" . $data['newsletter']['footer_plain'];
        
        $mail->AddAddress($row['email']);
        if(!$mail->Send()){
            XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
        }
        usleep(500000);
        $mail->ClearAddresses();
    }
}
else {

    // Assign $data
    XT::assign("xt" . XT::getBaseId() ."_send" , $data);
        
    if(is_file(TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.newsletter/mail/' . $data['newsletter']['template'])){
        $mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.newsletter/mail/' . $data['newsletter']['template']);
    }else {
        $mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . 'default/ch.iframe.snode.newsletter/mail/' . $data['newsletter']['template']);
    }
    
    $mail->AltBody  = $data['newsletter']['header_plain'] . "\n\n" . $data['newsletter']['content_plain'] . "\n\n" . $data['newsletter']['footer_plain'];

    while($row = $result->FetchRow()){
        $mail->AddAddress($row['email']);
        if(!$mail->Send()){
            XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
        }
        usleep(500000);
        $mail->ClearAddresses();
    }
}

XT::query("UPDATE " . XT::getTable('newsletter') . " SET status= status + 1, sent_date= " . time() . "
 WHERE
        id = " . XT::getValue('newsletter_id')
,__FILE__,__FILE__);

// Create and send report
XT::setAdminModule('e');

?>