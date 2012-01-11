# MySQL-Front Dump 2.5
#
# Host: localhost   Database: xtreme
# --------------------------------------------------------
# Server version 4.1.11


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
# Dumping data for table 'xt_projects'
#

INSERT INTO `xt_projects` (`id`, `customer_id`, `lead_id`, `title`, `status`, `accounting_type`, `accounting_value`, `end_date`, `start_date`, `description`, `customer_contact_id`, `budget_start`, `budget_end`, `creation_date`, `creation_user`, `mod_date`, `mod_user`) VALUES("1", "6", "7", "Webseite Gemeinde Oberriet", "0", "0", "0", "1117167720", "1116617640", "adfsdf afdsfsdf sdfasdfsdf dfasdfsdf", "1", "2000", "3000", "0", "0", "1117581854", "1");
INSERT INTO `xt_projects` (`id`, `customer_id`, `lead_id`, `title`, `status`, `accounting_type`, `accounting_value`, `end_date`, `start_date`, `description`, `customer_contact_id`, `budget_start`, `budget_end`, `creation_date`, `creation_user`, `mod_date`, `mod_user`) VALUES("2", "7", "0", "Testproject", "0", "0", "0", "1104537600", "1104537600", "This is the description", "20", "0", "0", "1114353517", "1", "1117568177", "1");
INSERT INTO `xt_projects` (`id`, `customer_id`, `lead_id`, `title`, `status`, `accounting_type`, `accounting_value`, `end_date`, `start_date`, `description`, `customer_contact_id`, `budget_start`, `budget_end`, `creation_date`, `creation_user`, `mod_date`, `mod_user`) VALUES("13", "5", "0", "Grosse Mäusejagd mit Hunden", "0", "0", "0", "1116859800", "1116859320", "Adi rennt mit Hunden den Mäusen im Riet hinterher.", "16", "0", "0", "0", "0", "1117568821", "1");
INSERT INTO `xt_projects` (`id`, `customer_id`, `lead_id`, `title`, `status`, `accounting_type`, `accounting_value`, `end_date`, `start_date`, `description`, `customer_contact_id`, `budget_start`, `budget_end`, `creation_date`, `creation_user`, `mod_date`, `mod_user`) VALUES("8", "5", "0", "Testkkkkk", "0", "0", "0", "1117277580", "1116845580", "", "16", "1000", "2500", "0", "0", "1117568175", "1");
INSERT INTO `xt_projects` (`id`, `customer_id`, `lead_id`, `title`, `status`, `accounting_type`, `accounting_value`, `end_date`, `start_date`, `description`, `customer_contact_id`, `budget_start`, `budget_end`, `creation_date`, `creation_user`, `mod_date`, `mod_user`) VALUES("14", NULL, NULL, "", NULL, "0", NULL, NULL, NULL, NULL, NULL, NULL, NULL, "0", "0", "0", "0");
INSERT INTO `xt_projects` (`id`, `customer_id`, `lead_id`, `title`, `status`, `accounting_type`, `accounting_value`, `end_date`, `start_date`, `description`, `customer_contact_id`, `budget_start`, `budget_end`, `creation_date`, `creation_user`, `mod_date`, `mod_user`) VALUES("15", NULL, NULL, "", NULL, "0", NULL, NULL, NULL, NULL, NULL, NULL, NULL, "0", "0", "0", "0");


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
# Dumping data for table 'xt_projects_members'
#

INSERT INTO `xt_projects_members` (`id`, `hr_id`, `hr_type`, `role`, `project_id`) VALUES("15", "8", "0", "Mailkonten", "1");
INSERT INTO `xt_projects_members` (`id`, `hr_id`, `hr_type`, `role`, `project_id`) VALUES("2", "6", "1", "Programmierer Backend", "1");
INSERT INTO `xt_projects_members` (`id`, `hr_id`, `hr_type`, `role`, `project_id`) VALUES("3", "7", "1", "Projektmanager", "1");
INSERT INTO `xt_projects_members` (`id`, `hr_id`, `hr_type`, `role`, `project_id`) VALUES("17", "1", "0", "Programmierung", "2");
INSERT INTO `xt_projects_members` (`id`, `hr_id`, `hr_type`, `role`, `project_id`) VALUES("11", "1", "0", "Programmierung & Design", "1");
INSERT INTO `xt_projects_members` (`id`, `hr_id`, `hr_type`, `role`, `project_id`) VALUES("18", "10", "0", "Supporter", "1");


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
# Dumping data for table 'xt_projects_milestones'
#



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
# Dumping data for table 'xt_projects_steps'
#

INSERT INTO `xt_projects_steps` (`id`, `l`, `r`, `pid`, `level`, `tree_id`, `project_id`, `title`, `lead_id`, `executer_id`, `executer_type`, `position`, `budget`, `start_date`, `duration`, `controller_id`, `real_duration`) VALUES("1", "1", "13", "0", "1", "1", "1", "root", "1", "1", "1", "1", "100", "0", "0", "1", "0");
INSERT INTO `xt_projects_steps` (`id`, `l`, `r`, `pid`, `level`, `tree_id`, `project_id`, `title`, `lead_id`, `executer_id`, `executer_type`, `position`, `budget`, `start_date`, `duration`, `controller_id`, `real_duration`) VALUES("2", "2", "3", "1", "2", "1", "1", "Entwurfsphase", "1", "1", "0", "0", "0", "0", "86400", "1", "172800");
INSERT INTO `xt_projects_steps` (`id`, `l`, `r`, `pid`, `level`, `tree_id`, `project_id`, `title`, `lead_id`, `executer_id`, `executer_type`, `position`, `budget`, `start_date`, `duration`, `controller_id`, `real_duration`) VALUES("3", "4", "10", "1", "2", "1", "1", "ddfasdf", "1", "1", "0", "0", "0", "0", "0", NULL, NULL);
INSERT INTO `xt_projects_steps` (`id`, `l`, `r`, `pid`, `level`, `tree_id`, `project_id`, `title`, `lead_id`, `executer_id`, `executer_type`, `position`, `budget`, `start_date`, `duration`, `controller_id`, `real_duration`) VALUES("4", "5", "9", "3", "3", "1", "1", "ddgdfsgdfg", "1", NULL, "0", "0", "0", "0", "0", NULL, NULL);
INSERT INTO `xt_projects_steps` (`id`, `l`, `r`, `pid`, `level`, `tree_id`, `project_id`, `title`, `lead_id`, `executer_id`, `executer_type`, `position`, `budget`, `start_date`, `duration`, `controller_id`, `real_duration`) VALUES("5", "7", "8", "4", "4", "1", "1", "fdsfsdf", NULL, NULL, "0", "0", "0", "0", "0", NULL, NULL);
INSERT INTO `xt_projects_steps` (`id`, `l`, `r`, `pid`, `level`, `tree_id`, `project_id`, `title`, `lead_id`, `executer_id`, `executer_type`, `position`, `budget`, `start_date`, `duration`, `controller_id`, `real_duration`) VALUES("6", "11", "12", "1", "2", "1", "1", "gerteter", NULL, NULL, "0", "0", "0", "0", "172800", NULL, "172800");
