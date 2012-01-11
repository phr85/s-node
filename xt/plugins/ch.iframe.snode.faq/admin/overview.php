<?php
XT::loadClass("ordering.class.php","ch.iframe.snode.core");

$order = new XT_Order("date,id,title","id",-1,"overview");

$order->setListener("sort","sortby");

XT::enableAdminNavigator('faq','',"
    SELECT
        count(id) as count_id
    FROM
        " . XT::getTable('faq') . "
    WHERE
        lang = '" . XT::getActiveLang() . "'
");

if(XT::getPermission('administrator')){
    // Buttons
    XT::addImageButton("Add FAQ entry", "addFaq","default","document_new.png",0,"slave1");
}

// Get category id
if(XT::getValue('scategory_id_') != '') {
	$category_id =  XT::getValue('scategory_id_');
} else {
	$category_id = 0;
}

if ($category_id == 0){
	// SQL query to execute if there is no category filtering selected
	$result = XT::query("
	    SELECT
	       *
	    FROM
	        " . XT::getTable('faq') . "
	    WHERE
	        lang = '" . XT::getActiveLang() . "'
	    " . $order->get() . "
	    LIMIT
	        " . $GLOBALS['plugin']->getLimiter() . "
	    ",__FILE__,__LINE__);
}else{
	// SQL query to execute if there is no category filtering selected
	$result = XT::query("
	    SELECT
	       *
	    FROM
	        " . XT::getTable('faq') . " as faq LEFT JOIN
	        " . XT::getTable('faq2cat') . " as faq2cat ON (faq.id = faq2cat.faq_id)
	    WHERE
	        lang = '" . XT::getActiveLang() . "'
	    AND
	        faq2cat.cat_id = " . $category_id . "
	    " . $order->get() . "
	    LIMIT
	        " . $GLOBALS['plugin']->getLimiter() . "
	    ",__FILE__,__LINE__);
}

$data = array();
while($row = $result->FetchRow()){
    $data[] = $row;
}

XT::assign("xt" . XT::getBaseID() . "_ACTIVE_CATEGORY", $category_id);
XT::assign("xt" . XT::getBaseID() . "_CATEGORIES", $categories);
XT::assign("xt" . XT::getBaseID() . "_DATA", $data);
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build("overview.tpl");
?>