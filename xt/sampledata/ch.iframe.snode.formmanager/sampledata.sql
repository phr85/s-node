insert into `{XT_PREFIX}forms` values (220,'Kontaktformular',1,'de','default.tpl','Nehmen Sie mit uns\r\nKontakt auf; wir stehen Ihnen gerne zur Verfügung und beantworten Ihre Anfrage schnellstmöglich.','',0);

insert into `{XT_PREFIX}forms_actions` values (1,220,2,'info@iframe.ch',1,'de','');
insert into `{XT_PREFIX}forms_actions` values (2,220,7,'10057',2,'de','');

insert into `{XT_PREFIX}forms_elements` values (1,8,220,1,0,'',0,'',NULL,0,'','','de','Persönliche Daten','','',0,NULL,NULL,'','',0);
insert into `{XT_PREFIX}forms_elements` values (2,3,220,2,0,'',0,'',NULL,2,'','','de','Anrede','','',0,NULL,NULL,'','anrede',0);
insert into `{XT_PREFIX}forms_elements` values (3,6,220,3,0,'',0,'',NULL,0,'','','de','Name / Vorname','','',0,2,NULL,'','',0);
insert into `{XT_PREFIX}forms_elements` values (4,1,220,4,1,'',0,'',NULL,0,'','','de','Name ','','',0,NULL,NULL,'','lastname',1);
insert into `{XT_PREFIX}forms_elements` values (5,1,220,5,1,'',0,'',NULL,0,'','','de','Vorname','','',0,NULL,NULL,'','firstname',1);
insert into `{XT_PREFIX}forms_elements` values (6,1,220,6,0,'',0,'',NULL,0,'','','de','Emailadresse','','',0,NULL,NULL,'','email',0);
insert into `{XT_PREFIX}forms_elements` values (7,8,220,7,0,'',0,'',NULL,0,'','','de','Optionale Angaben','','',0,NULL,NULL,'','',0);
insert into `{XT_PREFIX}forms_elements` values (8,6,220,8,0,'',0,'',NULL,0,'','','de','Strasse / Nr.','','',0,2,NULL,'','',0);
insert into `{XT_PREFIX}forms_elements` values (9,1,220,9,0,'',0,'',NULL,0,'','','de','Strasse','','',0,NULL,NULL,'','street',1);
insert into `{XT_PREFIX}forms_elements` values (10,1,220,10,0,'',0,'',NULL,0,'','','de','Nr.','','',0,4,NULL,'','street_nr',1);
insert into `{XT_PREFIX}forms_elements` values (11,6,220,11,0,'',0,'',NULL,0,'','','de','Plz / Ort','','',0,2,NULL,'','',0);
insert into `{XT_PREFIX}forms_elements` values (12,1,220,12,0,'',0,'',NULL,0,'','','de','Plz','','',0,4,NULL,'','zip',1);
insert into `{XT_PREFIX}forms_elements` values (13,1,220,13,0,'',0,'',NULL,0,'','','de','Ort','','',0,NULL,NULL,'','city',1);
insert into `{XT_PREFIX}forms_elements` values (14,2,220,14,0,'',0,'',NULL,3,'name','country','de','Land','CH','SELECT c.country,l.name FROM xt_countries as c LEFT JOIN xt_countries_detail as l on c.country = l.country Where l.lang=\'de\' ORDER BY l.name ASC',0,0,NULL,'','',0);
insert into `{XT_PREFIX}forms_elements` values (15,8,220,15,0,'',0,'',NULL,0,'','','de','Ihre Mitteilung','','',0,NULL,NULL,'','',0);
insert into `{XT_PREFIX}forms_elements` values (16,11,220,16,0,'',0,'',NULL,0,'','','de','Text','','',0,NULL,NULL,'cols=\"40\" rows=\"8\"','message',0);
insert into `{XT_PREFIX}forms_elements` values (17,12,220,17,0,'',0,'',NULL,0,'','','de','E-Mail-Kopie an Absender','1','',0,NULL,NULL,'','email_copy',0);


insert into `{XT_PREFIX}forms_elements_rules` values (220,4,'!=',1,'','',1,'','Rule',1,'de','Sie haben Ihren Namen nicht angegeben');
insert into `{XT_PREFIX}forms_elements_rules` values (220,5,'!=',1,'','',1,'','Rule',2,'de','Sie haben Ihren Vornamen nicht angegeben');
insert into `{XT_PREFIX}forms_elements_rules` values (220,6,'',4,NULL,NULL,NULL,'220','Rule',3,'de','');



insert into `{XT_PREFIX}forms_elements_values` values (1,2,'Frau','Frau',1);
insert into `{XT_PREFIX}forms_elements_values` values (2,2,'Herr','Herr',2);

insert into `{XT_PREFIX}forms_scripts` values (220,'Regel: E-Mail-Format überprüfen',NULL,NULL);
insert into `{XT_PREFIX}forms_scripts` values (222,'Regel: PLZ und Ort überprüfen',NULL,NULL);
insert into `{XT_PREFIX}forms_scripts` values (223,'Regel: Strasse und Nummer überprüfen',NULL,NULL);
insert into `{XT_PREFIX}forms_scripts` values (221,'Regel: Benutzername überprüfen',NULL,NULL);
insert into `{XT_PREFIX}forms_scripts` values (224,'Regel: Captcha pruefen',NULL,NULL);
insert into `{XT_PREFIX}forms_scripts` values (225,'Action: Datei an Emailadresse senden',NULL,NULL);
insert into `{XT_PREFIX}forms_scripts` values (3600,'Action: Benutzerregistrierung Forum',NULL,NULL);
insert into `{XT_PREFIX}forms_scripts` values (2402,'Action: Benutzerregistrierung Shop',NULL,NULL);
insert into `{XT_PREFIX}forms_scripts` values (2400,'Action: Adressdaten speichern Shop',NULL,NULL);
insert into `{XT_PREFIX}forms_scripts` values (2401,'Action: Adressdaten speichern Shop (Schritt 2)',NULL,NULL);
insert into `{XT_PREFIX}forms_scripts` values (2410,'PreAction: Adressdaten holen Shop',NULL,NULL);
