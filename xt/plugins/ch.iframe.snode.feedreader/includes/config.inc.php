<?php
XT::setBaseID(2300);

XT::addConfig('RSS_0.91', 'rss_091', 'Version string for RSS 0.91');
XT::addConfig('RSS_2.0' , 'rss_20' , 'Version string for RSS 2.0');
XT::addConfig('RSS_1.0' , 'rss_10' , 'Version string for RSS 1.0');
XT::addConfig('ATOM_0.3', 'atom_03', 'Version string for ATOM 0.3');
XT::addConfig('ATOM_1.0', 'atom_10', 'Version string for ATOM 1.0');
XT::addConfig('OPML_1.0', 'opml_10', 'Version string for OPML 1.0');
XT::addConfig('FEEDS_DIR', DATA_DIR . 'feeds/', 'Directory for feeds cache');
XT::addConfig('ITUNES_2.0', 'itunes_20', 'Version string for i-tunes friendly Podcast 2.0');

XT::addTable('feedreader_feeds');
XT::addTable('feedreader_feedcontainer');
XT::addTable('feedreader_rss_headers');

XT::addTab('o','Overview','overview.php',true,true);
XT::addTab('slave1','Slave1','slave1.php',false,false);
XT::addTab('e','Edit','edit.php',false,false);
XT::addTab('v','View','view.php',false,false);
XT::addTab('n','New','new.php',false,false);

XT::enablePermissions();

?>