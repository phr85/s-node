<?php

if(XT::getPermission('addChapter')){
    XT::addImageButton('Add chapter', 'addChapter',"document_new.png","0","slave1");
}

if(XT::getPermission('edit')){
    XT::addImageButton('[S]ave', 'saveArticle', 'down',"disk_blue.png","0","","s");
    if(XT::getValue('liveedit')!=true){
    XT::addImageButton('Save and [p]review', 'saveArticleAndPreview', 'down', 'view.png',"0","","p");
    }
    XT::addImageButton('Add [c]hapter', 'addChapter', 'down',"document_new.png","0","","c");
}

XT::assign('BUTTONSDOWN',$GLOBALS['plugin']->getButtons('down'));
XT::assign("LANGS", $GLOBALS['cfg']->getLangs());
XT::assign("ACTIVE_LANG", $GLOBALS['plugin']->getActiveLang());


// get available templates for the chapters
foreach (glob(TEMPLATE_DIR . '/default/ch.iframe.snode.articles/viewer/default/*.tpl') as $usertpls){
   $USER_TPL[trim(basename($usertpls))]= 'default';
}
foreach (glob(TEMPLATE_DIR . $_SESSION['theme'] . '/ch.iframe.snode.articles/viewer/default/*') as $usertpls){
    $USER_TPL[trim(basename($usertpls))]= $_SESSION['theme'];
}
XT::assign("USERTPL",$USER_TPL);


/**
* Set session variables
*/
if(is_numeric($GLOBALS['plugin']->getValue('id'))){
    $GLOBALS['plugin']->setSessionValue("id", $GLOBALS['plugin']->getValue('id'));
}

if(is_numeric($GLOBALS['plugin']->getSessionValue('id'))){
    // get the MAINFIELDS out of the database
    $result = XT::query("
        SELECT
            a.id,
            a.title,
            a.hide_title,
            a.subtitle,
            a.date,
            a.autor,
            a.introduction,
            a.maintext,
            a.creation_date,
            a.image,
            a.image_version,
            a.image_link,
            a.image_link_target,
            a.image_zoom,
            a.rid,
            a.published,
            a.active,
            a.lang,
            b.type as image_type,
            b.width,
            b.height,
            a.display_time_type,
            a.display_time_start,
            a.display_time_end
        FROM
            " . $GLOBALS['plugin']->getTable("articles_v") . " as a LEFT JOIN
            " . XT::getTable('files') . " as b ON (b.id = a.image)
        WHERE
            a.id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
            a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        ORDER BY
            a.rid DESC
        ",__FILE__,__LINE__);

    $data = array();
    while($row = $result->FetchRow()){
        if($row['image_version'] != ''){
            XT::assign("IMAGE_VERSION", '_' . $row['image_version']);
        }
        $data[] = $row;
    }
    XT::assign("ARTICLE", $data[0]);
    $article = $data[0];

    // Get the CHAPTERS out of the database
    $maxlevel = 0;
    $data = array();
    $chaptersthere = false;
    $result = XT::query("
        SELECT
            a.id,
            a.title,
            a.subtitle,
            a.maintext,
            a.image,
            a.image_version,
            a.image_link,
            a.image_link_target,
            a.image_zoom,
            a.active,
            a.layout,
            a.level,
            a.lang,
            b.type as image_type,
            b.width,
            b.height
        FROM
            " . $GLOBALS['plugin']->getTable("articles_chapters_v") . " as a LEFT JOIN
            " . XT::getTable('files') . " as b ON (b.id = a.image)
        WHERE
            a.id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
            a.rid = " . $article['rid'] . " AND
            a.lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        ORDER BY
            a.level"
    ,__FILE__,__LINE__);

    while($row = $result->FetchRow()){
        $maxlevel = $row['level'];
        $data[] = $row;
        $chaptersthere = true;
    }
    XT::assign("MAXLEVEL", $maxlevel);
    XT::assign("CHAPTERSTHERE", $chaptersthere);
    XT::assign("ARTICLECHAPTER", $data);

    // Images
    XT::assign("IMAGE_PICKER_TPL", $GLOBALS['plugin']->getConfig("image_picker_tpl"));
    XT::assign("IMAGE_PICKER_BASE_ID", $GLOBALS['plugin']->getConfig("image_picker_base_id"));

    // Get version history
    $result = XT::query("
        SELECT
            rid,
            title,
            creation_date,
            creation_user
        FROM
            " . $GLOBALS['plugin']->getTable("articles_v") . "
        WHERE
            id = " . $GLOBALS['plugin']->getSessionValue('id') . " AND
            lang = '" . $GLOBALS['plugin']->getActiveLang() . "'
        ORDER BY
            rid DESC
        LIMIT 10
    ",__FILE__,__LINE__);

    $data = array();
    while($row = $result->FetchRow()){
        $row['creation_user'] = XT::getUserName($row['creation_user']);
        $data[] = $row;
    }
    XT::assign("HISTORY", $data);


    // timer
    $time['type']=$article['display_time_type'];

    for ($i=0;$i<24;$i++){
        if($i == date('H',$article['display_time_start'])){
            $time['shour'][$i]=true;
        }else{
            $time['shour'][$i]=false;
        }
        if($i == date('H',$article['display_time_end'])){
            $time['ehour'][$i]=true;
        }else{
            $time['ehour'][$i]=false;
        }
    }

    for ($i=0;$i<60;$i= $i+5){
        if($i == intval(date('i',$article['display_time_start']))){
            $time['smin'][$i]=true;
        }else{
            $time['smin'][$i]=false;
        }
        if($i == intval(date('i',$article['display_time_end']))){
            $time['emin'][$i]=true;
        }else{
            $time['emin'][$i]=false;
        }
    }

    switch ($article['display_time_type']) {
    	case 0:
            $time['sdate']=0;
            $time['sdate_str']=0;
            $time['edate']=0;
            $time['edate_str']=0;
    		break;
		case 1:
		    $time['sdate']= $article['display_time_start'] > 0 ? $article['display_time_start'] : time();
            $time['sdate_str']=$article['display_time_start'] > 0 ? date('d.m.Y',$article['display_time_start']) : date('d.m.Y', time());
            $time['edate']=0;
            $time['edate_str']=0;
            break;
        case 2:
            $time['sdate']= 0;
            $time['sdate_str']=0;
            $time['edate']= $article['display_time_end'] > 0 ? $article['display_time_end'] : time();
            $time['edate_str']=$article['display_time_end'] > 0 ? date('d.m.Y',$article['display_time_end']) : date('d.m.Y', (time() + 86400));
            break;
        case 3:
            $time['sdate']= $article['display_time_start'] > 0 ? $article['display_time_start'] : time();
            $time['sdate_str']=$article['display_time_start'] > 0 ? date('d.m.Y',$article['display_time_start']) : date('d.m.Y', time());
            $time['edate']= $article['display_time_end'] > 0 ? $article['display_time_end'] : time();
            $time['edate_str']=$article['display_time_end'] > 0 ? date('d.m.Y',$article['display_time_end']) : date('d.m.Y', (time() + 86400));
            break;
    	default:
    	    $time['sdate']= $article['display_time_start'] > 0 ? $article['display_time_start'] : time();
            $time['sdate_str']=$article['display_time_start'] > 0 ? date('d.m.Y',$article['display_time_start']) : date('d.m.Y', time());
            $time['edate']= $article['display_time_end'] > 0 ? $article['display_time_end'] : time();
            $time['edate_str']=$article['display_time_end'] > 0 ? date('d.m.Y',$article['display_time_end']) : date('d.m.Y', (time() + 86400));

    		break;
    }


    XT::assign('TIME',$time);
    XT::assign('DATE_PICKER_TPL',305);
    XT::assign("LIVEEDIT", XT::getValue('liveedit'));

    $content = XT::build('edit.tpl');

} else {
    XT::log("No User ID set!",__FILE__,__LINE__);
}

?>