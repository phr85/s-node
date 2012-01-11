<?php
XT::loadClass("ordering.class.php","ch.iframe.snode.core");
$order = new XT_Order("id,title","title",1,"title");
$order->setListener("sort","sortby");

// Filtertypes:
// -2 = Undefined, -1 All, 1 Firm, 2 Department, 3 Person
$filtertype = XT::autoval('filtertype',"R",-1);
$orderwithand = 'WHERE';
if ($filtertype != -1){
	$filtertype_sql = "WHERE";
}

if($filtertype == -2){
	    $filtertype_sql = " WHERE type=0 ";
	    $orderwithand = 'AND';
}

if($filtertype >= 0){
    $filtertype_sql = " WHERE type=" . $filtertype . " ";
    $orderwithand = 'AND';
}

XT::assign("FILTERTYPE",$filtertype);

XT::assign("ADDRESSTYPES",XT::getConfig("ADDRESSTYPES"));

/* TODO Filter für addressübersicht implementieren
XT::assign("PROPERTIEFILTER",XT::getConfig("PROPERTIEFILTER"));
*/


// Load address entity class
XT::loadClass('address.class.php','ch.iframe.snode.addresses');

// Enable Char filter and navigator
XT::enableAdminCharFilter('title');


XT::enableAdminNavigator('addresses','',"SELECT
        count(id) as count_id
    FROM
        " . XT::getTable('addresses') . $filtertype_sql);


// Get users list
$result = XT::query("
    SELECT
       *
    FROM
        " . XT::getTable('addresses') . " "
    . $filtertype_sql
    . XT::getAdminCharFilter($orderwithand)
      . " " . $order->get() . "
    LIMIT
        " . XT::getAdminNavigatorLimit() . "
    ",__FILE__,__LINE__);

while($row = $result->fetchRow()) {

	// Instantiate address entry
	$tmp = new XT_Address($row["id"]);

	$row["organisation_name"] = $tmp->getOrganization();
	$row["organizationalunit_name"] = $tmp->getorganizationalUnit();
	if ($row["user_id"] != "") {
		$row["user_name"]  = XT::getUserName($row["user_id"]);
	}
	//echo  "<pre>" . print_r($row,1) . "</pre>";
	$data[] = $row;
}
//echo "<pre>" . print_r($GLOBALS['plugin'],1) . "</pre>";
XT::assign("DATA",$data);
if (XT::getPermission("create")) {
	XT::addImageButton("add", "addAddress" ,"default","add.png","0","slave1","0");
    XT::addImageButton("export", "exportAddresses" ,"default","download.png","0");
}



$content = XT::build('overview.tpl');

?>