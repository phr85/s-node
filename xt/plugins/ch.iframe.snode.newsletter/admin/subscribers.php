<?php
XT::loadClass("ordering.class.php","ch.iframe.snode.core");
$order = new XT_Order("id,s.email,name","s.email");
$order->setListener("sort","sortby");

// Get category id
if(XT::getValue('scategory_id_') != '') {
    $category_id =  XT::getValue('scategory_id_');
} else {
    $category_id = 0;
}

$category_id != '' ? XT::setSessionValue('scategory_id',$category_id) : $category_id = XT::getSessionValue('scategory_id');

XT::enableAdminCharFilter('s.email');

// Add buttons
XT::addImageButton('Add subscriber','addSubscriber','default','add.png','0','slave1');
//XT::addImageButton('Import','import','default','import1.png','0','slave1');
XT::addImageButton('Export','exportCsv','default','import2.png','1');

// Get all categories
$result = XT::query("
    SELECT
        id,
        title
    FROM
        " . XT::getDatabasePrefix() . "newsletter_categories
    ORDER BY title ASC
",__FILE__,__LINE__);

$categories = array();
while($row = $result->FetchRow()){
    $categories[] = $row;
}

XT::assign("CATEGORIES", $categories);

if (XT::getValue('lang') != "") {
    if ($category_id > 0) {
        $langfilter = "AND s.lang='" . XT::getValue('lang') . "' ";
    } else {
        $langfilter = "WHERE s.lang='" . XT::getValue('lang') . "' ";
        $langwhere = true;
    }
}


// Set category filter
$category_filter = '';
if($category_id > 0){
    $category_filter = ' WHERE  sc.category_id = \'' . $category_id . '\'' . XT::getAdminCharFilter('AND');
}else{
    $category_filter = XT::getAdminCharFilter();
}




$addrfilter = XT::getValue("addrfilter");
XT::assign("ADDRFILTER",$addrfilter );
if($addrfilter != ""){
	if($category_filter =="" &&  !$langwhere ){
	$addressfilter = " WHERE email like '%{$addrfilter}%'";
	} else {
		$addressfilter = " AND email like '%{$addrfilter}%'";
	}
}


if($category_filter ==""){
    // Enable navigator
    XT::enableAdminNavigator('','',"
    SELECT DISTINCT count(s.id)  as count_id FROM " . XT::getTable('newsletter_subscriptions') . " as s "  . $category_filter . $langfilter . $addressfilter);

    // Get all subscribers
    $result = XT::query("SELECT DISTINCT s.*  FROM " . XT::getTable('newsletter_subscriptions') . " as s
    " . $langfilter . $addressfilter .  $order->get()  . "
    LIMIT " . XT::getAdminNavigatorLimit() . "
",__FILE__,__LINE__);

}else{
    // Enable navigator
    XT::enableAdminNavigator('','',"
    SELECT DISTINCT count(s.id)  as count_id FROM " . XT::getTable('newsletter_subscriptions') . " as s
    LEFT JOIN " . XT::getTable('newsletter_subscr2cat') . " as sc on(sc.subscription_id = s.id)
    " . $category_filter . "");

    // Get all subscribers
    $result = XT::query("SELECT DISTINCT s.*  FROM " . XT::getTable('newsletter_subscriptions') . " as s
    LEFT JOIN " . XT::getTable('newsletter_subscr2cat') . " as sc on(sc.subscription_id = s.id)
    " . $category_filter . $langfilter . $addressfilter .  $order->get()  . "
    LIMIT " . XT::getAdminNavigatorLimit() . "
",__FILE__,__LINE__);
}



XT::assign("SUBSCRIBERS", XT::getQueryData($result));
XT::assign("ACTIVE_CATEGORY", $category_id);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", XT::getValue('lang') );
$content = XT::build('subscribers.tpl');

?>