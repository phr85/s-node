<?php
XT::addImageButton('save','saveSubscriber','default','save.png','edit');

 // Get categories
    $result = XT::query("SELECT n.id, n.title, floor(nc.category_id / n.id) as selected 
    FROM " . XT::getTable("newsletter_categories") . " as n 
    left join " . XT::getTable("newsletter_subscr2cat") . " as nc on (nc.category_id = n.id AND nc.subscription_id=" . XT::getValue('subscriber_id') . ") 
    ORDER BY n.title ASC",__FILE__,__LINE__);
    
    XT::assign("CATEGORIES", XT::getQueryData($result));
    
    
    
$result = XT::query("
    SELECT
        *
    FROM
        " . XT::getDatabasePrefix() . "newsletter_subscriptions
    WHERE
        id=" . XT::getValue('subscriber_id')
,__FILE__,__LINE__);

XT::assign("SUBSCRIBER", $result->fetchRow());
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
$content = XT::build("editSubscriptor.tpl");
?>