<?php
// Parameter :: Style
$style = $GLOBALS['plugin']->getParam('style') != '' ? $GLOBALS['plugin']->getParam('style') : 'default.tpl';

$data = array();
// Reassign posted data
$data['client_id'] = XT::getValue('client_id');
$data['mail_report'] = XT::getValue('mail_report');
$data['client_check'] = XT::getValue('client_check');
$data['title'] = XT::getValue('title');
$data['description'] = XT::getValue('description');
$data['date'] = XT::getValue('date');
$data['priority'] = XT::getValue('priority');
$data['work_time'] = XT::getValue('work_time');

$result = XT::query("SELECT
       *
    FROM
        " . XT::getTable('addresses') . "
	WHERE 
		user_id=" . XT::getUserId() . " and active=1
    ORDER BY
        title ASC
    ",__FILE__,__LINE__);
while($row = $result->fetchRow()) {
	$data['addresses'][] = $row;
}
// Get prorities
$data['priorities'] = XT::getConfig('priorities');
// Assign errors
if (is_array( XT::getValue('errors'))) {
	$data['errors'] = XT::getValue('errors');
} else {
	$data['errors'] = array();
}

//
$data['ticket_added'] = XT::getValue("ticket_added");
XT::assign("xt" . XT::getBaseID() . "_user_add", $data);
$content = XT::build($style)
?>
