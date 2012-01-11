<?php


if($_REQUEST['form'] !=""){
XT::setValue('form',$_REQUEST['form']);
}
XT::assign('FORM',XT::autoval('form',"R"));


if($_REQUEST['field'] !=""){
XT::setValue('field',$_REQUEST['field']);
}
XT::assign('field',XT::autoval('field',"R"));

if(XT::getSessionValue("titlefield")!=""){
XT::assign('TITLEFIELD',$_REQUEST['titlefield']);
}else {
	XT::assign('TITLEFIELD',XT::getSessionValue("field") . '_title');
}

// Filtertypes:
// -2 = Undefined, -1 All, 1 Firm, 2 Department, 3 Person
$filtertype = XT::autoval('filtertype',"R",-1);

// Get countries
$result = XT::query("
    SELECT
        country,
        name
    FROM
        " . XT::getTable('countries') . "
    ORDER BY
        name ASC
",__FILE__,__LINE__);

XT::assign("COUNTRIES",XT::getQueryData($result));
$countryfilter = '';
if(XT::getValue('country') != ''){
	if($filtertype == '-1'){
	$countryfilter = " country='" . XT::getValue("country") . "'";
	}else {
		$countryfilter = " AND country='" . XT::getValue("country") . "'";
	}
	XT::assign("COUNTRYSELECTED",XT::getValue("country"));
}


// Handle search
$search = '';
if(XT::getValue('search') != ''){
    if(is_numeric(XT::getValue('search'))){
        if($filtertype == '-1' && $countryfilter !=''){
        	$search = " AND id = '" . XT::getValue('search') . "'";	
        }else {
        	$search = " id = '" . XT::getValue('search') . "'";
        }
    	
    } else {
    	if($filtertype == '-1' && $countryfilter !=''){
        	$search = " AND " . XT::getValue('search_field') . " LIKE '%" . XT::getValue('search') . "%'";
    	}else {
    		$search = " " . XT::getValue('search_field') . " LIKE '%" . XT::getValue('search') . "%'";
    	}
    }
    XT::assign("SEARCHTERM",XT::getValue('search'));
    XT::assign("SEARCHFIELD",XT::getValue('search_field'));
}


XT::loadClass("ordering.class.php","ch.iframe.snode.core");
$order = new XT_Order("id,title","title",1,"title");
$order->setListener("sort","sortby");

$orderwithand = 'WHERE';
if ($filtertype != -1){
	$filtertype_sql = "WHERE";
}

if($filtertype == -2){
	    $filtertype_sql = " WHERE type=0 " . $countryfilter . $search;
	    $orderwithand = 'AND';
}
if($filtertype == -1 && ($search !='' || $countryfilter !='')){
	    $filtertype_sql = " WHERE " . $countryfilter . $search;
	    $orderwithand = 'AND';
	
}
if($filtertype >= 0){
    $filtertype_sql = " WHERE type=" . $filtertype  . $countryfilter . $search . " ";
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



$content = XT::build('overview.tpl');

?>