CREATE TABLE `xt_rssreader_feeds` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `url` varchar(255) collate latin1_general_ci default NULL,
  `creation_date` int(11) unsigned default '0',
  `creation_user` int(11) unsigned default '0',
  `mod_date` int(11) unsigned default NULL,
  `mod_user` int(11) unsigned default NULL,
  `active` tinyint(1) unsigned default '0',
  `refresh_interval` int(11) default '60',
  `last_update` int(11) unsigned default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
