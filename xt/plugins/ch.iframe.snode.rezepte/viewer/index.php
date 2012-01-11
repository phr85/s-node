<?php
// set And get session values


if(XT::getParam('id')){
    $GLOBALS['plugin']->setSessionValue('recipe_id',XT::getParam('id'));
    $GLOBALS['plugin']->setValue('recipe_id', XT::getParam('id'));
}

if(!XT::getValue('recipe_id')){
    $GLOBALS['plugin']->setValue('recipe_id', XT::getSessionValue('recipe_id'));
}else{
    $GLOBALS['plugin']->setSessionValue('recipe_id',XT::getValue('recipe_id'));
}


if (XT::getSessionValue('recipe_id') == ''){
    $GLOBALS['plugin']->setSessionValue('recipe_id', 0);
}

if(is_numeric(XT::getValue('portions'))){
    $GLOBALS['plugin']->setSessionValue('portions',XT::getValue('portions'));
    $data['portions'] = XT::getValue('portions');    
}else{
    $data['portions'] = XT::getSessionValue('portions');
}

// Ratings
$result = XT::query("select rating from xt_rezepte_rating where user_id= " . XT::getUserID() . " AND recipe_id= '" . XT::getSessionValue('recipe_id') . "'",__FILE__,__LINE__);
$values = XT::GetQueryData($result);
$data['rating'] = $values[0][rating];

//Recipe
$result = XT::query("
    SELECT
        ad.id,
        ad.title,
        ad.subtitle,
        ad.description,
        ad.active,
        ad.making,
        main.*
    FROM
        " . $GLOBALS['plugin']->getTable("r_details") . " as ad
    LEFT JOIN
        " . $GLOBALS['plugin']->getTable("rezepte") . " as main ON(main.id = ad.id)
    WHERE
        ad.lang='" . $GLOBALS['lang']->getLang() . "'
    AND
        ad.active=1
    AND
        main.id=" . XT::getSessionValue('recipe_id')
,__FILE__,__LINE__,$GLOBALS['plugin']->getParam("debug_sql"));

while ($row = $result->fetchRow()) {
    XT::addToTitle($row['title']);    
    $row['rating_avg_img'] = number_format(round(2 * $row['rating_avg'])/2,1,'_',"");
    $data['recipe'] = $row;
}


if(count($data['recipe'])>0){
    // ingridients
    $result = XT::query("
    SELECT 
        r2i.*, 
        un.standard,
        idet.* 
    FROM 
        " . XT::getTable('r2i') . "  as r2i
    LEFT JOIN 
        " . XT::getTable('i_details') . " as idet  on (r2i.ingridient_id = idet.id AND idet.lang='" . XT::getLang() . "')
    LEFT JOIN 
        " . XT::getTable('units') . "  as un  on (un.id = r2i.unit_id)
    WHERE 
        r2i.recipe_id=" . XT::getSessionValue('recipe_id') . " 
    ORDER 
        by r2i.position asc" ,__FILE__,__LINE__,0);

    while ($row = $result->fetchRow()) {
        if($data['portions'] > 0 && $data['recipe']['portions'] > 0){
            $row['unit_ammount_calc'] = ($row['unit_ammount'] * $data['portions']) / $data['recipe']['portions'];
        }
        $data['ingridients'][] = $row;
    }

}


XT::assign("DATA", $data);

// Fetch content
if($GLOBALS['plugin']->getParam("style") != ""){
    $style = $GLOBALS['plugin']->getParam("style");
}else{
    $style = "default.tpl";
}
$content = XT::build($style);
?>