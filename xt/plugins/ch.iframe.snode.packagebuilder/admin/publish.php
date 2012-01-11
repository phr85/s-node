<?php
foreach (glob(PLUGIN_DIR . '*') as $filename){
$plugins[] = basename($filename);
}
XT::addImageButton('[S] Publish package','publishPackage','default','check.png', 'publish','','s');
XT::assign('PRODUCTS',$plugins);
XT::assign('VALUES',XT::getValue('value'));

// Get installed packages
$result = XT::query("
    SELECT
       *
    FROM 
        " . XT::getTable('publish') . " 
    ORDER BY 
        publish_date DESC
	LIMIT 50
", __FILE__, __LINE__);

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}
XT::assign('LAST_PUBLISH',$data);
$content = XT::build('publish.tpl');
?>