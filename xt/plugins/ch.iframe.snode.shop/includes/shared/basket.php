<?php

$basket['sum'] = 0;
$basket['articles'] = 0;
unset($in);
foreach ($_SESSION['BASKET'] as $key => $value){
	$basket['sum'] += $value['price'] * $value['quantity'];
	$basket['articles'] += $value['quantity'];
	$in .= ', ' . $key;
	$basketarticles[$key] = $value;
	$basketarticles[$key]['title'] = $value;
}

$in = substr($in,1);
$result = XT::query("SELECT
                a.title,
                a.id,
                p.price,
                ma.art_nr
              FROM
                   " . $GLOBALS['plugin']->getTable('catalog_articles_details') . " as a
               LEFT JOIN
                   " . $GLOBALS['plugin']->getTable("price") . " as p ON (p.article_id = a.id)
               LEFT JOIN
                   " . $GLOBALS['plugin']->getTable("catalog_articles") . " as ma ON (ma.id = a.id)
               WHERE
                   a.id in (" . $in . ")
               AND
                   lang='" . XT::getLang() . "'"
,__FILE__,__LINE__,0);

while($row = $result->FetchRow()){


	// basket nach staffelpreisen durchgehen
$preis = 0;

	// Preis holen (Staffelpreise checken)
	$staffel = XT::getQueryData(XT::query("SELECT pcs,price from " . XT::getTable("staffelpreise") . " WHERE article_id= " .  $row['id'],__FILE__,__LINE__),"pcs");

	foreach ($staffel as $sp) {
		if($basketarticles[$row['id']]['quantity']  >= $sp['pcs']){
			$preis = $sp['price'];
		}
	}
	if($preis > 0){
		echo $row['price'] = $preis;
	}else {
		
	}

	$basketarticles[$row['id']]['title'] = $row['title'];
	$basketarticles[$row['id']]['price'] = $row['price'];	
	//sidebasket aktualisieren
	$_SESSION['BASKET'][$row['id']]['price'] = $row['price'];
	$basketarticles[$row['id']]['art_nr'] = $row['art_nr'];
	$basketarticles[$row['id']]['asum'] =  $row['price'] * $basketarticles[$row['id']]['quantity'];
	$totalprice += $row['price'] * $basketarticles[$row['id']]['quantity'];



}


// Discounts
$result = XT::query("SELECT
                d.id,
                d.value,
                d.give_discount_at,
                d.in_percent,
                d.for_single_article
              FROM
                   " . $GLOBALS['plugin']->getTable('discounts_articles') . " as da
               LEFT JOIN
                   " . $GLOBALS['plugin']->getTable("discounts") . " as d ON (d.id = da.discount_id)
               WHERE
                   da.article_id in (" . $in . ")
               ORDER by
                   d.in_percent asc, d.value desc
                   "
,__FILE__,__LINE__,0);

while($row = $result->FetchRow()){
	$disc[$row['id']]['value'] = $row['value'];
	$disc[$row['id']]['min'] = $row['give_discount_at'];
	$disc[$row['id']]['percent'] = $row['in_percent'];

	$subresult = XT::query("SELECT
                  article_id
              FROM
                   " . $GLOBALS['plugin']->getTable('discounts_articles') . "
              WHERE
                   discount_id =" . $row['id']
	,__FILE__,__LINE__,0);
	while($subrow = $subresult->FetchRow()){
		$disc[$row['id']]['articles'][$subrow['article_id']] = $subrow['article_id'];
	}
}
foreach ($_SESSION['BASKET'] as $key => $val){
	$virtbasket[$key] = $val['quantity'];
}
if(is_array($disc)){
	//check matches
	foreach ($disc as $discount_id => $val){
		// for single articles
		foreach ($val['articles'] as $article_id => $article){
			if(array_key_exists($article_id,$virtbasket)){
				$disc[$discount_id]['cnt'] += $virtbasket[$article_id];
			}
		}
	}
	//check matches
	foreach ($disc as $discount_id => $val){
		// for single articles
		foreach ($val['articles'] as $article_id => $article){
			if(array_key_exists($article_id,$virtbasket)){
				// wenn anzahl f�r rabatt erreicht
				if($disc[$discount_id]['cnt'] >= $disc[$discount_id]['min']){
					// Rabatt vergeben nach % oder w�hrung
					if($disc[$discount_id]['percent'] ==1 ){
						$DISCOUNT += $basketarticles[$article_id]['asum'] / 100 * $disc[$discount_id]['value'];
						$basketarticles[$article_id]['discount'] += ($basketarticles[$article_id]['asum'] / 100 * $disc[$discount_id]['value']);
						$basketarticles[$article_id]['pricediscount'] = ($basketarticles[$article_id]['price'] / 100 * $disc[$discount_id]['value']);
						$virtbasket[$article_id] = 0;
					}else{
						$DISCOUNT += $virtbasket[$article_id] * $disc[$discount_id]['value'];
						$basketarticles[$article_id]['discount'] += ($virtbasket[$article_id] * $disc[$discount_id]['value']);
						$basketarticles[$article_id]['pricediscount'] = $disc[$discount_id]['value'];
					}
					// rabatt als gematcht setzen
					$disc[$discount_id]['matched'] = 1;
					// Artikel reduzieren
					$virtbasket[$article_id] = $virtbasket[$article_id] - $disc[$discount_id]['min'];
				}
				if($virtbasket[$article_id] < 1){
					unset($virtbasket[$article_id]);
				}
			}
		}
	}
}



// promos
$result = XT::query("SELECT
                d.id,
                d.give_discount_at,
                d.kummulierbar
              FROM
                   " . $GLOBALS['plugin']->getTable('promo_articles') . " as da
               LEFT JOIN
                   " . $GLOBALS['plugin']->getTable("promo") . " as d ON (d.id = da.discount_id)
               WHERE
                   da.article_id in (" . $in . ")

                   "
,__FILE__,__LINE__,0);

while($row = $result->FetchRow()){
	$promo[$row['id']]['min'] = $row['give_discount_at'];
	$promo[$row['id']]['kummulierbar'] = $row['kummulierbar'];

	$subresult = XT::query("SELECT
                  article_id
              FROM
                   " . $GLOBALS['plugin']->getTable('promo_articles') . "
              WHERE
                   discount_id =" . $row['id']
	,__FILE__,__LINE__,0);
	while($subrow = $subresult->FetchRow()){
		$promo[$row['id']]['articles'][$subrow['article_id']] = $subrow['article_id'];
	}
}
foreach ($_SESSION['BASKET'] as $key => $val){
	$virtbasket[$key] = $val['quantity'];
}
if(is_array($promo)){
	foreach ($promo as $promo_id => $val){
		// Anzahl Treffer auf die Promo ermitteln
		foreach ($val['articles'] as $article_id => $article){
			if(array_key_exists($article_id,$virtbasket)){
				$promo[$promo_id]['cnt'] += $virtbasket[$article_id];
			}
		}
	}
	// Anzahl der Promogeschenke ermitteln
	foreach ($promo as $promo_id => $val){
		// wenn die mindestzahl erreicht wurde
		if($promo[$promo_id]['cnt'] >= $promo[$promo_id]['min']){
			// Wenn Kummulierbar, anzahl der promogeschenke zuweisen ,ansonsten nur 1 geschenk geben
			if($promo[$promo_id]['kummulierbar']){
				$anzahl = floor($promo[$promo_id]['cnt']/$promo[$promo_id]['min']);
			}else {
				$anzahl = 1;
			}
			$promo[$promo_id]['anzahl'] = $anzahl;

			// Artikel details der Promos holen
			//promos

			$result = XT::query("SELECT
                    artdet.id,
                	artdet.lang,
                	artdet.title,
                	artdet.lead,
                	artimage.image_id as image
                    FROM
                    " . XT::getTable('promo_gifts') . " as promogift
                    INNER JOIN " . XT::getTable('catalog_articles_details') . " as artdet ON promogift.article_id = artdet.id AND artdet.lang='" . XT::getLang() . "'
                	LEFT JOIN " . XT::getTable("catalog_images") . " as artimage ON promogift.article_id = artimage.article_id AND artimage.is_main_image = 1
                    WHERE promogift.discount_id = " . $promo_id
			,__FILE__,__LINE__);
			while($row = $result->FetchRow()){
				$GIVENPROMO[$row['id']] = $row;
				$GIVENPROMO[$row['id']]['quantity'] = $promo[$promo_id]['anzahl'];
			}
		}
	}
}

$total_tmp = $totalprice - $DISCOUNT + getTransportCost(($totalprice - $DISCOUNT));
XT::assign("GIVENPROMO", $GIVENPROMO);
XT::assign("TRANSPORTCOST", getTransportCost(($totalprice - $DISCOUNT)));
XT::assign("DISCOUNTPRICE", $DISCOUNT);

XT::assign("ENDPRICE", $totalprice - $DISCOUNT + getTransportCost(($totalprice - $DISCOUNT)));
XT::assign("ENDPRICEINC", $totalprice - $DISCOUNT + getTransportCost(($totalprice - $DISCOUNT)) + ($total_tmp * $GLOBALS['plugin']->getConfig("taxvalue")/100));

XT::assign("TOTALPRICE", $totalprice);
XT::assign("BASKET", $basket);

XT::assign("TAXES", $total_tmp * $GLOBALS['plugin']->getConfig("taxvalue")/100);
XT::assign("BASKETARTICLES", $basketarticles);
if(isset($errormessage)){
	XT::assign("ERRORMESSAGE", $errormessage);
}
$_SESSION['ORDER']['transport'] = getTransportCost(($totalprice - $DISCOUNT));
$_SESSION['ORDER']['discount'] = $DISCOUNT;
$_SESSION['ORDER']['totalprice'] = $totalprice;
$_SESSION['ORDER']['endprice'] = $totalprice - $DISCOUNT + getTransportCost(($totalprice - $DISCOUNT));
$_SESSION['ORDER']['taxes'] = ($totalprice - $DISCOUNT + getTransportCost(($totalprice - $DISCOUNT))) / 100 * $GLOBALS['plugin']->getConfig("taxvalue");
$_SESSION['ORDER']['endpriceinc'] = $totalprice - $DISCOUNT + getTransportCost(($totalprice - $DISCOUNT)) + ($total_tmp - ($total_tmp / (100 + $GLOBALS['plugin']->getConfig("taxvalue")) * 100));

$price = $totalprice - $DISCOUNT + getTransportCost(($totalprice - $DISCOUNT));
?>