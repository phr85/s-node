<?php
// Parameter :: Style
$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';

header('content-type: text/xml; charset=utf-8');
 
function getAddressIdByUserId($user_id) {
		$result = XT::query("SELECT * FROM " .  XT::getDatabasePrefix() . "addresses WHERE user_id=" . $user_id,__FILE__,__LINE__);
		if($row = $result->FetchRow()){
			return $row['id'];
		} else {
			return false;
		}
}

$result = XT::query("SELECT
       *
    FROM
        " . XT::getTable('tickets') . "
	WHERE 
		worker=" . XT::getUserId() . " and status < 4 and status != 0 
    ORDER BY
        date ASC
    ",__FILE__,__LINE__);
while($row = $result->fetchRow()) {
	$row['supervisor_address'] = getAddressIdByUserId($row['supervisor']);
	$data['data'][] = $row;
}

$data['taget_tpl'] = 8100;

// Assign the whole data
XT::assign("xt" . XT::getBaseID() . "_rss", $data);

// Render the template
$content = XT::build($style);
?>