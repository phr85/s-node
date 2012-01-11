<?php

XT::setBaseID(3600);

XT::addTable('forum_categories');
XT::addTable('forum_categories_details');
XT::addTable('forum_forums');
XT::addTable('forum_topics');
XT::addTable('forum_postings');
XT::addTable('forum_notification');
XT::addTable('forum_postings_alerts');
XT::addTable('user');
$GLOBALS['plugin']->addTable('files','files','Files', false);

XT::addConfig('postings_per_page', 8);

XT::addConfig('all_nodes_open',true);
XT::addConfig('nested_discussions',true);
XT::addConfig('public',true);

// autodeactivation of thread at x useralerts, 0 means no autodeactivation
XT::addConfig('bad_level', 3);

// autodeactivation of thread after inactivity time of x seconds
XT::addConfig('inactivitytime',0);
// new postings enabled or disabled?
XT::addConfig('activeposting',1);
XT::addConfig('allowedtags','<b> <p> <i> <strong> <a> <code> <pre>');
XT::addConfig('activepostingemail',"info@iframe.ch");


XT::addConfig('searchengine','forum'); // use false for global searchindex
XT::addConfig("searchindex",true); // Build index

// File upload dir
XT::addConfig('file_upload_dir', DATA_DIR . 'files/', 'The target folder for file uploads');
XT::addConfig('temp_file_upload_dir', ROOT_DIR . 'tmp/', 'The target folder for file uploads');
// upload to node (default is root node)
XT::addConfig('FileNode',15);

// Permission Manager Popup
$GLOBALS['plugin']->addConfig('node_manager_tpl', 110, 'Template ID for the node manager popup');
$GLOBALS['plugin']->addConfig('node_manager_base_id', 150, 'Template ID for the node manager popup');

$settings['categories']['TPL'] = 3600;
$settings['forum']['TPL'] = 3601;
$settings['forum']['new']['TPL'] = 3602;
$settings['topic']['TPL'] = 3603;
$settings['topic']['reply']['TPL'] = 3605;
$settings['topic']['new']['TPL'] = 3604;
$settings['topic']['alert']['TPL'] = 3607;

XT::addConfig('settings',$settings);
XT::assign('SETTINGS',$settings);

XT::addContentType(3601,'Forum Entry');
XT::addContentType(3602,'Forum Topic');
XT::addContentType(3603,'Forum');
XT::addContentType(3604,'Forum Category');

XT::addTab('o','Overview','overview.php',false,false);
XT::addTab('c','Categories','categories.php',true,true);
XT::addTab('ec','editCategories','editcategories.php',false,false);
XT::addTab('ef','editForum','editforum.php',false,false);
XT::addTab('p','Postings','postings.php',false,false);
XT::addTab('slave1','slave1','slave1.php',false,false);
XT::addTab('alerts','alerts','alerts.php',false,false);

XT::enablePermissions();

// relations
if(is_file(LICENCES_DIR . $GLOBALS["cfg"]->get("system","order_nr") . "_ch.iframe.snode.relations.zl")){
    $display['relations']=true;
}


XT::assign("DISPLAY",$display);


include_once('functions.inc.php')
?>