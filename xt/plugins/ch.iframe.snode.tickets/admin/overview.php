<?php
// Add buttons
XT::addImageButton('Add ticket','addTicket','default','document_new.png',0,'slave1');
XT::addImageButton('Manager','manager','default','tickets/magic-wand.png',1,'master','','','popup(\'index.php?TPL=8101\',400,800,\'thehole\');');

// Get all tickets in pool
$result = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable('tickets') . "
    WHERE
       status = 0
    ORDER BY 
        date,
        priority ASC
	LIMIT 0,5
", __FILE__, __LINE__);
$data['pool'] = XT::getQueryData($result);

// Get my tickets
$result = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable('tickets') . "
    WHERE
     worker = " . XT::getUserId() . " AND status <= 3
    ORDER BY 
        date,
        priority ASC
	LIMIT 0,5
", __FILE__, __LINE__);
$data['my_tickets'] = XT::getQueryData($result);

// Get my old tickets
$result = XT::query("
    SELECT
        *
    FROM 
        " . XT::getTable('tickets') . "
    WHERE
     worker = " . XT::getUserId() . " AND status >= 4
    ORDER BY 
        date,
        priority ASC
	LIMIT 0,5
", __FILE__, __LINE__);
$data['my_old_tickets'] = XT::getQueryData($result);
// Assign the user id
$data['my_userid'] = XT::getUserID();
// Assign the whole data
XT::assign("xt" . XT::getBaseID() . "_admin", $data);

// Render the template
$content = XT::build('overview.tpl');
?>