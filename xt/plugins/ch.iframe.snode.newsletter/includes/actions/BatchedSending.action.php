<?php
// Include our gorgeous class to send mails
require_once(CLASS_DIR . "/phpmailer/class.phpmailer.php");
// get all entries from queue
$sql = "SELECT * from " . XT::getTable("newsletter_queue") . " WHERE errors < 50 LIMIT 0," . XT::getConfig("max_emails_per_cycle");
//echo $sql;
$result = XT::query("SELECT * from " . XT::getTable("newsletter_queue") . " WHERE errors < 50 LIMIT 0," . XT::getConfig("max_emails_per_cycle"),__FILE__,__LINE__);
// Clear the content for debugging
$content = "";
while ($row = $result->FetchRow()) {
    $content .= "laod newletter " . $row['newsletter_id'] . " for " . $row['user_id'] . "\n";
    // Reset the  arrays
    $data = array();
    $newsletter = array();

    // Get newsletter details
    $result_nl = XT::query("
        SELECT
            *
        FROM
            " . XT::getTable("newsletter")  . "
        WHERE
            id = " .  $row['newsletter_id'] . "
    ",__FILE__,__LINE__);
    if($row_newsletter = $result_nl->FetchRow()){
       $data['newsletter'] = $row_newsletter;
    }

    // Chapters
    $result_chapters = XT::query("SELECT * from " . XT::getTable("newsletter_chapters") . " WHERE id = " . $row['newsletter_id'] . " ORDER by level ASC",__FILE__,__LINE__);
     // Reset the chapters array
        $chapters = array();
    while($row_chapters = $result_chapters->FetchRow()){
        if($row_chapters["image"]>0){
            if($row_chapters["image_version"] > 0) {
                $fileinfo = getimagesize (DATA_DIR . "files/" . $row_chapters["image"] . "_" . $row_chapters["image_version"]);
            }else{
                $fileinfo = getimagesize (DATA_DIR . "files/" . $row_chapters["image"]);
            }
            $row_chapters["image_width"] = $fileinfo[0];
            $row_chapters["image_height"] = $fileinfo[1];
        }
        $chapters[] = $row_chapters;
    }
    $data['chapters'] = $chapters;

    // Get user details
    $result_user = XT::query("SELECT * from " . XT::getTable("newsletter_subscriptions") . " WHERE id = " . $row['user_id'],__FILE__,__LINE__);
    if($row_user = $result_user->FetchRow()){
       $data['userdata'] = $row_user;
    }
    
    // Get Category
    $data['category']['id'] = $row['category_id'];

    // Assign all data
    XT::assign("xt" . XT::getBaseId() ."_send" , $data);
    
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
            target_content_id = " . $row['newsletter_id'] . " AND
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

    // Harrr... now we have collected all data and we are ready to send! Sulu open the channel!
    // Initiate the mailer object and configure it.
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->IsHTML(true);
    $mail->Encoding = '7bit';
    $mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
    $mail->FromName = $data['newsletter']['sender_name'];
    $mail->From = $data['newsletter']['sender_email'];
    $mail->Host = $GLOBALS['cfg']->get('smtp','Host');
    // Autorisation please!
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

    if(is_file(TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.newsletter/mail/' . $data['newsletter']['template'])){
        $mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.newsletter/mail/' . $data['newsletter']['template']);
    }else {
        $mail->Body     =  $GLOBALS['tpl']->fetch( TEMPLATE_DIR . 'default/ch.iframe.snode.newsletter/mail/' . $data['newsletter']['template']);
    }
    $mail->AltBody  = $data['newsletter']['header_plain'] . "\n\n" . $data['newsletter']['content_plain'] . "\n\n" . $data['newsletter']['footer_plain'];
    $mail->AddAddress( $data['userdata']['email'], $data['userdata']['firstname'] . " " . $data['userdata']['lastname']);
    if(!$mail->Send()){
       XT::query("UPDATE " . XT::getTable("newsletter_queue") . "  SET errors = errors + 1 WHERE newsletter_id =  " . $row['newsletter_id'] . " AND user_id = " . $row['user_id'],__FILE__,__LINE__);
       $content .= "error sent newletter " . $row['newsletter_id'] . " to " . $data['userdata']['email'] . "\n";
    } else {
         // Delete the record
         XT::query("DELETE FROM " . XT::getTable("newsletter_queue") . "  WHERE newsletter_id =  " . $row['newsletter_id'] . " AND user_id = " . $row['user_id'],__FILE__,__LINE__);
         // Add new record new in the table for sent newsletters
         XT::query("INSERT INTO " . XT::getTable("newsletter_sent") . " (newsletter_id,user_id,date,category_id) VALUES(" . $row['newsletter_id'] . "," . $row['user_id'] . "," . time() . "," . $row['category_id'] . ")",__FILE__,__LINE__);
         // add debbuging informations
         $content .= "successfuly sent newletter " . $row['newsletter_id'] . " to " . $data['userdata']['email'] . "\n";
    }
    // Clear addresses to be sure that all addresses are empty
    $mail->ClearAddresses();

    // Loading phaser and destroy the object!
    $mail = "";
    unset($mail);
    // Wait a little bit
    usleep(XT::getConfig("sleep_per_cycle"));
}
XT::setValue('content',$content);
?>