# MySQL-Front Dump 2.5
#
# Host: localhost   Database: xtreme
# --------------------------------------------------------
# Server version 4.1.10


#
# Table structure for table 'xt_banner'
#

DROP TABLE IF EXISTS `xt_banner`;
CREATE TABLE `xt_banner` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `customer_id` int(11) unsigned default NULL,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `image` int(11) unsigned default NULL,
  `image_version` varchar(10) collate latin1_general_ci default NULL,
  `active` tinyint(1) unsigned default '0',
  `description` varchar(255) collate latin1_general_ci default NULL,
  `link` varchar(255) collate latin1_general_ci default NULL,
  `code` text collate latin1_general_ci,
  `creation_date` int(11) unsigned default NULL,
  `creation_user` int(11) unsigned default NULL,
  `mod_date` int(11) unsigned default NULL,
  `mod_user` int(11) unsigned default NULL,
  `target` varchar(255) collate latin1_general_ci default '_blank',
  `priority` tinyint(3) unsigned default '1',
  `type` tinyint(2) default '1',
  `link_type` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_banner_clicks'
#

DROP TABLE IF EXISTS `xt_banner_clicks`;
CREATE TABLE `xt_banner_clicks` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `zone_id` int(11) unsigned default NULL,
  `session_id` varchar(40) collate latin1_general_ci default NULL,
  `call_date` int(11) unsigned default NULL,
  `referer` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_banner_views'
#

DROP TABLE IF EXISTS `xt_banner_views`;
CREATE TABLE `xt_banner_views` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `zone_id` int(11) unsigned default NULL,
  `session_id` varchar(40) collate latin1_general_ci default NULL,
  `call_date` int(11) unsigned default NULL,
  `referer` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_banner_zones'
#

DROP TABLE IF EXISTS `xt_banner_zones`;
CREATE TABLE `xt_banner_zones` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `width` int(11) unsigned default NULL,
  `height` int(11) unsigned default NULL,
  `creation_date` int(11) unsigned default NULL,
  `creation_user` int(11) unsigned default NULL,
  `mod_date` int(11) unsigned default NULL,
  `mod_user` int(11) unsigned default NULL,
  `description` varchar(255) collate latin1_general_ci default NULL,
  `type` tinyint(3) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_banner_zones_rel'
#

DROP TABLE IF EXISTS `xt_banner_zones_rel`;
CREATE TABLE `xt_banner_zones_rel` (
  `zone_id` int(11) unsigned default NULL,
  `banner_id` int(11) unsigned default NULL,
  `views` int(11) unsigned default '0',
  `clicks` int(11) unsigned default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

