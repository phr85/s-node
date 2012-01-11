<?php

XT::setBaseID(5300);

XT::addTab('o','Overview','overview.php',true,true);
XT::addTab('c','Categories','categories.php',false,true);
XT::addTab('u','Unsubscribed','unsubscribed.php',false,true);
XT::addTab('s','Subscribers','subscribers.php',false,true);
XT::addTab('import','import','import.php',false,true);
XT::addTab('update','update','update.php',false,true);
XT::addTab('slave1','Slave1','slave1.php',false,false);
XT::addTab('stats','Statistics','stats.php',false,true);
XT::addTab('e','Edit','edit.php',false,false);
XT::addTab('ec','Edit category','editCategory.php',false,false);
XT::addTab('es','Edit subscriber','editSubscriber.php',false,false);

XT::addTable('newsletter');
XT::addTable('newsletter_chapters');
XT::addTable('newsletter_categories');
XT::addTable('newsletter_newsl2cat');
XT::addTable('newsletter_subscr2cat');
XT::addTable('newsletter_subscriptions');
XT::addTable('newsletter_unsubscribed');
XT::addTable('newsletter_queue');
XT::addTable('newsletter_sent');
XT::addTable('newsletter_views');
XT::addTable('relations');
XT::addTable('files');
XT::addTable('files_rel');

XT::addConfig("image_picker_base_id", 240);
XT::addConfig("image_picker_tpl", 597);

XT::addConfig("inform_subscriptions",false);


XT::addConfig("individual_mails", true);

XT::addConfig("batched_mode", true);

XT::addConfig("max_emails_per_cycle", 25); // Anzahl mails pro durchlauf

XT::addConfig("max_timeout", ini_get('max_execution_time')); // Die maximale Ausführungszeit

XT::addConfig("sleep_per_cycle", 500000); // usleep — Programm-Verzögerung in Mikrosekunden

// TODO: Implement permissions (actions)
XT::enablePermissions();

$display = array();

// relations
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.relations.zl")){
    $display['relations'] = true;
}

// properties
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.properties.zl")){
    $display['properties'] = true;
}


XT::assign("DISPLAY",$display);

?>
