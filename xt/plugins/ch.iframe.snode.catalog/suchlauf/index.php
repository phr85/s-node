<?php
// abgelaufene Adressen l�schen
$result = XT::query("delete from " . XT::getTable('suchabo') . " WHERE valid_to < " . time(), __FILE__,__LINE__);
$content .= XT::queryRowsAffected() . " addresses deleted <br />";
// Email klasse initialisieren
require_once(CLASS_DIR . "/phpmailer/class.phpmailer.php");


// gr�sste Artikel ID f�r addressupdate ermitteln
$result = XT::query("SELECT art.id FROM " . XT::getTable("articles") . " as art
LEFT JOIN " . XT::getTable("articles_details") . " as ad on(art.id = ad.id) 
WHERE ad.active=1 ORDER BY art.id DESC limit 1",__FILE__,__LINE__);
$data = $result->fetchRow();
$update['id'] = $data['id'];
$content .= $GLOBALS['lang']->msg('newest id') . " = " . $update['id'] . "<br />";
//Adressen f�r abarbeitung holen
$adresses = XT::query("SELECT * from " . XT::getTable('suchabo') . " WHERE email!='' AND last_search_id < " . $update['id'],__FILE__,__LINE__);

while ($addr = $adresses->fetchRow()) {
    // alte Filter wegwerfen
    unset($articlefilter);
    unset($nodefilter);

    // Filter bauen
    //node
    if($addr['filter_kategorie'] > 0){
        $nodefilter = " tar.node_id=" . $addr['filter_kategorie'] . " AND ";
    }
    // ort (1)
    if($addr['filter_ort'] != 'not' && $addr['filter_ort'] != ''){
        $articlefilter .= "
        INNER JOIN " . XT::getTable("fields_values") . " as vals1 
        ON (vals1.field_id=1 AND vals1.value='" . $addr['filter_ort'] . "' AND vals1.article_id = ad.id AND vals1.lang='" . $addr['lang'] . "') "; 
    }
    // zimmer (7)
    if($addr['filter_zimmer'] != 'not' && $addr['filter_zimmer'] != ''){
        $articlefilter .= "
        INNER JOIN " . XT::getTable("fields_values") . " as vals7 
        ON (vals7.field_id=7 AND vals7.value='" . $addr['filter_zimmer'] . "' AND vals7.article_id = ad.id AND vals7.lang='" . $addr['lang'] . "') "; 
    }
    // kauf (3)
    if($addr['filter_kauf'] != 'not' && $addr['filter_kauf'] != ''){
        $articlefilter .= "
        INNER JOIN " . XT::getTable("fields_values") . " as vals3 
        ON (vals3.field_id=3 AND vals3.value='" . $addr['filter_kauf'] . "' AND vals3.article_id = ad.id AND vals3.lang='" . $addr['lang'] . "') "; 
    }

    // Filter verwenden um neue objekte mit match vergleichen
    $result = XT::query("
        SELECT
            ad.id,
            img.image_id,
            img.image_version,
            ad.title,
            ad.lead,
            ad.description,
            ad.subtitle,
            ad.active,
            main.quantity,
            main.art_nr,
            tar.node_id
        FROM
            " . XT::getTable("articles_details") . " as ad LEFT JOIN
            " . XT::getTable("tree2articles") . " as tar ON(tar.article_id = ad.id) LEFT JOIN
            " . XT::getTable("images") . " as img ON (img.article_id = ad.id AND img.is_main_image = 1) LEFT JOIN
            " . XT::getTable("articles") . " as main ON(main.id = ad.id)
            " . $articlefilter . "
        WHERE
            " . $nodefilter . " 
            ad.lang='" . $addr['lang'] . "' AND
            ad.active=1
        AND
            ad.id > " . $addr['last_search_id'] . "
        AND
            main.edate > " . $addr['create_date'] . "
        ORDER by
            ad.id asc"
    ,__FILE__,__LINE__);

    $data = array();
    $content .= '<b>' . $addr['email'] . '</b><br />';
    $objects = 0;
    while ($row = $result->fetchRow()) {
        $data[$row['id']] = $row;
        $content .= $row['id'] . " : " . $row['title'] . '<br />';
        $objects ++;
    }
    $content .= $objects . " objekte<br /><br />";
    //Informationen an Adresse schicken
    if($objects >0){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->IsHTML(true);
        $mail->Encoding = '7bit';
        $mail->SetLanguage(XT::getLang(),CLASS_DIR . "/phpmailer/language/");
        $mail->FromName = $GLOBALS['cfg']->get("system","name");
        $mail->From = $GLOBALS['cfg']->get("system","email");
        $mail->Host = $GLOBALS['cfg']->get('smtp','Host');
        $mail->SMTPAuth = $GLOBALS['cfg']->get('smtp','SMTPAuth');
        if($GLOBALS['cfg']->get('smtp','SMTPAuth')){
            $mail->Username = $GLOBALS['cfg']->get('smtp','Username');
            $mail->Password = $GLOBALS['cfg']->get('smtp','Password');
        }

        XT::assign('DATA',$data);
        $mail->AddAddress($addr['email']);
        $mail->Subject  =  $GLOBALS['lang']->msg('Suchabo Subject');
        $mail->Body     =  XT::build('default_html.tpl');
        $mail->AltBody  =  XT::build('default_plain.tpl');

        if(!$mail->Send()){
            XT::log($mail->ErrorInfo,__FILE__,__LINE__,XT_ERROR);
        }
    }
    // adresse aktualisieren
    XT::query("UPDATE " . XT::getTable('suchabo') . " SET
    last_search_id = " . $update['id'] . ",
    last_search_date= " . time(),__FILE__,__LINE__);

}


?>