<?php 

$value = $_POST['rating'];

// What kind of content is going to be rated?
$content_type = XT::getParam("content_type","R");
$content_id = XT::getParam("content_id","R");

if ($content_id == "" OR $content_type == ""){
	$content_type = 0;
	$content_id = 0;
	echo XT::translate('Keine Content ID oder Content Type angegeben');
}

// Style
$style = XT::autoval("style","P","default.tpl");

// Select which current Value to display:
$result = XT::query("SELECT avg_total,voters_total FROM " . XT::getTable('ratings') . " WHERE content_id = " . $content_id . "");
$querydata = XT::getQueryData($result);


$curval = str_replace(",",".",$querydata[0]['avg_total']);
$data['curval'] = $curval;

$data['voters'] = $querydata[0]['voters_total'];

// Display results
XT::assign("xt" . XT::getBaseID() . "_viewer",$data);
XT::assign("xt" . XT::getBaseID() . "_rated",$value);

XT::assign("xt" . XT::getBaseID() . "_content_type",$content_type);
XT::assign("xt" . XT::getBaseID() . "_content_id",$content_id);

// build content
$content = XT::build($style);

?>