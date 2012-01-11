<?php
XT::addImageButton('Save ticket','addTicketSave','default','save.png',0,'slave1');

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
$data['addresses'] = XT::getQueryData($result);

// Get all users from the system
$result = XT::query("
    SELECT
        u.*
    FROM 
        " . XT::getTable('user') . " as u,  " . XT::getTable('user_roles') . " as ur
	WHERE ur.role_id = " . XT::getConfig('admin_role') . " AND ur.user_id=u.id AND u.active=1 
    ORDER BY
       u.username ASC
", __FILE__, __LINE__);
$data['users'] = XT::getQueryData($result);

$data['priorities'] = XT::getConfig('priorities');

$data['supervisor'] = XT::getUserID();


// Assign the whole data
XT::assign("xt" . XT::getBaseID() . "_admin", $data);

// Render the template
$content = XT::build('addTicket.tpl');
?>