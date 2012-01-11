# MySQL-Front Dump 2.5
#
# Host: localhost   Database: xtreme
# --------------------------------------------------------
# Server version 4.1.10


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
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Dumping data for table 'xt_files'
#

INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("1", "Wireless Installation.doc", "1908456", NULL, NULL, "0", "0");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("7", "dwgpdf.exe", "1908456", "", "", "1117121799", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("6", "HTTP_WebDAV_Server-0.99.1.tgz", "24646", "", "", "1117121519", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("5", "GraphicServer_AAG.pdf", "58547", "", "", "1117121413", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("8", "adLDAP_1.1.zip", "5302", "", "", "1117121978", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("9", "11_1.jpg", "33935", "", "", "1117122118", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("10", "eclipse_org.psd", "1094807", "", "", "1117122172", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("11", "adLDAP_1.1.zip", "5302", "", "", "1117122327", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("12", "9-100.dxf", "404586", "", "", "1117122363", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("13", "cristuzzi.jpg", "359772", "", "", "1117122464", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("14", "franzosen.psd", "4229979", "", "", "1117122476", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("15", "franzosen.psd", "4229979", "", "", "1117122558", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("16", "Thunderbird Setup 1.0.2.exe", "6501605", "", "", "1117122681", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("17", "dwgpdf.exe", "1908456", "", "", "1117122916", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("18", "franzosen_startseite.jpg", "316948", "", "", "1117123014", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("19", "Chip_Kunde.doc", "36864", "", "", "1117123160", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("20", "9-100.pdf", "32278", "", "", "1117123302", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("21", "eclipse_org_v3.png", "53708", "", "", "1117123337", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("22", "document_active.png", "571", "", "", "1117123350", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("23", "HTTP_WebDAV_Server-0.99.1.tgz", "24646", "", "", "1117123373", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("24", "la31.deu.b955.msi", "7109120", "", "", "1117123426", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("25", "GraphicServer_AAG.pdf", "58547", "", "", "1117123470", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("26", "jfreechart-1.0.0-pre2.zip", "3853037", "", "", "1117123507", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("27", "dwg_pdf.exe", "5607424", "", "", "1117123532", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("28", "hundeschule.txt", "9932", "", "", "1117123669", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("29", "eclipse_org.png", "48821", "", "", "1117123697", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("30", "Tarifgruppen.doc", "42496", "", "", "1117123711", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("31", "document_active.png", "571", "", "", "1117123756", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("32", "franzosen.psd", "4229979", "", "", "1117123774", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("33", "cristuzzi.jpg", "359772", "", "", "1117123964", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("34", "Chip_Kunde.doc", "36864", "", "", "1117123971", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("35", "GraphicServer_AAG.pdf", "58547", "", "", "1117123987", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("36", "adLDAP_1.1.zip", "5302", "", "", "1117124032", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("37", "document_active.png", "571", "", "", "1117124091", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("38", "eclipse_org.png", "48821", "", "", "1117124664", "1");
INSERT INTO `xt_files` (`id`, `title`, `filesize`, `description`, `keywords`, `upload_date`, `upload_user`) VALUES("39", "9-100.pdf", "32278", "", "", "1117124712", "1");


#
# Table structure for table 'xt_files_rel'
#

DROP TABLE IF EXISTS `xt_files_rel`;
CREATE TABLE `xt_files_rel` (
  `node_id` int(11) unsigned default NULL,
  `file_id` int(11) unsigned default NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Dumping data for table 'xt_files_rel'
#

INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("3", "1");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("3", "6");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("3", "7");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("3", "8");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("3", "9");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("3", "10");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("3", "11");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("3", "12");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("3", "13");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("3", "14");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("3", "15");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("3", "16");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("3", "17");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("3", "18");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("27", "19");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("27", "20");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("27", "21");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("27", "22");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("27", "23");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("27", "24");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("27", "25");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("27", "26");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("27", "27");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("27", "28");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("27", "29");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("27", "30");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("27", "31");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("27", "32");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("27", "33");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("35", "34");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("35", "35");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("33", "36");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("35", "37");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("32", "38");
INSERT INTO `xt_files_rel` (`node_id`, `file_id`) VALUES("32", "39");


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
# Dumping data for table 'xt_files_tree'
#

INSERT INTO `xt_files_tree` (`id`, `l`, `r`, `pid`, `level`, `tree_id`) VALUES("1", "1", "16", "0", "1", "0");
INSERT INTO `xt_files_tree` (`id`, `l`, `r`, `pid`, `level`, `tree_id`) VALUES("2", "2", "3", "1", "2", "0");
INSERT INTO `xt_files_tree` (`id`, `l`, `r`, `pid`, `level`, `tree_id`) VALUES("3", "4", "11", "1", "2", "0");
INSERT INTO `xt_files_tree` (`id`, `l`, `r`, `pid`, `level`, `tree_id`) VALUES("32", "9", "10", "3", "3", "0");
INSERT INTO `xt_files_tree` (`id`, `l`, `r`, `pid`, `level`, `tree_id`) VALUES("27", "5", "8", "3", "3", "0");
INSERT INTO `xt_files_tree` (`id`, `l`, `r`, `pid`, `level`, `tree_id`) VALUES("33", "12", "15", "1", "2", "0");
INSERT INTO `xt_files_tree` (`id`, `l`, `r`, `pid`, `level`, `tree_id`) VALUES("34", "13", "14", "33", "3", "0");
INSERT INTO `xt_files_tree` (`id`, `l`, `r`, `pid`, `level`, `tree_id`) VALUES("35", "6", "7", "27", "4", "0");


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
  PRIMARY KEY  (`node_id`,`lang`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;



#
# Dumping data for table 'xt_files_tree_details'
#

INSERT INTO `xt_files_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("2", "de", "0", "0", "0", "0", "0", "Dies ist ein Testfile", "1", "0", "", "0");
INSERT INTO `xt_files_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("3", "de", "0", "0", "0", "0", "0", "Wichtige Dokumente", "1", "0", "", "1");
INSERT INTO `xt_files_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("32", "de", "0", "0", "0", "0", "0asdfsdf", "asdfsdf", "1", "0", "", "1");
INSERT INTO `xt_files_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("27", "de", "0", "0", "0", "0", "0", "asdfsdfasd", "1", "0", "", "1");
INSERT INTO `xt_files_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("27", "fr", "0", "0", "0", "0", "", "asdfsdfasdf", "0", "0", "", "1");
INSERT INTO `xt_files_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("32", "fr", "0", "0", "0", "0", "", "", "0", "0", "", "1");
INSERT INTO `xt_files_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("33", "de", "0", "0", "0", "0", "asdfsdfsd", "asdfsdfasdf", "1", "0", "", "1");
INSERT INTO `xt_files_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("33", "fr", "0", "0", "0", "0", "", "", "0", "0", "", "1");
INSERT INTO `xt_files_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("34", "de", "0", "0", "0", "0", "asdfsdfasdfsdf", "asdfsdfasdfsdf", "1", "0", "", "1");
INSERT INTO `xt_files_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("34", "fr", "0", "0", "0", "0", "", "", "0", "0", "", "1");
INSERT INTO `xt_files_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("35", "de", "0", "0", "0", "0", "", "Testordner 2", "1", "0", "", "1");
INSERT INTO `xt_files_tree_details` (`node_id`, `lang`, `creation_date`, `creation_user`, `mod_date`, `mod_user`, `description`, `title`, `active`, `download_count`, `md5`, `isFolder`) VALUES("35", "fr", "0", "0", "0", "0", "", "", "0", "0", "", "1");
