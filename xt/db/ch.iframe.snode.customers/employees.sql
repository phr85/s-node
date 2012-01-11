# MySQL-Front Dump 2.5
#
# Host: localhost   Database: xtreme
# --------------------------------------------------------
# Server version 4.1.11


#
# Table structure for table 'xt_employees'
#

DROP TABLE IF EXISTS `xt_employees`;
CREATE TABLE `xt_employees` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) unsigned default NULL,
  `firstName` varchar(255) collate latin1_general_ci default NULL,
  `lastName` varchar(255) collate latin1_general_ci default NULL,
  `email` varchar(255) collate latin1_general_ci default NULL,
  `active` tinyint(1) unsigned default '0',
  `position` varchar(255) collate latin1_general_ci default NULL,
  `birthday` int(11) unsigned default NULL,
  `social_nr` varchar(40) collate latin1_general_ci default NULL,
  `mobile` varchar(20) collate latin1_general_ci default NULL,
  `tel` varchar(20) collate latin1_general_ci default NULL,
  `street_nr` varchar(10) collate latin1_general_ci default NULL,
  `street` varchar(255) collate latin1_general_ci default NULL,
  `cityCode` varchar(5) collate latin1_general_ci default NULL,
  `city` varchar(255) collate latin1_general_ci default NULL,
  `image` int(11) unsigned default NULL,
  `image_version` int(11) unsigned default NULL,
  `facsimile` varchar(20) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Dumping data for table 'xt_employees'
#

INSERT INTO `xt_employees` (`id`, `user_id`, `firstName`, `lastName`, `email`, `active`, `position`, `birthday`, `social_nr`, `mobile`, `tel`, `street_nr`, `street`, `cityCode`, `city`, `image`, `image_version`, `facsimile`) VALUES("1", "1", "Rogedf", "Dudlerdfasdfdasfsdf", "rdudler@iframe.ch", "0", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `xt_employees` (`id`, `user_id`, `firstName`, `lastName`, `email`, `active`, `position`, `birthday`, `social_nr`, `mobile`, `tel`, `street_nr`, `street`, `cityCode`, `city`, `image`, `image_version`, `facsimile`) VALUES("2", "2", "Rogerfadsf", "Dudlerdfasdfsdf", "vzaech@iframe.ch", "0", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `xt_employees` (`id`, `user_id`, `firstName`, `lastName`, `email`, `active`, `position`, `birthday`, `social_nr`, `mobile`, `tel`, `street_nr`, `street`, `cityCode`, `city`, `image`, `image_version`, `facsimile`) VALUES("4", NULL, "fasdfsdf", "dfasdfad", NULL, "0", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `xt_employees` (`id`, `user_id`, `firstName`, `lastName`, `email`, `active`, `position`, `birthday`, `social_nr`, `mobile`, `tel`, `street_nr`, `street`, `cityCode`, `city`, `image`, `image_version`, `facsimile`) VALUES("6", "12", "Veith", "Zäch", NULL, "0", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `xt_employees` (`id`, `user_id`, `firstName`, `lastName`, `email`, `active`, `position`, `birthday`, `social_nr`, `mobile`, `tel`, `street_nr`, `street`, `cityCode`, `city`, `image`, `image_version`, `facsimile`) VALUES("7", NULL, "Michael", "Jäger", NULL, "0", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
