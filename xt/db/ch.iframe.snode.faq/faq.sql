# MySQL-Front Dump 2.5
#
# Host: localhost   Database: xtreme
# --------------------------------------------------------
# Server version 4.1.10


#
# Table structure for table 'xt_faq'
#

DROP TABLE IF EXISTS `xt_faq`;
CREATE TABLE `xt_faq` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `views` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Dumping data for table 'xt_faq'
#

INSERT INTO `xt_faq` (`id`, `views`) VALUES("50", "0");
INSERT INTO `xt_faq` (`id`, `views`) VALUES("54", "0");
INSERT INTO `xt_faq` (`id`, `views`) VALUES("53", "0");
INSERT INTO `xt_faq` (`id`, `views`) VALUES("52", "0");
INSERT INTO `xt_faq` (`id`, `views`) VALUES("51", "0");
INSERT INTO `xt_faq` (`id`, `views`) VALUES("49", "0");
INSERT INTO `xt_faq` (`id`, `views`) VALUES("55", "0");
INSERT INTO `xt_faq` (`id`, `views`) VALUES("56", "0");
INSERT INTO `xt_faq` (`id`, `views`) VALUES("57", "0");


#
# Table structure for table 'xt_faq_details'
#

DROP TABLE IF EXISTS `xt_faq_details`;
CREATE TABLE `xt_faq_details` (
  `article_id` int(11) unsigned NOT NULL default '0',
  `title` varchar(255) collate latin1_general_ci default NULL,
  `question_detail` text collate latin1_general_ci,
  `keywords` varchar(255) collate latin1_general_ci default NULL,
  `creation_date` int(11) unsigned default NULL,
  `creation_user` int(11) unsigned default NULL,
  `mod_date` int(11) unsigned default NULL,
  `mod_user` int(11) unsigned default NULL,
  `answer` text collate latin1_general_ci,
  `lang` char(3) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`article_id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Dumping data for table 'xt_faq_details'
#

INSERT INTO `xt_faq_details` (`article_id`, `title`, `question_detail`, `keywords`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `answer`, `lang`) VALUES("49", "New article*", NULL, NULL, "1117617405", "1", NULL, NULL, NULL, "de");
INSERT INTO `xt_faq_details` (`article_id`, `title`, `question_detail`, `keywords`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `answer`, `lang`) VALUES("50", "New article*", NULL, NULL, "1117617519", "1", NULL, NULL, NULL, "de");
INSERT INTO `xt_faq_details` (`article_id`, `title`, `question_detail`, `keywords`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `answer`, `lang`) VALUES("51", "Was haben Sie gegen Tierversuche ?", "Just mach keine Tierversuche. Mich interessiert deshalb, wie Just sicherstellt, dass Ihre Produkte dennoch sicher sind.", NULL, "1117617564", "1", NULL, NULL, "Wir finden, dass Tierversuche nicht den eigentlich verfolgten Zweck, nämlich den Test der Verträglichkeit am Menschen, erreichen. Wir testen deswegen direkt an minderjährigen Somalis.", "de");
INSERT INTO `xt_faq_details` (`article_id`, `title`, `question_detail`, `keywords`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `answer`, `lang`) VALUES("52", "New article*", "asdfsd", NULL, "1117617764", "1", NULL, NULL, "fsdfasdfsdfsdf", "de");
INSERT INTO `xt_faq_details` (`article_id`, `title`, `question_detail`, `keywords`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `answer`, `lang`) VALUES("53", "New article*fasdfs", "dafsdfasdfsd", NULL, "1117618334", "1", NULL, NULL, "dafsdfasd", "de");
INSERT INTO `xt_faq_details` (`article_id`, `title`, `question_detail`, `keywords`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `answer`, `lang`) VALUES("54", "New article*sdfasdf23", "sadfsdf", NULL, "1117618559", "1", NULL, NULL, "asdfsdf", "de");
INSERT INTO `xt_faq_details` (`article_id`, `title`, `question_detail`, `keywords`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `answer`, `lang`) VALUES("55", "New article*dfasdasfasdfdsf", "fasdfsdf", NULL, "1117624358", "1", NULL, NULL, "dfasdfasdfsdfsdf", "de");
INSERT INTO `xt_faq_details` (`article_id`, `title`, `question_detail`, `keywords`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `answer`, `lang`) VALUES("56", "New article*", "dfsdf", NULL, "1117629117", "1", NULL, NULL, "sdffsdfsdf", "de");
INSERT INTO `xt_faq_details` (`article_id`, `title`, `question_detail`, `keywords`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `answer`, `lang`) VALUES("57", "New article*dafsdf", "asdfsdf", NULL, "1117629449", "1", NULL, NULL, "asdfsdfsdfsdfsdfasd\r\nfasdf\r\nsdfasdfasdfasdfsdf\r\nsdfsdfsdfsdfsdf\r\nsdfsdfsdfsdf", "de");


#
# Table structure for table 'xt_faq_rel'
#

DROP TABLE IF EXISTS `xt_faq_rel`;
CREATE TABLE `xt_faq_rel` (
  `node_id` int(11) unsigned default NULL,
  `article_id` int(11) unsigned default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Dumping data for table 'xt_faq_rel'
#

INSERT INTO `xt_faq_rel` (`node_id`, `article_id`) VALUES("34", "55");
INSERT INTO `xt_faq_rel` (`node_id`, `article_id`) VALUES("34", "51");
INSERT INTO `xt_faq_rel` (`node_id`, `article_id`) VALUES("33", "53");
INSERT INTO `xt_faq_rel` (`node_id`, `article_id`) VALUES("34", "56");
INSERT INTO `xt_faq_rel` (`node_id`, `article_id`) VALUES("34", "57");


#
# Table structure for table 'xt_faq_tree'
#

DROP TABLE IF EXISTS `xt_faq_tree`;
CREATE TABLE `xt_faq_tree` (
  `id` int(11) NOT NULL auto_increment,
  `l` int(11) NOT NULL default '0',
  `r` int(11) NOT NULL default '0',
  `pid` int(11) NOT NULL default '0',
  `level` int(11) NOT NULL default '0',
  `tree_id` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `l` (`l`),
  KEY `r` (`r`),
  KEY `level` (`level`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Dumping data for table 'xt_faq_tree'
#

INSERT INTO `xt_faq_tree` (`id`, `l`, `r`, `pid`, `level`, `tree_id`) VALUES("1", "1", "14", "0", "1", "0");
INSERT INTO `xt_faq_tree` (`id`, `l`, `r`, `pid`, `level`, `tree_id`) VALUES("2", "2", "3", "1", "2", "0");
INSERT INTO `xt_faq_tree` (`id`, `l`, `r`, `pid`, `level`, `tree_id`) VALUES("3", "4", "9", "1", "2", "0");
INSERT INTO `xt_faq_tree` (`id`, `l`, `r`, `pid`, `level`, `tree_id`) VALUES("27", "5", "8", "3", "3", "0");
INSERT INTO `xt_faq_tree` (`id`, `l`, `r`, `pid`, `level`, `tree_id`) VALUES("33", "10", "13", "1", "2", "0");
INSERT INTO `xt_faq_tree` (`id`, `l`, `r`, `pid`, `level`, `tree_id`) VALUES("34", "11", "12", "33", "3", "0");
INSERT INTO `xt_faq_tree` (`id`, `l`, `r`, `pid`, `level`, `tree_id`) VALUES("35", "6", "7", "27", "4", "0");


#
# Table structure for table 'xt_faq_tree_details'
#

DROP TABLE IF EXISTS `xt_faq_tree_details`;
CREATE TABLE `xt_faq_tree_details` (
  `node_id` int(11) NOT NULL auto_increment,
  `lang` char(3) collate latin1_general_ci NOT NULL default '',
  `creation_date` int(11) NOT NULL default '0',
  `creation_user` int(11) NOT NULL default '0',
  `mod_date` int(11) NOT NULL default '0',
  `mod_user` int(11) NOT NULL default '0',
  `description` varchar(255) collate latin1_general_ci NOT NULL default '',
  `title` varchar(255) collate latin1_general_ci NOT NULL default '',
  `active` tinyint(4) NOT NULL default '0',
  `download_count` int(11) unsigned NOT NULL default '0',
  `md5` varchar(32) collate latin1_general_ci NOT NULL default '',
  `isFolder` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`node_id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Dumping data for table 'xt_faq_tree_details'
#

INSERT INTO `xt_faq_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("2", "de", "0", "0", "0", "0", "0", "Dies ist ein Testfile", "1", "0", "", "0");
INSERT INTO `xt_faq_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("3", "de", "0", "0", "0", "0", "0", "Wichtige Dokumente", "1", "0", "", "1");
INSERT INTO `xt_faq_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("27", "de", "0", "0", "0", "0", "0", "asdfsdfasd", "1", "0", "", "1");
INSERT INTO `xt_faq_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("27", "fr", "0", "0", "0", "0", "", "asdfsdfasdf", "0", "0", "", "1");
INSERT INTO `xt_faq_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("33", "de", "0", "0", "0", "0", "asdfsdfsd", "Produktion", "1", "0", "", "1");
INSERT INTO `xt_faq_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("33", "fr", "0", "0", "0", "0", "", "", "0", "0", "", "1");
INSERT INTO `xt_faq_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("34", "fr", "0", "0", "0", "0", "", "", "0", "0", "", "1");
INSERT INTO `xt_faq_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("35", "de", "0", "0", "0", "0", "", "Testordner 2", "1", "0", "", "1");
INSERT INTO `xt_faq_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("35", "fr", "0", "0", "0", "0", "", "", "0", "0", "", "1");
INSERT INTO `xt_faq_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("34", "de", "0", "0", "0", "0", "asdfsdfasdfsdf", "Tierversuche", "1", "0", "", "1");
