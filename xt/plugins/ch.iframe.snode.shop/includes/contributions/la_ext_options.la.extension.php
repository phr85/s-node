<?php

XT::enableAdminCharFilter('d.title');
XT::enableAdminNavigator('', '',"SELECT count(a.id) as count_id FROM " . $GLOBALS['plugin']->getTable('articles') . " as a LEFT JOIN " . $GLOBALS['plugin']->getTable('articles_details') . " as d ON (a.id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "') " . $GLOBALS['plugin']->getCharFilter());
XT::loadClass("ordering.class.php","ch.iframe.snode.core");

$sorter = XT::getValue("sort");
switch ($sorter) {
	case "a.art_nr":
		XT::setValue("sortsub","art.art_nr");
		break;
    case "a.id":
        XT::setValue("sortsub","a.article_id");
        break;
    case "d.title":
        XT::setValue("sortsub","d.title");
        break;
	default:
		break;
}
$suborder = new XT_Order("a.article_id,art.art_nr,d.title","a.article_id",1,"extlist");
$suborder->setListener("sortsub","sortbysub");


$result = XT::query("
    SELECT
        a.article_id,
        a.gift,
        a.price,
        a.product_of_month,
        a.taxes
    FROM
        " . $GLOBALS['plugin']->getTable('price') . " as a,
        " . $GLOBALS['plugin']->getTable('articles_details') . " as d
        LEFT JOIN " . XT::getTable("articles") . " as art on d.id = art.id
    WHERE a.article_id = d.id AND d.lang='" . $GLOBALS['plugin']->getActiveLang() . "'
    " . $GLOBALS['plugin']->getCharFilter('AND') . "
    " . $suborder->get() . "
    LIMIT
        " . $GLOBALS['plugin']->getLimiter() . "
    ",__FILE__,__LINE__,0);

while($row = $result->FetchRow()){
    XT::assign("DATA", $row);
    $GLOBALS['plugin']->contribute("la_ext_options",$row['article_id'],  XT::buildContribution("la_ext_options.tpl"));
}

?>