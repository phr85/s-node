<?php
if(XT::getValue('term') != ''){
	XT::loadClass('search.class.php','ch.iframe.snode.search');

	$search = new XT_Search();

	$search->setContentType(1200);
	$search->enableSoundex(true);
	$search->setLang(XT::getValue('lang_filter'));
	$inarray = $search->search_id(XT::getValue('term'));
	XT::assign("SEARCHTERM",XT::getValue('term'));

	// Get results
	if(is_array($inarray)){
		$result = XT::query("
            SELECT
                det.title,
                main.*
            FROM
                " . XT::getTable('articles_details') . " as det
            LEFT JOIN  " . XT::getTable('articles') . " as main on det.id = main.id
            WHERE
                det.lang = '" . XT::getPluginLang() . "' AND
                det.id IN (" . implode(",",$inarray) . ")
            GROUP BY
                id
        ",__FILE__,__LINE__,0);

		$results = array();
		while($row = $result->FetchRow()){
			$results[] = $row;
		}
	}

	XT::assign("ARTICLES", $results);
}


XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());

$content = XT::build('search_articles.tpl');

?>