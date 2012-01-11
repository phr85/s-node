<?php 
XT::addImageButton('Export data','exportAccounting','default','column-chart.png',1,'master');
// Clean the data array
$data = array();

if (XT::getValue("startdate_str") != "") {
	$data['startdate'] = XT::getValue("startdate_str");
} else {
	$data['startdate'] = date("d.m.Y", time() - ((60*60*24*7*4) + (60*60*24*7)));
}

if (XT::getValue("enddate_str") != "") {
	$data['enddate'] = XT::getValue("enddate_str");
} else {
	$data['enddate'] = date("d.m.Y", time());
}

// Assign the whole data
XT::assign("xt" . XT::getBaseID() . "_admin", $data);

// Render the template
$content = XT::build('accounting.tpl');
?>