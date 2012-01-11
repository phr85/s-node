# MySQL-Front Dump 2.2
#
# Host: localhost   Database: xtreme
#--------------------------------------------------------
# Server version 4.1.10


#
# Table structure for table 'xt_plugins_packages'
#

DROP TABLE IF EXISTS xt_plugins_packages;
CREATE TABLE `xt_plugins_packages` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `package` varchar(255) collate latin1_general_ci NOT NULL default '',
  `description` tinytext collate latin1_general_ci,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `package` (`package`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Dumping data for table 'xt_plugins_packages'
#
INSERT INTO xt_plugins_packages VALUES("1000","ch.iframe.snode.areas","");
INSERT INTO xt_plugins_packages VALUES("270","ch.iframe.snode.articles","");
INSERT INTO xt_plugins_packages VALUES("1100","ch.iframe.snode.banner","");
INSERT INTO xt_plugins_packages VALUES("1200","ch.iframe.snode.catalog","");
INSERT INTO xt_plugins_packages VALUES("260","ch.iframe.snode.controlling","");
INSERT INTO xt_plugins_packages VALUES("1","ch.iframe.snode.core","");
INSERT INTO xt_plugins_packages VALUES("10","ch.iframe.snode.core_info","");
INSERT INTO xt_plugins_packages VALUES("1300","ch.iframe.snode.customers","");
INSERT INTO xt_plugins_packages VALUES("250","ch.iframe.snode.desktop","");
INSERT INTO xt_plugins_packages VALUES("20","ch.iframe.snode.errorpages","");
INSERT INTO xt_plugins_packages VALUES("1400","ch.iframe.snode.faq","");
INSERT INTO xt_plugins_packages VALUES("240","ch.iframe.snode.filemanager","");
INSERT INTO xt_plugins_packages VALUES("230","ch.iframe.snode.footer","");
INSERT INTO xt_plugins_packages VALUES("220","ch.iframe.snode.formmanager","");
INSERT INTO xt_plugins_packages VALUES("120","ch.iframe.snode.groupmanager","");
INSERT INTO xt_plugins_packages VALUES("1500","ch.iframe.snode.guestbook","");
INSERT INTO xt_plugins_packages VALUES("210","ch.iframe.snode.header","");
INSERT INTO xt_plugins_packages VALUES("1600","ch.iframe.snode.hr","");
INSERT INTO xt_plugins_packages VALUES("30","ch.iframe.snode.i18n","");
INSERT INTO xt_plugins_packages VALUES("40","ch.iframe.snode.info","");
INSERT INTO xt_plugins_packages VALUES("1700","ch.iframe.snode.jobcenter","");
INSERT INTO xt_plugins_packages VALUES("1800","ch.iframe.snode.lexikon","");
INSERT INTO xt_plugins_packages VALUES("1900","ch.iframe.snode.licensemanager","");
INSERT INTO xt_plugins_packages VALUES("2000","ch.iframe.snode.locations","");
INSERT INTO xt_plugins_packages VALUES("0","ch.iframe.snode.mediamanager","");
INSERT INTO xt_plugins_packages VALUES("50","ch.iframe.snode.messages","");
INSERT INTO xt_plugins_packages VALUES("60","ch.iframe.snode.navigation","");
INSERT INTO xt_plugins_packages VALUES("200","ch.iframe.snode.news","");
INSERT INTO xt_plugins_packages VALUES("150","ch.iframe.snode.nodepermissions","");
INSERT INTO xt_plugins_packages VALUES("140","ch.iframe.snode.permissions","");
INSERT INTO xt_plugins_packages VALUES("70","ch.iframe.snode.pluginmanager","");
INSERT INTO xt_plugins_packages VALUES("2100","ch.iframe.snode.pluginwizard","");
INSERT INTO xt_plugins_packages VALUES("2200","ch.iframe.snode.projects","");
INSERT INTO xt_plugins_packages VALUES("130","ch.iframe.snode.rolemanager","");
INSERT INTO xt_plugins_packages VALUES("2300","ch.iframe.snode.rssreader","");
INSERT INTO xt_plugins_packages VALUES("80","ch.iframe.snode.search","");
INSERT INTO xt_plugins_packages VALUES("100","ch.iframe.snode.securitycenter","");
INSERT INTO xt_plugins_packages VALUES("2400","ch.iframe.snode.shop","");
INSERT INTO xt_plugins_packages VALUES("2500","ch.iframe.snode.shop_orders","");
INSERT INTO xt_plugins_packages VALUES("2600","ch.iframe.snode.statistics","");
INSERT INTO xt_plugins_packages VALUES("2700","ch.iframe.snode.survey","");
INSERT INTO xt_plugins_packages VALUES("2800","ch.iframe.snode.tasks","");
INSERT INTO xt_plugins_packages VALUES("90","ch.iframe.snode.templatemanager","");
INSERT INTO xt_plugins_packages VALUES("2900","ch.iframe.snode.units","");
INSERT INTO xt_plugins_packages VALUES("110","ch.iframe.snode.usermanager","");
INSERT INTO xt_plugins_packages VALUES("3000","ch.iframe.snode.usertracking","");
INSERT INTO xt_plugins_packages VALUES("160","ch.iframe.snode.virtual","");
INSERT INTO xt_plugins_packages VALUES("3100","ch.iframe.snode.workflow","");
