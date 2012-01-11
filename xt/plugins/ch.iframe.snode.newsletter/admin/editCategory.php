<?php

// Add buttons
XT::addImageButton('Save','saveCategory','default','disk_blue.png','0','slave1','s');

// Get newsletter id
if(is_numeric(XT::getValue("category_id"))){
    XT::setSessionValue("category_id", XT::getValue("category_id"));
}
$category_id = XT::getSessionValue('category_id');

if($category_id > 0){
    
    // Get newsletter details
    $result = XT::query("
        SELECT
            a.id,
            a.title,
            a.description,
            a.subscriber_count
        FROM
            " . XT::getDatabasePrefix() . "newsletter_categories as a
        WHERE
            id = " . $category_id . "
    ",__FILE__,__LINE__);
    
    $category = array();
    while($row = $result->FetchRow()){
        $category = $row;
    }
    
    XT::assign("CATEGORY", $category);

    
    
    
    
    
// Get all subscribers
$result = XT::query("SELECT DISTINCT s.*  FROM " . XT::getTable('newsletter_subscriptions') . " as s
    LEFT JOIN " . XT::getTable('newsletter_subscr2cat') . " as sc on(sc.subscription_id = s.id)
    WHERE sc.category_id =" . $category_id . "
    ORDER BY
        s.creation_date DESC 
   limit 15
",__FILE__,__LINE__);


XT::assign("SUBSCRIBERS", XT::getQueryData($result));

}

$content = XT::build('editCategory.tpl');

?>