<?php
//$GLOBALS['plugin']->setAdminModule('publish');
XT::setValue('encode',1);
XT::call("buildPackage");

$rev = Trim(system (BIN . "getrevsion.sh"));

$publis_date = time();
XT::query("
INSERT INTO
    " . XT::getTable("publish") .  " (publish_date,comment,revision,package) VALUES (" . $publis_date  . ",'" . XT::getValue("comment") .  "','" . $rev  . "','" . XT::getValue("package") .  "');
",__FILE__,__LINE__);


if (copy(PACKAGES . XT::getValue("package") . ".xtp", PUBLISHED_PACKAGES . XT::getValue("package") . "." . $rev  . ".xtp")){
	
}
system (BIN . "publish.sh " . XT::getValue("package") . "." . $rev  . ".xtp " . XT::getValue("package") . ".xtp")
?>
