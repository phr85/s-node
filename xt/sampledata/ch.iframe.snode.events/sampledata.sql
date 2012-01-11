INSERT INTO `{XT_PREFIX}forms_elements` VALUES (NULL,1,5100,1,1,'',0,'',NULL,0,'','','de','Name','','',0,0,NULL,'','lastName',0);
INSERT INTO `{XT_PREFIX}forms_elements` VALUES (NULL,1,5100,2,1,'',0,'',NULL,0,'','','de','Vorname','','',0,0,NULL,'','firstName',0);
INSERT INTO `{XT_PREFIX}forms_elements` VALUES (NULL,1,5100,3,1,'',0,'',NULL,0,'','','de','Strasse / Nr','','',0,0,NULL,'','street',0);
INSERT INTO `{XT_PREFIX}forms_elements` VALUES (NULL,1,5100,4,1,'',0,'',NULL,0,'','','de','Postleitzahl','','',0,0,NULL,'','postalCode',0);
INSERT INTO `{XT_PREFIX}forms_elements` VALUES (NULL,1,5100,5,1,'',0,'',NULL,0,'','','de','Ort','','',0,0,NULL,'','city',0);
INSERT INTO `{XT_PREFIX}forms_elements` VALUES (NULL,1,5100,6,1,'',0,'',NULL,0,'','','de','Telefon','','',0,0,NULL,'','tel',0);
INSERT INTO `{XT_PREFIX}forms_elements` VALUES (NULL,1,5100,7,1,'',0,'',NULL,0,'','','de','E-Mail','','',0,0,NULL,'','email',0);
INSERT INTO `{XT_PREFIX}forms_elements` VALUES (NULL,12,5100,8,0,'',0,'',NULL,0,'','','de','event_id','get:event_id','',0,0,NULL,'','event_id',0);

INSERT INTO `{XT_PREFIX}forms` VALUES (  '5100',  'Event Anmeldung',  '1',  'de',  'default.tpl',  '',  'eventreg',0 );

INSERT INTO `{XT_PREFIX}forms_actions` VALUES (NULL,5100,3,'5100',1,'de');

insert into `{XT_PREFIX}forms_scripts` values (5100,'Action: Eventmanager Anmeldung',NULL,NULL);