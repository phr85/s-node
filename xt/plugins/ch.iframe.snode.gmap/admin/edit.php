<?php
XT::addImageButton('Save','saveGmap','default','disk_blue.png','0','slave1','s');
$result = XT::query("SELECT * FROM " . XT::getTable("gmap") . " WHERE id = " . XT::getValue("id"),__FILE__,__LINE__);
$rset = XT::getQueryData($result);
$data['gmap'] = $rset[0];

XT::assign("DATA",$data);

$content = XT::build('edit.tpl');

?>