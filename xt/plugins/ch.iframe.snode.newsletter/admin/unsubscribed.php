<?php
XT::loadClass("ordering.class.php","ch.iframe.snode.core");
$order = new XT_Order("s.id,s.email","s.email",1,"unsubscribe");
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


// Set category filter
$category_filter = '';
if($category_id > 0){
    $category_filter = ' WHERE  sc.category_id = \'' . $category_id . '\'' . XT::getAdminCharFilter('AND');
}else{
    $category_filter = XT::getAdminCharFilter();
}

if($category_filter ==""){
     // Enable navigator
    XT::enableAdminNavigator('','',"
    SELECT DISTINCT count(s.id)  as count_id FROM " . XT::getTable('newsletter_subscriptions') . " as s
    INNER JOIN " . XT::getTable('newsletter_unsubscribed') . " as sc on(sc.subscription_id = s.id)");

   // Get all subscribers
    $result = XT::query("SELECT DISTINCT s.*  FROM " . XT::getTable('newsletter_subscriptions') . " as s
    INNER JOIN " . XT::getTable('newsletter_unsubscribed') . " as sc on(sc.subscription_id = s.id)
    " . $langfilter .  $order->get()  . "
    LIMIT " . XT::getAdminNavigatorLimit() . "
",__FILE__,__LINE__);

}else{

   // Enable navigator
    XT::enableAdminNavigator('','',"
    SELECT DISTINCT count(s.id)  as count_id FROM " . XT::getTable('newsletter_subscriptions') . " as s
    INNER JOIN " . XT::getTable('newsletter_unsubscribed') . " as sc on(sc.subscription_id = s.id)
    " . $category_filter . "");

    // Get all subscribers
    $result = XT::query("SELECT DISTINCT s.*  FROM " . XT::getTable('newsletter_subscriptions') . " as s
    INNER JOIN " . XT::getTable('newsletter_unsubscribed') . " as sc on(sc.subscription_id = s.id)
    " . $category_filter . $langfilter .  $order->get()  . "
    LIMIT " . XT::getAdminNavigatorLimit() . "
",__FILE__,__LINE__);
}

XT::assign("SUBSCRIBERS", XT::getQueryData($result));
XT::assign("ACTIVE_CATEGORY", $category_id);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", XT::getValue('lang') );
$content = XT::build('unsubscribed.tpl');

?>