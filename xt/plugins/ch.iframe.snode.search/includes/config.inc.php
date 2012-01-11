<?php

// Set Base id
$GLOBALS['plugin']->setBaseID(80);


// extend for "lang" sys
$GLOBALS['cfg']->addLanguage('sys', 'System');

// Tables
$GLOBALS['plugin']->addTable('search_notfound'    ,'search_notfound'    ,'searched Words not found', true);
$GLOBALS['plugin']->addTable('search_found'       ,'search_found'       ,'found', true);
$GLOBALS['plugin']->addTable('search_kw'          ,'search_keywords'    ,'keywords', true);
$GLOBALS['plugin']->addTable('search_nonwords'    ,'search_nonwords'    ,'nonwords', true);
$GLOBALS['plugin']->addTable('search_assoc_global','search_assoc_global','assocs', true);
$GLOBALS['plugin']->addTable('search_infos_global','search_infos_global','infos', true);
$GLOBALS['plugin']->addTable('content_types'      ,'content_types'      ,'Content types');

// Plugin config variables
$GLOBALS['plugin']->addConfig('userTrackerTPL'   , 117    , 'TPL from user Tracker');
$GLOBALS['plugin']->addConfig('userTrackerModule', 'ut'   , 'TPL from user Tracker');
$GLOBALS['plugin']->addConfig('userTrackerBaseID', 3000  , 'TPL from user Tracker');


if(XT::getPermission('view')){
    // Plugin admin tabs
    $GLOBALS['plugin']->addTab('o'   ,'Overview'             ,'overview.php'            ,true,true);
    $GLOBALS['plugin']->addTab('nf'  ,'Not found'            ,'notfound.php'            ,false,true);
    $GLOBALS['plugin']->addTab('ls'  ,'Last searched'        ,'lastsearched.php'        ,false,false);
    $GLOBALS['plugin']->addTab('ms'  ,'Most searched'        ,'mostsearched.php'        ,false,true);
    $GLOBALS['plugin']->addTab('mu'  ,'Most used'            ,'mostused.php'            ,false,false);
    $GLOBALS['plugin']->addTab('kw'  ,'Keywords'             ,'keywords.php'            ,false,true);
    if(XT::getPermission('nonwords')){
        $GLOBALS['plugin']->addTab('nw'  ,'Nonwords'             ,'nonwords.php'            ,false,true);
    }
    if(XT::getPermission('viewdetails')){
        $GLOBALS['plugin']->addTab('nfd' ,'Search Details'       ,'notfound_details.php'    ,false,false);
        $GLOBALS['plugin']->addTab('lsd' ,'Search Details'       ,'lastsearched_details.php',false,false);
    }
    $GLOBALS['plugin']->addTab('slave1' ,'Slave1'       ,'slave1.php',false,false);
}

$GLOBALS['plugin']->enablePermissions();

?>
