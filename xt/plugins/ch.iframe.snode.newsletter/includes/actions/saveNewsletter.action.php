<?php
$categories = XT::getValue('categories');
//delete old categories
XT::query("DELETE from " . XT::getTable('newsletter_newsl2cat') . " WHERE newsletter_id = " . XT::getValue('newsletter_id'),__FILE__,__LINE__);
// insert new categories
if(is_array($categories)){
    foreach ($categories as $val) {
        XT::query("INSERT into " . XT::getTable('newsletter_newsl2cat') . " ( `category_id`, `newsletter_id` )
	 values (  '" . $val . "',  '" . XT::getValue('newsletter_id') . "')",__FILE__,__LINE__);
    }
}

XT::query("
    UPDATE
        " . XT::getDatabasePrefix() . "newsletter
    SET
        title = '" . XT::getValue('title') . "',
        description = '" . XT::getValue('description') . "',
        image = '" . XT::getValue('image') . "',
        image_version = '" . XT::getValue('image_version') . "',
        content_html = '" . XT::getValue('content_html') . "',
        content_plain = '" . XT::getValue('content_plain') . "',
        sender_name = '" . XT::getValue('sender_name') . "',
        sender_email = '" . XT::getValue('sender_email') . "',
        template = '" . XT::getValue('template') . "',
        header = '" . XT::getValue('header') . "',
        header_plain = '" . XT::getValue('header_plain') . "',
        footer = '" . XT::getValue('footer') . "',
        footer_plain = '" . XT::getValue('footer_plain') . "',
        mod_date = '" . TIME . "',
        mod_user = '" . XT::getUserID() . "',
		lang = '" . XT::getValue('lang') . "'
    WHERE
        id = '" . XT::getValue('newsletter_id') . "'
",__FILE__,__LINE__);



// perform CHAPTER-Articles save operation
for ($i = 0; $i < XT::getValue('maxlevel'); $i++) {
    XT::query("
        UPDATE
            " . XT::getTable('newsletter_chapters') . "
        SET
            title = '" . XT::getValue('title'. $i) . "',
            subtitle = '" . XT::getValue('subtitle'. $i) . "',
            link = '" . XT::getValue('link'. $i) . "',
            maintext = '" . XT::getValue('maintext'. $i) . "',
            image = '" . XT::getValue('image'. $i) . "',
            image_version = '" . XT::getValue('image' . $i . '_version') . "'
        WHERE
            id = " . XT::getValue('newsletter_id') . " AND 
            level=" . ($i+1) ,__FILE__,__LINE__,0);
}

XT::setAdminModule('e');

?>
