<?php
if (XT::getValue("principal_id")){
	// check whether the addressmanager is installed
	if(is_file(PLUGIN_DIR . "ch.iframe.snode.addressmanager/package.xml")){
		$result = XT::query("
	        SELECT *
			FROM
			" . XT::getTable("addresses") . "
			WHERE
			user_id=" . XT::getValue("principal_id") . "
			",__FILE__,__LINE__,0);
			$row = $result->FetchRow();
			if (!is_array($row)){
				XT::addImageButton('Add to addresses','addToAddresses','default','vcard.gif','0','slave1','');
			}
	}

	$result = XT::query("
	        SELECT
	           usr.*

	        FROM
	            " . XT::getTable('users') . " as usr
	        WHERE
	           usr.id=" . XT::getValue("principal_id")
	,__FILE__,__LINE__,0);
	$user =  XT::getQueryData($result);
	XT::assign("USER", $user[0]);
	XT::assign("PRINCIPAL_ID", XT::getValue("principal_id"));
	$content = XT::build("s1Users.tpl");
} else {
	$content = XT::build("slave1.tpl");
}
?>
