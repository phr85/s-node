<?php
// Add buttons
XT::addImageButton('Add ticket','addTicket','default','document_new.png',0,'slave1');
XT::addImageButton('Manager','manager','default','tickets/magic-wand.png',1,'master','','','popup(\'index.php?TPL=8101\',400,800,\'thehole\');');
$data = array();

// Sortation of the list
if(XT::getValue("order_by")) {
	XT::setSessionValue("order_by",XT::getValue("order_by"));	
}else{
	if (XT::getSessionValue("order_by") == "") {
		XT::setSessionValue("order_by","date");
	}	
}
$data['order_by'] = XT::getSessionValue("order_by");

if(XT::getValue("order_by_dir")) {
	XT::setSessionValue("order_by_dir",XT::getValue("order_by_dir"));	
}else{
	if (XT::getSessionValue("order_by_dir") == "") {
		XT::setSessionValue("order_by_dir","ASC");
	}	
}
$data['order_by_dir'] = XT::getSessionValue("order_by_dir");

if(XT::getValue("client_filter") || XT::getValue("client_filter") == 0) {
	XT::setSessionValue("client_filter",XT::getValue("client_filter"));
	
}else{
	if (XT::getSessionValue("client_filter") == "") {
		XT::setSessionValue("client_filter","0");
	}	
}
$data['client_filter'] = XT::getSessionValue("client_filter");

// Get all clients for all my tickets
$sql_all_clients = "SELECT DISTINCT
       client_id
    FROM
        " . XT::getTable('tickets') . "
	WHERE 
		status=0";
$result_all_clients = XT::query($sql_all_clients,__FILE__,__LINE__);
while($row_all_clients = $result_all_clients->fetchRow()) {
	$data['all_clients'][] = $row_all_clients['client_id'];
}

$sql = "SELECT
       *
    FROM
        " . XT::getTable('tickets') . "
	WHERE 
		status=0";
if ($data['client_filter'] > 0) {
	$sql .= " AND client_id=". $data['client_filter'];
}
XT::enableAdminNavigator('tickets','id',$sql);
$result = XT::query($sql . "
    ORDER BY
        " . $data['order_by'] . " " . $data['order_by_dir'] . "
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);
while($row = $result->fetchRow()) {
	$data['data_worker'][] = $row;
}
// Assign the whole data
XT::assign("xt" . XT::getBaseID() . "_admin", $data);

// Render the template
$content = XT::build('list.tpl');
?>