<?php
// Select newsletter,chapters,categories with newsletter_id
$newsletter = XT::getQueryData(XT::query("Select * from " . XT::getDatabasePrefix() . "newsletter WHERE id=" . XT::getValue("newsletter_id"),__FILE__,__LINE__));
$newsletter_chapters = XT::getQueryData(XT::query("Select * from " . XT::getDatabasePrefix() . "newsletter_chapters WHERE id=" . XT::getValue("newsletter_id"),__FILE__,__LINE__));
$categories = XT::getQueryData(XT::query("Select * from " . XT::getDatabasePrefix() . "newsletter_newsl2cat WHERE newsletter_id=" . XT::getValue("newsletter_id"),__FILE__,__LINE__));

// insert

XT::query("
    INSERT into
        " . XT::getDatabasePrefix() . "newsletter
    SET
        title = 'copy: " . addslashes($newsletter[0]['title']) . "',
        description = '" . addslashes($newsletter[0]['description']) . "',
        image = '" . $newsletter[0]['image'] . "',
        image_version = '" . $newsletter[0]['image_version'] . "',
        content_html = '" . addslashes($newsletter[0]['content_html']) . "',
        content_plain = '" . addslashes($newsletter[0]['content_plain']) . "',
        sender_name = '" . addslashes($newsletter[0]['sender_name']) . "',
        sender_email = '" . $newsletter[0]['sender_email'] . "',
        template = '" . $newsletter[0]['template'] . "',
        comment = '" . addslashes($newsletter[0]['comment']) . "',
        header = '" . addslashes($newsletter[0]['header']) . "',
        header_plain = '" . addslashes($newsletter[0]['header_plain']) . "',
        footer = '" . addslashes($newsletter[0]['footer']) . "',
        footer_plain = '" . addslashes($newsletter[0]['footer_plain']) . "',
        mod_date = '" . TIME . "',
        mod_user = '" . XT::getUserID() . "',
		lang = '" . $newsletter[0]['lang'] . "'
",__FILE__,__LINE__);

$newid = XT::getQueryData(XT::query("SELECT id from  " . XT::getDatabasePrefix() . "newsletter Where mod_date=" . TIME . " AND mod_user=" .XT::getUserID(),__FILE__,__LINE__));
$newid = $newid[0]['id'];


// insert new categories
if(is_array($categories)){
    foreach ($categories as $val) {
        XT::query("INSERT into " . XT::getTable('newsletter_newsl2cat') . " ( `category_id`, `newsletter_id` )
	 values (  '" . $val['category_id'] . "',  '" . $newid . "')",__FILE__,__LINE__);
    }
}

if(is_array($newsletter_chapters)){
    foreach ($newsletter_chapters as $chapter) {


// perform CHAPTER-Articles save operation
    XT::query("
        INSERT into
            " . XT::getTable('newsletter_chapters') . "
        SET
            title = '" . addslashes($chapter['title']) . "',
            subtitle = '" . addslashes($chapter['subtitle']) . "',
            link = '" .  addslashes($chapter['link']) . "',
            maintext = '" .  addslashes($chapter['maintext']) . "',
            image = '" .  $chapter['image'] . "',
            image_version = '" .  $chapter['image_version'] . "',
            id = " . $newid . ",
            level=" . $chapter['level'] ,__FILE__,__LINE__,0);
    }
}

?>