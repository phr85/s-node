<?php

if($_SESSION['user']['id'] != '') {

	if(XT::getValue('subscribe') == "true") {
	
		// Abfragen oder die E-Mail Adresse bereits vorhanden ist
		$result = XT::query("
			SELECT
				id
			FROM
				" . XT::getDatabasePrefix() . "newsletter_subscriptions
			WHERE
				email = '" . $_SESSION['user']['email'] . "'
		" ,__FILE__,__LINE__);
		
		$data = XT::getQueryData($result);
		
		if($data[0]['id'] != '') {
			$subscrid = $data[0]['id'];
		}
		else {
			$result = XT::query("
				SELECT
					id,
					firstName,
					lastName,
					company,
					email,
					gender,
					tel_mobile
				FROM
					" . XT::getDatabasePrefix() . "addresses
				WHERE
					user_id = " . $_SESSION['user']['id'] . " AND
					is_primary_user_address = 1
			" ,__FILE__,__LINE__);
			
			$data = XT::getQueryData($result);
			
			// Falls eine Adresse vorhanden ist und diese als primŠre Useradresse gesetzt Adressdaten nehmen
			if($data[0]['id'] != '') {
			
				if($data[0]['gender'] == 1) {
					$gender = 'Herr';
				}
				elseif($data[0]['gender'] == 2) {
					$gender = 'Frau';
				}
				else {
				    $gender = 'Unknown';
				}
				
				XT::query("
					INSERT INTO " . XT::getDatabasePrefix() . "newsletter_subscriptions (
						user_id,
						name,
						email,
						creation_date,
						creation_user,
						lang,
						anrede,
						company,
						firstName,
						lastName,
						mobile
					)
					VALUES (
						0,
						'" . $data[0]['lastName'] . " " . $data[0]['firstName'] ."',
						'" . $data[0]['email'] . "',
						'" . TIME . "',
						1,
						'" . $_SESSION['user']['lang'] . "',
						'" . $gender . "',
						'" . $data[0]['company'] . "',
						'" . $data[0]['firstName'] . "',
						'" . $data[0]['lastName'] . "',
						'" . $data[0]['tel_mobile'] . "'
					)" ,__FILE__,__LINE__);
			}
			// Falls keine Adresse vorhanden ist, die Userdaten nehmen
			else {
				XT::query("
					INSERT INTO " . XT::getDatabasePrefix() . "newsletter_subscriptions (
						user_id,
						name,
						email,
						creation_date,
						creation_user,
						lang
					)
					VALUES (
						0,
						'" . $_SESSION['user']['email'] . "',
						'" . $_SESSION['user']['email'] . "',
						'" . TIME . "',
						1,
						'" . $_SESSION['user']['lang'] . "'
					)" ,__FILE__,__LINE__);
			}
				
			// Die ID abfragen vom neuen Eintrag	
			$result = XT::query("
				SELECT
					id
				FROM
					" . XT::getDatabasePrefix() . "newsletter_subscriptions
				WHERE
					email = '" . $_SESSION['user']['email'] . "'
			" ,__FILE__,__LINE__);
		
			$data = XT::getQueryData($result);
			$subscrid = $data[0]['id'];
		}
		
		// Alle Abos entfernen
		XT::query("
			DELETE
			FROM
				" . XT::getDatabasePrefix() . "newsletter_subscr2cat
			WHERE
				subscription_id = " . $subscrid . "
		" ,__FILE__,__LINE__);
		
		if(is_array(XT::getValue('categories'))) {
			foreach(XT::getValue('categories') as $catid) {
			
				// Den Newsletter abonnieren
				XT::query("
					INSERT INTO " . XT::getDatabasePrefix() . "newsletter_subscr2cat (
						category_id,
						subscription_id,
						type
					) VALUES (
						" . $catid . ",
						" . $subscrid . ",
						0
					)
				" ,__FILE__,__LINE__);
				
			}
		}
		
	}
	
	// Parameter :: Style
	$style = XT::getParam('style') != '' ? XT::getParam('style') : 'default.tpl';
	
	$data = array();
	
	// Die E-Mail Adresse aus der Session auslesen
	$data['email'] = $_SESSION['user']['email'];
	
	// Alle Newsletterkategorien abfragen welche der User abonniert hat
	$result = XT::query("
		SELECT
			cat.id as id,
			cat.title as title
		FROM
			" . XT::getDatabasePrefix() . "newsletter_categories as cat
		LEFT JOIN
			" . XT::getDatabasePrefix() . "newsletter_subscr2cat as subscr2cat ON (subscr2cat.category_id = cat.id)
		LEFT JOIN
			" . XT::getDatabasePrefix() . "newsletter_subscriptions as sub ON (sub.id = subscr2cat.subscription_id)
		WHERE 
			sub.email = '" . $data['email'] ."'
	",__FILE__,__LINE__);
	
	$res = XT::getQueryData($result);
	
    $i = 0;
	
	// Die abonierten Kategorien $data['categories'] zuweisen
	foreach($res as $row) {
		$data['categories'][$i]['id'] = $row['id'];
		$data['categories'][$i]['title'] = $row['title'];
		$data['categories'][$i]['subscr'] = 1;
		$i++;
	}
	
	// Die Abfrage der nicht abonierten Kategorien vorbereiten und die abonierten Kategorien zaehlen
	if(!empty($res[0]['id'])) {
	
		$catcount = 0;
		foreach($res as $cat) {
			if($catcount == 0) {
				$where_of_query .= " WHERE id != " . $cat['id'];
			}
			else {
				$where_of_query .= " AND id != " . $cat['id'];
			}
			$catcount++;
		}
	
	}

    // Alle nicht abonierten Kategorien abfragen
	$result = XT::query("
		SELECT
			id,
			title
		FROM
			" . XT::getDatabasePrefix() . "newsletter_categories
			" . $where_of_query ."
	",__FILE__,__LINE__);
	
	
	$res = XT::getQueryData($result);
	
	// Die nicht abonierten Kategorien $data['categories'] zuweisen
	foreach($res as $row) {
		$data['categories'][$i]['id'] = $row['id'];
		$data['categories'][$i]['title'] = $row['title'];
		$data['categories'][$i]['subscr'] = 0;
		$i++;
	}
	
	//Sortierfunktion
	if(!function_exists("subscribe_fromaddressdb_order")) {
		function subscribe_fromaddressdb_order ($a,$b) {
			return strcmp($a['id'], $b['id']);
		}
	}
	
	// Den Array $data['categories'] nach id sortieren
	usort($data['categories'], "subscribe_fromaddressdb_order");
	
	XT::assign("xt" . XT::getBaseID() . "_subscribe_fromaddressdb", $data);
	
	$content = XT::build($style);
	
}

?>