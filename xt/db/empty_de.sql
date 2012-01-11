# MySQL-Front Dump 2.5
#
# Host: localhost   Database: xtreme
# --------------------------------------------------------
# Server version 4.1.10


#
# Table structure for table 'xt_admin_navigation'
#

DROP TABLE IF EXISTS `xt_admin_navigation`;
CREATE TABLE `xt_admin_navigation` (
  `id` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL default '0',
  `tpl_id` int(11) NOT NULL default '0',
  `title` varchar(40) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_alerts'
#

DROP TABLE IF EXISTS `xt_alerts`;
CREATE TABLE `xt_alerts` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `query` varchar(255) collate latin1_general_ci default NULL,
  `result` varchar(255) collate latin1_general_ci default NULL,
  `mail` varchar(255) collate latin1_general_ci default NULL,
  `action` int(3) unsigned default '0',
  `script` varchar(255) collate latin1_general_ci default NULL,
  `mail_address` varchar(255) collate latin1_general_ci default NULL,
  `active` tinyint(3) unsigned default '0',
  `condition` varchar(20) collate latin1_general_ci default NULL,
  `field` varchar(255) collate latin1_general_ci default NULL,
  `description` varchar(255) collate latin1_general_ci NOT NULL default '',
  `creation_date` int(11) unsigned default NULL,
  `creation_user` int(11) unsigned default NULL,
  `mod_date` int(11) unsigned default NULL,
  `mod_user` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_areas'
#

DROP TABLE IF EXISTS `xt_areas`;
CREATE TABLE `xt_areas` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `employee_id` int(11) unsigned default NULL,
  `active` tinyint(1) unsigned default '0',
  `creation_date` int(11) unsigned default '0',
  `creation_user` int(11) unsigned default '0',
  `mod_date` int(11) unsigned default '0',
  `mod_user` int(11) unsigned default '0',
  `pos` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_articles'
#

DROP TABLE IF EXISTS `xt_articles`;
CREATE TABLE `xt_articles` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `active` tinyint(1) unsigned NOT NULL default '0',
  `title` varchar(255) collate latin1_general_ci default NULL,
  `subtitle` varchar(255) collate latin1_general_ci default NULL,
  `autor` varchar(40) collate latin1_general_ci default NULL,
  `introduction` text collate latin1_general_ci,
  `maintext` text collate latin1_general_ci,
  `time_active` tinyint(3) unsigned NOT NULL default '0',
  `time_start` int(11) unsigned default NULL,
  `time_end` int(11) unsigned default NULL,
  `time_r_active` tinyint(3) unsigned NOT NULL default '0',
  `time_r_monthdays` int(11) unsigned default NULL,
  `time_r_weekdays` int(11) unsigned default NULL,
  `time_r_months` int(11) unsigned default NULL,
  `time_r_start` int(11) unsigned default NULL,
  `time_r_end` int(11) unsigned default NULL,
  `creation_date` int(11) unsigned NOT NULL default '0',
  `creation_user` int(11) unsigned NOT NULL default '0',
  `mod_date` int(11) unsigned NOT NULL default '0',
  `mod_user` int(11) unsigned NOT NULL default '0',
  `image` int(11) unsigned default NULL,
  `image_version` varchar(11) collate latin1_general_ci default NULL,
  `image_link` varchar(255) collate latin1_general_ci default NULL,
  `image_link_target` varchar(20) collate latin1_general_ci default NULL,
  `image_zoom` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_articles_chapters'
#

DROP TABLE IF EXISTS `xt_articles_chapters`;
CREATE TABLE `xt_articles_chapters` (
  `id` int(11) unsigned NOT NULL default '0',
  `active` tinyint(1) unsigned NOT NULL default '0',
  `title` varchar(255) collate latin1_general_ci default NULL,
  `subtitle` varchar(255) collate latin1_general_ci default NULL,
  `maintext` text collate latin1_general_ci,
  `level` tinyint(3) unsigned NOT NULL default '1',
  `image` int(11) unsigned default NULL,
  `image_version` varchar(11) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`,`level`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



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
  `clicks` int(11) unsigned default '0',
  `active` tinyint(1) default '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_catalog_articles'
#

DROP TABLE IF EXISTS `xt_catalog_articles`;
CREATE TABLE `xt_catalog_articles` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `unit` int(10) unsigned default NULL,
  `quantity` float default NULL,
  `art_nr` varchar(100) collate latin1_general_ci default NULL,
  `active` tinyint(3) unsigned default '0',
  `edate` int(14) unsigned NOT NULL default '0',
  `cdate` int(14) unsigned NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_catalog_articles_details'
#

DROP TABLE IF EXISTS `xt_catalog_articles_details`;
CREATE TABLE `xt_catalog_articles_details` (
  `id` int(11) unsigned NOT NULL default '0',
  `lang` varchar(5) collate latin1_general_ci NOT NULL default '',
  `title` varchar(250) collate latin1_general_ci NOT NULL default '',
  `lead` text collate latin1_general_ci,
  `package` text collate latin1_general_ci,
  `active` tinyint(3) unsigned default NULL,
  UNIQUE KEY `id` (`id`,`lang`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_catalog_articles_fieldnames'
#

DROP TABLE IF EXISTS `xt_catalog_articles_fieldnames`;
CREATE TABLE `xt_catalog_articles_fieldnames` (
  `id` int(11) unsigned NOT NULL default '0',
  `lang` varchar(5) collate latin1_general_ci NOT NULL default '',
  `fieldname` varchar(30) collate latin1_general_ci NOT NULL default '0',
  `description` mediumtext collate latin1_general_ci,
  `position` int(11) unsigned default '1',
  PRIMARY KEY  (`id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_catalog_articles_fields'
#

DROP TABLE IF EXISTS `xt_catalog_articles_fields`;
CREATE TABLE `xt_catalog_articles_fields` (
  `article_id` int(11) unsigned NOT NULL default '0',
  `lang` varchar(5) collate latin1_general_ci NOT NULL default '',
  `fieldname_id` int(11) NOT NULL default '0',
  `value` blob,
  PRIMARY KEY  (`article_id`,`lang`,`fieldname_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_catalog_articles_images'
#

DROP TABLE IF EXISTS `xt_catalog_articles_images`;
CREATE TABLE `xt_catalog_articles_images` (
  `article_id` int(11) unsigned NOT NULL default '0',
  `image_id` int(11) unsigned NOT NULL default '0',
  `image_version` int(10) NOT NULL default '0',
  `is_main_image` tinyint(1) unsigned NOT NULL default '0',
  `position` int(11) NOT NULL default '0',
  PRIMARY KEY  (`article_id`,`position`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_catalog_articles_relations'
#

DROP TABLE IF EXISTS `xt_catalog_articles_relations`;
CREATE TABLE `xt_catalog_articles_relations` (
  `main_article_id` int(11) unsigned NOT NULL default '0',
  `article_id` int(11) unsigned NOT NULL default '0',
  `position` int(11) default NULL,
  PRIMARY KEY  (`article_id`,`main_article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_catalog_articles_set'
#

DROP TABLE IF EXISTS `xt_catalog_articles_set`;
CREATE TABLE `xt_catalog_articles_set` (
  `main_article_id` int(11) unsigned NOT NULL default '0',
  `article_id` int(11) unsigned NOT NULL default '0',
  `position` int(11) default NULL,
  PRIMARY KEY  (`article_id`,`main_article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_catalog_lexikon'
#

DROP TABLE IF EXISTS `xt_catalog_lexikon`;
CREATE TABLE `xt_catalog_lexikon` (
  `main_article_id` int(11) unsigned NOT NULL default '0',
  `article_id` int(11) unsigned NOT NULL default '0',
  `position` int(11) default NULL,
  `main` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`article_id`,`main_article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_catalog_tree'
#

DROP TABLE IF EXISTS `xt_catalog_tree`;
CREATE TABLE `xt_catalog_tree` (
  `id` int(11) NOT NULL auto_increment,
  `l` int(11) NOT NULL default '0',
  `r` int(11) NOT NULL default '0',
  `pid` int(11) NOT NULL default '0',
  `level` int(11) NOT NULL default '0',
  `tree_id` int(11) unsigned default '1',
  PRIMARY KEY  (`id`),
  KEY `l` (`l`),
  KEY `r` (`r`),
  KEY `level` (`level`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_catalog_tree_articles'
#

DROP TABLE IF EXISTS `xt_catalog_tree_articles`;
CREATE TABLE `xt_catalog_tree_articles` (
  `node_id` int(11) unsigned NOT NULL default '0',
  `article_id` int(11) unsigned NOT NULL default '0',
  `position` int(11) default NULL,
  PRIMARY KEY  (`article_id`,`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_catalog_tree_nodes'
#

DROP TABLE IF EXISTS `xt_catalog_tree_nodes`;
CREATE TABLE `xt_catalog_tree_nodes` (
  `node_id` int(11) unsigned NOT NULL default '0',
  `title` varchar(255) collate latin1_general_ci default NULL,
  `subtitle` varchar(255) collate latin1_general_ci default NULL,
  `description` tinyblob,
  `lang` char(3) collate latin1_general_ci NOT NULL default '',
  `use_description` tinyint(3) unsigned default '0',
  `public` tinyint(1) NOT NULL default '1',
  `active` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`node_id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_categories'
#

DROP TABLE IF EXISTS `xt_categories`;
CREATE TABLE `xt_categories` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `l` int(11) unsigned default NULL,
  `r` int(11) unsigned default NULL,
  `pid` int(11) unsigned default NULL,
  `level` int(11) unsigned default NULL,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `description` varchar(255) collate latin1_general_ci default NULL,
  `creation_date` int(11) unsigned default NULL,
  `creation_user` int(11) unsigned default NULL,
  `mod_date` int(11) unsigned default NULL,
  `mod_user` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `l` (`l`,`r`),
  KEY `l_2` (`l`,`r`,`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_categories_content'
#

DROP TABLE IF EXISTS `xt_categories_content`;
CREATE TABLE `xt_categories_content` (
  `cat_id` int(11) unsigned NOT NULL default '0',
  `content_id` int(11) unsigned NOT NULL default '0',
  `content_type` int(11) unsigned NOT NULL default '0',
  `title` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`cat_id`,`content_id`,`content_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_company_locations'
#

DROP TABLE IF EXISTS `xt_company_locations`;
CREATE TABLE `xt_company_locations` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `cityCode` varchar(10) collate latin1_general_ci default NULL,
  `city` varchar(255) collate latin1_general_ci default NULL,
  `street` varchar(255) collate latin1_general_ci default NULL,
  `street_nr` varchar(10) collate latin1_general_ci default NULL,
  `country` char(3) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_content_types'
#

DROP TABLE IF EXISTS `xt_content_types`;
CREATE TABLE `xt_content_types` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `open_url` varchar(255) collate latin1_general_ci default NULL,
  `content_table` varchar(255) collate latin1_general_ci NOT NULL default '',
  `title_field` varchar(255) collate latin1_general_ci NOT NULL default '',
  `icon` varchar(255) collate latin1_general_ci NOT NULL default '',
  `id_field` varchar(255) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_countries'
#

DROP TABLE IF EXISTS `xt_countries`;
CREATE TABLE `xt_countries` (
  `country` char(2) collate latin1_general_ci NOT NULL default '0',
  `name` varchar(50) collate latin1_general_ci default NULL,
  `continent` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`country`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='Ländertabelle';



#
# Table structure for table 'xt_countries_regions'
#

DROP TABLE IF EXISTS `xt_countries_regions`;
CREATE TABLE `xt_countries_regions` (
  `country` char(2) collate latin1_general_ci NOT NULL default '0',
  `region` char(2) collate latin1_general_ci NOT NULL default '',
  `name` varchar(50) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`country`,`region`),
  KEY `country` (`country`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_customers'
#

DROP TABLE IF EXISTS `xt_customers`;
CREATE TABLE `xt_customers` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `cnr` varchar(40) collate latin1_general_ci default NULL,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `creation_date` int(11) unsigned default '0',
  `creation_user` int(11) unsigned default '0',
  `mod_date` int(11) unsigned default '0',
  `mod_user` int(11) unsigned default '0',
  `active` tinyint(1) unsigned default '0',
  `city` varchar(255) collate latin1_general_ci default NULL,
  `postalCode` int(6) unsigned default NULL,
  `tel` varchar(20) collate latin1_general_ci default NULL,
  `facsimile` varchar(20) collate latin1_general_ci default NULL,
  `status` tinyint(2) unsigned default '0',
  `our_consultant` int(11) unsigned default NULL,
  `our_technician` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_customers_persons'
#

DROP TABLE IF EXISTS `xt_customers_persons`;
CREATE TABLE `xt_customers_persons` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `customer_id` int(11) unsigned default NULL,
  `firstName` varchar(255) collate latin1_general_ci default NULL,
  `lastName` varchar(255) collate latin1_general_ci default NULL,
  `position` varchar(255) collate latin1_general_ci default NULL,
  `active` tinyint(1) unsigned default '0',
  `email` varchar(255) collate latin1_general_ci default NULL,
  `street` varchar(255) collate latin1_general_ci default NULL,
  `street_nr` varchar(10) collate latin1_general_ci default NULL,
  `cityCode` varchar(6) collate latin1_general_ci default NULL,
  `city` varchar(255) collate latin1_general_ci default NULL,
  `cnr` varchar(100) collate latin1_general_ci default NULL,
  `user_id` int(11) unsigned default NULL,
  `shipping_firstName` varchar(255) collate latin1_general_ci default NULL,
  `shipping_lastName` varchar(255) collate latin1_general_ci default NULL,
  `shipping_street` varchar(255) collate latin1_general_ci default NULL,
  `shipping_street_nr` varchar(10) collate latin1_general_ci default NULL,
  `shipping_cityCode` varchar(255) collate latin1_general_ci default NULL,
  `shipping_city` varchar(255) collate latin1_general_ci default NULL,
  `email_type` tinyint(1) default '0',
  `anrede` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_dummy'
#

DROP TABLE IF EXISTS `xt_dummy`;
CREATE TABLE `xt_dummy` (
  `id` int(11) NOT NULL auto_increment,
  `l` int(11) default NULL,
  `r` int(11) default NULL,
  `pid` int(11) default NULL,
  `level` int(11) default NULL,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `active` int(1) default NULL,
  `creation_date` int(11) default NULL,
  `creation_user` int(11) default NULL,
  `mod_date` int(11) default NULL,
  `mod_user` int(11) default NULL,
  `isProfile` int(1) default NULL,
  `description` text collate latin1_general_ci,
  PRIMARY KEY  (`id`),
  KEY `l` (`l`),
  KEY `r` (`r`),
  KEY `pid` (`pid`),
  KEY `level` (`level`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



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
# Table structure for table 'xt_faq'
#

DROP TABLE IF EXISTS `xt_faq`;
CREATE TABLE `xt_faq` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `views` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



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
  `public` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`article_id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_faq_rel'
#

DROP TABLE IF EXISTS `xt_faq_rel`;
CREATE TABLE `xt_faq_rel` (
  `node_id` int(11) unsigned default NULL,
  `article_id` int(11) unsigned default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



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
  `public` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`node_id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_feed'
#

DROP TABLE IF EXISTS `xt_feed`;
CREATE TABLE `xt_feed` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `description` varchar(255) collate latin1_general_ci default NULL,
  `creation_date` int(11) unsigned default NULL,
  `creation_user` int(11) unsigned default NULL,
  `mod_date` int(11) unsigned default NULL,
  `mod_user` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_feed_auto'
#

DROP TABLE IF EXISTS `xt_feed_auto`;
CREATE TABLE `xt_feed_auto` (
  `feed_id` int(11) unsigned NOT NULL default '0',
  `cat_id` int(11) unsigned NOT NULL default '0',
  `content_type` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`feed_id`,`cat_id`,`content_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_feed_man'
#

DROP TABLE IF EXISTS `xt_feed_man`;
CREATE TABLE `xt_feed_man` (
  `cat_id` int(11) unsigned NOT NULL default '0',
  `content_id` int(11) unsigned NOT NULL default '0',
  `content_type` int(11) unsigned NOT NULL default '0',
  `title` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`cat_id`,`content_id`,`content_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_feed_types'
#

DROP TABLE IF EXISTS `xt_feed_types`;
CREATE TABLE `xt_feed_types` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `edit_url` varchar(255) collate latin1_general_ci default NULL,
  `preview_url` varchar(255) collate latin1_general_ci default NULL,
  `open_url` varchar(255) collate latin1_general_ci default NULL,
  `delete_url` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_files'
#

DROP TABLE IF EXISTS `xt_files`;
CREATE TABLE `xt_files` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `filesize` int(11) unsigned default NULL,
  `description` varchar(255) collate latin1_general_ci default NULL,
  `keywords` varchar(255) collate latin1_general_ci default NULL,
  `upload_date` int(11) unsigned NOT NULL default '0',
  `upload_user` int(11) unsigned NOT NULL default '0',
  `type` int(11) unsigned default '0',
  `width` int(11) unsigned default NULL,
  `height` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_files_rel'
#

DROP TABLE IF EXISTS `xt_files_rel`;
CREATE TABLE `xt_files_rel` (
  `node_id` int(11) unsigned default NULL,
  `file_id` int(11) unsigned default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_files_tree'
#

DROP TABLE IF EXISTS `xt_files_tree`;
CREATE TABLE `xt_files_tree` (
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
# Table structure for table 'xt_files_tree_details'
#

DROP TABLE IF EXISTS `xt_files_tree_details`;
CREATE TABLE `xt_files_tree_details` (
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
  `public` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`node_id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_files_versions'
#

DROP TABLE IF EXISTS `xt_files_versions`;
CREATE TABLE `xt_files_versions` (
  `file_id` int(11) unsigned default NULL,
  `version` int(11) unsigned default NULL,
  `width` int(11) unsigned default NULL,
  `height` int(11) unsigned default NULL,
  `filesize` int(11) unsigned default NULL,
  `type` tinyint(3) unsigned default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_filetypes'
#

DROP TABLE IF EXISTS `xt_filetypes`;
CREATE TABLE `xt_filetypes` (
  `id` int(11) NOT NULL auto_increment,
  `isImage` int(1) NOT NULL default '0',
  `extension` varchar(10) collate latin1_general_ci NOT NULL default '',
  `description` varchar(255) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_forms'
#

DROP TABLE IF EXISTS `xt_forms`;
CREATE TABLE `xt_forms` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `active` tinyint(1) unsigned default '0',
  `lang` char(3) collate latin1_general_ci default NULL,
  `layout` varchar(255) collate latin1_general_ci default NULL,
  `description` text collate latin1_general_ci,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_forms_actions'
#

DROP TABLE IF EXISTS `xt_forms_actions`;
CREATE TABLE `xt_forms_actions` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `form_id` int(11) unsigned default NULL,
  `type` int(11) unsigned default NULL,
  `value` varchar(255) collate latin1_general_ci default NULL,
  `pos` int(11) unsigned default NULL,
  `lang` char(3) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_forms_data'
#

DROP TABLE IF EXISTS `xt_forms_data`;
CREATE TABLE `xt_forms_data` (
  `fillout_id` int(11) unsigned default NULL,
  `element_id` int(11) unsigned default NULL,
  `element_value` text collate latin1_general_ci,
  `id` int(11) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_forms_elements'
#

DROP TABLE IF EXISTS `xt_forms_elements`;
CREATE TABLE `xt_forms_elements` (
  `element_id` int(11) unsigned NOT NULL auto_increment,
  `element_type` int(11) unsigned default NULL,
  `form_id` int(11) unsigned default NULL,
  `pos` int(11) unsigned default '0',
  `required` tinyint(1) unsigned default '0',
  `required_msg` varchar(255) collate latin1_general_ci default NULL,
  `active` tinyint(1) unsigned default '0',
  `description` varchar(255) collate latin1_general_ci default NULL,
  `datasource` int(11) unsigned default NULL,
  `datasource_type` int(11) unsigned default '0',
  `datasource_label_field` varchar(255) collate latin1_general_ci default NULL,
  `datasource_value_field` varchar(255) collate latin1_general_ci default NULL,
  `lang` char(3) collate latin1_general_ci default NULL,
  `label` varchar(255) collate latin1_general_ci default NULL,
  `default_value` varchar(255) collate latin1_general_ci default NULL,
  `datasource_query` text collate latin1_general_ci,
  `readonly` tinyint(1) unsigned NOT NULL default '0',
  `size` int(11) unsigned default NULL,
  `maxlength` int(11) unsigned default NULL,
  `params` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`element_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_forms_elements_rules'
#

DROP TABLE IF EXISTS `xt_forms_elements_rules`;
CREATE TABLE `xt_forms_elements_rules` (
  `form_id` int(11) unsigned NOT NULL default '0',
  `element_id` int(11) unsigned default NULL,
  `compare_query` varchar(255) collate latin1_general_ci default NULL,
  `compare_type` int(11) unsigned default NULL,
  `value_field` varchar(255) collate latin1_general_ci default NULL,
  `value_query` text collate latin1_general_ci,
  `value_type` int(11) unsigned default NULL,
  `value` varchar(255) collate latin1_general_ci default NULL,
  `title` varchar(255) collate latin1_general_ci NOT NULL default '',
  `id` int(11) unsigned NOT NULL auto_increment,
  `lang` char(3) collate latin1_general_ci NOT NULL default '',
  `error_msg` varchar(255) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_forms_elements_values'
#

DROP TABLE IF EXISTS `xt_forms_elements_values`;
CREATE TABLE `xt_forms_elements_values` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `element_id` int(11) unsigned default NULL,
  `label` varchar(255) collate latin1_general_ci default NULL,
  `value` varchar(255) collate latin1_general_ci default NULL,
  `pos` int(11) unsigned default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_forms_fillouts'
#

DROP TABLE IF EXISTS `xt_forms_fillouts`;
CREATE TABLE `xt_forms_fillouts` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `form_id` int(11) unsigned NOT NULL default '0',
  `session_id` varchar(40) collate latin1_general_ci default NULL,
  `start_date` int(11) unsigned default NULL,
  `submission_date` int(11) unsigned default '0',
  `referer` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_forms_scripts'
#

DROP TABLE IF EXISTS `xt_forms_scripts`;
CREATE TABLE `xt_forms_scripts` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `description` varchar(255) collate latin1_general_ci default NULL,
  `script` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_group_perms'
#

DROP TABLE IF EXISTS `xt_group_perms`;
CREATE TABLE `xt_group_perms` (
  `node_id` int(11) NOT NULL default '0',
  `group_id` int(11) NOT NULL default '0',
  `rights` int(11) NOT NULL default '0',
  `lang` char(3) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`node_id`,`group_id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_group_roles'
#

DROP TABLE IF EXISTS `xt_group_roles`;
CREATE TABLE `xt_group_roles` (
  `group_id` int(11) unsigned NOT NULL default '0',
  `role_id` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`role_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_groups'
#

DROP TABLE IF EXISTS `xt_groups`;
CREATE TABLE `xt_groups` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `maintainer` int(11) unsigned default NULL,
  `description` varchar(255) collate latin1_general_ci default NULL,
  `creation_date` int(11) unsigned default NULL,
  `creation_user` int(11) unsigned default NULL,
  `mod_date` int(11) unsigned default NULL,
  `mod_user` int(11) unsigned default NULL,
  `active` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_guestbook'
#

DROP TABLE IF EXISTS `xt_guestbook`;
CREATE TABLE `xt_guestbook` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `active` tinyint(1) unsigned NOT NULL default '0',
  `creation_date` int(11) unsigned NOT NULL default '0',
  `creation_user` int(11) unsigned NOT NULL default '0',
  `mod_date` int(11) unsigned NOT NULL default '0',
  `mod_user` int(11) unsigned NOT NULL default '0',
  `ip` varchar(15) collate latin1_general_ci NOT NULL default '0',
  `name` varchar(255) collate latin1_general_ci default NULL,
  `email` varchar(255) collate latin1_general_ci default NULL,
  `website` varchar(255) collate latin1_general_ci default NULL,
  `comment` text collate latin1_general_ci,
  `blockip` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_header_footer'
#

DROP TABLE IF EXISTS `xt_header_footer`;
CREATE TABLE `xt_header_footer` (
  `header` varchar(255) collate latin1_general_ci NOT NULL default '',
  `footer` varchar(255) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`header`,`footer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_i18n_untranslated'
#

DROP TABLE IF EXISTS `xt_i18n_untranslated`;
CREATE TABLE `xt_i18n_untranslated` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `word` varchar(255) collate latin1_general_ci default NULL,
  `lang` char(3) collate latin1_general_ci default NULL,
  `plugin` varchar(255) collate latin1_general_ci default NULL,
  `creation_date` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_ip_geo'
#

DROP TABLE IF EXISTS `xt_ip_geo`;
CREATE TABLE `xt_ip_geo` (
  `begin_num` int(11) unsigned NOT NULL default '0',
  `end_num` int(11) unsigned NOT NULL default '0',
  `country` char(2) collate latin1_general_ci default '0',
  PRIMARY KEY  (`end_num`,`begin_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='laender und IPs';



#
# Table structure for table 'xt_jobs'
#

DROP TABLE IF EXISTS `xt_jobs`;
CREATE TABLE `xt_jobs` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `subtitle` varchar(255) collate latin1_general_ci default NULL,
  `location_id` int(11) unsigned default NULL,
  `duration_type` tinyint(1) unsigned default '0',
  `duration` varchar(100) collate latin1_general_ci default NULL,
  `work_begin` int(11) unsigned default NULL,
  `deadline` int(11) unsigned default NULL,
  `job_id` varchar(20) collate latin1_general_ci default NULL,
  `description` text collate latin1_general_ci,
  `profile` text collate latin1_general_ci,
  `requirements` text collate latin1_general_ci,
  `advantages` text collate latin1_general_ci,
  `part_time` tinyint(3) unsigned default '0',
  `part_time_value` varchar(255) collate latin1_general_ci default NULL,
  `active` tinyint(1) unsigned default '0',
  `contact` text collate latin1_general_ci,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_jobs_categories'
#

DROP TABLE IF EXISTS `xt_jobs_categories`;
CREATE TABLE `xt_jobs_categories` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `l` int(11) unsigned default NULL,
  `r` int(11) unsigned default NULL,
  `pid` int(11) unsigned default NULL,
  `level` int(11) unsigned default NULL,
  `tree_id` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`),
  KEY `l` (`l`,`r`,`pid`,`level`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_jobs_categories_details'
#

DROP TABLE IF EXISTS `xt_jobs_categories_details`;
CREATE TABLE `xt_jobs_categories_details` (
  `node_id` int(11) unsigned default NULL,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `active` tinyint(1) unsigned default '0',
  `lang` char(3) collate latin1_general_ci default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_jobs_categories_rel'
#

DROP TABLE IF EXISTS `xt_jobs_categories_rel`;
CREATE TABLE `xt_jobs_categories_rel` (
  `job_id` int(11) unsigned default NULL,
  `category_id` int(11) unsigned default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_katalog_articles'
#

DROP TABLE IF EXISTS `xt_katalog_articles`;
CREATE TABLE `xt_katalog_articles` (
  `id` int(11) unsigned NOT NULL auto_increment,
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_katalog_articles_details'
#

DROP TABLE IF EXISTS `xt_katalog_articles_details`;
CREATE TABLE `xt_katalog_articles_details` (
  `id` int(11) unsigned NOT NULL default '0',
  `lang` char(5) collate latin1_general_ci NOT NULL default '',
  UNIQUE KEY `id` (`id`,`lang`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_languages'
#

DROP TABLE IF EXISTS `xt_languages`;
CREATE TABLE `xt_languages` (
  `id` char(3) collate latin1_general_ci default NULL,
  `title` varchar(255) collate latin1_general_ci default '0',
  `installed` tinyint(3) unsigned default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_languages_translations'
#

DROP TABLE IF EXISTS `xt_languages_translations`;
CREATE TABLE `xt_languages_translations` (
  `id` char(3) collate latin1_general_ci NOT NULL default '',
  `lang` char(3) collate latin1_general_ci NOT NULL default '',
  `title` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_lexikon_articles'
#

DROP TABLE IF EXISTS `xt_lexikon_articles`;
CREATE TABLE `xt_lexikon_articles` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `unit` int(10) unsigned default NULL,
  `quantity` float default NULL,
  `art_nr` varchar(100) collate latin1_general_ci default NULL,
  `active` tinyint(3) unsigned default '0',
  `edate` int(14) unsigned NOT NULL default '0',
  `cdate` int(14) unsigned NOT NULL default '0',
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_lexikon_articles_details'
#

DROP TABLE IF EXISTS `xt_lexikon_articles_details`;
CREATE TABLE `xt_lexikon_articles_details` (
  `id` int(11) unsigned NOT NULL default '0',
  `lang` varchar(5) collate latin1_general_ci NOT NULL default '',
  `title` varchar(250) collate latin1_general_ci NOT NULL default '',
  `lead` text collate latin1_general_ci,
  `package` text collate latin1_general_ci,
  `active` tinyint(3) unsigned default NULL,
  UNIQUE KEY `id` (`id`,`lang`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_lexikon_articles_fieldnames'
#

DROP TABLE IF EXISTS `xt_lexikon_articles_fieldnames`;
CREATE TABLE `xt_lexikon_articles_fieldnames` (
  `id` int(11) unsigned NOT NULL default '0',
  `lang` varchar(5) collate latin1_general_ci NOT NULL default '',
  `fieldname` varchar(30) collate latin1_general_ci NOT NULL default '0',
  `description` mediumtext collate latin1_general_ci,
  `position` int(11) unsigned default '1',
  PRIMARY KEY  (`id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_lexikon_articles_fields'
#

DROP TABLE IF EXISTS `xt_lexikon_articles_fields`;
CREATE TABLE `xt_lexikon_articles_fields` (
  `article_id` int(11) unsigned NOT NULL default '0',
  `lang` varchar(5) collate latin1_general_ci NOT NULL default '',
  `fieldname_id` int(11) NOT NULL default '0',
  `value` blob,
  PRIMARY KEY  (`article_id`,`lang`,`fieldname_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_lexikon_articles_images'
#

DROP TABLE IF EXISTS `xt_lexikon_articles_images`;
CREATE TABLE `xt_lexikon_articles_images` (
  `article_id` int(11) unsigned NOT NULL default '0',
  `image_id` int(11) unsigned NOT NULL default '0',
  `image_version` int(10) NOT NULL default '0',
  `is_main_image` tinyint(1) unsigned NOT NULL default '0',
  `position` int(11) NOT NULL default '0',
  PRIMARY KEY  (`article_id`,`position`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_lexikon_articles_relations'
#

DROP TABLE IF EXISTS `xt_lexikon_articles_relations`;
CREATE TABLE `xt_lexikon_articles_relations` (
  `main_article_id` int(11) unsigned NOT NULL default '0',
  `article_id` int(11) unsigned NOT NULL default '0',
  `position` int(11) default NULL,
  PRIMARY KEY  (`article_id`,`main_article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_lexikon_tree'
#

DROP TABLE IF EXISTS `xt_lexikon_tree`;
CREATE TABLE `xt_lexikon_tree` (
  `id` int(11) NOT NULL auto_increment,
  `l` int(11) NOT NULL default '0',
  `r` int(11) NOT NULL default '0',
  `pid` int(11) NOT NULL default '0',
  `level` int(11) NOT NULL default '0',
  `tree_id` int(11) unsigned default '1',
  PRIMARY KEY  (`id`),
  KEY `l` (`l`),
  KEY `r` (`r`),
  KEY `level` (`level`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_lexikon_tree_articles'
#

DROP TABLE IF EXISTS `xt_lexikon_tree_articles`;
CREATE TABLE `xt_lexikon_tree_articles` (
  `node_id` int(11) unsigned NOT NULL default '0',
  `article_id` int(11) unsigned NOT NULL default '0',
  `position` int(11) default NULL,
  PRIMARY KEY  (`article_id`,`node_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_lexikon_tree_nodes'
#

DROP TABLE IF EXISTS `xt_lexikon_tree_nodes`;
CREATE TABLE `xt_lexikon_tree_nodes` (
  `node_id` int(11) unsigned NOT NULL default '0',
  `title` varchar(255) collate latin1_general_ci default NULL,
  `subtitle` varchar(255) collate latin1_general_ci default NULL,
  `description` tinyblob,
  `lang` char(3) collate latin1_general_ci NOT NULL default '',
  `use_description` tinyint(3) unsigned default '0',
  `public` tinyint(1) unsigned NOT NULL default '1',
  `active` tinyint(1) unsigned NOT NULL default '1',
  PRIMARY KEY  (`node_id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_licenses'
#

DROP TABLE IF EXISTS `xt_licenses`;
CREATE TABLE `xt_licenses` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `product_id` int(11) unsigned default NULL,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `description` varchar(255) collate latin1_general_ci default NULL,
  `price` float(11,3) default '0.000',
  `licensing_date` int(11) unsigned default '0',
  `licensing_end_date` int(11) unsigned default '0',
  `duration` int(11) unsigned default NULL,
  `perpetual` tinyint(1) unsigned default '0',
  `update_duration` int(11) unsigned default NULL,
  `creation_date` int(11) unsigned default NULL,
  `creation_user` int(11) unsigned default NULL,
  `mod_date` int(11) unsigned default NULL,
  `mod_user` int(11) unsigned default NULL,
  `active` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_links'
#

DROP TABLE IF EXISTS `xt_links`;
CREATE TABLE `xt_links` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `image` int(11) default NULL,
  `image_version` int(11) unsigned default NULL,
  `description` tinytext collate latin1_general_ci,
  `link` varchar(255) collate latin1_general_ci default NULL,
  `creation_date` int(11) unsigned default NULL,
  `creation_user` int(11) unsigned default NULL,
  `mod_date` int(11) unsigned default NULL,
  `mod_user` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_log'
#

DROP TABLE IF EXISTS `xt_log`;
CREATE TABLE `xt_log` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `user_id` int(11) unsigned default NULL,
  `action` varchar(255) collate latin1_general_ci default NULL,
  `when` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_messages'
#

DROP TABLE IF EXISTS `xt_messages`;
CREATE TABLE `xt_messages` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `sender` int(11) unsigned default NULL,
  `subject` varchar(255) collate latin1_general_ci default NULL,
  `text` text collate latin1_general_ci,
  `priority` tinyint(3) unsigned default '0',
  `receiver` int(11) unsigned default NULL,
  `send_date` int(11) unsigned default '0',
  `read_date` int(11) unsigned default NULL,
  `deleted` tinyint(1) unsigned default '0',
  `message_flow` int(11) unsigned default '0',
  `parent_message` int(11) unsigned default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_messages_attachements'
#

DROP TABLE IF EXISTS `xt_messages_attachements`;
CREATE TABLE `xt_messages_attachements` (
  `msg_id` int(11) unsigned NOT NULL auto_increment,
  `file` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`msg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_modules'
#

DROP TABLE IF EXISTS `xt_modules`;
CREATE TABLE `xt_modules` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `package_id` int(10) unsigned NOT NULL default '0',
  `module` varchar(255) collate latin1_general_ci NOT NULL default '',
  `path` varchar(255) collate latin1_general_ci NOT NULL default '',
  `version` float unsigned NOT NULL default '0',
  `description` tinytext collate latin1_general_ci,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_modules_installed'
#

DROP TABLE IF EXISTS `xt_modules_installed`;
CREATE TABLE `xt_modules_installed` (
  `base_id` int(11) unsigned NOT NULL default '0',
  `module_id` int(11) unsigned NOT NULL default '0',
  `title` varchar(255) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`base_id`,`module_id`,`title`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_navigation'
#

DROP TABLE IF EXISTS `xt_navigation`;
CREATE TABLE `xt_navigation` (
  `id` int(11) NOT NULL auto_increment,
  `l` int(11) NOT NULL default '0',
  `r` int(11) NOT NULL default '0',
  `pid` int(11) NOT NULL default '0',
  `level` int(11) NOT NULL default '0',
  `title` varchar(255) collate latin1_general_ci NOT NULL default '',
  `isProfile` int(1) NOT NULL default '0',
  `tree_id` int(11) unsigned NOT NULL default '1',
  `active` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`id`),
  KEY `l` (`l`),
  KEY `r` (`r`),
  KEY `pid` (`pid`),
  KEY `level` (`level`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_navigation_details'
#

DROP TABLE IF EXISTS `xt_navigation_details`;
CREATE TABLE `xt_navigation_details` (
  `node_id` int(11) NOT NULL auto_increment,
  `lang` char(3) collate latin1_general_ci NOT NULL default '',
  `creation_date` int(11) NOT NULL default '0',
  `creation_user` int(11) NOT NULL default '0',
  `mod_date` int(11) NOT NULL default '0',
  `mod_user` int(11) NOT NULL default '0',
  `description` varchar(255) collate latin1_general_ci NOT NULL default '',
  `title` varchar(255) collate latin1_general_ci NOT NULL default '',
  `tpl_file` varchar(40) collate latin1_general_ci NOT NULL default '',
  `ext_link` varchar(255) collate latin1_general_ci NOT NULL default '',
  `target` varchar(20) collate latin1_general_ci NOT NULL default '',
  `active` tinyint(4) NOT NULL default '0',
  `live` tinyint(1) unsigned default '0',
  `public` tinyint(1) default '0',
  `cache` int(11) unsigned default '0',
  `keywords` tinytext collate latin1_general_ci,
  `copyright` varchar(255) collate latin1_general_ci default NULL,
  `author` varchar(255) collate latin1_general_ci default NULL,
  `halflife` int(11) unsigned default '0',
  `visitorexcept` int(11) unsigned default '0',
  `visitorexcept_mode` tinyint(1) unsigned default '0',
  `article_id` int(11) unsigned default '0',
  `charset` varchar(255) collate latin1_general_ci default NULL,
  `c_lang` varchar(10) collate latin1_general_ci default NULL,
  `article_layout` varchar(255) collate latin1_general_ci default NULL,
  `visible` tinyint(1) unsigned default '1',
  `image` int(11) unsigned default NULL,
  `image_version` int(11) unsigned default NULL,
  `show_in_overview` tinyint(1) unsigned default '1',
  PRIMARY KEY  (`node_id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_news'
#

DROP TABLE IF EXISTS `xt_news`;
CREATE TABLE `xt_news` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `active` tinyint(1) unsigned NOT NULL default '0',
  `title` varchar(255) collate latin1_general_ci default NULL,
  `subtitle` varchar(255) collate latin1_general_ci default NULL,
  `autor` varchar(40) collate latin1_general_ci default NULL,
  `introduction` text collate latin1_general_ci,
  `maintext` text collate latin1_general_ci,
  `time_active` tinyint(3) unsigned NOT NULL default '0',
  `time_start` int(11) unsigned default NULL,
  `time_end` int(11) unsigned default NULL,
  `time_r_active` tinyint(3) unsigned NOT NULL default '0',
  `time_r_monthdays` int(11) unsigned default NULL,
  `time_r_weekdays` int(11) unsigned default NULL,
  `time_r_months` int(11) unsigned default NULL,
  `time_r_start` int(11) unsigned default NULL,
  `time_r_end` int(11) unsigned default NULL,
  `creation_date` int(11) unsigned NOT NULL default '0',
  `creation_user` int(11) unsigned NOT NULL default '0',
  `mod_date` int(11) unsigned NOT NULL default '0',
  `mod_user` int(11) unsigned NOT NULL default '0',
  `image` int(11) unsigned default NULL,
  `image_version` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_news_archive'
#

DROP TABLE IF EXISTS `xt_news_archive`;
CREATE TABLE `xt_news_archive` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `active` tinyint(1) unsigned NOT NULL default '0',
  `title` varchar(255) collate latin1_general_ci default NULL,
  `subtitle` varchar(255) collate latin1_general_ci default NULL,
  `creation_date` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_news_chapters'
#

DROP TABLE IF EXISTS `xt_news_chapters`;
CREATE TABLE `xt_news_chapters` (
  `id` int(11) unsigned NOT NULL default '0',
  `active` tinyint(1) unsigned NOT NULL default '0',
  `title` varchar(255) collate latin1_general_ci default NULL,
  `subtitle` varchar(255) collate latin1_general_ci default NULL,
  `maintext` text collate latin1_general_ci,
  `level` tinyint(3) unsigned NOT NULL default '1',
  PRIMARY KEY  (`id`,`level`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_node_perms'
#

DROP TABLE IF EXISTS `xt_node_perms`;
CREATE TABLE `xt_node_perms` (
  `base_id` int(11) unsigned NOT NULL default '0',
  `node_id` int(11) unsigned NOT NULL default '0',
  `principal_id` int(11) unsigned NOT NULL default '0',
  `principal_type` tinyint(1) unsigned NOT NULL default '0',
  `tree` varchar(50) collate latin1_general_ci NOT NULL default '',
  `perms` int(11) unsigned default '0',
  `lang` char(3) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`base_id`,`node_id`,`tree`,`lang`,`principal_id`,`principal_type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_packages'
#

DROP TABLE IF EXISTS `xt_packages`;
CREATE TABLE `xt_packages` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `package` varchar(255) collate latin1_general_ci NOT NULL default '',
  `description` tinytext collate latin1_general_ci,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `version` int(11) unsigned NOT NULL default '0',
  `provider` varchar(255) collate latin1_general_ci NOT NULL default '',
  `repo_path` varchar(255) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `package` (`package`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_packages_installed'
#

DROP TABLE IF EXISTS `xt_packages_installed`;
CREATE TABLE `xt_packages_installed` (
  `base_id` int(11) unsigned default NULL,
  `package_id` int(11) unsigned default NULL,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `description` varchar(255) collate latin1_general_ci default NULL,
  `version` varchar(20) collate latin1_general_ci default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_perms'
#

DROP TABLE IF EXISTS `xt_perms`;
CREATE TABLE `xt_perms` (
  `base_id` int(11) unsigned NOT NULL default '0',
  `principal_id` int(11) unsigned NOT NULL default '0',
  `perms` int(11) unsigned NOT NULL default '0',
  `principal_type` tinyint(1) NOT NULL default '1',
  `lang` char(3) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`base_id`,`principal_id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_plugin_group_perms'
#

DROP TABLE IF EXISTS `xt_plugin_group_perms`;
CREATE TABLE `xt_plugin_group_perms` (
  `plugin_id` int(11) NOT NULL default '0',
  `group_id` int(11) NOT NULL default '0',
  `rights` int(11) NOT NULL default '0',
  PRIMARY KEY  (`plugin_id`,`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_plugin_user_perms'
#

DROP TABLE IF EXISTS `xt_plugin_user_perms`;
CREATE TABLE `xt_plugin_user_perms` (
  `plugin_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `rights` int(11) NOT NULL default '0',
  PRIMARY KEY  (`plugin_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_plugins'
#

DROP TABLE IF EXISTS `xt_plugins`;
CREATE TABLE `xt_plugins` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pluginid` int(10) unsigned NOT NULL default '0',
  `baseid` int(10) unsigned NOT NULL default '0',
  `module` int(10) unsigned NOT NULL default '0',
  `label` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_plugins_modfiles'
#

DROP TABLE IF EXISTS `xt_plugins_modfiles`;
CREATE TABLE `xt_plugins_modfiles` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `module` int(10) unsigned NOT NULL default '0',
  `filename` varchar(255) collate latin1_general_ci NOT NULL default '',
  `md5` varchar(32) collate latin1_general_ci default NULL,
  `origmd5` varchar(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_plugins_modules'
#

DROP TABLE IF EXISTS `xt_plugins_modules`;
CREATE TABLE `xt_plugins_modules` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `package` int(10) unsigned NOT NULL default '0',
  `module` varchar(255) collate latin1_general_ci NOT NULL default '',
  `path` varchar(255) collate latin1_general_ci NOT NULL default '',
  `version` float unsigned NOT NULL default '0',
  `description` tinytext collate latin1_general_ci,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_plugins_packages'
#

DROP TABLE IF EXISTS `xt_plugins_packages`;
CREATE TABLE `xt_plugins_packages` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `package` varchar(255) collate latin1_general_ci NOT NULL default '',
  `description` tinytext collate latin1_general_ci,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `package` (`package`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_plugins_params'
#

DROP TABLE IF EXISTS `xt_plugins_params`;
CREATE TABLE `xt_plugins_params` (
  `id` int(11) NOT NULL default '0',
  `param_name` varchar(20) collate latin1_general_ci NOT NULL default '',
  `allowed_values` varchar(255) collate latin1_general_ci NOT NULL default '',
  `value_type` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`,`param_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_plugins_updates'
#

DROP TABLE IF EXISTS `xt_plugins_updates`;
CREATE TABLE `xt_plugins_updates` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `package` varchar(255) collate latin1_general_ci default NULL,
  `module` varchar(255) collate latin1_general_ci default NULL,
  `version` float NOT NULL default '0',
  `reqversion` float NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_projects'
#

DROP TABLE IF EXISTS `xt_projects`;
CREATE TABLE `xt_projects` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `customer_id` int(11) unsigned default NULL,
  `lead_id` int(11) unsigned default NULL,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `status` tinyint(2) unsigned default NULL,
  `accounting_type` tinyint(1) unsigned default '0',
  `accounting_value` int(11) unsigned default NULL,
  `end_date` int(11) unsigned default NULL,
  `start_date` int(11) unsigned default NULL,
  `description` varchar(255) collate latin1_general_ci default NULL,
  `customer_contact_id` int(11) unsigned default NULL,
  `budget_start` int(11) unsigned default NULL,
  `budget_end` int(11) unsigned default NULL,
  `creation_date` int(11) unsigned default '0',
  `creation_user` int(11) unsigned default '0',
  `mod_date` int(11) unsigned default '0',
  `mod_user` int(11) unsigned default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_projects_members'
#

DROP TABLE IF EXISTS `xt_projects_members`;
CREATE TABLE `xt_projects_members` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `hr_id` int(11) unsigned default '0',
  `hr_type` tinyint(3) unsigned default '0',
  `role` varchar(255) collate latin1_general_ci default NULL,
  `project_id` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_projects_milestones'
#

DROP TABLE IF EXISTS `xt_projects_milestones`;
CREATE TABLE `xt_projects_milestones` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `after_step_id` int(11) unsigned default NULL,
  `title` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_projects_steps'
#

DROP TABLE IF EXISTS `xt_projects_steps`;
CREATE TABLE `xt_projects_steps` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `l` int(11) unsigned default NULL,
  `r` int(11) unsigned default NULL,
  `pid` int(11) unsigned default NULL,
  `level` int(11) unsigned default NULL,
  `tree_id` int(11) unsigned default NULL,
  `project_id` int(11) unsigned default NULL,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `lead_id` int(11) unsigned default NULL,
  `executer_id` int(11) unsigned default NULL,
  `executer_type` tinyint(3) unsigned default '0',
  `position` int(11) unsigned default '0',
  `budget` int(11) unsigned default '0',
  `start_date` int(11) unsigned default '0',
  `duration` int(11) unsigned default '0',
  `controller_id` int(11) unsigned default NULL,
  `real_duration` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_ratings'
#

DROP TABLE IF EXISTS `xt_ratings`;
CREATE TABLE `xt_ratings` (
  `rating` tinyint(2) unsigned default NULL,
  `content_type` int(11) unsigned default NULL,
  `content_id` int(11) unsigned default NULL,
  `creation_date` int(11) unsigned default NULL,
  `creation_user` int(11) unsigned default NULL,
  `comment` varchar(255) collate latin1_general_ci default NULL,
  `email` varchar(255) collate latin1_general_ci default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_relations'
#

DROP TABLE IF EXISTS `xt_relations`;
CREATE TABLE `xt_relations` (
  `content_id` int(11) unsigned NOT NULL default '0',
  `content_type` int(11) unsigned NOT NULL default '0',
  `target_content_type` int(11) unsigned NOT NULL default '0',
  `target_content_id` int(11) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_role_perms'
#

DROP TABLE IF EXISTS `xt_role_perms`;
CREATE TABLE `xt_role_perms` (
  `node_id` int(11) NOT NULL default '0',
  `role_id` int(11) NOT NULL default '0',
  `rights` int(11) NOT NULL default '0',
  `lang` char(3) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`node_id`,`role_id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_roles'
#

DROP TABLE IF EXISTS `xt_roles`;
CREATE TABLE `xt_roles` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `maintainer` int(11) unsigned default NULL,
  `description` varchar(255) collate latin1_general_ci default NULL,
  `creation_date` int(11) unsigned default NULL,
  `creation_user` int(11) unsigned default NULL,
  `mod_date` int(11) unsigned default NULL,
  `mod_user` int(11) unsigned default NULL,
  `active` tinyint(1) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_rssreader_feeds'
#

DROP TABLE IF EXISTS `xt_rssreader_feeds`;
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



#
# Table structure for table 'xt_search_assoc__de'
#

DROP TABLE IF EXISTS `xt_search_assoc__de`;
CREATE TABLE `xt_search_assoc__de` (
  `info_id` int(14) NOT NULL default '0',
  `kw_id` int(14) NOT NULL default '0',
  `weight` smallint(4) NOT NULL default '0',
  KEY `spider_id` (`info_id`),
  KEY `key_id` (`kw_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_assoc_global_de'
#

DROP TABLE IF EXISTS `xt_search_assoc_global_de`;
CREATE TABLE `xt_search_assoc_global_de` (
  `info_id` int(14) NOT NULL default '0',
  `kw_id` int(14) NOT NULL default '0',
  `weight` smallint(4) NOT NULL default '0',
  KEY `spider_id` (`info_id`),
  KEY `key_id` (`kw_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_assoc_global_en'
#

DROP TABLE IF EXISTS `xt_search_assoc_global_en`;
CREATE TABLE `xt_search_assoc_global_en` (
  `info_id` int(14) NOT NULL default '0',
  `kw_id` int(14) NOT NULL default '0',
  `weight` smallint(4) NOT NULL default '0',
  KEY `spider_id` (`info_id`),
  KEY `key_id` (`kw_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_assoc_global_fr'
#

DROP TABLE IF EXISTS `xt_search_assoc_global_fr`;
CREATE TABLE `xt_search_assoc_global_fr` (
  `info_id` int(14) NOT NULL default '0',
  `kw_id` int(14) NOT NULL default '0',
  `weight` smallint(4) NOT NULL default '0',
  KEY `spider_id` (`info_id`),
  KEY `key_id` (`kw_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_assoc_global_it'
#

DROP TABLE IF EXISTS `xt_search_assoc_global_it`;
CREATE TABLE `xt_search_assoc_global_it` (
  `info_id` int(14) NOT NULL default '0',
  `kw_id` int(14) NOT NULL default '0',
  `weight` smallint(4) NOT NULL default '0',
  KEY `spider_id` (`info_id`),
  KEY `key_id` (`kw_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_assoc_global_sys'
#

DROP TABLE IF EXISTS `xt_search_assoc_global_sys`;
CREATE TABLE `xt_search_assoc_global_sys` (
  `info_id` int(14) NOT NULL default '0',
  `kw_id` int(14) NOT NULL default '0',
  `weight` smallint(4) NOT NULL default '0',
  KEY `spider_id` (`info_id`),
  KEY `key_id` (`kw_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_found_de'
#

DROP TABLE IF EXISTS `xt_search_found_de`;
CREATE TABLE `xt_search_found_de` (
  `id` int(14) unsigned NOT NULL auto_increment,
  `kw_id` int(14) NOT NULL default '0',
  `search_date` int(11) unsigned NOT NULL default '0',
  `profile` varchar(20) collate latin1_general_ci default NULL,
  `session_id` varchar(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_found_en'
#

DROP TABLE IF EXISTS `xt_search_found_en`;
CREATE TABLE `xt_search_found_en` (
  `id` int(14) unsigned NOT NULL auto_increment,
  `kw_id` int(14) NOT NULL default '0',
  `search_date` int(11) unsigned NOT NULL default '0',
  `profile` varchar(20) collate latin1_general_ci default NULL,
  `session_id` varchar(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_found_fr'
#

DROP TABLE IF EXISTS `xt_search_found_fr`;
CREATE TABLE `xt_search_found_fr` (
  `id` int(14) unsigned NOT NULL auto_increment,
  `kw_id` int(14) NOT NULL default '0',
  `search_date` int(11) unsigned NOT NULL default '0',
  `profile` varchar(20) collate latin1_general_ci default NULL,
  `session_id` varchar(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_found_it'
#

DROP TABLE IF EXISTS `xt_search_found_it`;
CREATE TABLE `xt_search_found_it` (
  `id` int(14) unsigned NOT NULL auto_increment,
  `kw_id` int(14) NOT NULL default '0',
  `search_date` int(11) unsigned NOT NULL default '0',
  `profile` varchar(20) collate latin1_general_ci default NULL,
  `session_id` varchar(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_found_sys'
#

DROP TABLE IF EXISTS `xt_search_found_sys`;
CREATE TABLE `xt_search_found_sys` (
  `id` int(14) unsigned NOT NULL auto_increment,
  `kw_id` int(14) NOT NULL default '0',
  `search_date` int(11) unsigned NOT NULL default '0',
  `profile` varchar(20) collate latin1_general_ci default NULL,
  `session_id` varchar(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_infos__de'
#

DROP TABLE IF EXISTS `xt_search_infos__de`;
CREATE TABLE `xt_search_infos__de` (
  `id` int(14) unsigned NOT NULL auto_increment,
  `title` mediumblob NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  `active` int(1) NOT NULL default '1',
  `ext_link` varchar(255) collate latin1_general_ci default NULL,
  `content_id` int(14) unsigned NOT NULL default '0',
  `content_type` int(8) unsigned NOT NULL default '0',
  `mod_date` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_infos_global_de'
#

DROP TABLE IF EXISTS `xt_search_infos_global_de`;
CREATE TABLE `xt_search_infos_global_de` (
  `id` int(14) unsigned NOT NULL auto_increment,
  `title` mediumblob NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  `active` int(1) NOT NULL default '1',
  `ext_link` varchar(255) collate latin1_general_ci default NULL,
  `content_id` int(14) unsigned NOT NULL default '0',
  `content_type` int(8) unsigned NOT NULL default '0',
  `mod_date` int(11) unsigned NOT NULL default '0',
  `image` int(11) unsigned default '0',
  `public` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_infos_global_en'
#

DROP TABLE IF EXISTS `xt_search_infos_global_en`;
CREATE TABLE `xt_search_infos_global_en` (
  `id` int(14) unsigned NOT NULL auto_increment,
  `title` mediumblob NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  `active` int(1) NOT NULL default '1',
  `ext_link` varchar(255) collate latin1_general_ci default NULL,
  `content_id` int(14) unsigned NOT NULL default '0',
  `content_type` int(8) unsigned NOT NULL default '0',
  `mod_date` int(11) unsigned NOT NULL default '0',
  `image` int(11) unsigned default '0',
  `public` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_infos_global_fr'
#

DROP TABLE IF EXISTS `xt_search_infos_global_fr`;
CREATE TABLE `xt_search_infos_global_fr` (
  `id` int(14) unsigned NOT NULL auto_increment,
  `title` mediumblob NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  `active` int(1) NOT NULL default '1',
  `ext_link` varchar(255) collate latin1_general_ci default NULL,
  `content_id` int(14) unsigned NOT NULL default '0',
  `content_type` int(8) unsigned NOT NULL default '0',
  `mod_date` int(11) unsigned NOT NULL default '0',
  `image` int(11) unsigned default '0',
  `public` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_infos_global_it'
#

DROP TABLE IF EXISTS `xt_search_infos_global_it`;
CREATE TABLE `xt_search_infos_global_it` (
  `id` int(14) unsigned NOT NULL auto_increment,
  `title` mediumblob NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  `active` int(1) NOT NULL default '1',
  `ext_link` varchar(255) collate latin1_general_ci default NULL,
  `content_id` int(14) unsigned NOT NULL default '0',
  `content_type` int(8) unsigned NOT NULL default '0',
  `mod_date` int(11) unsigned NOT NULL default '0',
  `image` int(11) unsigned NOT NULL default '0',
  `public` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_infos_global_sys'
#

DROP TABLE IF EXISTS `xt_search_infos_global_sys`;
CREATE TABLE `xt_search_infos_global_sys` (
  `id` int(14) unsigned NOT NULL auto_increment,
  `title` mediumblob NOT NULL,
  `description` text collate latin1_general_ci NOT NULL,
  `active` int(1) NOT NULL default '1',
  `ext_link` varchar(255) collate latin1_general_ci default NULL,
  `content_id` int(14) unsigned NOT NULL default '0',
  `content_type` int(8) unsigned NOT NULL default '0',
  `create_date` int(11) unsigned NOT NULL default '0',
  `mod_date` int(11) unsigned NOT NULL default '0',
  `image` int(11) unsigned NOT NULL default '0',
  `create_user` int(11) unsigned NOT NULL default '0',
  `mod_user` int(11) unsigned NOT NULL default '0',
  `public` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_keywords_de'
#

DROP TABLE IF EXISTS `xt_search_keywords_de`;
CREATE TABLE `xt_search_keywords_de` (
  `id` int(14) NOT NULL auto_increment,
  `two` char(2) collate latin1_general_ci NOT NULL default '',
  `kw` varchar(64) collate latin1_general_ci NOT NULL default '',
  `soundex` varchar(4) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`kw`),
  UNIQUE KEY `key_id_2` (`id`),
  KEY `twoletters` (`two`),
  FULLTEXT KEY `soundex` (`soundex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_keywords_en'
#

DROP TABLE IF EXISTS `xt_search_keywords_en`;
CREATE TABLE `xt_search_keywords_en` (
  `id` int(14) NOT NULL auto_increment,
  `two` char(2) collate latin1_general_ci NOT NULL default '',
  `kw` varchar(64) collate latin1_general_ci NOT NULL default '',
  `soundex` varchar(4) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`kw`),
  UNIQUE KEY `key_id_2` (`id`),
  KEY `twoletters` (`two`),
  FULLTEXT KEY `soundex` (`soundex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_keywords_fr'
#

DROP TABLE IF EXISTS `xt_search_keywords_fr`;
CREATE TABLE `xt_search_keywords_fr` (
  `id` int(14) NOT NULL auto_increment,
  `two` char(2) collate latin1_general_ci NOT NULL default '',
  `kw` varchar(64) collate latin1_general_ci NOT NULL default '',
  `soundex` varchar(4) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`kw`),
  UNIQUE KEY `key_id_2` (`id`),
  KEY `twoletters` (`two`),
  FULLTEXT KEY `soundex` (`soundex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_keywords_it'
#

DROP TABLE IF EXISTS `xt_search_keywords_it`;
CREATE TABLE `xt_search_keywords_it` (
  `id` int(14) NOT NULL auto_increment,
  `two` char(2) collate latin1_general_ci NOT NULL default '',
  `kw` varchar(64) collate latin1_general_ci NOT NULL default '',
  `soundex` varchar(4) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`kw`),
  UNIQUE KEY `key_id_2` (`id`),
  KEY `twoletters` (`two`),
  KEY `soundex` (`soundex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_keywords_sys'
#

DROP TABLE IF EXISTS `xt_search_keywords_sys`;
CREATE TABLE `xt_search_keywords_sys` (
  `id` int(14) NOT NULL auto_increment,
  `two` char(2) collate latin1_general_ci NOT NULL default '',
  `kw` varchar(64) collate latin1_general_ci NOT NULL default '',
  `soundex` varchar(4) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`kw`),
  UNIQUE KEY `key_id_2` (`id`),
  KEY `twoletters` (`two`),
  FULLTEXT KEY `soundex` (`soundex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_nonwords_de'
#

DROP TABLE IF EXISTS `xt_search_nonwords_de`;
CREATE TABLE `xt_search_nonwords_de` (
  `id` int(14) NOT NULL auto_increment,
  `two` char(2) collate latin1_general_ci NOT NULL default '',
  `kw` varchar(64) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`kw`),
  UNIQUE KEY `key_id_2` (`id`),
  KEY `twoletters` (`two`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_nonwords_en'
#

DROP TABLE IF EXISTS `xt_search_nonwords_en`;
CREATE TABLE `xt_search_nonwords_en` (
  `id` int(14) NOT NULL auto_increment,
  `two` char(2) collate latin1_general_ci NOT NULL default '',
  `kw` varchar(64) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`kw`),
  UNIQUE KEY `key_id_2` (`id`),
  KEY `twoletters` (`two`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_nonwords_fr'
#

DROP TABLE IF EXISTS `xt_search_nonwords_fr`;
CREATE TABLE `xt_search_nonwords_fr` (
  `id` int(14) NOT NULL auto_increment,
  `two` char(2) collate latin1_general_ci NOT NULL default '',
  `kw` varchar(64) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`kw`),
  UNIQUE KEY `key_id_2` (`id`),
  KEY `twoletters` (`two`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_nonwords_it'
#

DROP TABLE IF EXISTS `xt_search_nonwords_it`;
CREATE TABLE `xt_search_nonwords_it` (
  `id` int(14) NOT NULL auto_increment,
  `two` char(2) collate latin1_general_ci NOT NULL default '',
  `kw` varchar(64) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`kw`),
  UNIQUE KEY `key_id_2` (`id`),
  KEY `twoletters` (`two`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_nonwords_sys'
#

DROP TABLE IF EXISTS `xt_search_nonwords_sys`;
CREATE TABLE `xt_search_nonwords_sys` (
  `id` int(14) NOT NULL auto_increment,
  `two` char(2) collate latin1_general_ci NOT NULL default '',
  `kw` varchar(64) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`kw`),
  UNIQUE KEY `key_id_2` (`id`),
  KEY `twoletters` (`two`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_notfound_de'
#

DROP TABLE IF EXISTS `xt_search_notfound_de`;
CREATE TABLE `xt_search_notfound_de` (
  `id` int(14) unsigned NOT NULL auto_increment,
  `kw` varchar(64) collate latin1_general_ci NOT NULL default '',
  `search_date` int(11) unsigned NOT NULL default '0',
  `profile` varchar(20) collate latin1_general_ci default NULL,
  `session_id` varchar(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_notfound_en'
#

DROP TABLE IF EXISTS `xt_search_notfound_en`;
CREATE TABLE `xt_search_notfound_en` (
  `id` int(14) unsigned NOT NULL auto_increment,
  `kw` varchar(64) collate latin1_general_ci NOT NULL default '',
  `search_date` int(11) unsigned NOT NULL default '0',
  `profile` varchar(20) collate latin1_general_ci default NULL,
  `session_id` varchar(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_notfound_fr'
#

DROP TABLE IF EXISTS `xt_search_notfound_fr`;
CREATE TABLE `xt_search_notfound_fr` (
  `id` int(14) unsigned NOT NULL auto_increment,
  `kw` varchar(64) collate latin1_general_ci NOT NULL default '',
  `search_date` int(11) unsigned NOT NULL default '0',
  `profile` varchar(20) collate latin1_general_ci default NULL,
  `session_id` varchar(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_notfound_it'
#

DROP TABLE IF EXISTS `xt_search_notfound_it`;
CREATE TABLE `xt_search_notfound_it` (
  `id` int(14) unsigned NOT NULL auto_increment,
  `kw` varchar(64) collate latin1_general_ci NOT NULL default '',
  `search_date` int(11) unsigned NOT NULL default '0',
  `profile` varchar(20) collate latin1_general_ci default NULL,
  `session_id` varchar(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_search_notfound_sys'
#

DROP TABLE IF EXISTS `xt_search_notfound_sys`;
CREATE TABLE `xt_search_notfound_sys` (
  `id` int(14) unsigned NOT NULL auto_increment,
  `kw` varchar(64) collate latin1_general_ci NOT NULL default '',
  `search_date` int(11) unsigned NOT NULL default '0',
  `profile` varchar(20) collate latin1_general_ci default NULL,
  `session_id` varchar(32) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_security_pools'
#

DROP TABLE IF EXISTS `xt_security_pools`;
CREATE TABLE `xt_security_pools` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `l` int(11) unsigned default NULL,
  `r` int(11) unsigned default NULL,
  `pid` int(11) unsigned default NULL,
  `level` int(11) unsigned default NULL,
  `tree_id` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_security_pools_details'
#

DROP TABLE IF EXISTS `xt_security_pools_details`;
CREATE TABLE `xt_security_pools_details` (
  `node_id` int(11) unsigned default NULL,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `active` tinyint(1) unsigned default '0',
  `lang` char(3) collate latin1_general_ci default 'sys',
  `public` tinyint(1) unsigned NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_security_pools_rel'
#

DROP TABLE IF EXISTS `xt_security_pools_rel`;
CREATE TABLE `xt_security_pools_rel` (
  `node_id` int(11) unsigned default NULL,
  `principal_id` int(11) unsigned default NULL,
  `principal_type` tinyint(3) unsigned default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_shop_articles'
#

DROP TABLE IF EXISTS `xt_shop_articles`;
CREATE TABLE `xt_shop_articles` (
  `article_id` int(11) unsigned NOT NULL default '0',
  `price` float(11,3) default NULL,
  `gift` int(1) NOT NULL default '0',
  `product_of_month` int(1) unsigned NOT NULL default '0',
  `taxes` int(10) unsigned NOT NULL default '0',
  `buyable` int(1) unsigned NOT NULL default '1',
  UNIQUE KEY `id` (`article_id`),
  KEY `id_2` (`article_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_shop_discounts'
#

DROP TABLE IF EXISTS `xt_shop_discounts`;
CREATE TABLE `xt_shop_discounts` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `value` decimal(10,3) default NULL,
  `give_discount_at` int(4) unsigned NOT NULL default '5',
  `in_percent` tinyint(3) unsigned default '1',
  `for_single_article` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_shop_discounts_articles'
#

DROP TABLE IF EXISTS `xt_shop_discounts_articles`;
CREATE TABLE `xt_shop_discounts_articles` (
  `discount_id` int(11) unsigned NOT NULL default '0',
  `article_id` int(11) unsigned NOT NULL default '0',
  `position` int(11) default NULL,
  PRIMARY KEY  (`article_id`,`discount_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_shop_discounts_details'
#

DROP TABLE IF EXISTS `xt_shop_discounts_details`;
CREATE TABLE `xt_shop_discounts_details` (
  `id` int(11) unsigned NOT NULL default '0',
  `lang` varchar(5) collate latin1_general_ci NOT NULL default '',
  `description` varchar(255) collate latin1_general_ci NOT NULL default '',
  `name` varchar(100) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_shop_orders'
#

DROP TABLE IF EXISTS `xt_shop_orders`;
CREATE TABLE `xt_shop_orders` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `session_id` varchar(40) collate latin1_general_ci default NULL,
  `user_id` int(11) unsigned default NULL,
  `creation_date` int(11) unsigned default NULL,
  `transport` float(10,3) NOT NULL default '0.000',
  `discount` float(10,3) NOT NULL default '0.000',
  `totalprice` float(10,3) NOT NULL default '0.000',
  `endprice` float(10,3) NOT NULL default '0.000',
  `taxes` float(10,3) NOT NULL default '0.000',
  `gifts` int(11) unsigned NOT NULL default '0',
  `products` int(11) unsigned NOT NULL default '0',
  `products_count` int(11) unsigned NOT NULL default '0',
  `status` tinyint(3) unsigned default '0',
  `order_no` varchar(40) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_shop_orders_details'
#

DROP TABLE IF EXISTS `xt_shop_orders_details`;
CREATE TABLE `xt_shop_orders_details` (
  `order_id` int(11) unsigned default NULL,
  `product_id` int(11) unsigned default NULL,
  `price` float(10,3) default NULL,
  `quantity` int(11) unsigned default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_shop_taxes'
#

DROP TABLE IF EXISTS `xt_shop_taxes`;
CREATE TABLE `xt_shop_taxes` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `value` decimal(4,3) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_shop_taxes_details'
#

DROP TABLE IF EXISTS `xt_shop_taxes_details`;
CREATE TABLE `xt_shop_taxes_details` (
  `id` int(11) unsigned NOT NULL default '0',
  `lang` varchar(5) collate latin1_general_ci NOT NULL default '',
  `description` varchar(100) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_tasks'
#

DROP TABLE IF EXISTS `xt_tasks`;
CREATE TABLE `xt_tasks` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `sender` int(11) unsigned default NULL,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `text` text collate latin1_general_ci,
  `priority` tinyint(1) unsigned default '0',
  `receiver` int(11) unsigned default NULL,
  `read_date` int(11) unsigned default NULL,
  `deleted` tinyint(1) unsigned default '0',
  `status` tinyint(1) unsigned NOT NULL default '0',
  `deadline` int(11) unsigned NOT NULL default '0',
  `percent` tinyint(3) unsigned default '0',
  `max_duration` int(11) unsigned default NULL,
  `creation_date` int(10) unsigned default NULL,
  `creation_user` int(11) unsigned default NULL,
  `mod_date` int(11) unsigned default NULL,
  `mod_user` int(11) unsigned default NULL,
  `project_id` int(11) unsigned default NULL,
  `project_step_id` int(11) unsigned default NULL,
  `active` tinyint(1) unsigned default '1',
  `workflow_id` int(11) unsigned default NULL,
  `workflow_step_id` int(11) unsigned default NULL,
  `workflow_instance_id` tinyint(3) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_tpl_group_perms'
#

DROP TABLE IF EXISTS `xt_tpl_group_perms`;
CREATE TABLE `xt_tpl_group_perms` (
  `tpl_id` int(11) NOT NULL default '0',
  `group_id` int(11) NOT NULL default '0',
  `rights` int(11) NOT NULL default '0',
  `lang` char(3) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`tpl_id`,`group_id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_tpl_role_perms'
#

DROP TABLE IF EXISTS `xt_tpl_role_perms`;
CREATE TABLE `xt_tpl_role_perms` (
  `tpl_id` int(11) NOT NULL default '0',
  `role_id` int(11) NOT NULL default '0',
  `rights` int(11) NOT NULL default '0',
  `lang` char(3) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`tpl_id`,`role_id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_tpl_user_perms'
#

DROP TABLE IF EXISTS `xt_tpl_user_perms`;
CREATE TABLE `xt_tpl_user_perms` (
  `tpl_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `rights` int(11) NOT NULL default '0',
  `lang` char(3) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`tpl_id`,`user_id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_tracking'
#

DROP TABLE IF EXISTS `xt_tracking`;
CREATE TABLE `xt_tracking` (
  `user_id` int(11) unsigned NOT NULL default '0',
  `session_id` varchar(40) collate latin1_general_ci NOT NULL default '',
  `page_url` varchar(255) collate latin1_general_ci NOT NULL default '',
  `call_time` int(11) NOT NULL default '0',
  `agent` varchar(255) collate latin1_general_ci NOT NULL default '',
  `host` varchar(255) collate latin1_general_ci NOT NULL default '',
  `addr` varchar(50) collate latin1_general_ci NOT NULL default '',
  `uri` varchar(255) collate latin1_general_ci NOT NULL default '',
  `tpl` int(11) NOT NULL default '0',
  `os` varchar(255) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`call_time`,`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_tracking_archives'
#

DROP TABLE IF EXISTS `xt_tracking_archives`;
CREATE TABLE `xt_tracking_archives` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `start_date` int(11) unsigned default NULL,
  `end_date` int(11) unsigned default NULL,
  `cached` tinyint(1) unsigned default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_tree'
#

DROP TABLE IF EXISTS `xt_tree`;
CREATE TABLE `xt_tree` (
  `id` int(11) NOT NULL auto_increment,
  `l` int(11) NOT NULL default '0',
  `r` int(11) NOT NULL default '0',
  `pid` int(11) NOT NULL default '0',
  `level` int(11) NOT NULL default '0',
  `tree_id` int(11) NOT NULL default '0',
  `active` int(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `l` (`l`),
  KEY `r` (`r`),
  KEY `pid` (`pid`),
  KEY `level` (`level`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_units'
#

DROP TABLE IF EXISTS `xt_units`;
CREATE TABLE `xt_units` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `standard` varchar(20) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_units_details'
#

DROP TABLE IF EXISTS `xt_units_details`;
CREATE TABLE `xt_units_details` (
  `id` int(11) unsigned NOT NULL default '0',
  `lang` varchar(5) collate latin1_general_ci NOT NULL default '',
  `short` varchar(10) collate latin1_general_ci NOT NULL default '',
  `full` varchar(100) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_units_relations'
#

DROP TABLE IF EXISTS `xt_units_relations`;
CREATE TABLE `xt_units_relations` (
  `id` int(11) unsigned NOT NULL default '0',
  `relation_id` int(10) unsigned NOT NULL default '0',
  `factor` float NOT NULL default '1',
  PRIMARY KEY  (`id`,`relation_id`),
  UNIQUE KEY `id` (`id`,`relation_id`),
  KEY `id_2` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_updates'
#

DROP TABLE IF EXISTS `xt_updates`;
CREATE TABLE `xt_updates` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `package_id` int(11) default NULL,
  `module_id` int(11) default NULL,
  `version` int(11) NOT NULL default '0',
  `reqversion` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_user'
#

DROP TABLE IF EXISTS `xt_user`;
CREATE TABLE `xt_user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(40) collate latin1_general_ci default NULL,
  `password` varchar(40) collate latin1_general_ci NOT NULL default '',
  `tpl_read` int(11) NOT NULL default '0',
  `tpl_write` int(11) NOT NULL default '0',
  `tpl_edit` int(11) NOT NULL default '0',
  `tpl_delete` int(11) NOT NULL default '0',
  `plugin_read` int(11) NOT NULL default '0',
  `plugin_write` int(11) NOT NULL default '0',
  `plugin_edit` int(11) NOT NULL default '0',
  `plugin_delete` int(11) NOT NULL default '0',
  `creation_date` int(11) NOT NULL default '0',
  `creation_user` int(11) NOT NULL default '0',
  `mod_date` int(11) NOT NULL default '0',
  `mod_user` int(11) NOT NULL default '0',
  `last_login_date` int(11) NOT NULL default '0',
  `firstName` varchar(40) collate latin1_general_ci NOT NULL default '',
  `lastName` varchar(40) collate latin1_general_ci NOT NULL default '',
  `active` int(1) NOT NULL default '0',
  `street` varchar(255) collate latin1_general_ci NOT NULL default '',
  `plz` varchar(5) collate latin1_general_ci NOT NULL default '',
  `city` varchar(255) collate latin1_general_ci NOT NULL default '',
  `email` varchar(255) collate latin1_general_ci NOT NULL default '',
  `tel` varchar(20) collate latin1_general_ci NOT NULL default '',
  `facsimile` varchar(20) collate latin1_general_ci NOT NULL default '',
  `lang` char(3) collate latin1_general_ci NOT NULL default '',
  `date_short` varchar(40) collate latin1_general_ci NOT NULL default '',
  `date_long` varchar(40) collate latin1_general_ci NOT NULL default '',
  `description` text collate latin1_general_ci NOT NULL,
  `image` int(11) unsigned default NULL,
  `image_version` char(3) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_user_groups'
#

DROP TABLE IF EXISTS `xt_user_groups`;
CREATE TABLE `xt_user_groups` (
  `user_id` int(11) unsigned NOT NULL default '0',
  `group_id` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`group_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_user_perms'
#

DROP TABLE IF EXISTS `xt_user_perms`;
CREATE TABLE `xt_user_perms` (
  `node_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  `rights` int(11) NOT NULL default '0',
  `lang` char(3) collate latin1_general_ci NOT NULL default '',
  PRIMARY KEY  (`node_id`,`user_id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_user_roles'
#

DROP TABLE IF EXISTS `xt_user_roles`;
CREATE TABLE `xt_user_roles` (
  `user_id` int(11) unsigned NOT NULL default '0',
  `role_id` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`role_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_virtual_url'
#

DROP TABLE IF EXISTS `xt_virtual_url`;
CREATE TABLE `xt_virtual_url` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `pattern` varchar(255) collate latin1_general_ci default NULL,
  `pattern_mode` tinyint(3) default '0',
  `url` varchar(255) collate latin1_general_ci default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_webdav_locks'
#

DROP TABLE IF EXISTS `xt_webdav_locks`;
CREATE TABLE `xt_webdav_locks` (
  `token` varchar(255) collate latin1_general_ci NOT NULL default '',
  `path` varchar(200) collate latin1_general_ci NOT NULL default '',
  `expires` int(11) NOT NULL default '0',
  `owner` varchar(200) collate latin1_general_ci default NULL,
  `recursive` int(11) default '0',
  `writelock` int(11) default '0',
  `exclusivelock` int(11) NOT NULL default '0',
  PRIMARY KEY  (`token`),
  UNIQUE KEY `token` (`token`),
  KEY `path` (`path`),
  KEY `path_2` (`path`),
  KEY `path_3` (`path`,`token`),
  KEY `expires` (`expires`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_webdav_properties'
#

DROP TABLE IF EXISTS `xt_webdav_properties`;
CREATE TABLE `xt_webdav_properties` (
  `path` varchar(255) collate latin1_general_ci NOT NULL default '',
  `name` varchar(120) collate latin1_general_ci NOT NULL default '',
  `ns` varchar(120) collate latin1_general_ci NOT NULL default 'DAV:',
  `value` text collate latin1_general_ci,
  PRIMARY KEY  (`path`,`name`,`ns`),
  KEY `path` (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_workflow_steps_details'
#

DROP TABLE IF EXISTS `xt_workflow_steps_details`;
CREATE TABLE `xt_workflow_steps_details` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `workflow_id` int(11) unsigned default NULL,
  `step_id` int(11) unsigned default NULL,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `max_time` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_workflows'
#

DROP TABLE IF EXISTS `xt_workflows`;
CREATE TABLE `xt_workflows` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `workflow_id` int(11) unsigned default NULL,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `lang` char(3) collate latin1_general_ci default NULL,
  `max_duration` int(11) unsigned default NULL,
  `description` varchar(255) collate latin1_general_ci default NULL,
  `parallel` tinyint(1) unsigned default '0',
  `phase` int(11) unsigned default '0',
  PRIMARY KEY  (`id`),
  KEY `tree_id` (`workflow_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_workflows_dependences'
#

DROP TABLE IF EXISTS `xt_workflows_dependences`;
CREATE TABLE `xt_workflows_dependences` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `workflow_id` int(11) unsigned default NULL,
  `step_id` int(11) unsigned default NULL,
  `dependent_workflow_id` int(11) unsigned default NULL,
  `dependent_step_id` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_workflows_instances'
#

DROP TABLE IF EXISTS `xt_workflows_instances`;
CREATE TABLE `xt_workflows_instances` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `workflow_id` int(11) unsigned default NULL,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `start_date` int(11) unsigned default NULL,
  `start_user` int(11) unsigned default NULL,
  `creation_date` int(11) unsigned default NULL,
  `creation_user` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_workflows_members'
#

DROP TABLE IF EXISTS `xt_workflows_members`;
CREATE TABLE `xt_workflows_members` (
  `workflow_id` int(11) unsigned NOT NULL default '0',
  `step_id` int(11) unsigned NOT NULL default '0',
  `executer_id` int(11) unsigned NOT NULL default '0',
  `executer_mode` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`workflow_id`,`step_id`,`executer_id`,`executer_mode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_workflows_perms'
#

DROP TABLE IF EXISTS `xt_workflows_perms`;
CREATE TABLE `xt_workflows_perms` (
  `workflow_id` int(11) unsigned NOT NULL default '0',
  `workflow_step_id` int(11) unsigned NOT NULL default '0',
  `perms` int(11) unsigned NOT NULL default '0',
  PRIMARY KEY  (`workflow_id`,`workflow_step_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_workflows_phases'
#

DROP TABLE IF EXISTS `xt_workflows_phases`;
CREATE TABLE `xt_workflows_phases` (
  `phase_id` int(11) unsigned NOT NULL auto_increment,
  `workflow_id` int(11) unsigned NOT NULL default '0',
  `title` varchar(255) collate latin1_general_ci default NULL,
  `position` tinyint(3) unsigned default NULL,
  PRIMARY KEY  (`phase_id`,`workflow_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Table structure for table 'xt_workflows_running'
#

DROP TABLE IF EXISTS `xt_workflows_running`;
CREATE TABLE `xt_workflows_running` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `workflow_id` int(11) unsigned default NULL,
  `status` tinyint(3) unsigned default '0',
  `comment` varchar(255) collate latin1_general_ci default NULL,
  `creation_date` int(11) unsigned default NULL,
  `creation_user` int(11) unsigned default NULL,
  `mod_date` int(11) unsigned default NULL,
  `mod_user` int(11) unsigned default NULL,
  `title` varchar(255) collate latin1_general_ci default NULL,
  `step_id` int(11) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

