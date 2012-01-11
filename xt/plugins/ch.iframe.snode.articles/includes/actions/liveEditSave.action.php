<?php
	// explode auf idsrting Sprache_Artikel-id_Kapitel_id_identifier (damit es nicht mehrmals gleichnamige ID's gibt)
	$identifier = explode('_', XT::getValue('idstring'));

	// letze published Revision holen
	$latestRevision = XT::getQueryData(XT::query("select published from xt_articles_v where id='" . $identifier[1] . "' and lang='" . $identifier[0] . "' and latest = 1",__FILE__,__LINE__));
	if ($latestRevision[0]['published'] == 0) {
		// id setzen, damit publish-action weiss wo
		XT::setValue('id',$identifier[1]);
		// Admin-Sprache richtig setzen
		XT::setSessionValue('lang_filter',$identifier[0]);
		XT::call('publish');
	}

	// letze Revisions-Id holen
	$revid = XT::getQueryData(XT::query("select rid from xt_articles where id='" . $identifier[1] . "' and lang='" . $identifier[0] . "'",__FILE__,__LINE__));

	// Elementtyp ermittel
	switch(XT::getValue('elementtype')) {
		case 'articleintroduction':
			// Daten für introduction holen
			XT::query("update xt_articles set introduction='" . XT::getValue('articleintroduction') . "' where id='" . $identifier[1] . "' and lang='" . $identifier[0] . "'",__FILE__,__LINE__);
			XT::query("update xt_articles_v set introduction='" . XT::getValue('articleintroduction') . "' where id='" . $identifier[1] . "' and lang='" . $identifier[0] . "' and rid='" . $revid[0]['rid'] . "'",__FILE__,__LINE__);
			echo(stripslashes(XT::getValue('articleintroduction')));
			break;
		case 'articletitle':
			// Daten für title holen
			XT::query("update xt_articles set title='" . XT::getValue('articletitle') . "' where id='" . $identifier[1] . "' and lang='" . $identifier[0] . "'",__FILE__,__LINE__);
			XT::query("update xt_articles_v set title='" . XT::getValue('articletitle') . "' where id='" . $identifier[1] . "' and lang='" . $identifier[0] . "' and rid='" . $revid[0]['rid'] . "'",__FILE__,__LINE__);
			echo(stripslashes(XT::getValue('articletitle')));
			break;
		case 'articlesubtitle':
			// Daten für subtitle holen
			XT::query("update xt_articles set subtitle='" . XT::getValue('articlesubtitle') . "' where id='" . $identifier[1] . "' and lang='" . $identifier[0] . "'",__FILE__,__LINE__);
			XT::query("update xt_articles_v set subtitle='" . XT::getValue('articlesubtitle') . "' where id='" . $identifier[1] . "' and lang='" . $identifier[0] . "' and rid='" . $revid[0]['rid'] . "'",__FILE__,__LINE__);
			echo(stripslashes(XT::getValue('articlesubtitle')));
			break;
		case 'chaptermaintext':
			// Daten für chapter holen
			XT::query("update xt_articles_chapters set maintext='" . XT::getValue('chaptermaintext') . "' where id='" . $identifier[1] . "' and level='" . $identifier[2] . "' and lang='" . $identifier[0] . "'",__FILE__,__LINE__);
			XT::query("update xt_articles_chapters_v set maintext='" . XT::getValue('chaptermaintext') . "' where id='" . $identifier[1] . "' and level='" . $identifier[2] . "' and lang='" . $identifier[0] . "' and rid='" . $revid[0]['rid'] . "'",__FILE__,__LINE__);
			echo(stripslashes(XT::getValue('chaptermaintext')));
			break;
		case 'chaptertitle':
			// Daten für chapter title holen
			XT::query("update xt_articles_chapters set title='" . XT::getValue('chaptertitle') . "' where id='" . $identifier[1] . "' and level='" . $identifier[2] . "' and lang='" . $identifier[0] . "'",__FILE__,__LINE__);
			XT::query("update xt_articles_chapters_v set title='" . XT::getValue('chaptertitle') . "' where id='" . $identifier[1] . "' and level='" . $identifier[2] . "' and lang='" . $identifier[0] . "' and rid='" . $revid[0]['rid'] . "'",__FILE__,__LINE__);
			echo(stripslashes(XT::getValue('chaptertitle')));
			break;
		case 'chaptersubtitle':
			// Daten für chapter title holen
			XT::query("update xt_articles_chapters set subtitle='" . XT::getValue('chaptersubtitle') . "' where id='" . $identifier[1] . "' and level='" . $identifier[2] . "' and lang='" . $identifier[0] . "'",__FILE__,__LINE__);
			XT::query("update xt_articles_chapters_v set subtitle='" . XT::getValue('chaptersubtitle') . "' where id='" . $identifier[1] . "' and level='" . $identifier[2] . "' and lang='" . $identifier[0] . "' and rid='" . $revid[0]['rid'] . "'",__FILE__,__LINE__);
			echo(stripslashes(XT::getValue('chaptersubtitle')));
			break;
	}

	// artikel + kapitel für index holen
	$article = XT::getQueryData(XT::query("select display_time_start, display_time_end, date, subtitle, autor, maintext, image, title, introduction from xt_articles where id='" . $identifier[1] . "' and lang='" . $identifier[0] . "'",__FILE__,__LINE__));
	$chapter = XT::getQueryData(XT::query("select title, subtitle, maintext from xt_articles_chapters where id='" . $identifier[1] . "' and level='" . $identifier[2] . "' and lang='" . $identifier[0] . "'",__FILE__,__LINE__));

	// artikel + kapitel in index schreiben
	XT::loadClass("searchindex.class.php","ch.iframe.snode.search");
	$search = new XT_SearchIndex($identifier[1],$GLOBALS['plugin']->getContentType("Article"),1);
	$search->setLang($GLOBALS['plugin']->getActiveLang());
	$search->setTime($article[0]['display_time_start'],$article[0]['display_time_end']);
	$search->setManualDate($article[0]['date']);
	$search->add(addslashes($article[0]['subtitle']), 3);
	$search->add(addslashes($article[0]['autor']), 2);
	$search->add(addslashes($article[0]['maintext']), 1);
	$search->add(addslashes($chapter[0]['title']), 3);
	$search->add(addslashes($chapter[0]['subtitle']), 2);
	$search->add(addslashes($chapter[0]['maintext']), 1);
	$searchimage = $article[0]['image'] != "" ? $article[0]['image'] : 0;
	$search->build(addslashes($article[0]['title']), addslashes($article[0]['introduction']),$searchimage);