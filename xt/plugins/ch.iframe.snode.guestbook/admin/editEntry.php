<?php

if(XT::getPermission('edit')){

    // Buttons
    if(XT::getValue('id') > 0){
        XT::setSessionValue('id',XT::getValue('id'));
    }
    XT::addImageButton("[s]ave and exit", "saveEntry","default","save_close.png","guestbook","master","s");
    // SQL
    $result = XT::query("SELECT id, creation_date, ip, name, email, website, comment FROM " . $GLOBALS['plugin']->getTable("guestbook") . " WHERE ID=" . XT::getSessionValue('id') . " LIMIT 0,1",__FILE__,__LINE__);

    $data = array();
    while($row = $result->FetchRow()){

        // if are an error, take content from POST-data
        $error = $GLOBALS['logger']->getErrors();

        if($GLOBALS['logger']->getErrors() != array() && $error[0]['severity'] < 8){

            $row['name'] =  $GLOBALS['plugin']->getPostValue('name');
            $row['email'] =  $GLOBALS['plugin']->getPostValue('email');
            $row['website'] =  $GLOBALS['plugin']->getPostValue('website');
            $row['comment'] =  $GLOBALS['plugin']->getPostValue('comment');

        }

        XT::assign("ID", $row['id']);
        XT::assign("CREATION_DATE", $row['creation_date']);
        XT::assign("IP", $row['ip']);
        XT::assign("NAME", $row['name']);
        XT::assign("EMAIL", $row['email']);
        XT::assign("WEBSITE", $row['website']);
        XT::assign("COMMENT", $row['comment']);
    }

    $content = XT::build("editEntry.tpl");

}

?>