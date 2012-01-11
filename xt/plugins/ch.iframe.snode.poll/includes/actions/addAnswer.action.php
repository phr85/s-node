<?php

xt::call('savePoll');

// Determine next position
$position = XT::getQueryData(XT::query("
		SELECT
			max(position)+1 as pos
		FROM
       		" . XT::getTable('answers') . " 
		WHERE
			poll_id =  " . XT::getValue('id') . "  "
			));
			
			
// Overwrite Array with Value
if ($position[0]["pos"] == ""){
	$position = 1;
}else{
	$position = $position[0]["pos"];
};
			
// Add a new Poll option
XT::query("
    INSERT INTO 
        " . XT::getTable('answers') . " 
    (
        poll_id,
        lang,
        position
    ) VALUES (
        " . XT::getValue('id') . ", 
        '" . xt::getActiveLang() . "',
        " . $position . "
    )",__FILE__,__LINE__);

$id = xt::getValue('id');

XT::setValue("id", $row['maxid']);
XT::setValue("id", $id);
XT::setAdminModule("edit");

?>